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
                window.location.href = '../wtp/cooling_tower.php';
            });
        </script>
    ";
}

require_once("wtp_data.php");
require_once(SITE_ROOT."/src/header-admin.php");
require_once(SITE_ROOT."/src/footer-admin.php");
require_once(SITE_ROOT."/src/koneksi.php");

// Assuming you have cooling_tower_id as the unique identifier
if (isset($_GET['cooling_tower_id'])) {
    $cooling_tower_id = $_GET['cooling_tower_id'];

    // Fetch the data for the specified cooling_tower_id
    $query = "SELECT * FROM cooling_tower WHERE cooling_tower_id = ?;";
    $prepare_edit = $koneksi->prepare($query);
    $prepare_edit->bindParam(1, $cooling_tower_id, PDO::PARAM_STR);
    $prepare_edit->execute();

    $editData = $prepare_edit->fetch(PDO::FETCH_ASSOC);

    if (!$editData) {
        // Data not found, handle accordingly
        echo "Data not found!";
        exit;
    }
} else {
    // cooling_tower_id not provided, handle accordingly
    echo "cooling_tower_id not provided!";
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
                <h4 style="display: flex; float: left;">EDIT DATA COOLING TOWER</h4>
            </div>
        </div>
        <br>

        <div class="table-responsive-sm table-responsie-md table-responsive-lg">
            <form action="" method="post" id="myForm" enctype="multipart/form-data">
                <!-- Display existing data for editing -->
                <input type="hidden" name="cooling_tower_id" value="<?= $editData['cooling_tower_id'] ?>">

                <table class="table table-hover table-bordered table-sm">
                    <tr>
                        <!-- Tanggal -->
                        <td class="custom-black-bg">Mulai</td>
                        <td><input type="date" value="<?= $editData['tanggal'] ?>" name="tanggal" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <th>Pemakaian Chemical</th>
                    <tr>
                        <!-- Corrotion -->
                        <td class="custom-black-bg">Corrotion Inhibitor (S-3006)</td>
                        <td><input type="number" value="<?= $editData['corrotion_inhibitor'] ?>" name="corrotion" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <!-- Dispersant -->
                        <td class="custom-black-bg">Cooling Water Dispersant (S-3104)</td>
                        <td><input type="number" value="<?= $editData['cooling_water_dispersant'] ?>" name="dispersant" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <!-- Oxy -->
                        <td class="custom-black-bg">OXY HG (S-1450)</td>
                        <td><input type="number" value="<?= $editData['oxy_hg'] ?>" name="oxy" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <!-- Sulfur -->
                        <td class="custom-black-bg">Sulfuric Acid (H2SO4)</td>
                        <td><input type="number" value="<?= $editData['sulfuric_acid'] ?>" name="sulfur" class="form-control" width=20%></td>
                    </tr>
                </table>

                <div class="form-group text-center" style="margin-top: 10px;">
                    <button type="submit" name="update" class="btn btn-primary">
                        <i class="fas fa-save"></i> UPDATE DATA
                    </button>
                    <a href="cooling_tower" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> CANCEL</a>
                </div>
            </form>
        </div>
    </div>

    <?php
    // Update Data
    if (isset($_POST['update'])) {
        $cooling_tower_id = $_POST['cooling_tower_id'];
        $tanggal = $_POST['tanggal'];
        $corrotion = emptyToNull($_POST['corrotion']);
        $dispersant = emptyToNull($_POST['dispersant']);
        $oxy = emptyToNull($_POST['oxy']);
        $sulfur = emptyToNull($_POST['sulfur']);

        //handle tanggal
        $tanggalid = insertOrSelectTanggal($tanggal, $koneksi);

        // Update data in the database
        $update_query = "UPDATE cooling_tower 
                         SET tanggal = ?, 
                             corrotion_inhibitor = ?, 
                             cooling_water_dispersant = ?, 
                             oxy_hg = ?, 
                             sulfuric_acid = ?,
                             tanggal_id = ?
                         WHERE cooling_tower_id = ?";

        $prepare_update = $koneksi->prepare($update_query);

        $prepare_update->bindParam(1, $tanggal);
        $prepare_update->bindParam(2, $corrotion);
        $prepare_update->bindParam(3, $dispersant);
        $prepare_update->bindParam(4, $oxy);
        $prepare_update->bindParam(5, $sulfur);
        $prepare_update->bindParam(6, $tanggalid);
        $prepare_update->bindParam(7, $cooling_tower_id);

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
                        window.location = 'cooling_tower';
                    }
                });
            </script>
            <?php
        } catch (PDOException $e) {
            echo "Error in SQL query: " . $e->getMessage();
            
            echo "PDO ERROR: ". $e -> getMessage();
                echo "SQLSTATE: " . $errorInfo[0] . "<br>";
                echo "Code: " . $errorInfo[1] . "<br>";
                echo "Message: " . $errorInfo[2] . "<br>";

                $koneksi -> rollBack();
        }
    }
    ?>
</body>
