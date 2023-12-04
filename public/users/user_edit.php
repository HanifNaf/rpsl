<?php
require_once("../../config/config.php");
require_once(SITE_ROOT . "/src/koneksi.php");
require_once(SITE_ROOT."/src/header-admin.php");

// Retrieve user data based on the session information
$userId = $_SESSION['id'];
$query = "SELECT users_id, username, password FROM users WHERE users_id = :userId;";
$prep = $koneksi->prepare($query);

try {
    $prep->execute(array(":userId" => $userId));
    $userData = $prep->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "PDO ERROR: " . $e->getMessage();
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ubah"])) {
    // Sanitize input
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $passwordbaru = filter_input(INPUT_POST, "passwordbaru", FILTER_SANITIZE_STRING);

    // Update the user data in the database
    $updateQuery = "UPDATE users SET username = :username";
    
    // Check if a new password is provided
    if (!empty($passwordbaru)) {
        $updateQuery .= ", password = :password";
    }
    
    $updateQuery .= " WHERE users_id = :userId;";
    
    $updatePrep = $koneksi->prepare($updateQuery);

    try {
        $updatePrep->bindParam(":username", $username, PDO::PARAM_STR);
        
        // Check if a new password is provided
        if (!empty($passwordbaru)) {
            // Hash the new password before updating
            $hashedPassword = password_hash($passwordbaru, PASSWORD_DEFAULT);
            $updatePrep->bindParam(":password", $hashedPassword, PDO::PARAM_STR);
        }
        
        $updatePrep->bindParam(":userId", $userId, PDO::PARAM_INT);
        $updatePrep->execute();

        // Redirect to a success page or perform other actions
        header("Location: success.php");
        exit();
    } catch (PDOException $e) {
        echo "PDO ERROR: " . $e->getMessage();
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom style for green table header */
        .table th {
            background-color: #28a745; /* Change this to the desired shade of green */
            color: #ffffff; /* Text color for better contrast */
        }

        .password-container {
            display: flex;
            align-items: center; /* Vertically align items in the center */
        }
        
        .password-toggle {
            cursor: pointer;
            margin-left: 10px; /* Adjust margin as needed */
        }
    </style>

    <script>
    function togglePassword() {
        var passwordInput = document.getElementById("passwordInput");
        var passwordToggle = document.querySelector(".password-toggle");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordToggle.classList.remove("fa-eye");
            passwordToggle.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            passwordToggle.classList.remove("fa-eye-slash");
            passwordToggle.classList.add("fa-eye");
        }
    }
    </script>

    <title>Your Page Title</title>
</head>

<body>
    <form action="" method="POST">
        <div class="container">
            <div class="row">
                <div class="container">
                    <h3 style="display: flex; float: left;">EDIT DATA USER</h3>
                    <br><hr>
                </div>
                <div class="table-responsive table-responsive-md table-responsive-sm table-responsive-lg">
                    <table class="table table-hover table-condensed">
                        <tr>
                            <th>Username</th>
                            <td><input type="text" class="form-control" name="username" value="<?php echo $userData['username']; ?>"></td>
                        </tr>
                        <tr>
                            <th>Password Baru</th>
                            <td>
                                <div class="password-container">
                                    <input type="password" class="form-control" name="passwordbaru" placeholder="Masukkan Password Baru Anda" id="passwordInput">
                                    <i class="password-toggle fas fa-eye" onclick="togglePassword()"></i>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div style="display: flex; justify-content: space-between; margin: 0 auto;">
                    <button type="submit" data-toggle="tooltip" data-placement="top" title="Ubah" class="btn btn-primary" name="ubah"><b>UPDATE</b></button>
                    <a href="user_data" class="btn btn-secondary"><b>CANCEL</b></a>
                </div>
            </div>
        </div>
    </form>
</body>

</html>