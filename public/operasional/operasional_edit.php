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


// Cek id
if (isset($_GET['pr'], $_GET['op'], $_GET['pe'], $_GET['ba'])){
    $produksi = $_GET['pr'];
    $operasional = $_GET['op'];
    $pemakaian = $_GET['pe'];
    $bahan_bakar = $_GET['ba'];



    $edit_query = "SELECT t1.produksi_id, t1.generation, t1.pm_kwh_pltbm, 
        t2.operasional_id, t2.tanggal, t2.waktu, t2.shift, t2.keterangan, t2.downtime, 
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

    $prepare_edit = $koneksi->prepare($edit_query);
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
//    $prepare_edit = $koneksi->prepare($edit_query);
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
                                <option value="1" <?php echo ($dataToEdit['shift'] == 1) ? 'selected' : ''; ?>>1</option>
                                <option value="2" <?php echo ($dataToEdit['shift'] == 2) ? 'selected' : ''; ?>>2</option>
                                <option value="3" <?php echo ($dataToEdit['shift'] == 3) ? 'selected' : ''; ?>>3</option>
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
                        <!-- Downtime -->
                        <tr>
                            <td class="custom-black-bg">Downtime (Jam)</td>
                            <td><input type="number" value="<?= $dataToEdit['downtime'] ?>" name="downtime" class="form-control"></td>
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

    // Produksi
    $shift = $_POST['shift'];
    $generasi = $_POST['generasi'];
    $pm_kwh_pltbm = $_POST['pm-kwh-pltbm'];

    //Pemakaian
    $ekspor = $_POST['ekspor'];
    $pemakaian_sendiri = $_POST['pemakaian-sendiri'];
    $kwh_loss = $_POST['kwh-loss'];

    //Bahan Bakar
    $cangkang = $_POST['kg_cangkang'];
    $palm_fiber = $_POST['kg_palmfiber'];
    $wood_chips = $_POST['kg_woodchips'];
    $serbuk_kayu = $_POST['kg_serbukkayu'];
    $sabut_kelapa = $_POST['kg_sabutkelapa'];
    $efb = $_POST['kg_efbpress'];
    $opt = $_POST['kg_opt'];

    //Operasional
    $downtime = $_POST['downtime'];
    $keterangan = emptyToNull($_POST['keterangan']);

    // Tanggal
    $tanggal = $_POST['tanggal'];
    $tanggalid = insertOrSelectTanggal($tanggal, $koneksi);


    // Mulai Statement
    $koneksi->beginTransaction();

    try {
        // Update produksi_kwh
        $produksi_query = "UPDATE produksi_kwh 
                        SET shift = ?,
                            generation = ?, 
                            pm_kwh_pltbm = ?,
                            tanggal = ?,
                            tanggal_id =?
                        WHERE produksi_id = ?;";

        $prep_produksi = $koneksi->prepare($produksi_query);
        $prep_produksi->bindParam(1, $shift);
        $prep_produksi->bindParam(2, $generasi);
        $prep_produksi->bindParam(3, $pm_kwh_pltbm);
        $prep_produksi->bindParam(4, $tanggal);
        $prep_produksi->bindParam(5, $tanggalid);
        $prep_produksi->bindParam(6, $produksi);

        $prep_produksi->execute();   


        // Update pemakaian_kwh
        $pemakaian_query = "UPDATE pemakaian_kwh
                        SET shift =?,
                            ekspor = ?, 
                            pemakaian_sendiri = ?, 
                            kwh_loss = ?,
                            tanggal = ?,
                            tanggal_id =?
                        WHERE pemakaian_id = ?";
        $prep_pemakaian = $koneksi->prepare($pemakaian_query);
        $prep_pemakaian->bindParam(1, $shift);
        $prep_pemakaian->bindParam(2, $ekspor);
        $prep_pemakaian->bindParam(3, $pemakaian_sendiri);
        $prep_pemakaian->bindParam(4, $kwh_loss);
        $prep_pemakaian->bindParam(5, $tanggal);
        $prep_pemakaian->bindParam(6, $tanggalid);
        $prep_pemakaian->bindParam(7, $pemakaian);

        $prep_pemakaian->execute();


        // Update pemakaian_bahan_bakar
        $bahan_bakar_query = "UPDATE pemakaian_bahan_bakar
                            SET shift = ?,
                                tanggal = ?,
                                kg_cangkang = ?, 
                                kg_palmfiber = ?, 
                                kg_woodchips = ?, 
                                kg_serbukkayu = ?, 
                                kg_sabutkelapa = ?, 
                                kg_efbpress = ?, 
                                kg_opt = ?,
                                tanggal_id =?
                            WHERE pemakaian_bahan_bakar_id = ?;";
        $prep_bahan_bakar = $koneksi->prepare($bahan_bakar_query);
        $prep_bahan_bakar->bindParam(1, $shift);
        $prep_bahan_bakar->bindParam(2, $tanggal);
        $prep_bahan_bakar->bindParam(3, $cangkang);
        $prep_bahan_bakar->bindParam(4, $palm_fiber);
        $prep_bahan_bakar->bindParam(5, $wood_chips);
        $prep_bahan_bakar->bindParam(6, $serbuk_kayu);
        $prep_bahan_bakar->bindParam(7, $sabut_kelapa);
        $prep_bahan_bakar->bindParam(8, $efb);
        $prep_bahan_bakar->bindParam(9, $opt);
        $prep_bahan_bakar->bindParam(10, $tanggalid);
        $prep_bahan_bakar->bindParam(11, $bahan_bakar);

        $prep_bahan_bakar->execute();


        // Insert operasional
        $operasional_query = "UPDATE operasional
                            SET shift = ?,
                              tanggal = ?,
                              downtime = ?,
                              keterangan = ?,
                              tanggal_id =?                              
                            WHERE operasional_id = ?";
        $prep_operasional = $koneksi->prepare($operasional_query);
        $prep_operasional->bindParam(1, $shift);
        $prep_operasional->bindParam(2, $tanggal);
        $prep_operasional->bindParam(3, $downtime);
        $prep_operasional->bindParam(4, $keterangan);
        $prep_operasional->bindParam(5, $tanggalid);
        $prep_operasional->bindParam(6, $operasional);

        $prep_operasional->execute();
        
        // Commit Statement
        $koneksi->commit();  
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

        $koneksi -> rollBack();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();

        $koneksi -> rollBack();
    }
}
?>

