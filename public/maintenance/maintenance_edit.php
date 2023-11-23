<?php
require_once("../../config/config.php");
require_once("maintenance_data.php");
require_once(SITE_ROOT . "/src/header-admin.php");
require_once(SITE_ROOT . "/src/footer-admin.php");
require_once(SITE_ROOT . "/src/koneksi.php");

// Retrieve Data for Editing
if (isset($_GET['maintenance_id'])) {
    $maintenance_id = $_GET['maintenance_id'];

    $edit_query = "SELECT maintenance_id, maintenance.lampiran_id, divisi, unit, problem, evaluasi, 
        penanganan, tanggal_mulai, tanggal_selesai, status, 
        tingkat_kerusakan, keterangan, sparepart, jumlah_sparepart, 
        satuan_sparepart
        FROM maintenance WHERE maintenance_id = ?;";

    $prepare_edit = $koneksi_maintenance->prepare($edit_query);
    $prepare_edit->bindParam(1, $maintenance_id, PDO::PARAM_INT);
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
            window.location = 'maintenance';
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
    <title>Edit Data Maintenance</title>
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
                    <!-- Divisi -->
                    <td class="custom-black-bg">Divisi</td>
                    <td><input type="text" value="<?= $editData['divisi'] ?>" name="divisi" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Unit -->
                    <td class="custom-black-bg">Unit</td>
                    <td><input type="text" value="<?= $editData['unit'] ?>" name="unit" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Problem -->
                    <td class="custom-black-bg">Problem</td>
                    <td><input type="text" value="<?= $editData['problem'] ?>" name="problem" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Evaluasi -->
                    <td class="custom-black-bg">Evaluasi</td>
                    <td><input type="text" value="<?= $editData['evaluasi'] ?>" name="evaluasi" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Penanganan -->
                    <td class="custom-black-bg">Penanganan</td>
                    <td><input type="text" value="<?= $editData['penanganan'] ?>" name="penanganan" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Sparepart -->
                    <td class="custom-black-bg">Sparepart</td>
                    <td><input type="text" value="<?= $editData['sparepart'] ?>" name="sparepart" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Jumlah Sparepart -->
                    <td class="custom-black-bg">Jumlah Sparepart</td>
                    <td><input type="number" value="<?= $editData['jumlah_sparepart'] ?>" name="jumlah_sparepart" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Satuan Sparepart -->
                    <td class="custom-black-bg">Satuan Sparepart</td>
                    <td><input type="text" value="<?= $editData['satuan_sparepart'] ?>" name="satuan_sparepart" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Tingkat Kerusakan -->
                    <td class="custom-black-bg">Tingkat Kerusakan</td>
                    <td><input type="text" value="<?= $editData['tingkat_kerusakan'] ?>" name="tingkat_kerusakan" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Tanggal Mulai -->
                    <td class="custom-black-bg">Tanggal Mulai</td>
                    <td><input type="text" value="<?= $editData['tanggal_mulai'] ?>" name="tanggal_mulai" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Tanggal Selesai -->
                    <td class="custom-black-bg">Tanggal Selesai</td>
                    <td><input type="text" value="<?= $editData['tanggal_selesai'] ?>" name="tanggal_selesai" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Status -->
                    <td class="custom-black-bg">Status</td>
                    <td><input type="text" value="<?= $editData['status'] ?>" name="status" class="form-control" width=20%></td>
                </tr>
                <tr>
                    <!-- Keterangan -->
                    <td class="custom-black-bg">Keterangan</td>
                    <td><input type="text" value="<?= $editData['keterangan'] ?>" name="keterangan" class="form-control" width=20%></td>
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
            $edit_id = $_GET['maintenance_id'];
            $divisi = $_POST['divisi'];
            $unit = $_POST['unit'];
            $problem = $_POST['problem'];
            $evaluasi = $_POST['evaluasi'];
            $penanganan = $_POST['penanganan'];
            $tanggal_mulai = $_POST['tanggal_mulai'];
            $tanggal_selesai = $_POST['tanggal_selesai'];
            $status = $_POST['status'];
            $tingkat_kerusakan = $_POST['tingkat_kerusakan'];
            $keterangan = $_POST['keterangan'];
            $sparepart = $_POST['sparepart'];
            $jumlah_sparepart = $_POST['jumlah_sparepart'];
            $satuan_sparepart = $_POST['satuan_sparepart'];

            // Update data in the database
            $update_query = "UPDATE maintenance 
                             SET divisi = ?, 
                                 unit = ?, 
                                 problem = ?, 
                                 evaluasi = ?, 
                                 penanganan = ?, 
                                 tanggal_mulai = ?, 
                                 tanggal_selesai = ?, 
                                 status = ?, 
                                 tingkat_kerusakan = ?, 
                                 keterangan = ?, 
                                 sparepart = ?, 
                                 jumlah_sparepart = ?, 
                                 satuan_sparepart = ? 
                             WHERE maintenance_id = ?;";

            $prepare_update = $koneksi_maintenance->prepare($update_query);
            $prepare_update->bindParam(1, $divisi);
            $prepare_update->bindParam(2, $unit);
            $prepare_update->bindParam(3, $problem);
            $prepare_update->bindParam(4, $evaluasi);
            $prepare_update->bindParam(5, $penanganan);
            $prepare_update->bindParam(6, $tanggal_mulai);
            $prepare_update->bindParam(7, $tanggal_selesai);
            $prepare_update->bindParam(8, $status);
            $prepare_update->bindParam(9, $tingkat_kerusakan);
            $prepare_update->bindParam(10, $keterangan);
            $prepare_update->bindParam(11, $sparepart);
            $prepare_update->bindParam(12, $jumlah_sparepart);
            $prepare_update->bindParam(13, $satuan_sparepart);
            $prepare_update->bindParam(14, $edit_id, PDO::PARAM_INT);

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
                            window.location = 'maintenance';
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
