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

require_once(SITE_ROOT."/src/header-admin.php");
require_once(SITE_ROOT."/src/footer-admin.php");
require_once(SITE_ROOT."/src/koneksi.php");
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
            <!--Nama Divisi-->
            <div class="col-md-6 col-sm-12 col">
            <h4 style="display: flex; float: left;">INPUT DATA PEMAKAIAN CHEMICAL COOLING TOWER</h4>
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
        <div class="table-responsive-sm table-responsie-md table-responsive-lg">
            <form action="" method="post" id="myForm" enctype="multipart/form-data">
                <input type="hidden" name="total" value="<?= @$_POST['count_add'] ?>">
                <table class="table table-hover table-bordered table-sm">
                    <?php for($i=1; $i<=$_POST['count_add']; $i++){ ?>
                        <tr>
                            <!-- Nomor -->
                            <td class="custom-black-bg">No</td>
                            <td> <?= $i ?> </td>
                        </tr>
                        <tr>
                            <!-- Tanggal -->
                            <td class="custom-black-bg" width="30%">  Mulai  </td>
                            <td><input type="date" value="<? date('Y-m-d') ?>" name="tanggal-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                           <td> </td> 
                        </tr>
                        <th>Pemakaian Chemical</th>
                        <tr>
                            <!-- Corrotion -->
                            <td class="custom-black-bg">Corrotion Inhibitor<br>(S-3006)</td>
                            <td> <input type="number" name="corrotion-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Dispersant -->
                            <td class="custom-black-bg">Cooling Water Dispersant<br>(S-3104)</td>
                            <td> <input type="number" name="dispersant-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Oxy -->
                            <td class="custom-black-bg">OXY HG<br>(S-1450)</td>
                            <td> <input type="number" name="oxy-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>     
                        <tr>
                            <!-- Sulfur -->
                            <td class="custom-black-bg">Sulfuric Acid<br>(H2SO4)</td>
                            <td> <input type="number" name="sulfur-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>   

                    <?php } ?>
                </table>
                <div class="form-group text-center" style="margin-top: 10px;">
                <button type="submit" name="add" class="btn btn-primary"><i class="fas fa-save"><a href="cooling_tower"></a></i> TAMBAH DATA</button>
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

            //Chemical
            $corrotion = emptyToNull($_REQUEST['corrotion-'.$i]);
            $dispersant = emptyToNull($_REQUEST['dispersant-'.$i]);
            $oxy = emptyToNull($_REQUEST['oxy-'.$i]);
            $sulfur = emptyToNull($_REQUEST['sulfur-'.$i]);

            //Query Insert
            $query = "INSERT INTO cooling_tower(cooling_tower_id, tanggal, corrotion_inhibitor,
                    cooling_water_dispersant, oxy_hg, sulphuric_acid) 
                    VALUES(uuid_generate_v4(), ?, ?, ?, ?, ?);"; 
            
            //Prepare
            $prep = $koneksi_wtp -> prepare($query);

            //bind parameter
            $prep ->bindParam(1, $tanggal);
            $prep ->bindParam(2, $corrotion);
            $prep ->bindParam(3, $dispersant);
            $prep ->bindParam(4, $oxy);
            $prep ->bindParam(5, $sulfur);
            
            //Insert
            try{
                $koneksi_wtp -> beginTransaction();
                $prep -> execute();
                $koneksi_wtp -> commit();

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
                            window.location = 'cooling_tower_input';
                        } else {
                            window.location = 'cooling_tower';
                        }
                    })
                </script>
                <?php

            } catch(PDOException $e) {
                echo "PDO ERROR: ". $e -> getMessage();
                $koneksi_wtp -> rollBack();

            } finally{
                echo pg_last_error();
            }
        }
    }
?>


</body>