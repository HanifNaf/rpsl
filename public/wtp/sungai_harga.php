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
    $edit_query = "SELECT a.attname, pg_get_expr(d.adbin, d.adrelid) AS default_value
                FROM   pg_catalog.pg_attribute    a
                LEFT   JOIN pg_catalog.pg_attrdef d ON (a.attrelid, a.attnum) = (d.adrelid, d.adnum)
                WHERE  NOT a.attisdropped           
                AND    a.attnum   > 0               
                AND    pg_get_expr(d.adbin, d.adrelid) IS NOT NULL
                AND    a.attrelid = 'public.sungai'::regclass;";

    $prepare_edit = $koneksi_wtp->prepare($edit_query);
    $prepare_edit->execute();

    $roData = $prepare_edit->fetchAll(PDO::FETCH_ASSOC);

    // Pivot boilerData Array
    $pivotedArray = [];

    // loop setiap elemen array
    foreach ($roData as $row) {
        // set attname sebagai key dan default_value sebagai valuenya
        $pivotedArray[$row['attname']] = $row['default_value'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        .custom-black-bg {
            background-color: #228B22;
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
                        <td><input type="number" name="koagulan" value="<?= $pivotedArray['cost_koagulan'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Soda Ash</td>
                        <td><input type="number" name="soda" value="<?= $pivotedArray['cost_soda_ash'] ?>" class="form-control" width=20% required></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Harga Flokulan</td>
                        <td><input type="number" name="flokulan" value="<?= $pivotedArray['cost_flokulan'] ?>" class="form-control" width=20% required></td>
                    </tr>
                </table>
                <div class="form-group text-center" style="margin-top: 10px;">
                    <button type="submit" name="update" class="btn btn-primary"><i class="fas fa-save"></i> Update Data</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['update'])) {

        //Sanitize user inputed value
        $koagulan = filter_var($_POST['koagulan'], FILTER_VALIDATE_INT);
        $soda = filter_var($_POST['soda'], FILTER_VALIDATE_INT);
        $flokulan = filter_var($_POST['flokulan'], FILTER_VALIDATE_INT);

        // Check if the values are valid integers
        if (
            $koagulan === false ||
            $soda === false||
            $flokulan === false
        ) {
            // Handle invalid input
            echo "Invalid input detected.";
            exit;
        }

        // Query
        $query = "ALTER TABLE sungai
                ALTER COLUMN cost_koagulan SET DEFAULT $koagulan,
                ALTER COLUMN cost_soda_ash SET DEFAULT $soda,
                ALTER COLUMN cost_flokulan SET DEFAULT $flokulan;";

        try {
            $koneksi_wtp->beginTransaction();
            $koneksi_wtp->exec($query);
            $koneksi_wtp->commit();

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
            $koneksi_wtp->rollBack();
        } finally {
            echo pg_result_error();
        }
    }
    ?>
</body>

</html>
