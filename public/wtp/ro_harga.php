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
                WHERE TABLE_NAME = 'ro' AND TABLE_SCHEMA = 'rpsl';";

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
                <h2 style="display: flex; float: left;">EDIT DATA HARGA CHEMICAL RO</h2>
            </div>
        </div>
        <br>

        <div class="table-responsive-sm table-responsie-md table-responsive-lg">
            <form action="" method="post" id="myForm" enctype="multipart/form-data">

                <!-- Display existing data for editing -->
                <table class="table table-hover table-bordered table-sm">
                    <tr>
                        <td class="custom-black-bg">Harga Treatment Anti Scalant</td>
                        <td><input type="number" name="anti" value="<?= $pivotedArray['cost_anti_scalant'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Alkalinity Booster</td>
                        <td><input type="number" name="alkalinity" value="<?= $pivotedArray['cost_alkalinity_booster'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Asam S4241</td>
                        <td><input type="number" name="asam-s" value="<?= $pivotedArray['cost_asam_s4241'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Asam Hcl</td>
                        <td><input type="number" name="asam-h" value="<?= $pivotedArray['cost_asam_hcl'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Basa S4243</td>
                        <td><input type="number" name="basa-s" value="<?= $pivotedArray['cost_basa_s4243'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Basa Caustik</td>
                        <td><input type="number" name="basa-c" value="<?= $pivotedArray['cost_basa_caustik'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Cartridge 30<sup>"</sup></td>
                        <td><input type="number" name="cartridge-30" value="<?= $pivotedArray['cost_cartridge_30'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Cartridge 40<sup>"</sup></td>
                        <td><input type="number" name="cartridge-40" value="<?= $pivotedArray['cost_cartridge_40'] ?>" class="form-control" width=20% required></td>
                    </tr>
                </table>
                <div class="form-group text-center" style="margin-top: 10px;">
                    <button type="submit" name="update" class="btn btn-primary"><i class="fas fa-save"></i> Update Data</button>
                    <a href="ro" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> CANCEL</a>
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['update'])) {

        //Sanitize user inputed value
        $anti = filter_var($_POST['anti'], FILTER_VALIDATE_INT);
        $alkalinity = filter_var($_POST['alkalinity'], FILTER_VALIDATE_INT);
        $asam_s = filter_var($_POST['asam-s'], FILTER_VALIDATE_INT);
        $asam_h = filter_var($_POST['asam-h'], FILTER_VALIDATE_INT);
        $basa_s = filter_var($_POST['basa-s'], FILTER_VALIDATE_INT);
        $basa_c = filter_var($_POST['basa-c'], FILTER_VALIDATE_INT);
        $cart_30 = filter_var($_POST['cartridge-30'], FILTER_VALIDATE_INT);
        $cart_40 = filter_var($_POST['cartridge-40'], FILTER_VALIDATE_INT);

        // Check if the values are valid integers
        if (
            $anti === false ||
            $alkalinity === false||
            $asam_s === false ||
            $asam_h === false ||
            $basa_s === false ||
            $basa_c === false ||
            $cart_30 === false ||
            $cart_40 === false
        ) {
            // Handle invalid input
            echo "Invalid input detected.";
            exit;
        }

        // Query
        $query = "ALTER TABLE ro
                ALTER COLUMN cost_anti_scalant SET DEFAULT $anti,
                ALTER COLUMN cost_alkalinity_booster SET DEFAULT $alkalinity,
                ALTER COLUMN cost_asam_s4241 SET DEFAULT $asam_s,
                ALTER COLUMN cost_asam_hcl SET DEFAULT $asam_h,
                ALTER COLUMN cost_basa_s4243 SET DEFAULT $basa_s,
                ALTER COLUMN cost_basa_caustik SET DEFAULT $basa_c,
                ALTER COLUMN cost_cartridge_30 SET DEFAULT $cart_30,
                ALTER COLUMN cost_cartridge_40 SET DEFAULT $cart_40;";

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
                            window.location.href = 'ro';
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
