<?php
require_once("../../config/config.php");
require_once("maintenance_data.php");
require_once(SITE_ROOT . "/src/header-admin.php");
require_once(SITE_ROOT . "/src/footer-admin.php");
require_once(SITE_ROOT . "/src/koneksi.php");

if (isset($_GET['maintenance_id'], $_GET['lampiran_id'])) {
    $maintenance_id = $_GET['maintenance_id'];
    $lampiran_id = $_GET['lampiran_id'];

    $edit_query = "SELECT maintenance_id, maintenance.lampiran_id, divisi, unit, problem, evaluasi, 
        penanganan, tanggal_mulai, tanggal_selesai, status, 
        tingkat_kerusakan, keterangan, sparepart, jumlah_sparepart, 
        satuan_sparepart, nama 
        FROM maintenance 
        LEFT JOIN lampiran ON maintenance.lampiran_id = lampiran.lampiran_id
        WHERE maintenance.maintenance_id = ? 
        AND lampiran.lampiran_id = ?;";

    $prepare_edit = $koneksi_maintenance->prepare($edit_query);
    $prepare_edit->bindParam(1, $maintenance_id);
    $prepare_edit->bindParam(2, $lampiran_id);
    $prepare_edit->execute();

    $maintenanceData = $prepare_edit->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Request Error";
}

?>

<head>
    <!-- Import JS Sweet Alert -->
    <script src="../js/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="row">
        <!-- Nama Divisi -->
        <div class="col-md-6 col-sm-12 col">
            <h2 style="display: flex; float: left;">OPERASIONAL</h2>
        </div>
    </div>

    <div class="table-responsive-sm table-responsie-md table-responsive-lg">
        <!-- Form for Data Editing -->
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="maintenance_id" value="<?= $maintenanceData['maintenance_id'] ?>">
            <input type="hidden" name="lampiran_id" value="<?= $maintenanceData['lampiran_id'] ?>">
            <table class="table">
                <tr>
                    <td><label for="divisi">Divisi</label></td>
                    <td><input type="text" name="divisi" id="divisi" class="form-control" value="<?= $maintenanceData['divisi'] ?>" required></td>
                </tr>
                <tr>
                    <td><label for="unit">Unit</label></td>
                    <td><input type="text" name="unit" id="unit" class="form-control" value="<?= $maintenanceData['unit'] ?>" required></td>
                </tr>
                <tr>
                    <td><label for="problem">Problem</label></td>
                    <td><input type="text" name="problem" id="problem" class="form-control" value="<?= $maintenanceData['problem'] ?>" required></td>
                </tr>
                <tr>
                    <td><label for="evaluasi">Evaluasi</label></td>
                    <td><input type="text" name="evaluasi" id="evaluasi" class="form-control" value="<?= $maintenanceData['evaluasi'] ?>" required></td>
                </tr>
                <tr>
                    <td><label for="penanganan">Penanganan</label></td>
                    <td><input type="text" name="penanganan" id="penanganan" class="form-control" value="<?= $maintenanceData['penanganan'] ?>" required></td>
                </tr>
                <tr>
                    <td><label for="sparepart">Sparepart</label></td>
                    <td><input type="text" name="sparepart" id="sparepart" class="form-control" value="<?= $maintenanceData['sparepart'] ?>" required></td>
                </tr>
                <tr>
                    <td><label for="quantity">Quantity Sparepart</label></td>
                    <td><input type="number" name="quantity" id="quantity" class="form-control" value="<?= $maintenanceData['jumlah_sparepart'] ?>" required></td>
                </tr>
                <tr>
                    <td><label for="satuan">Satuan Sparepart</label></td>
                    <td><input type="text" name="satuan" id="satuan" class="form-control" value="<?= $maintenanceData['satuan_sparepart'] ?>" required></td>
                </tr>
                <tr>
                    <td><label for="tanggal_mulai">Tanggal Mulai</label></td>
                    <td><input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="<?= $maintenanceData['tanggal_mulai'] ?>" required></td>
                </tr>
                <tr>
                    <td><label for="tanggal_selesai">Tanggal Selesai</label></td>
                    <td><input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="<?= $maintenanceData['tanggal_selesai'] ?>" required></td>
                </tr>
                <tr>
                    <td><label for="tingkat_kerusakan">Tingkat Kerusakan</label></td>
                    <td>
                        <input type="radio" id="major" value="Major" name="tingkat_kerusakan" <?= ($maintenanceData['tingkat_kerusakan'] == 'Major') ? 'checked' : '' ?>>
                        <label for="major">Major</label>
                        <input type="radio" id="minor" value="Minor" name="tingkat_kerusakan" <?= ($maintenanceData['tingkat_kerusakan'] == 'Minor') ? 'checked' : '' ?>>
                        <label for="minor">Minor</label>
                    </td>
                </tr>
                <tr>
                    <td><label for="status">Status</label></td>
                    <td>
                        <select name="status" id="status" class="form-control">
                            <option value="Dijadwalkan" <?= ($maintenanceData['status'] == 'Dijadwalkan') ? 'selected' : '' ?>>Dijadwalkan</option>
                            <option value="Sedang Berlangsung" <?= ($maintenanceData['status'] == 'Sedang Berlangsung') ? 'selected' : '' ?>>Sedang Berlangsung</option>
                            <option value="Selesai" <?= ($maintenanceData['status'] == 'Selesai') ? 'selected' : '' ?>>Selesai</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="keterangan">Keterangan</label></td>
                    <td><input type="text" name="keterangan" id="keterangan" class="form-control" value="<?= $maintenanceData['keterangan'] ?>" required></td>
                </tr>
                <tr>
                    <td><label for="lampiran">Lampiran</label></td>
                    <td><input type="file" name="lampiran" id="lampiran" class="form-control"></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center" style="margin-top: 10px;">
                        <button type="submit" name="update" class="btn btn-primary"><i class="fas fa-save"></i> UPDATE DATA</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <?php
    if (isset($_POST['update'])) {
        $maintenance_id = $_POST['maintenance_id'];
        $lampiran_id = $_POST['lampiran_id'];

        // Handle Lampiran Update
        if (!empty($_FILES['lampiran']['name'])) {
            $lampiran_nama = $_FILES['lampiran']['name'];
            $lampiran_tipe = pathinfo($lampiran_nama)['extension'];
            $lampiran_isi = fopen($_FILES['lampiran']['tmp_name'], 'rb');

            $update_lampiran_query = "UPDATE lampiran 
                                      SET nama = ?, tipe = ?, file = ? 
                                      WHERE lampiran_id = ?";
            $prep_update_lampiran = $koneksi_maintenance->prepare($update_lampiran_query);
            $prep_update_lampiran->bindParam(1, $lampiran_nama);
            $prep_update_lampiran->bindParam(2, $lampiran_tipe);
            $prep_update_lampiran->bindParam(3, $lampiran_isi, PDO::PARAM_LOB);
            $prep_update_lampiran->bindParam(4, $lampiran_id);

            try {
                $koneksi_maintenance->beginTransaction();
                $prep_update_lampiran->execute();
                $koneksi_maintenance->commit();
            } catch (PDOException $e) {
                echo "PDO ERROR: " . $e->getMessage();
                $koneksi_maintenance->rollBack();
            }
        }

        // Handle other fields update
        $divisi = $_POST['divisi'];
        $unit = $_POST['unit'];
        $problem = $_POST['problem'];
        $evaluasi = $_POST['evaluasi'];
        $penanganan = $_POST['penanganan'];
        $sparepart = $_POST['sparepart'];
        $quantity = $_POST['quantity'];
        $satuan = $_POST['satuan'];
        $tanggal_mulai = $_POST['tanggal_mulai'];
        $tanggal_selesai = $_POST['tanggal_selesai'];
        $tingkat_kerusakan = $_POST['tingkat_kerusakan'];
        $status = $_POST['status'];
        $keterangan = $_POST['keterangan'];

        $update_maintenance_query = "UPDATE maintenance 
                                     SET divisi = ?, unit = ?, problem = ?, evaluasi = ?, penanganan = ?, 
                                     sparepart = ?, jumlah_sparepart = ?, satuan_sparepart = ?, 
                                     tanggal_mulai = ?, tanggal_selesai = ?, tingkat_kerusakan = ?, 
                                     status = ?, keterangan = ? 
                                     WHERE maintenance_id = ?";
        $prep_update_maintenance = $koneksi_maintenance->prepare($update_maintenance_query);
        $prep_update_maintenance->bindParam(1, $divisi);
        $prep_update_maintenance->bindParam(2, $unit);
        $prep_update_maintenance->bindParam(3, $problem);
        $prep_update_maintenance->bindParam(4, $evaluasi);
        $prep_update_maintenance->bindParam(5, $penanganan);
        $prep_update_maintenance->bindParam(6, $sparepart);
        $prep_update_maintenance->bindParam(7, $quantity);
        $prep_update_maintenance->bindParam(8, $satuan);
        $prep_update_maintenance->bindParam(9, $tanggal_mulai);
        $prep_update_maintenance->bindParam(10, $tanggal_selesai);
        $prep_update_maintenance->bindParam(11, $tingkat_kerusakan);
        $prep_update_maintenance->bindParam(12, $status);
        $prep_update_maintenance->bindParam(13, $keterangan);
        $prep_update_maintenance->bindParam(14, $maintenance_id);

        try {
            $koneksi_maintenance->beginTransaction();
            $prep_update_maintenance->execute();
            $koneksi_maintenance->commit();
            echo "Update Successful";
        } catch (PDOException $e) {
            echo "PDO ERROR: " . $e->getMessage();
            $koneksi_maintenance->rollBack();
        }
    }
    ?>
</body>
