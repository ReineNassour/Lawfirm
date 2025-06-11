<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['user']) && isset($_POST['code'])) {
    $id = $_SESSION['user']['id'];
    $code = $_POST['code'];

    include "db.php";
    $query = "SELECT * FROM verification_code WHERE user_id = $id ORDER BY ID DESC LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $cdt = new DateTime("now");
        $cdt = $cdt->format('Y-m-d H:i:s');
        $edt = $row['expires_at'];

        if ($cdt < $edt) {
            $dbCode = $row['Code'];
            if ($code == $dbCode) {
                $_SESSION['user']['status'] = "Unrestricted";
                $query2 = "UPDATE `user` SET status = 'Unrestricted' WHERE id = $id";
                $conn->query($query2);
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Wrong verification code']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'The code has expired. Please request a new code.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'No verification code found. Please request a new code.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
    exit;
}
