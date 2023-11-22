<?php
require_once("../../config/config.php");
require_once("hse_data.php");
require_once(SITE_ROOT . "/src/header-admin.php");
require_once(SITE_ROOT . "/src/footer-admin.php");
require_once(SITE_ROOT . "/src/koneksi.php");

// Identify the Record to Edit
$editRecordId = $_GET['id'];

// Retrieve Data for Editing
$editData = null;
if ($editRecordId) {
    $edit_query = "SELECT * FROM kecelakaan_kerja WHERE kecelakaan_kerja_id = $1;";
    $prepare_edit = pg_prepare($koneksi_hse, "my_edit", $edit_query);
    $exec_edit = pg_execute($koneksi_hse, "my_edit", array($editRecordId));
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
                    <!-- Jenis Kecelakaan Kerja -->
                    <td class="custom-black-bg">Jenis Kecelakaan Kerja</td>
                    <td> <input type="text" value="<?= $editData['jenis_kecelakaan_kerja'] ?>" name="jenis" class="form-control" width=20%> </td>
                </tr>
                <tr>
                    <!-- Penanganan -->
                    <td class="custom-black-bg">Penanganan</td>
                    <td> <input type="text" value="<?= $editData['penanganan'] ?>" name="penanganan" class="form-control" width=20%> </td>
                </tr>
                <tr>
                    <!-- Area Kejadian -->
                    <td class="custom-black-bg">Area</td>
                    <td> <input type="text" value="<?= $editData['area_kejadian'] ?>" name="area" class="form-control" width=20%> </td>
                </tr>
                <tr>
                    <!-- Waktu Kejadian -->
                    <td class="custom-black-bg">Waktu</td>
                    <td> <input type="time" value="<?= $editData['waktu_kejadian'] ?>" name="waktu" class="form-control" width=20%> </td>
                </tr>
                <tr>
                    <!-- Jam Kerja Kejadian -->
                    <td class="custom-black-bg">Jam Kerja</td>
                    <td> <input type="text" value="<?= $editData['jam_kerja_kejadian'] ?>" name="jam" class="form-control" width=20%> </td>
                </tr>
                <tr>
                    <!-- Penyebab -->
                    <td class="custom-black-bg">Penyebab</td>
                    <td> <input type="text" value="<?= $editData['penyebab'] ?>" name="penyebab" class="form-control" width=20%> </td>
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
        $jenis = $_POST['jenis'];
        $penanganan = $_POST['penanganan'];
        $area = $_POST['area'];
        $waktu = $_POST['waktu'];
        $jam_kerja = $_POST['jam'];
        $penyebab = $_POST['penyebab'];

        // Update data in the database
        $update_query = "UPDATE kecelakaan_kerja 
                         SET tanggal = $1, 
                             jenis_kecelakaan_kerja = $2, 
                             penanganan = $3, 
                             area_kejadian = $4, 
                             waktu_kejadian = $5, 
                             jam_kerja_kejadian = $6, 
                             penyebab = $7
                         WHERE kecelakaan_kerja_id = $8;";
        $prepare_update = pg_prepare($koneksi_hse, "my_update", $update_query);
        $exec_update = pg_execute($koneksi_hse, "my_update", array(
            $tanggal, $jenis, $penanganan, $area, $waktu, $jam_kerja, $penyebab, $edit_id
        ));

        if (!$exec_update) {
            echo "Error in SQL query: " . pg_last_error($koneksi_hse);
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
                        window.location = 'kecelakaan_kerja';
                    }         

                });
            </script>
            <?php
        }
    }
    ?>

</body>