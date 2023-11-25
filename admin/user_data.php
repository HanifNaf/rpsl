<?php
require_once("../config/config.php");
require_once(SITE_ROOT . "/src/koneksi.php");
require_once(SITE_ROOT."/src/header-admin.php");

// Fetch user data
$userID = $_SESSION['id'];
$query = "SELECT users_id, username, role
          FROM users
          WHERE users_id = :userID";
$prep = $koneksi_users->prepare($query);

try {
    $prep->execute(array(":userID" => $userID));
    $userData = $prep->fetch(PDO::FETCH_ASSOC);

    if ($userData) {
        // Display user data in a container
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>View User Data</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                }

                .container {
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                    max-width: 400px;
                    width: 100%;
                }

                h2 {
                    text-align: center;
                    color: #333;
                }

                form {
                    display: flex;
                    flex-direction: column;
                }

                label {
                    margin-bottom: 8px;
                }

                input {
                    padding: 8px;
                    margin-bottom: 16px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                }

                a {
                    text-align: center;
                    color: #007bff;
                    text-decoration: none;
                    cursor: pointer;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>User Data</h2>
                <form>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?= htmlspecialchars($userData['username']) ?>" readonly>

                    <label for="role">Role:</label>
                    <input type="text" id="role" name="role" value="<?= htmlspecialchars($userData['role']) ?>" readonly>

                    <!-- Add more fields as needed -->

                    <a href="../public/index.php">Back to Home</a>
                </form>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "User data not found.";
    }
} catch (PDOException $e) {
    echo "PDO ERROR: " . $e->getMessage();
}
?>
