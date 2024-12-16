<?php
// Include the database connection file
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acc_no = intval($_POST['acc_no']);
    $depositAmount = intval($_POST['amount']); 
    $accountType = 'savings';
    $status = "active";
    $transaction_type = "Deposit";
   

    if (empty($acc_no) || empty($depositAmount)) {
        echo "<script>alert('Account Number and Deposit Amount are required');</script>";
        exit;
    }

    $getUser = $con->prepare("SELECT account_no, Balance FROM user WHERE account_no = ?");
    $getUser->bind_param("i", $acc_no);
    $getUser->execute();
    $result = $getUser->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $newBalance = floatval($depositAmount) + floatval($user['Balance']); 

        $updateDeposit = $con->prepare("UPDATE user SET Balance = ? WHERE account_no = ?");
        if (!$updateDeposit) {
            echo "<script>alert('Error preparing update statement: " . $con->error . "');</script>";
            exit;
        }
        $message = "Deposited".$depositAmount.", available balance remaining: ".$newBalance;

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
    } else {
        $stmt = $con->prepare("INSERT INTO user (account_no, Balance, acc_status) VALUES (?, ?, ?)");
        if (!$stmt) {
            echo "<script>alert('Error preparing insert statement: " . $con->error . "');</script>";
            exit;
        }

        $stmt->bind_param("iis", $acc_no, $depositAmount, $status);
        if ($stmt->execute()) {
            echo "<script>alert('Deposit added successfully. Initial Balance: " . $depositAmount . "');</script>";
        } else {
            echo "<script>alert('Error inserting account: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    }

    $getUser->close();
}

$con->close();
?>
