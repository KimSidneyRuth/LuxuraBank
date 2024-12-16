<?php
// Include the database connection file
include 'connection.php';

// Set error reporting (if needed for debugging; otherwise, comment these out)
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Process POST requests only
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acc_no = intval($_POST['acc_no']);
    $depositAmount = intval($_POST['amount']);
    $accountType = 'savings';
    $status = "active";
    $transaction_type = "Withdraw";

    // Validate required fields
    if (empty($acc_no) || empty($depositAmount)) {
        echo "<script>alert('Account Number and Withdraw Amount are required');</script>";
        exit;
    }

    // Check if the user already has an account
    $getUser = $con->prepare("SELECT account_no, Balance FROM user WHERE account_no = ?");
    $getUser->bind_param("i", $acc_no);
    $getUser->execute();
    $result = $getUser->get_result();

    if ($result->num_rows > 0) {
        // Update the balance if the account exists
        $user = $result->fetch_assoc();
        $newBalance = floatval($user['Balance']) - floatval($depositAmount);

        if ($newBalance < 0) {
            echo "<script>alert('Insufficient balance! Current balance: " . $user['Balance'] . "');</script>";
        } else {
            $updateDeposit = $con->prepare("UPDATE user SET Balance = ? WHERE account_no = ?");
            if (!$updateDeposit) {
                echo "<script>alert('Error preparing update statement: " . $con->error . "');</script>";
                exit;
            }
            $message = "Withdrawn".$depositAmount.", available balance remaining: ".$newBalance;

            $updateDeposit->bind_param("ii", $newBalance, $acc_no);
            if ($updateDeposit->execute()) {
                echo "<script>alert('Balance updated successfully. New Balance: " . $newBalance . "');</script>";
            } else {
                echo "<script>alert('Error updating balance: " . $updateDeposit->error . "');</script>";
            }




            $stmt = $con->prepare("INSERT INTO transaction (account_no, transaction_type, message) VALUES (?, ?, ?)");
            if (!$stmt) {
                echo "<script>alert('Error preparing insert statement: " . $con->error . "');</script>";
                exit;
            }
    
            $stmt->bind_param("iss", $acc_no, $transaction_type, $message);
            if ($stmt->execute()) {
               
            } else {
                echo "<script>alert('Error inserting account: " . $stmt->error . "');</script>";
            }
    
            $stmt->close();



            $updateDeposit->close();
        }
    } else {
        // Insert a new account if it does not exist
        $stmt = $con->prepare("INSERT INTO user (account_no, Balance, acc_status) VALUES (?, ?, ?)");
        if (!$stmt) {
            echo "<script>alert('Error preparing insert statement: " . $con->error . "');</script>";
            exit;
        }

        $stmt->bind_param("iis", $acc_no, $depositAmount, $status);
        if ($stmt->execute()) {
            echo "<script>alert('Withdraw successfully. Amount: " . $depositAmount . "');</script>";
        } else {
            echo "<script>alert('Error inserting account: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    }

    $getUser->close();
}

// Close the database connection
$con->close();
?>
