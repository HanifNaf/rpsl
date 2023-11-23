<?php
require_once("../../config/config.php");
require_once("hse_data.php");
require_once(SITE_ROOT . "/src/header-admin.php");
require_once(SITE_ROOT . "/src/footer-admin.php");
require_once(SITE_ROOT . "/src/koneksi.php");

// Retrieve Data for Editing
if (isset($_GET['kecelakaan_kerja_id'])) {
    $kecelakaan_kerja_id = $_GET['kecelakaan_kerja_id'];

    $edit_query = "SELECT * FROM kecelakaan_kerja WHERE kecelakaan_kerja_id = ?;";

    $prepare_edit = $koneksi_hse->prepare($edit_query);
    $prepare_edit->bindParam(1, $kecelakaan_kerja_id, PDO::PARAM_INT);
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
            window.location = 'kecelakaan_kerja';
        });
    </script>
    <?php
    exit; // Keluar dari skrip jika tidak ada data yang ditemukan
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
                <input type="hidden" name="edit_id" value="<?= $kecelakaan_kerja_id ?>">
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
                         SET tanggal = :tanggal, 
                             jenis_kecelakaan_kerja = :jenis, 
                             penanganan = :penanganan, 
                             area_kejadian = :area, 
                             waktu_kejadian = :waktu, 
                             jam_kerja_kejadian = :jam_kerja, 
                             penyebab = :penyebab
                         WHERE kecelakaan_kerja_id = :edit_id";
        
        $prepare_update = $koneksi_hse->prepare($update_query);
        
        $prepare_update->bindParam(':tanggal', $tanggal);
        $prepare_update->bindParam(':jenis', $jenis);
        $prepare_update->bindParam(':penanganan', $penanganan);
        $prepare_update->bindParam(':area', $area);
        $prepare_update->bindParam(':waktu', $waktu);
        $prepare_update->bindParam(':jam_kerja', $jam_kerja);
        $prepare_update->bindParam(':penyebab', $penyebab);
        $prepare_update->bindParam(':edit_id', $edit_id);

        try {
            $prepare_update->execute();
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
        } catch (PDOException $e) {
            echo "Error in SQL query: " . $e->getMessage();
        }
    }
    ?>

</body>
