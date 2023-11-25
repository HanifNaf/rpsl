<?php
require_once("../config/config.php");
require_once(SITE_ROOT . "/src/koneksi.php");
require_once(SITE_ROOT."/src/header-admin.php");

// Retrieve user data based on the session information
$userId = $_SESSION['id'];
$query = "SELECT users_id, username, role FROM users WHERE users_id = :userId;";
$prep = $koneksi_users->prepare($query);

try {
    $prep->execute(array(":userId" => $userId));
    $userData = $prep->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "PDO ERROR: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .dashboard-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        p {
            margin: 10px 0;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <h1>Welcome, <?php echo $userData['username']; ?>!</h1>
        <form>
            <label>Your User ID:</label>
            <p><?php echo $userData['users_id']; ?></p>

            <label>Your Role:</label>
            <p><?php echo $userData['role']; ?></p>

            <!-- Add more user information as needed -->

            <a href="logout.php">Logout</a>
        </form>
    </div>
</body>

</html>
