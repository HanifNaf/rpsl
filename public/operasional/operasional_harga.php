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
                    window.location.href = '../operasional/operasional.php';
                });
            </script>
        ";
    }

    require_once("operasional_data.php");
    require_once(SITE_ROOT."/src/header-admin.php");
    require_once(SITE_ROOT."/src/footer-admin.php");
    require_once(SITE_ROOT."/src/koneksi.php");

    // Retrieve Data for Editing
    $edit_query = "SELECT COLUMN_NAME, COLUMN_DEFAULT
                FROM information_schema.columns
                WHERE TABLE_NAME = 'pemakaian_bahan_bakar' AND TABLE_SCHEMA = 'rpsl';";

    $prepare_edit = $koneksi->prepare($edit_query);
    $prepare_edit->execute();

    $data = $prepare_edit->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($data);

    // Pivot boilerData Array
    $pivotedArray = [];

    // loop setiap elemen array
    foreach ($data as $row) {
        // set attname sebagai key dan default_value sebagai valuenya
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
                <h4 style="display: flex; float: left;">EDIT DATA HARGA BAHAN BAKAR</h4>
            </div>
        </div>
        <br>

        <div class="table-responsive-sm table-responsie-md table-responsive-lg">
            <form action="" method="post" id="myForm" enctype="multipart/form-data">
                <table class="table table-hover table-bordered table-sm">
                    <tr>
                        <td class="custom-black-bg">Harga Cangkang</td>
                        <td><input type="number" name="cangkang" value="<?= $pivotedArray['rpkg_cangkang'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Palm Fiber</td>
                        <td><input type="number" name="palm_fiber" value="<?= $pivotedArray['rpkg_palmfiber'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Wood Chips</td>
                        <td><input type="number" name="wood_chips" value="<?= $pivotedArray['rpkg_woodchips'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Serbuk Kayu</td>
                        <td><input type="number" name="serbuk_kayu" value="<?= $pivotedArray['rpkg_serbukkayu'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga EFB Press</td>
                        <td><input type="number" name="efb" value="<?= $pivotedArray['rpkg_efbpress'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga OPT</td>
                        <td><input type="number" name="opt" value="<?= $pivotedArray['rpkg_opt'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Sabut Kelapa</td>
                        <td><input type="number" name="sabut_kelapa" value="<?= $pivotedArray['rpkg_sabutkelapa'] ?>" class="form-control" width=20% required></td>
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

        //Selesaikan

        //Sanitize user inputed value
        $cangkang = filter_var($_POST['cangkang'], FILTER_VALIDATE_INT);
        $palm_fiber = filter_var($_POST['palm_fiber'], FILTER_VALIDATE_INT);
        $wood_chips = filter_var($_POST['wood_chips'], FILTER_VALIDATE_INT);
        $serbuk_kayu = filter_var($_POST['serbuk_kayu'], FILTER_VALIDATE_INT);
        $sabut_kelapa = filter_var($_POST['sabut_kelapa'], FILTER_VALIDATE_INT);
        $efb = filter_var($_POST['efb'], FILTER_VALIDATE_INT);
        $opt = filter_var($_POST['opt'], FILTER_VALIDATE_INT);

        // Check if the values are valid integers
        if (
            $cangkang === false ||
            $palm_fiber === false ||
            $wood_chips === false ||
            $serbuk_kayu === false ||
            $sabut_kelapa === false ||
            $efb === false ||
            $opt === false
        ) {
            // Handle invalid input
            echo "Invalid input detected.";
            exit;
        }

        try {
            // Query
            $query = "ALTER TABLE pemakaian_bahan_bakar 
                    ALTER COLUMN rpkg_cangkang SET DEFAULT $cangkang,
                    ALTER COLUMN rpkg_palmfiber SET DEFAULT $palm_fiber,
                    ALTER COLUMN rpkg_woodchips SET DEFAULT $wood_chips,
                    ALTER COLUMN rpkg_serbukkayu SET DEFAULT $serbuk_kayu,
                    ALTER COLUMN rpkg_sabutkelapa SET DEFAULT $sabut_kelapa,
                    ALTER COLUMN rpkg_efbpress SET DEFAULT $efb,
                    ALTER COLUMN rpkg_opt SET DEFAULT $opt;";

        

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
                            window.location.href = 'operasional.php';
                        }
                    });
                  </script>";
        } catch (PDOException $e) {
            echo "PDO ERROR: " . $e->getMessage();
            
            $koneksi -> rollBack();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();

            $koneksi -> rollBack();
        }
    }
    ?>
</body>

</html>
