<?php
require_once("../config/config.php");
require_once(SITE_ROOT . "/src/koneksi.php");
require_once(SITE_ROOT."/src/header-admin.php");

// Retrieve user data based on the session information
$userId = $_SESSION['id'];
$query = "SELECT users_id, username, role, password FROM users WHERE users_id = :userId;";
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

<div class="container mt-4">
    <div class="row">
        <div class="container">
            <h3 class="mb-4">DATA USER</h3>
            <div class="float-right">
                <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Ubah">
                    <a href="user_edit.php?id=<?=$userData['users_id']?>">
                        <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                            <path fill="#FFFFFF" d="M5,3C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V12H19V19H5V5H12V3H5M17.78,4C17.61,4 17.43,4.07 17.3,4.2L16.08,5.41L18.58,7.91L19.8,6.7C20.06,6.44 20.06,6 19.8,5.75L18.25,4.2C18.12,4.07 17.95,4 17.78,4M15.37,6.12L8,13.5V16H10.5L17.87,8.62L15.37,6.12Z" />
                        </svg>
                    </a>
                </button>
            </div>
            <br><hr>
        </div>
        <div class="table-responsive table-responsive-md table-responsive-sm table-responsive-lg">
            <table class="table table-striped table-condensed">
                <tr class="green-header">
                    <th>Username</th>
                    <td><input type="text" value="<?php echo $userData['username']; ?>" class='form-control' readonly></td>
                </tr>
                <tr class="green-header">
                    <th>Password</th>
                    <td>
                        <div class="password-container">
                        <input type="password" value="<?php echo $userData['password']; ?>" class='form-control' id='passwordInput' readonly>
                        <i class="password-toggle fas fa-eye" onclick="togglePassword()"></i>
                    </div>
                    </td>
                </tr>
                <tr class="green-header">
                    <th>Role</th>
                    <td><input type="role" value="<?php echo $userData['role']; ?>" class='form-control' readonly></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>