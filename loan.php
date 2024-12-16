<?php


include 'connection.php';

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = intval($_POST['id']); 
    $loanAmount = intval($_POST['loanAmount']); 
    
    $fullName = $con->real_escape_string($_POST['fullName']);
    $income = floatval($_POST['income']);
    $employmentStatus = $con->real_escape_string($_POST['employmentStatus']);
  
    $loanPurpose = $con->real_escape_string($_POST['loanPurpose']);
    $rate = 15; // Fixed rate of 15%
    $transaction_type ="Loan";
    $status = "active";

    $totalLoanAmount = $loanAmount + ($loanAmount * ($rate / 100));

    // Validate required fields
    if (empty($userId) || empty($loanAmount)) {
        echo "<script>alert('User ID and Loan Amount are required');</script>";
        exit;
    }

    // Check if the user already has an account
    $getUser = $con->prepare("SELECT userId, Balance FROM user WHERE userId = ?");
    $getUser->bind_param("i", $userId);
    $getUser->execute();
    $result = $getUser->get_result();

    if ($result->num_rows > 0) {
        // Update the balance if the account exists
        $user = $result->fetch_assoc();
        $newBalance = floatval($loanAmount) + floatval($user['Balance']); // Add the loan amount to the current balance

        $updateLoan = $con->prepare("UPDATE user SET Balance = ? WHERE userId = ?");
        if (!$updateLoan) {
            echo "<script>alert('Error preparing update statement: " . $con->error . "');</script>";
            exit;
        }
        $message = "Loan Ammount: ".$loanAmount;

        $updateLoan->bind_param("ii", $newBalance, $userId);
        if ($updateLoan->execute()) {
            echo "<script>alert('Loan processed successfully. New Balance: " . $newBalance . "');</script>";
        } else {
            echo "<script>alert('Error updating balance: " . $updateLoan->error . "');</script>";
        }

        

        $stmt = $con->prepare("INSERT INTO loans (userId, name, annual_income, employmentStatus, amount, total_amount, loan_purpose, rate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo "<script>alert('Error preparing statement: " . $con->error . "');</script>";
        exit;
    }

    $stmt->bind_param(
        "isdsddsi",
        $userId,
        $fullName,
        $income,
        $employmentStatus,
        $loanAmount,
        $totalLoanAmount,
        $loanPurpose,
        $rate
    );

    if ($stmt->execute()) {
        echo "<script>alert('Loan application submitted successfully. Total Loan Amount: " . $totalLoanAmount . "');</script>";
    } else {
        echo "<script>alert('Error processing application: " . $stmt->error . "');</script>";
    }

    $stmt->close();

        $stmt = $con->prepare("INSERT INTO transaction (userId, transaction_type, message) VALUES (?, ?, ?)");
        if (!$stmt) {
            echo "<script>alert('Error preparing insert statement: " . $con->error . "');</script>";
            exit;
        }

        $stmt->bind_param("iss", $userId, $transaction_type, $message);
        if ($stmt->execute()) {
           
        } else {
            echo "<script>alert('Error inserting account: " . $stmt->error . "');</script>";
        }

        $stmt->close();


        $updateLoan->close();
    } else {
        // Insert a new account if it does not exist
        $stmt = $con->prepare("INSERT INTO user (userId, Balance, acc_status) VALUES (?, ?, ?)");
        if (!$stmt) {
            echo "<script>alert('Error preparing insert statement: " . $con->error . "');</script>";
            exit;
        }

        $stmt->bind_param("iis", $userId, $loanAmount, $status);
        if ($stmt->execute()) {
            echo "<script>alert('Account created and loan processed successfully. Initial Balance: " . $loanAmount . "');</script>";
        } else {
            echo "<script>alert('Error inserting account: " . $stmt->error . "');</script>";
        }

        $stmt->close();
    }

    $getUser->close();
} else {
    echo "<script>alert('Invalid request method');</script>";
}

$con->close();




?>
