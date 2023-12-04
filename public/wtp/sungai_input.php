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
                window.location.href = '../wtp/sungai.php';
            });
        </script>
    ";
}

require_once(SITE_ROOT."/src/header-admin.php");
require_once(SITE_ROOT."/src/footer-admin.php");
require_once(SITE_ROOT."/src/koneksi.php");
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
            <!--Nama Divisi-->
            <div class="col-md-6 col-sm-12 col">
            <h4 style="display: flex; float: left;">INPUT DATA PEMAKAIAN CHEMICAL SUNGAI</h4>
            </div> 
            <!--Input Jumlah Kolom-->
            <div class="col-md-6 col-sm-12 col" style="margin-left: auto; max-width:250px;">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="count_add" id="count_add" maxlength="2" pattern="[0-9]+" placeholder="Isi Jumlah Kolom" class="form-control" aria-label="" aria-describedby="basic-addon1" required>
                            <div class="input-group-prepend">
                                <button class="btn btn-success" type="submit" name="generate"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#ffffff" d="M14 12L10 8V11H2V13H10V16M22 12A10 10 0 0 1 2.46 15H4.59A8 8 0 1 0 4.59 9H2.46A10 10 0 0 1 22 12Z" /></svg></button>
                            </div>
                    </div>
                </form>
            </div>
        </div>
        <br>

        <div class="table-responsive-sm table-responsie-md table-responsive-lg">
            <form action="" method="post" id="myForm" enctype="multipart/form-data">
                <input type="hidden" name="total" value="<?= @$_POST['count_add'] ?>">
                <table class="table table-hover table-bordered table-sm">
                    <?php for($i=1; $i<=$_POST['count_add']; $i++){ ?>
                        <tr>
                            <!-- Tanggal -->
                            <td class="custom-black-bg" width="30%">  Tanggal  </td>
                            <td><input type="date" value="<? date('Y-m-d') ?>" name="tanggal-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- M3 Air -->
                            <td class="custom-black-bg" width="30%">  M<sup>3</sup>  </td>
                            <td><input type="number" step="any" name="m3-air-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>

                        <tr>
                            <!-- Pemisah -->
                           <td> </td> 
                        </tr>
                        <th>Pemakaian Chemical</th>
                        <tr>
                            <!-- Koagulan -->
                            <td class="custom-black-bg">Koagulan<br>(S-1009)</td>
                            <td> <input type="number" step="any" name="koagulan-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Soda  -->
                            <td class="custom-black-bg">Soda<br>(Ash)</td>
                            <td> <input type="number" step="any" name="soda-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Flokulan -->
                            <td class="custom-black-bg">Flokulan<br>(S-1101)</td>
                            <td> <input type="number" step="any" name="flokulan-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>     

                    <?php } ?>
                </table>
                <div class="form-group text-center" style="margin-top: 10px;">
                <button type="submit" name="add" class="btn btn-primary"><i class="fas fa-save"><a href="sungai"></a></i> TAMBAH DATA
                </button>
                <a href="sungai" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> CANCEL</a>
                </div>
            </form>
        </div> 
    </div> <!--Akhir Container-->
<!-- Menambahan ke Database -->
<?php 
    if(isset($_POST['add'])){
        $total = $_POST['total'];

        //Menyimpan input dalam variabel (Menggunakan looping)
        for($i=1; $i<=$total; $i++){
            
            $tanggal = $_REQUEST['tanggal-'.$i];
            $m3_air = emptyToNull($_REQUEST['m3-air-'.$i]);

            //Chemical
            $koagulan = emptyToNull($_REQUEST['koagulan-'.$i]);
            $soda = emptyToNull($_REQUEST['soda-'.$i]);
            $flokulan = emptyToNull($_REQUEST['flokulan-'.$i]);

            //handle tanggal
            $tanggalid = insertOrSelectTanggal($tanggal, $koneksi);

            //Query Insert
            $query = "INSERT INTO sungai(sungai_id, tanggal, koagulan, soda_ash, flokulan, m3_air, tanggal_id) 
                    VALUES(uuid_generate_v4(), ?, ?, ?, ?, ?, ?);"; 
            
            //Prepare
            $prep = $koneksi -> prepare($query);

            //bind parameter
            $prep ->bindParam(1, $tanggal);
            $prep ->bindParam(2, $koagulan);
            $prep ->bindParam(3, $soda);
            $prep ->bindParam(4, $flokulan);
            $prep ->bindParam(5, $m3_air);
            $prep ->bindParam(6, $tanggalid);
            
            //Insert
            try{
                $koneksi -> beginTransaction();
                $prep -> execute();
                $koneksi -> commit();

                ?>
                <script type="text/javascript">
                    Swal.fire({
                        title: 'Tambah Data Lagi?',
                        text: "Data Berhasil disimpan!",
                        type: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Iya!',
                        cancelButtonText: 'Tidak!',
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'sungai_input';
                        } else {
                            window.location = 'sungai';
                        }
                    })
                </script>
                <?php

            } catch(PDOException $e) {
                echo "PDO ERROR: ". $e -> getMessage();
            
                echo "PDO ERROR: ". $e -> getMessage();
                    echo "SQLSTATE: " . $errorInfo[0] . "<br>";
                    echo "Code: " . $errorInfo[1] . "<br>";
                    echo "Message: " . $errorInfo[2] . "<br>";
    
                    $koneksi -> rollBack();
            }
        }
    }
?>


</body>