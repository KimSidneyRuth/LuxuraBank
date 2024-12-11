
<?php
include "connection.php";

if (!$con) {
    die("Could not connect: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user inputs
    $id = mysqli_real_escape_string($con, $_POST['id']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Query to fetch admin credentials
    $query = "SELECT id, password FROM admin LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Check if the entered credentials match the admin credentials
        if ($id == $row['id'] && $password == $row['password']) {
            // Valid credentials, redirect to the dashboard
            $_SESSION['id'] = $id;
            header('Location: admin-dash.php');
            exit();
        } else {
            // Incorrect credentials
            $errorMessage = "Incorrect id or Password";
        }

        // Free the result set
        mysqli_free_result($result);
    } else {
        // Error fetching admin credentials
        $errorMessage = "Error fetching admin credentials";
    }

    // Close the database connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- Add your CSS styling here -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .login-container {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            box-sizing: border-box;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }

        .login-button {
            background-color: #d4bee4;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        .login-button:hover {
            background-color: #F3B75B;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    
    <div class="login-container">
        
        <h1 style="text-align: center;">Admin Login</h1>

        <?php if (isset($errorMessage)) { ?>
            <p class="error-message"><?php echo $errorMessage; ?></p>
        <?php } ?>

        <form method="post" action="">
            <label for="username">User ID:</label>
            <input type="text" name="id" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit" class="login-button">Login</button>
        </form>
    </div>
</body>
</html>
