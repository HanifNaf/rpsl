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
                text: 'Anda tidak memiliki izin yang cukup.',
            }).then(function() {
                window.location.href = '../index.php';
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
    $prepare_edit = $koneksi_wtp->prepare($query);
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
            background-color: #228B22;
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

        <div class="table-responsive-sm table-responsie-md table-responsive-lg">
            <form action="" method="post" id="myForm" enctype="multipart/form-data">
                <!-- Display existing data for editing -->
                <input type="hidden" name="cooling_tower_id" value="<?= $editData['cooling_tower_id'] ?>">

                <table class="table table-hover table-bordered table-sm">
                    <tr>
                        <!-- Nomor -->
                        <td class="custom-black-bg">No</td>
                        <td><?= $editData['nomor'] ?></td>
                    </tr>
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
                        <td><input type="number" value="<?= $editData['sulphuric_acid'] ?>" name="sulfur" class="form-control" width=20%></td>
                    </tr>
                </table>

                <div class="form-group text-center" style="margin-top: 10px;">
                    <button type="submit" name="update" class="btn btn-primary">
                        <i class="fas fa-save"></i> UPDATE DATA
                    </button>
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

        // Update data in the database
        $update_query = "UPDATE cooling_tower 
                         SET tanggal = :tanggal, 
                             corrotion_inhibitor = :corrotion, 
                             cooling_water_dispersant = :dispersant, 
                             oxy_hg = :oxy, 
                             sulphuric_acid = :sulfur
                         WHERE cooling_tower_id = :cooling_tower_id";

        $prepare_update = $koneksi_wtp->prepare($update_query);

        $prepare_update->bindParam(':tanggal', $tanggal);
        $prepare_update->bindParam(':corrotion', $corrotion);
        $prepare_update->bindParam(':dispersant', $dispersant);
        $prepare_update->bindParam(':oxy', $oxy);
        $prepare_update->bindParam(':sulfur', $sulfur);
        $prepare_update->bindParam(':cooling_tower_id', $cooling_tower_id);

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
        }
    }
    ?>
</body>
