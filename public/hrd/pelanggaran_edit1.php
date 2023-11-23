<?php
require_once("../../config/config.php");
require_once("hrd_data.php");
require_once(SITE_ROOT . "/src/header-admin.php");
require_once(SITE_ROOT . "/src/footer-admin.php");
require_once(SITE_ROOT . "/src/koneksi.php");

// Retrieve Data for Editing
if (isset($_GET['hrd_id'])) {
    $hrd_id = $_GET['hrd_id'];

    $edit_query = "SELECT hrd_id, tanggal, nik, nama, bagian, shift, waktu_pelanggaran, 
        tempat_pelanggaran, bentuk_pelanggaran, potensi_bahaya, sanksi
        FROM hrd WHERE hrd_id = ?;";

    $prepare_edit = $koneksi_hrd->prepare($edit_query);
    $prepare_edit->bindParam(1, $hrd_id, PDO::PARAM_INT);
    $prepare_edit->execute();

    $editData = $prepare_edit->fetch(PDO::FETCH_ASSOC);

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
            window.location = 'pelanggaran';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pelanggaran</title>
    <style>
        .custom-black-bg {
            background-color: #2ca143;
            color: white;
        }
    </style>
    <!-- Import JS Sweet Alert -->
    <script src="../js/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Display existing data for editing -->
            <table class="table table-hover table-bordered table-sm">
                <tr>
                    <!-- Tanggal -->
                    <td class="custom-black-bg">Tanggal</td>
                    <td><input type="date" value="<?= $editData['tanggal'] ?>" name="tanggal" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- NIK -->
                    <td class="custom-black-bg">NIK</td>
                    <td><input type="text" value="<?= $editData['nik'] ?>" name="nik" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Nama -->
                    <td class="custom-black-bg">Nama</td>
                    <td><input type="text" value="<?= $editData['nama'] ?>" name="nama" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Bagian -->
                    <td class="custom-black-bg">Bagian</td>
                    <td><input type="text" value="<?= $editData['bagian'] ?>" name="bagian" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Shift -->
                    <td class="custom-black-bg">Shift</td>
                    <td><input type="text" value="<?= $editData['shift'] ?>" name="shift" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Waktu Pelanggaran -->
                    <td class="custom-black-bg">Waktu Pelanggaran</td>
                    <td><input type="time" value="<?= $editData['waktu_pelanggaran'] ?>" name="waktu" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Tempat Pelanggaran -->
                    <td class="custom-black-bg">Tempat Pelanggaran</td>
                    <td><input type="text" value="<?= $editData['tempat_pelanggaran'] ?>" name="tempat" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Bentuk Pelanggaran -->
                    <td class="custom-black-bg">Bentuk Pelanggaran</td>
                    <td><input type="text" value="<?= $editData['bentuk_pelanggaran'] ?>" name="bentuk" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Potensi Bahaya -->
                    <td class="custom-black-bg">Potensi Bahaya</td>
                    <td><input type="text" value="<?= $editData['potensi_bahaya'] ?>" name="potensi" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Sanksi -->
                    <td class="custom-black-bg">Sanksi</td>
                    <td><input type="text" value="<?= $editData['sanksi'] ?>" name="sanksi" class="form-control" width=20%></td>
                </tr>
            </table>
            <div class="form-group text-center" style="margin-top: 10px;">
                <button type="submit" name="update" class="btn btn-primary">
                    <i class="fas fa-save"></i> UPDATE DATA
                </button>
            </div>
        </form>
    </div>

    <?php
    // Update Data
    if (isset($_POST['update'])) {
        try {
            $edit_id = $_GET['hrd_id'];
            $tanggal = $_POST['tanggal'];
            $nik = $_POST['nik'];
            $nama = $_POST['nama'];
            $bagian = $_POST['bagian'];
            $shift = $_POST['shift'];
            $waktu_pelanggaran = $_POST['waktu'];
            $tempat_pelanggaran = $_POST['tempat'];
            $bentuk_pelanggaran = $_POST['bentuk'];
            $potensi_bahaya = $_POST['potensi'];
            $sanksi = $_POST['sanksi'];

            // Update data in the database
            $update_query = "UPDATE hrd 
                             SET tanggal = ?, 
                                 nik = ?, 
                                 nama = ?, 
                                 bagian = ?, 
                                 shift = ?, 
                                 waktu_pelanggaran = ?, 
                                 tempat_pelanggaran = ?, 
                                 bentuk_pelanggaran = ?, 
                                 potensi_bahaya = ?, 
                                 sanksi = ?
                             WHERE hrd_id = ?;";

            $prepare_update = $koneksi_hrd->prepare($update_query);
            $prepare_update->bindParam(1, $tanggal);
            $prepare_update->bindParam(2, $nik);
            $prepare_update->bindParam(3, $nama);
            $prepare_update->bindParam(4, $bagian);
            $prepare_update->bindParam(5, $shift);
            $prepare_update->bindParam(6, $waktu_pelanggaran);
            $prepare_update->bindParam(7, $tempat_pelanggaran);
            $prepare_update->bindParam(8, $bentuk_pelanggaran);
            $prepare_update->bindParam(9, $potensi_bahaya);
            $prepare_update->bindParam(10, $sanksi);
            $prepare_update->bindParam(11, $edit_id, PDO::PARAM_INT);

            $exec_update = $prepare_update->execute();

            if (!$exec_update) {
                throw new Exception("Error in SQL query: " . $prepare_update->errorInfo()[2]);
            } else {
                ?>
                <script type="text/javascript">
                    Swal.fire({
                        text: "Data Berhasil diedit!",
                        type: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'pelanggaran';
                        }
                    });
                </script>
    <?php
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    ?>
</body>

</html>