<?php
// Include database connection
include "sampleCon.php";

function getUserPoints($userId) {
    global $con;
    $stmt = $con->prepare("SELECT points FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['points'] ?? 0;
}

function updateUserPoints($userId, $points) {
    global $con;
    $stmt = $con->prepare("UPDATE users SET points = points + ? WHERE id = ?");
    $stmt->execute([$points, $userId]);
}

function getRecentTransactions() {
    global $con;
    $stmt = $con->query("SELECT user_id, points, date FROM transactions ORDER BY date DESC LIMIT 10");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getTotalPointsAwarded() {
    global $con;
    $stmt = $con->query("SELECT SUM(points) AS total_points FROM transactions");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total_points'] ?? 0; // Return 0 if no data
}

function getActiveUsersCount() {
    global $con;
    $stmt = $con->query("SELECT COUNT(DISTINCT user_id) AS active_users FROM transactions");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['active_users'] ?? 0; // Return 0 if no data
}

// Handle point awarding
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['award_points'])) {
    $userId = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_STRING);
    $points = filter_input(INPUT_POST, 'points', FILTER_VALIDATE_INT);
    $goal = filter_input(INPUT_POST, 'goal', FILTER_VALIDATE_INT);

    if ($userId && $points && $goal) {
        $currentPoints = getUserPoints($userId);
        if ($currentPoints >= $goal) {
            try {
                updateUserPoints($userId, $points);
                $stmt = $con->prepare("INSERT INTO transactions (user_id, points, date) VALUES (?, ?, NOW())");
                $stmt->execute([$userId, $points]);
                $message = "Points awarded successfully!";
            } catch (Exception $e) {
                $message = "Database error: " . $e->getMessage();
            }
        } else {
            $message = "User has not reached the goal yet.";
        }
    } else {
        $message = "Invalid input. Please try again.";
    }
}

$totalPoints = getTotalPointsAwarded();
$activeUsers = getActiveUsersCount();
$recentTransactions = getRecentTransactions();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Banking Admin - Pointing System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .card h2 {
            margin-top: 0;
            color: #444;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        #pointsForm {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
        }
        #pointsForm input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Online Banking Admin - Pointing System</h1>
        <div class="dashboard">
            <div class="card">
                <h2>Total Points Awarded</h2>
                <p id="totalPoints"><?php echo htmlspecialchars($totalPoints); ?></p>
            </div>
            <div class="card">
                <h2>Active Users</h2>
                <p id="activeUsers"><?php echo htmlspecialchars($activeUsers); ?></p>
            </div>
            <div class="card">
                <h2>Award Points</h2>
                <form id="pointsForm" method="POST">
                    <input type="text" name="user_id" placeholder="User ID" required>
                    <input type="number" name="points" placeholder="Points to Award" required>
                    <input type="number" name="goal" placeholder="Goal to Achieve" required>
                    <button type="submit" name="award_points" class="btn">Award Points</button>
                </form>
            </div>
        </div>
        <div class="card">
            <h2>Recent Point Transactions</h2>
            <table id="transactionsTable">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Points</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentTransactions as $transaction): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($transaction['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($transaction['points']); ?></td>
                        <td><?php echo htmlspecialchars($transaction['date']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    <?php if (!empty($message)): ?>
        alert("<?php echo addslashes($message); ?>");
    <?php endif; ?>
    </script>
</body>
</html>
