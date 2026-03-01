<?php
require "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_SESSION['id'] ?? 0;

    if (!$user_id) {
        $error = "User tidak valid.";
    } elseif (!isset($_POST['activities'])) {
        $error = "Data aktivitas tidak ditemukan.";
    } else {

        $activities = json_decode($_POST['activities'], true);

        if (!is_array($activities)) {
            $error = "Format data aktivitas tidak valid.";
        } else {

            // Validasi angka
            $total = 0;
            foreach ($activities as $hours) {
                $total += (float)$hours;
            }

            if ($total != 24) {
                $error = "Total jam harus tepat 24 jam.";
            } else {

                $today = date("Y-m-d");

                // Cek session hari ini
                $stmt = $conn->prepare(
                    "SELECT id FROM monitoring_sessions 
                     WHERE user_id = ? AND monitor_date = ?"
                );
                $stmt->bind_param("is", $user_id, $today);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {

                    $row = $result->fetch_assoc();
                    $session_id = $row['id'];

                    // Hapus detail lama
                    $stmtDelete = $conn->prepare(
                        "DELETE FROM monitoring_details WHERE session_id = ?"
                    );
                    $stmtDelete->bind_param("i", $session_id);
                    $stmtDelete->execute();

                } else {

                    // Insert session baru
                    $stmtInsert = $conn->prepare(
                        "INSERT INTO monitoring_sessions (user_id, monitor_date) 
                         VALUES (?, ?)"
                    );
                    $stmtInsert->bind_param("is", $user_id, $today);
                    $stmtInsert->execute();

                    $session_id = $stmtInsert->insert_id;
                }

                $_SESSION['monitor_session_id'] = $session_id;

                // Insert detail
                $stmtDetail = $conn->prepare(
                    "INSERT INTO monitoring_details 
                     (session_id, activity_name, hours) 
                     VALUES (?, ?, ?)"
                );

                foreach ($activities as $name => $hours) {

                    $hours = (float)$hours;

                    if ($hours > 0) {
                        $stmtDetail->bind_param("isd", $session_id, $name, $hours);
                        $stmtDetail->execute();
                    }
                }

                header("Location: qna.php");
                exit;
            }
        }
    }
}
?>  