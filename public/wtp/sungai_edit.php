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
                window.location.href = '../wtp/sungai.php';
            });
        </script>
    ";
}

require_once(SITE_ROOT."/src/header-admin.php");
require_once(SITE_ROOT."/src/footer-admin.php");
require_once(SITE_ROOT."/src/koneksi.php");

// Assuming you have sungai_id as the unique identifier
if (isset($_GET['sungai_id'])) {
    $sungai_id = $_GET['sungai_id'];

    // Fetch the data for the specified sungai_id
    $query = "SELECT * FROM sungai WHERE sungai_id = ?;";
    $prepare_edit = $koneksi_wtp->prepare($query);
    $prepare_edit->bindParam(1, $sungai_id, PDO::PARAM_STR);
    $prepare_edit->execute();

    $editData = $prepare_edit->fetch(PDO::FETCH_ASSOC);

    if (!$editData) {
        // Data not found, handle accordingly
        echo "Data not found!";
        exit;
    }
} else {
    // sungai_id not provided, handle accordingly
    echo "sungai_id not provided!";
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
                <h4 style="display: flex; float: left;">EDIT DATA PEMAKAIAN CHEMICAL SUNGAI</h4>
            </div>
        </div>
        <br>

        <div class="table-responsive-sm table-responsie-md table-responsive-lg">
            <form action="" method="post" id="myForm" enctype="multipart/form-data">
                <!-- Display existing data for editing -->
                <input type="hidden" name="sungai_id" value="<?= $editData['sungai_id'] ?>">

                <table class="table table-hover table-bordered table-sm">
                    <tr>
                        <!-- Nomor -->
                        <td class="custom-black-bg">No</td>
                        <td><?= $editData['nomor'] ?></td>
                    </tr>
                    <tr>
                        <!-- Tanggal -->
                        <td class="custom-black-bg">Tanggal</td>
                        <td><input type="date" value="<?= $editData['tanggal'] ?>" name="tanggal" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <!-- M3 Air -->
                        <td class="custom-black-bg">M<sup>3</sup> Air</td>
                        <td><input type="number" step="any" value="<?= $editData['m3_air'] ?>" name="m3_air" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    <th>Pemakaian Chemical</th>
                    <tr>
                        <!-- Koagulan -->
                        <td class="custom-black-bg">Koagulan (S-1009)</td>
                        <td><input type="number" step="any" value="<?= $editData['koagulan'] ?>" name="koagulan" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <!-- Soda -->
                        <td class="custom-black-bg">Soda (Ash)</td>
                        <td><input type="number" step="any" value="<?= $editData['soda_ash'] ?>" name="soda" class="form-control" width=20%></td>
                    </tr>
                    <tr>
                        <!-- Flokulan -->
                        <td class="custom-black-bg">Flokulan (S-1101)</td>
                        <td><input type="number" step="any" value="<?= $editData['flokulan'] ?>" name="flokulan" class="form-control" width=20%></td>
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
        $sungai_id = $_POST['sungai_id'];
        $tanggal = $_POST['tanggal'];
        $m3_air = $_POST['m3_air'];
        $koagulan = emptyToNull($_POST['koagulan']);
        $soda = emptyToNull($_POST['soda']);
        $flokulan = emptyToNull($_POST['flokulan']);

        // Update data in the database
        $update_query = "UPDATE sungai 
                         SET tanggal = :tanggal, 
                             m3_air = :m3_air, 
                             koagulan = :koagulan, 
                             soda_ash = :soda, 
                             flokulan = :flokulan
                         WHERE sungai_id = :sungai_id";

        $prepare_update = $koneksi_wtp->prepare($update_query);

        $prepare_update->bindParam(':tanggal', $tanggal);
        $prepare_update->bindParam(':m3_air', $m3_air);
        $prepare_update->bindParam(':koagulan', $koagulan);
        $prepare_update->bindParam(':soda', $soda);
        $prepare_update->bindParam(':flokulan', $flokulan);
        $prepare_update->bindParam(':sungai_id', $sungai_id);

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
                        window.location = 'sungai';
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
