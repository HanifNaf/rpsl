<?php
    require_once("../../config/config.php");

    // Cek role
    if (!in_array($_SESSION['role'], ['wtp', 'admin'])) {
        echo "<p style='color: white;'>Akses Dibatasi. Anda tidak memiliki izin yang cukup.</p>";

        // Menambahkan skrip SweetAlert untuk notifikasi yang lebih menarik
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
    require_once(SITE_ROOT."/src/header-admin.php");
    require_once(SITE_ROOT."/src/footer-admin.php");
    require_once(SITE_ROOT."/src/koneksi.php");

    // Retrieve Data for Editing
    $edit_query = "SELECT COLUMN_NAME, COLUMN_DEFAULT
                FROM information_schema.columns
                WHERE TABLE_NAME = 'boiler' AND TABLE_SCHEMA = 'rpsl';";

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
                <h4 style="display: flex; float: left;">EDIT DATA HARGA CHEMICAL BOILER</h4>
            </div>
        </div>
        <br>

        <div class="table-responsive-sm table-responsie-md table-responsive-lg">
            <form action="" method="post" id="myForm" enctype="multipart/form-data">
                <table class="table table-hover table-bordered table-sm">
                    <tr>
                        <td class="custom-black-bg">Harga Alkalinity Booster</td>
                        <td><input type="number" name="alkalinity_booster" value="<?= $pivotedArray['cost_alkalinity_booster'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Oxygen Scavenger</td>
                        <td><input type="number" name="oxygen_scavenger" value="<?= $pivotedArray['cost_oxygen_scavenger'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Internal Treatment</td>
                        <td><input type="number" name="internal_treatment" value="<?= $pivotedArray['cost_internal_treatment'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Condensate Treatment</td>
                        <td><input type="number" name="condensate_treatment" value="<?= $pivotedArray['cost_condensate_treatment'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Solid Additive</td>
                        <td><input type="number" name="solid_additive" value="<?= $pivotedArray['cost_solid_additive'] ?>" class="form-control" width=20% required></td>
                    </tr>
                </table>
                <div class="form-group text-center" style="margin-top: 10px;">
                    <button type="submit" name="update" class="btn btn-primary"><i class="fas fa-save"></i> UPDATE DATA</button>
                    <a href="boiler" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> CANCEL</a>
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['update'])) {

        //Sanitize user inputed value
        $alkalinity_booster = filter_var($_POST['alkalinity_booster'], FILTER_VALIDATE_INT);
        $oxygen_scavenger = filter_var($_POST['oxygen_scavenger'], FILTER_VALIDATE_INT);
        $internal_treatment = filter_var($_POST['internal_treatment'], FILTER_VALIDATE_INT);
        $condensate_treatment = filter_var($_POST['condensate_treatment'], FILTER_VALIDATE_INT);
        $solid_additive = filter_var($_POST['solid_additive'], FILTER_VALIDATE_INT);

        // Check if the values are valid integers
        if (
            $alkalinity_booster === false ||
            $oxygen_scavenger === false ||
            $internal_treatment === false ||
            $condensate_treatment === false ||
            $solid_additive === false
        ) {
            // Handle invalid input
            echo "Invalid input detected.";
            exit;
        }

        // Query
        $query = "ALTER TABLE boiler 
                ALTER COLUMN cost_alkalinity_booster SET DEFAULT $alkalinity_booster,
                ALTER COLUMN cost_oxygen_scavenger SET DEFAULT $oxygen_scavenger,
                ALTER COLUMN cost_internal_treatment SET DEFAULT $internal_treatment,
                ALTER COLUMN cost_condensate_treatment SET DEFAULT $condensate_treatment,
                ALTER COLUMN cost_solid_additive SET DEFAULT $solid_additive;";

        try {
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
                            window.location.href = 'boiler';
                        }
                    });
                  </script>";
        } catch (PDOException $e) {
            echo "PDO ERROR: " . $e->getMessage();
            
            echo "PDO ERROR: ". $e -> getMessage();
                echo "SQLSTATE: " . $errorInfo[0] . "<br>";
                echo "Code: " . $errorInfo[1] . "<br>";
                echo "Message: " . $errorInfo[2] . "<br>";

                $koneksi -> rollBack();
        }
    }
    ?>
</body>

</html>
