<?php
require_once("../../config/config.php");
require_once("operasional_data.php");
require_once(SITE_ROOT . "/src/header-admin.php");
require_once(SITE_ROOT . "/src/footer-admin.php");
require_once(SITE_ROOT . "/src/koneksi.php");

// Identify the Record to Edit
if (isset($_GET['produksi_id'], $_GET['operasional_id'], $_GET['pemakaian_id'], $_GET['bahan_bakar_id']){
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
        WHERE produksi_id=? 
        AND operasional_id=?
        AND pemakaian_id=?
        AND pemakaian_bahan_bakar_id=?;";

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
//    $edit_query = "SELECT t1.produksi_id, t1.generation, t1.pm_kwh_pltbm, 
//        t2.operasional_id, t2.tanggal, t2.waktu, t2.shift, t2.supervisor, t2.keterangan, 
//        t3.pemakaian_id, t3.ekspor, t3.pemakaian_sendiri, t3.kwh_loss, 
//        t4.pemakaian_bahan_bakar_id, t4.kg_cangkang, t4.kg_palmfiber, t4.kg_woodchips, t4.kg_serbukkayu, t4.kg_sabutkelapa, t4.kg_efbpress, t4.//kg_opt//
//        FROM produ//ksi_kwh t1//
//        INNER JOIN// operasional t2 ON t1.produksi_id=t2.produksi_id//
//        INNER JOIN// pemakaian_kwh t3 ON t2.pemakaian_id=t3.pemakaia//n_id//
//        INNER JOIN// pemakaian_bahan_bakar t4 ON t2.pemakaian_bahan_//bakar_id=t4.pemakaian_bahan_bakar_id //
//        WHERE prod//uksi_id=? //
//        AND operas//ional_id=?//
//        AND pemaka//ian_id=?//
//        AND pemaka//ian_baha//n_bakar_id=?;";//
//    $prepare_edit //= $konek//si_operasional->prepare($edit_query);//
//    $prepare_edit-//>bindPar//am(1, $produksi);//
//    $prepare_edit-//>bindPar//am(2, $operasiona//l);//
//    $prepare_edit-//>bindPar//am(3, $pemakaian)//;//
//    $prepare_edit-//>bindPar//am(4, $bahan_baka//r//);//
//
//    $prepare_edit->execute();
//    $dataToEdit = $prepare_edit->fetch(PDO::FETCH_ASSOC);
//}

/*var encodedID = encodeURIComponent(row.operasional_id + row.produksi_id + row.pemakaian_id + row.pemakaian_bahan_bakar_id);
                        var editButton = '<a href="operasional_edit.php?id=' + encodedID + '" class="btn btn-warning btn-custom d-flex justify-content-center align-items-center">Edit</a>';
                        var deleteButton = '<a href="operasional_delete.php?id=' + encodedID + '" class="btn btn-danger btn-custom d-flex justify-content-center align-items-center" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">Hapus</a>';
                        return editButton + deleteButton;*/
?>

                        

<head>
     <!-- Import JS Sweet Alert -->
        <script src="../js/sweetalert2.all.min.js"></script>
</head>
<body>
    <div class="row">
            <!--Nama Divisi-->
            <div class="col-md-6 col-sm-12 col">
                <h2 style="display: flex; float: left;">OPERASIONAL</h2>
            </div>
        </div>

        <div class="table-responsive-sm table-responsie-md table-responsive-lg">
            <!-- Form for Data Editing -->
            <form action="" method="post">
                <input type="hidden" name="idToEdit" value="<?= $idToEdit ?>">
                <table class="table table-hover table-bordered table-sm">
                    <?php if ($idToEdit && $dataToEdit) { ?>
                        <tr>
                            <!-- Tanggal -->
                            <td class="custom-black-bg">Tanggal</td>
                            <td><input type="date" value="<?= $dataToEdit['tanggal'] ?>" name="tanggal" class="form-control" width=20%></td>
                        </tr>
                        <tr>
                            <!-- Shift -->
                            <td class="custom-black-bg">Shift</td>
                            <td><input type="number" value="<?= $dataToEdit['shift'] ?>" name="shift" class="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Generasi -->
                            <td class="custom-black-bg">Generasi</td>
                            <td><input type="text" value="<?= $dataToEdit['generation'] ?>" name="generation" class="form-control"></td>
                        </tr>
                        <tr>
                            <!-- PM kWh PLTBM -->
                            <td class="custom-black-bg">PM kWh PLTBM</td>
                            <td><input type="number" value="<?= $dataToEdit['pm_kwh_pltbm'] ?>" name="pm_kwh_pltbm" class="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Ekspor -->
                            <td class="custom-black-bg">Ekspor</td>
                            <td><input type="number" value="<?= $dataToEdit['ekspor'] ?>" name="ekspor" class="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian Sendiri -->
                            <td class="custom-black-bg">Pemakaian Sendiri</td>
                            <td><input type="number" value="<?= $dataToEdit['pemakaian_sendiri'] ?>" name="pemakaian_sendiri" class="form-control"></td>
                        </tr>
                        <tr>
                            { data: 'kg_cangkang' },
                { data: 'kg_palmfiber' },
                { data: 'kg_woodchips' },
                { data: 'kg_serbukkayu' },
                { data: 'kg_sabutkelapa' },
                { data: 'kg_efbpress' },
                { data: 'kg_opt' },
                { data: 'supervisor' },
                { data: 'keterangan' },
                <th>Pemakaian Sabut Kelapa (kg)</th>
                <th>Pemakaian EFB Press (kg)</th>
                <th>Pemakaian OPT (kg)</th>
                <th>Supervisor</th>
                <th>Keterangan</th>
                            <!-- kWh Loss -->
                            <td class="custom-black-bg">kWh Loss</td>
                            <td><input type="number" value="<?= $dataToEdit['kwh_loss'] ?>" name="kwh_loss" class="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian Cangkang (kg) -->
                            <td class="custom-black-bg">Pemakaian Cangkang (kg)</td>
                            <td><input type="number" value="<?= $dataToEdit['kg_cangkang'] ?>" name="kg_cangkang" class="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian Palm Fiber (kg) -->
                            <td class="custom-black-bg">Pemakaian Palm Fiber (kg)</td>
                            <td><input type="number" value="<?= $dataToEdit['kg_palmfiber'] ?>" name="kg_palmfiber" class="form-control"></td>
                        </tr>
                         <tr>
                            <!-- Pemakaian Wood Chips (kg) -->
                            <td class="custom-black-bg">Pemakaian Wood Chips (kg)</td>
                            <td><input type="number" value="<?= $dataToEdit['kg_woodchips'] ?>" name="kg_woodchips" class="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian Serbuk Kayu (kg) -->
                            <td class="custom-black-bg">Pemakaian Serbuk Kayu (kg)</td>
                            <td><input type="number" value="<?= $dataToEdit['kg_serbukkayu'] ?>" name="kg_serbukkayu" class="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian Sabut Kelapa (kg) -->
                            <td class="custom-black-bg">Pemakaian Sabut Kelapa (kg)</td>
                            <td><input type="number" value="<?= $dataToEdit['kg_sabutkelapa'] ?>" name="kg_sabutkelapa" class="form-control"></td>
                        </tr>
                        <tr>
                            <!-- PPemakaian EFB Press (kg) -->
                            <td class="custom-black-bg">Pemakaian EFB Press (kg)</td>
                            <td><input type="number" value="<?= $dataToEdit['kg_efbpress'] ?>" name="kg_efbpress" class="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian OPT (kg) -->
                            <td class="custom-black-bg">Pemakaian OPT (kg)</td>
                            <td><input type="number" value="<?= $dataToEdit['kg_opt'] ?>" name="kg_opt" class="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Supervisor -->
                            <td class="custom-black-bg">Supervisor</td>
                            <td><input type="text" value="<?= $dataToEdit['supervisor'] ?>" name="supervisor" class="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Keterangan -->
                            <td class="custom-black-bg">Keterangan</td>
                            <td><input type="text" value="<?= $dataToEdit['keterangan'] ?>" name="keterangan" class="form-control"></td>
                        </tr>
            <<div class="form-group text-center" style="margin-top: 10px;">
                    <button type="submit" name="update" class="btn btn-primary"><i class="fas fa-save"></i> UPDATE DATA</button>
                    <a href="operasional" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> CANCEL</a>
                </div>
            </form>
        </div>
    </div>

    <?php
if (isset($_POST['update'])) {
    // Update data in the database
    $update_query = "UPDATE operasional 
                     SET tanggal = ?, shift = ?, generasi = ?, 
                         pm_kwh_pltbm = ?, ekspor = ?, pemakaian_sendiri = ?, 
                         kwh_loss = ?, cangkang = ?, palm_fiber = ?, 
                         wood_chips = ?, serbuk_kayu = ?, sabut_kelapa = ?, 
                         efb = ?, opt = ?, supervisor = ?, keterangan = ?
                     WHERE operasional_id = ?";

    $prepare_update = $koneksi_operasional->prepare($update_query);

    // Bind parameters
    $prepare_update->bindParam(1, $_POST['tanggal']);
    $prepare_update->bindParam(2, $_POST['shift']);
    $prepare_update->bindParam(3, $_POST['generasi']);
    $prepare_update->bindParam(4, $_POST['pm_kwh_pltbm']);
    $prepare_update->bindParam(5, $_POST['ekspor']);
    $prepare_update->bindParam(6, $_POST['pemakaian_sendiri']);
    $prepare_update->bindParam(7, $_POST['kwh_loss']);
    $prepare_update->bindParam(8, $_POST['cangkang']);
    $prepare_update->bindParam(9, $_POST['palm_fiber']);
    $prepare_update->bindParam(10, $_POST['wood_chips']);
    $prepare_update->bindParam(11, $_POST['serbuk_kayu']);
    $prepare_update->bindParam(12, $_POST['sabut_kelapa']);
    $prepare_update->bindParam(13, $_POST['efb']);
    $prepare_update->bindParam(14, $_POST['opt']);
    $prepare_update->bindParam(15, $_POST['supervisor']);
    $prepare_update->bindParam(16, $_POST['keterangan']);
    $prepare_update->bindParam(17, $_POST['idToEdit']);

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
</body>
