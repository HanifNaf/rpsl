<?php
require_once("../../config/config.php");
require_once("hrd_data.php");
require_once(SITE_ROOT . "/src/header-admin.php");
require_once(SITE_ROOT . "/src/footer-admin.php");
require_once(SITE_ROOT . "/src/koneksi.php");

// Identify the Record to Edit
$editRecordId = $_GET['id'];

// Retrieve Data for Editing
$editData = null;
if ($editRecordId) {
    $edit_query = "SELECT * FROM hrd WHERE hrd_id = $1;";
    $prepare_edit = pg_prepare($koneksi_hrd, "my_edit", $edit_query);
    $exec_edit = pg_execute($koneksi_hrd, "my_edit", array($editRecordId));
    $editData = pg_fetch_assoc($exec_edit);
}
?>
<head>
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
        <form action="" method="post">
                <!-- Display existing data for editing -->
                <table class="table table-hover table-bordered table-sm">
                <input type="hidden" name="edit_id" value="<?= $editRecordId ?>">
                <tr>
                    <!-- Tanggal -->
                    <td class="custom-black-bg">Tanggal</td>
                    <td> <input type="date" value="<?= $editData['tanggal'] ?? date('Y-m-d') ?>" name="tanggal" class="form-control" width=20%> </td>
                </tr>
                <tr>
                    <!-- NIK -->
                    <td class="custom-black-bg">NIK</td>
                    <td> <input type="text" value="<?= $editData['nik'] ?>" name="nik" class="form-control" width=20%> </td>
                </tr>
                <tr>
                    <!-- Nama -->
                    <td class="custom-black-bg">Nama</td>
                    <td> <input type="text" value="<?= $editData['nama'] ?>" name="nama" class="form-control" width=20%> </td>
                </tr>
                <tr>
                    <!-- Bagian -->
                    <td class="custom-black-bg">Bagian</td>
                    <td> <input type="text" value="<?= $editData['bagian'] ?>" name="bagian" class="form-control" width=20%> </td>
                </tr>
                <tr>
                    <!-- Shift -->
                    <td class="custom-black-bg">Shift</td>
                    <td> <input type="text" value="<?= $editData['shift'] ?>" name="shift" class="form-control" width=20%> </td>
                </tr>
                <tr>
                    <!-- Waktu Pelanggaran -->
                    <td class="custom-black-bg">Waktu Pelanggaran</td>
                    <td> <input type="time" value="<?= $editData['waktu_pelanggaran'] ?>" name="waktu" class="form-control" width=20%> </td>
                </tr>
                 <tr>
                    <!-- Tempat Pelanggaran -->
                    <td class="custom-black-bg">Tempat Pelanggaran</td>
                    <td> <input type="text" value="<?= $editData['tempat_pelanggaran'] ?>" name="tempat" class="form-control" width=20%> </td>
                </tr>
                 <tr>
                    <!-- Bentuk Pelanggaran -->
                    <td class="custom-black-bg">Bentuk Pelanggaran</td>
                    <td> <input type="text" value="<?= $editData['bentuk_pelanggaran'] ?>" name="bentuk" class="form-control" width=20%> </td>
                </tr>
                <tr>
                    <!-- Potensi Bahaya -->
                    <td class="custom-black-bg">Potensi Bahaya</td>
                    <td> <input type="text" value="<?= $editData['potensi_bahaya'] ?>" name="potensi" class="form-control" width=20%> </td>
                </tr>
                <tr>
                    <!-- Sanksi -->
                    <td class="custom-black-bg">Sanksi</td>
                    <td> <input type="text" value="<?= $editData['sanksi'] ?>" name="sanksi" class="form-control" width=20%> </td>
                </tr>
                <tr>
                    <!-- Lampiran -->
                    <td class="custom-black-bg">Lampiran</td>
                    <td> <input type="file" value="<?= $editData['lampiran'] ?>" name="lampiran" class="form-control" width=20%> </td>
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
        $edit_id = $_POST['edit_id'];
        $tanggal = $_POST['tanggal'];
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $bagian = $_POST['bagian'];
        $shift = $_POST['shift'];
        $waktu = $_POST['waktu'];
        $tempat = $_POST['tempat'];
        $bentuk = $_POST['bentuk'];
        $potensi = $_POST['potensi'];
        $sanksi = $_POST['sanksi'];
        $lampiran = $_POST['lampiran'];

        // Update data in the database
        $update_query = "UPDATE hrd 
                         SET tanggal = $1, 
                             nik = $2, 
                             nama = $3, 
                             bagian = $4,
                             shift = $5,
                             waktu_pelanggaran = $6,
                             tempat_pelanggaran = $7,
                             bentuk_pelanggaran = $8,
                             potensi_bahaya = $9,
                             sanksi = $10,
                             lampiran = $11
                         WHERE hrd_id = $12;";
        $prepare_update = pg_prepare($koneksi_hrd, "my_update", $update_query);
        $exec_update = pg_execute($koneksi_hrd, "my_update", array(
            $tanggal, $nik, $nama, $bagian, $shift, $waktu, $tempat, $bentuk, $potensi, $sanksi, $lampiran, $edit_id));

        if (!$exec_update) {
            echo "Error in SQL query: " . pg_last_error($koneksi_hrd);
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
    }
    ?>

</body>