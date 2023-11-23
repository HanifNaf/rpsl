<?php
require_once("../../config/config.php");
require_once("operasional_data.php");
require_once(SITE_ROOT . "/src/header-admin.php");
require_once(SITE_ROOT . "/src/footer-admin.php");
require_once(SITE_ROOT . "/src/koneksi.php");

// Identify the Record to Edit
//echo "prodid= ".$_GET['produksi_id']."\n";
//echo "opid= ".$_GET['operasional_id']."\n";
//echo "pemid= ".$_GET['pemakaian_id']."\n";
//echo "bbid= ".$_GET['bahan_bakar_id']."\n";

if (isset($_GET['maintenance_id'], $_GET['lampiran_id'])){
    $produksi = $_GET['maintenance_id'];
    $operasional = $_GET['lampiran_id'];

    $edit_query = "SELECT maintenance_id, maintenance.lampiran_id, divisi, unit, problem, evaluasi, 
        penanganan, tanggal_mulai, tanggal_selesai, status, 
        tingkat_kerusakan, keterangan, sparepart, jumlah_sparepart, 
        satuan_sparepart, nama 
        FROM maintenance 
        LEFT JOIN lampiran ON maintenance.lampiran_id=lampiran.lampiran_id
        WHERE t1.maintenance_id=? 
        AND t2.lampiran_id=?;";

    $prepare_edit = $koneksi_maintenance->prepare($edit_query);
    $prepare_edit->bindParam(1, $maintenance);
    $prepare_edit->bindParam(2, $lampiran);


    $prepare_edit->execute();

    $maintenanceData = $prepare_edit->fetch(PDO::FETCH_ASSOC);
}else{
    echo "Request Error";
}


//$idToEdit = isset($_GET['edit']) ? $_GET['edit'] : null;
//$dataToEdit = [];
//
//// Fetch data for editing
//if ($idToEdit) {
//    $edit_query = "SELECT * FROM operasional WHERE operasional_id = $1;";
//    $prepare_edit = $koneksi_operasional->prepare($edit_query);
//    $prepare_edit->bindParam(1, $idToEdit);
//    $prepare_edit->execute();
//    $dataToEdit = $prepare_edit->fetch(PDO::FETCH_ASSOC);
//}

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
        <form action="" method="post">
            
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
    </div>


<?php
if (isset($_POST['update'])) {
    // Update data in the database
    $update_query = "WITH 
                      up1 AS (
                        UPDATE lampiran
                        SET generation = ?, 
                            pm_kwh_pltbm = ?,
                            tanggal = ?
                        WHERE produksi_id = ?
                        RETURNING produksi_id
                      ),
                      UPDATE operasional
                      SET shift = ?,
                        keterangan = ?,
                        supervisor = ?,
                        tanggal = ?
                      FROM up1, up2, up3
                      WHERE operasional.operasional_id = ? 
                        AND up1.produksi_id = up1.produksi_id
                        AND up2.pemakaian_id = up2.pemakaian_id
                        AND up3.pemakaian_bahan_bakar_id = up3.pemakaian_bahan_bakar_id;";
    
    $prepare_update = $koneksi_operasional->prepare($update_query);
    
    // Bind parameters
    $prepare_update->bindParam(1, $_POST['generation']);
    $prepare_update->bindParam(2, $_POST['pm_kwh_pltbm']);
    $prepare_update->bindParam(3, $_POST['tanggal']);
    $prepare_update->bindParam(4, $_GET['produksi_id']);
    
    $prepare_update->bindParam(5, $_POST['ekspor']);
    $prepare_update->bindParam(6, $_POST['pemakaian_sendiri']);
    $prepare_update->bindParam(7, $_POST['kwh_loss']);
    $prepare_update->bindParam(8, $_POST['tanggal']);
    $prepare_update->bindParam(9, $_GET['pemakaian_id']);

    $prepare_update->bindParam(10, $_POST['kg_cangkang']);
    $prepare_update->bindParam(11, $_POST['kg_palmfiber']);
    $prepare_update->bindParam(12, $_POST['kg_woodchips']);
    $prepare_update->bindParam(13, $_POST['kg_serbukkayu']);
    $prepare_update->bindParam(14, $_POST['kg_sabutkelapa']);
    $prepare_update->bindParam(15, $_POST['kg_efbpress']);
    $prepare_update->bindParam(16, $_POST['kg_opt']);
    $prepare_update->bindParam(17, $_POST['tanggal']);
    $prepare_update->bindParam(18, $_GET['bahan_bakar_id']);

    $prepare_update->bindParam(19, $_POST['shift']);
    $prepare_update->bindParam(20, $_POST['keterangan']);
    $prepare_update->bindParam(21, $_POST['supervisor']);
    $prepare_update->bindParam(22, $_POST['tanggal']);
    $prepare_update->bindParam(23, $_GET['operasional_id']);

    try {
        $koneksi_operasional->beginTransaction();
        $prepare_update->execute();
        $koneksi_operasional->commit();
    ?>
        <script type="text/javascript">
            Swal.fire({
                title: 'Update Successful',
                text: "Data Berhasil diupdate!",
                type: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK',
            }).then((result) => {
                window.location = 'operasional';
            });
        </script>
    <?php
    } catch (PDOException $e) {
        echo "PDO ERROR: " . $e->getMessage();
        $koneksi_operasional->rollBack();
    }
}
?>

