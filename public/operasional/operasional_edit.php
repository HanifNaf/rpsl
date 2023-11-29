<?php
require_once("../../config/config.php");

// Cek role
if (!in_array($_SESSION['role'], ['operasional', 'admin'])) {
    echo "<p style='color: white;'>Akses Dibatasi. Anda tidak memiliki izin yang cukup.</p>";

    // Menambahkan skrip SweetAlert untuk notifikasi yang lebih menarik
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Dibatasi',
            }).then(function() {
                window.location.href = '../operasional/operasional.php';
            });
        </script>
    ";
}

require_once("operasional_data.php");
require_once(SITE_ROOT . "/src/header-admin.php");
require_once(SITE_ROOT . "/src/footer-admin.php");
require_once(SITE_ROOT . "/src/koneksi.php");

// Identify the Record to Edit
//echo "prodid= ".$_GET['produksi_id']."\n";
//echo "opid= ".$_GET['operasional_id']."\n";
//echo "pemid= ".$_GET['pemakaian_id']."\n";
//echo "bbid= ".$_GET['bahan_bakar_id']."\n";

if (isset($_GET['produksi_id'], $_GET['operasional_id'], $_GET['pemakaian_id'], $_GET['bahan_bakar_id'])){
    $produksi = $_GET['produksi_id'];
    $operasional = $_GET['operasional_id'];
    $pemakaian = $_GET['pemakaian_id'];
    $bahan_bakar = $_GET['bahan_bakar_id'];



    $edit_query = "SELECT t1.produksi_id, t1.generation, t1.pm_kwh_pltbm, 
        t2.operasional_id, t2.tanggal, t2.waktu, t2.shift, t2.supervisor, t2.keterangan, 
        t3.pemakaian_id, t3.ekspor, t3.pemakaian_sendiri, t3.kwh_loss, 
        t4.pemakaian_bahan_bakar_id, t4.kg_cangkang, t4.kg_palmfiber, t4.kg_woodchips, t4.kg_serbukkayu, t4.kg_sabutkelapa, t4.kg_efbpress, t4.kg_opt
        FROM produksi_kwh t1
        INNER JOIN operasional t2 ON t1.produksi_id=t2.produksi_id
        INNER JOIN pemakaian_kwh t3 ON t2.pemakaian_id=t3.pemakaian_id
        INNER JOIN pemakaian_bahan_bakar t4 ON t2.pemakaian_bahan_bakar_id=t4.pemakaian_bahan_bakar_id 
        WHERE t1.produksi_id=? 
        AND t2.operasional_id=?
        AND t3.pemakaian_id=?
        AND t4.pemakaian_bahan_bakar_id=?;";

    $prepare_edit = $koneksi_operasional->prepare($edit_query);
    $prepare_edit->bindParam(1, $produksi);
    $prepare_edit->bindParam(2, $operasional);
    $prepare_edit->bindParam(3, $pemakaian);
    $prepare_edit->bindParam(4, $bahan_bakar);


    $prepare_edit->execute();

    $dataToEdit = $prepare_edit->fetch(PDO::FETCH_ASSOC);
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
        <div class="row">
            <!-- Nama Divisi -->
            <div class="col-md-6 col-sm-12 col">
                <h2 style="display: flex; float: left;">EDIT DATA OPERASIONAL</h2>
            </div>
        </div>
        <br>

    
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Display existing data for editing -->
            <table class="table table-hover table-bordered table-sm">
                <tr>
                    <!-- Tanggal -->
                        <td class="custom-black-bg">Tanggal</td>
                        <td><input type="date" value="<?= $dataToEdit['tanggal'] ?>" name="tanggal" class="form-control" width=20%></td>
                    </tr>
                    <!-- Shift -->
                    <tr>
                        <td class="custom-black-bg">Shift</td>
                        <td>
                            <select name="shift" class="form-control">
                                <option value="1" <?php echo ($editData['shift'] == 1) ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo ($editData['shift'] == 2) ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?php echo ($editData['shift'] == 3) ? 'selected' : ''; ?>>3</option>
                            </select>
                        </td>
                    </tr>
                    <!-- Generasi -->
                    <tr>
                        <td class="custom-black-bg">Generasi</td>
                        <td><input type="text" value="<?= $dataToEdit['generation'] ?>" name="generation" class="form-control"></td>
                    </tr>
                    <!-- PM kWh PLTBM -->
                    <tr>
                        <td class="custom-black-bg">PM kWh PLTBM</td>
                        <td><input type="number" value="<?= $dataToEdit['pm_kwh_pltbm'] ?>" name="pm_kwh_pltbm" class="form-control"></td>
                    </tr>
                    <!-- Ekspor -->
                    <tr>
                        <td class="custom-black-bg">Ekspor</td>
                        <td><input type="number" value="<?= $dataToEdit['ekspor'] ?>" name="ekspor" class="form-control"></td>
                    </tr>
                    <!-- Pemakaian Sendiri -->
                    <tr>
                        <td class="custom-black-bg">Pemakaian Sendiri</td>
                        <td><input type="number" value="<?= $dataToEdit['pemakaian_sendiri'] ?>" name="pemakaian_sendiri" class="form-control"></td>
                    </tr>
                    <!-- kWh Loss -->
                    <tr>
                        <td class="custom-black-bg">kWh Loss</td>
                        <td><input type="number" value="<?= $dataToEdit['kwh_loss'] ?>" name="kwh_loss" class="form-control"></td>
                    </tr>
                    <!-- Pemakaian Cangkang (kg) -->
                    <tr>
                        <td class="custom-black-bg">Pemakaian Cangkang (kg)</td>
                        <td><input type="number" value="<?= $dataToEdit['kg_cangkang'] ?>" name="kg_cangkang" class="form-control"></td>
                    </tr>
                    <!-- Pemakaian Palm Fiber (kg) -->
                    <tr>
                        <td class="custom-black-bg">Pemakaian Palm Fiber (kg)</td>
                        <td><input type="number" value="<?= $dataToEdit['kg_palmfiber'] ?>" name="kg_palmfiber" class="form-control"></td>
                    </tr>
                    <!-- Pemakaian Wood Chips (kg) -->
                    <tr>
                        <td class="custom-black-bg">Pemakaian Wood Chips (kg)</td>
                        <td><input type="number" value="<?= $dataToEdit['kg_woodchips'] ?>" name="kg_woodchips" class="form-control"></td>
                    </tr>
                    <!-- Pemakaian Serbuk Kayu (kg) -->
                    <tr>
                        <td class="custom-black-bg">Pemakaian Serbuk Kayu (kg)</td>
                        <td><input type="number" value="<?= $dataToEdit['kg_serbukkayu'] ?>" name="kg_serbukkayu" class="form-control"></td>
                    </tr>
                    <!-- Pemakaian Sabut Kelapa (kg) -->
                    <tr>
                        <td class="custom-black-bg">Pemakaian Sabut Kelapa (kg)</td>
                        <td><input type="number" value="<?= $dataToEdit['kg_sabutkelapa'] ?>" name="kg_sabutkelapa" class="form-control"></td>
                    </tr>
                        <!-- Pemakaian EFB Press (kg) -->
                    <tr>
                        <td class="custom-black-bg">Pemakaian EFB Press (kg)</td>
                        <td><input type="number" value="<?= $dataToEdit['kg_efbpress'] ?>" name="kg_efbpress" class="form-control"></td>
                    </tr>
                        <!-- Pemakaian OPT (kg) -->
                        <tr>
                        <td class="custom-black-bg">Pemakaian OPT (kg)</td>
                        <td><input type="number" value="<?= $dataToEdit['kg_opt'] ?>" name="kg_opt" class="form-control"></td>
                    </tr>
                        <!-- Keterangan -->
                    <tr>
                        <td class="custom-black-bg">Keterangan</td>
                        <td><input type="text" value="<?= $dataToEdit['keterangan'] ?>" name="keterangan" class="form-control"></td>
                    </tr>    
                </table>
                <div class="form-group text-center" style="margin-top: 10px;">
                    <button type="submit" name="update" class="btn btn-primary"><i class="fas fa-save"></i> UPDATE DATA</button>
                    <a href="operasional" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> CANCEL</a>
                </div>
            </form>
        </div>
    </div>


<?php
if (isset($_POST['update'])) {
    // Update data in the database
    $update_query = "WITH 
                      up1 AS (
                        UPDATE produksi_kwh
                        SET generation = ?, 
                            pm_kwh_pltbm = ?,
                            tanggal = ?
                        WHERE produksi_id = ?
                        RETURNING produksi_id
                      ),
                      up2 AS (
                        UPDATE pemakaian_kwh
                        SET ekspor = ?, 
                            pemakaian_sendiri = ?, 
                            kwh_loss = ?,
                            tanggal = ?
                        WHERE pemakaian_id = ?
                        RETURNING pemakaian_id
                      ),
                      up3 AS (
                        UPDATE pemakaian_bahan_bakar
                        SET kg_cangkang = ?, 
                            kg_palmfiber = ?, 
                            kg_woodchips = ?, 
                            kg_serbukkayu = ?, 
                            kg_sabutkelapa = ?, 
                            kg_efbpress = ?, 
                            kg_opt = ?,
                            tanggal = ?
                        WHERE pemakaian_bahan_bakar_id = ?
                        RETURNING pemakaian_bahan_bakar_id
                      )
                      UPDATE operasional
                      SET shift = ?,
                        keterangan = ?,
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
    $prepare_update->bindParam(21, $_POST['tanggal']);
    $prepare_update->bindParam(22, $_GET['operasional_id']);

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

