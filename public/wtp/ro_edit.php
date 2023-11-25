<?php
require_once("../../config/config.php");

// Cek role
if (!in_array($_SESSION['role'], ['wtp', 'admin'])) {
    echo "<p style='color: white;'>Akses Dibatasi. Anda tidak memiliki izin yang cukup.</p>";

    // Menambahkan skrip SweetAlert untuk notifikasi yang lebih menarik
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Dibatasi',
            }).then(function() {
                window.location.href = '../wtp/ro.php';
            });
        </script>
    ";
}

require_once("wtp_data.php");
require_once(SITE_ROOT."/src/header-admin.php");
require_once(SITE_ROOT."/src/footer-admin.php");
require_once(SITE_ROOT."/src/koneksi.php");

// Assuming you have ro_id as the unique identifier
if (isset($_GET['ro_id'])) {
    $ro_id = $_GET['ro_id'];

    // Fetch the data for the specified ro_id
    $query = "SELECT * FROM ro WHERE ro_id = ?;";
    $prepare_edit = $koneksi_wtp->prepare($query);
    $prepare_edit->bindParam(1, $ro_id, PDO::PARAM_STR);
    $prepare_edit->execute();

    $editData = $prepare_edit->fetch(PDO::FETCH_ASSOC);

    if (!$editData) {
        // Data not found, handle accordingly
        echo "Data not found!";
        exit;
    }
} else {
    // ro_id not provided, handle accordingly
    echo "ro_id not provided!";
    exit;
}
?>

<head>
    <meta charset="UTF-8">
    <style>
        .custom-black-bg {
            background-color: #2ca143;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Import JS Sweet Alert -->
        <script src="../js/sweetalert2.all.min.js"></script>

        <div class="row">
            <div class="col-md-6 col-sm-12 col">
                <h4 style="display: flex; float: left;">EDIT DATA PEMAKAIAN CHEMICAL RO</h4>
            </div>
        </div>
        <br>

        <div class="table-responsive-sm table-responsie-md table-responsive-lg">
            <form action="" method="post" id="myForm" enctype="multipart/form-data">
                <!-- Display existing data for editing -->
                <input type="hidden" name="ro_id" value="<?= $editData['ro_id'] ?>">

                <table class="table table-hover table-bordered table-sm">
                    <tr>
                        <!-- Tanggal -->
                        <td class="custom-black-bg">Tanggal</td>
                        <td><input type="date" value="<?= $editData['tanggal'] ?>" name="tanggal" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <!-- M3 Air -->
                        <td class="custom-black-bg">M<sup>3</sup> Air</td>
                        <td><input type="number" value="<?= $editData['m3_air'] ?>" name="m3_air" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <th>Pemakaian Chemical</th>
                    <tr>
                        <!-- Treatment Anti Scalant -->
                        <td class="custom-black-bg">Treatment Anti Scalant (S-8010)</td>
                        <td><input type="number" value="<?= $editData['anti_scalant'] ?>" name="anti" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <!-- Alkalinity Boster -->
                        <td class="custom-black-bg">Alkalinity Boster (S–2002)</td>
                        <td><input type="number" value="<?= $editData['alkalinity_booster'] ?>" name="alkalinity" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <!-- Asam S -->
                        <td class="custom-black-bg">Asam (S-4241)</td>
                        <td><input type="number" value="<?= $editData['asam_s4241'] ?>" name="asam_s" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <!-- Asam H -->
                        <td class="custom-black-bg">Asam (Hcl)</td>
                        <td><input type="number" value="<?= $editData['asam_hcl'] ?>" name="asam_h" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <!-- Basa S -->
                        <td class="custom-black-bg">Basa (S-4243)</td>
                        <td><input type="number" value="<?= $editData['basa_s4243'] ?>" name="basa_s" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <!-- Basa C -->
                        <td class="custom-black-bg">Basa (Caustik Soda)</td>
                        <td><input type="number" value="<?= $editData['basa_caustik'] ?>" name="basa_c" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <!-- Cart 30 -->
                        <td class="custom-black-bg">Catridge (30")</td>
                        <td><input type="number" value="<?= $editData['cartridge_30'] ?>" name="cart_30" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <!-- Cart 40 -->
                        <td class="custom-black-bg">Catridge (40")</td>
                        <td><input type="number" value="<?= $editData['cartridge_40'] ?>" name="cart_40" class="form-control" width=20%></td>
                    </tr>
                </table>

                <div class="form-group text-center" style="margin-top: 10px;">
                    <button type="submit" name="update" class="btn btn-primary"><i class="fas fa-save"></i> UPDATE DATA</button>
                    <a href="ro" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> CANCEL</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Update Data to Database -->
    <?php
    if (isset($_POST['update'])) {
        $ro_id = $_POST['ro_id'];
        $tanggal = $_POST['tanggal'];
        $m3_air = emptyToNull($_POST['m3_air']);
        $anti_scalant = emptyToNull($_POST['anti']);
        $alkalinity_booster = emptyToNull($_POST['alkalinity']);
        $asam_s4241 = emptyToNull($_POST['asam_s']);
        $asam_hcl = emptyToNull($_POST['asam_h']);
        $basa_s4243 = emptyToNull($_POST['basa_s']);
        $basa_caustik = emptyToNull($_POST['basa_c']);
        $cartridge_40 = emptyToNull($_POST['cart_40']);
        $cartridge_30 = emptyToNull($_POST['cart_30']);

        // Update Query
        $updateQuery = "UPDATE ro SET tanggal=?, m3_air=?, anti_scalant=?, alkalinity_booster=?, 
            asam_s4241=?, asam_hcl=?, basa_s4243=?, basa_caustik=?, cartridge_40=?, cartridge_30=? WHERE ro_id=?;";

        // Prepare
        $prepUpdate = $koneksi_wtp->prepare($updateQuery);

        // Bind parameters
        $prepUpdate->bindParam(1, $tanggal);
        $prepUpdate->bindParam(2, $m3_air);
        $prepUpdate->bindParam(3, $anti_scalant);
        $prepUpdate->bindParam(4, $alkalinity_booster);
        $prepUpdate->bindParam(5, $asam_s4241);
        $prepUpdate->bindParam(6, $asam_hcl);
        $prepUpdate->bindParam(7, $basa_s4243);
        $prepUpdate->bindParam(8, $basa_caustik);
        $prepUpdate->bindParam(9, $cartridge_40);
        $prepUpdate->bindParam(10, $cartridge_30);
        $prepUpdate->bindParam(11, $ro_id);

        // Execute the update
       try {
            $koneksi_wtp->beginTransaction();
            $prepUpdate->execute();
            $koneksi_wtp->commit();

            echo "<script>
                    Swal.fire({
                        title: 'Data Updated!',
                        text: 'Data has been updated successfully.',
                        type: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = 'ro';
                        }
                    });
                  </script>";
        } catch (PDOException $e) {
            echo "PDO ERROR: " . $e->getMessage();
            $koneksi_wtp->rollBack();
        } finally {
            echo pg_last_error();
        }
    }
    ?>
</body>

</body>
