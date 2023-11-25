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
if (isset($_GET['boiler_id'])) {
    $boiler_id = $_GET['boiler_id'];

    $edit_query = "SELECT boiler_id, tanggal, alkalinity_booster, oxygen_scavenger, 
        internal_treatment, condensate_treatment, m3_air,
        cost_alkalinity_booster, cost_oxygen_scavenger, 
        cost_internal_treatment,cost_condensate_treatment, solid_additive, cost_solid_additive
        FROM chemical_boiler WHERE boiler_id = ?;";

    $prepare_edit = $koneksi_wtp->prepare($edit_query);
    $prepare_edit->bindParam(1, $boiler_id, PDO::PARAM_INT);
    $prepare_edit->execute();

    $boilerData = $prepare_edit->fetch(PDO::FETCH_ASSOC);

} else {
    ?>
    <script type="text/javascript">
        Swal.fire({
            title: 'Update Gagal',
            text: "Request Gagal",
            type: 'warning',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Kembali',
        }).then((result) => {
            window.location = 'boiler';
        });
    </script>
    <?php
    exit; // Keluar dari skrip jika tidak ada data yang ditemukan
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
                <h4 style="display: flex; float: left;">EDIT DATA PEMAKAIAN CHEMICAL BOILER</h4>
            </div>
        </div>
        <br>

        <div class="table-responsive-sm table-responsie-md table-responsive-lg">
            <form action="" method="post" id="myForm" enctype="multipart/form-data">
                <input type="hidden" name="boiler_id" value="<?= $boilerData['boiler_id'] ?>">
                <table class="table table-hover table-bordered table-sm">
                    <tr>
                        <td class="custom-black-bg">Tanggal</td>
                        <td><input type="date" value="<?= $boilerData['tanggal'] ?>" name="tanggal" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">M<sup>3</sup> Air</td>
                        <td><input type="number" name="m3_air" value="<?= $boilerData['m3_air'] ?>" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Alkalinity Booster</td>
                        <td><input type="number" name="alkalinity_booster" value="<?= $boilerData['alkalinity_booster'] ?>" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Oxygen Scavenger</td>
                        <td><input type="number" name="oxygen_scavenger" value="<?= $boilerData['oxygen_scavenger'] ?>" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Internal Treatment</td>
                        <td><input type="number" name="internal_treatment" value="<?= $boilerData['internal_treatment'] ?>" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Condensate Treatment</td>
                        <td><input type="number" name="condensate_treatment" value="<?= $boilerData['condensate_treatment'] ?>" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <td class="custom-black-bg">Solid Additive</td>
                        <td><input type="number" name="solid_additive" value="<?= $boilerData['solid_additive'] ?>" class="form-control" width=20%></td>
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
        $boilerId = $_POST['boiler_id'];
        $tanggal = $_POST['tanggal'];
        $m3_air = emptyToNull($_POST['m3_air']);
        $alkalinity_booster = emptyToNull($_POST['alkalinity_booster']);
        $oxygen_scavenger = emptyToNull($_POST['oxygen_scavenger']);
        $internal_treatment = emptyToNull($_POST['internal_treatment']);
        $condensate_treatment = emptyToNull($_POST['condensate_treatment']);
        $solid_additive = emptyToNull($_POST['solid_additive']);

        $query = "UPDATE chemical_boiler 
                  SET tanggal = ?, m3_air = ?, alkalinity_booster = ?, oxygen_scavenger = ?, 
                  internal_treatment = ?, condensate_treatment = ?, solid_additive = ?
                  WHERE boiler_id = ?";

        $prep = $koneksi_wtp->prepare($query);

        $prep->bindParam(1, $tanggal);
        $prep->bindParam(2, $m3_air);
        $prep->bindParam(3, $alkalinity_booster);
        $prep->bindParam(4, $oxygen_scavenger);
        $prep->bindParam(5, $internal_treatment);
        $prep->bindParam(6, $condensate_treatment);
        $prep->bindParam(7, $solid_additive);
        $prep->bindParam(8, $boilerId);

        try {
            $koneksi_wtp->beginTransaction();
            $prep->execute();
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
                            window.location.href = 'boiler';
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
