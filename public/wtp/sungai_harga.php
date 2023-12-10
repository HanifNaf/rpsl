<?php
require_once("../../config/config.php");

// Check role
if (!in_array($_SESSION['role'], ['wtp', 'admin'])) {
    echo "<p style='color: white;'>Akses Dibatasi. Anda tidak memiliki izin yang cukup.</p>";

    // Add SweetAlert script for a more attractive notification
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Dibatasi',
                text: 'Anda tidak memiliki izin yang cukup.',
            }).then(function() {
                window.location.href = '../boiler/boiler.php';
            });
        </script>
    ";
}

require_once("wtp_data.php");
require_once(SITE_ROOT . "/src/header-admin.php");
require_once(SITE_ROOT . "/src/footer-admin.php");
require_once(SITE_ROOT . "/src/koneksi.php");

// Retrieve Data for Editing
$edit_query = "SELECT COLUMN_NAME, COLUMN_DEFAULT
                FROM information_schema.columns
                WHERE TABLE_NAME = 'sungai' AND TABLE_SCHEMA = 'rpsl';";

$prepare_edit = $koneksi->prepare($edit_query);
$prepare_edit->execute();

$roData = $prepare_edit->fetchAll(PDO::FETCH_ASSOC);

// Pivot sungaiData Array
$pivotedArray = [];

// loop through each array element
foreach ($roData as $row) {
    // set attname as key and default_value as its value
    $pivotedArray[$row['COLUMN_NAME']] = $row['COLUMN_DEFAULT'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        .custom-black-bg {
            background-color: #2ca143;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Import JS Sweet Alert -->
        <script src="../js/sweetalert2.all.min.js"></script>

        <div class="row">
            <div class="col-md-6 col-sm-12 col">
                <h2 style="display: flex; float: left;">EDIT DATA HARGA CHEMICAL SUNGAI</h2>
            </div>
        </div>
        <br>

        <div class="table-responsive-sm table-responsie-md table-responsive-lg">
            <form action="" method="post" id="myForm" enctype="multipart/form-data">

                <!-- Display existing data for editing -->
                <table class="table table-hover table-bordered table-sm">
                    <tr>
                        <td class="custom-black-bg">Harga Koagulan</td>
                        <td><input type="number" name="koagulan" value="<?= htmlspecialchars($pivotedArray['cost_koagulan']) ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Soda Ash</td>
                        <td><input type="number" name="soda" value="<?= htmlspecialchars($pivotedArray['cost_soda_ash']) ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Flokulan</td>
                        <td><input type="number" name="flokulan" value="<?= htmlspecialchars($pivotedArray['cost_flokulan']) ?>" class="form-control" width=20% required></td>
                    </tr>
                </table>
                <div class="form-group text-center" style="margin-top: 10px;">
                    <button type="submit" name="update" class="btn btn-primary"><i class="fas fa-save"></i> UPDATE DATA</button>
                    <a href="sungai" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> CANCEL</a>
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['update'])) {
        try {
            // Sanitize user input values
            $koagulan = filter_var($_POST['koagulan'], FILTER_VALIDATE_INT);
            $soda = filter_var($_POST['soda'], FILTER_VALIDATE_INT);
            $flokulan = filter_var($_POST['flokulan'], FILTER_VALIDATE_INT);

            // Check if the values are valid integers
            if ($koagulan === false || $soda === false || $flokulan === false) {
                // Handle invalid input
                echo "Invalid input detected.";
                exit;
            }

            // Query using prepared statements to prevent SQL injection
            $query = "ALTER TABLE sungai
                    ALTER COLUMN cost_koagulan SET DEFAULT $koagulan,
                    ALTER COLUMN cost_soda_ash SET DEFAULT $soda,
                    ALTER COLUMN cost_flokulan SET DEFAULT $flokulan;";

           $koneksi->exec($query);

            echo "<script>
                    Swal.fire({
                        title: 'Data Updated!',
                        text: 'Data has been updated successfully.',
                        type: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = 'sungai';
                        }
                    });
                  </script>";
        } catch (PDOException $e) {
            echo "PDO ERROR: " . $e->getMessage();
            $koneksi->rollBack();
        }
    }
    ?>
</body>

</html>
