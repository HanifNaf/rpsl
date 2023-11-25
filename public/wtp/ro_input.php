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
                window.location.href = '../wtp/ro.php';
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
            <h2 style="display: flex; float: left;">INPUT DATA PEMAKAIAN CHEMICAL RO</h2>
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
                            <!-- Nomor -->
                            <td class="custom-black-bg">No</td>
                            <td> <?= $i ?> </td>
                        </tr>
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
                            <!-- Anti -->
                            <td class="custom-black-bg">Treatment Anti Scalant<br>(S-8010)</td>
                            <td> <input type="number" step="any" name="anti-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Alkalinity  -->
                            <td class="custom-black-bg">Alkalinity Boster<br>(S–2002)</td>
                            <td> <input type="number" step="any" name="alkalinity-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Asam S -->
                            <td class="custom-black-bg">Asam<br>(S-4241)</td>
                            <td> <input type="number" step="any" name="asam-s-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Asam H -->
                            <td class="custom-black-bg">Asam<br>(Hcl)</td>
                            <td> <input type="number" step="any" name="asam-h-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Basa S  -->
                            <td class="custom-black-bg">Basa<br>(S-4243)</td>
                            <td> <input type="number" step="any" name="basa-s-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Basa C -->
                            <td class="custom-black-bg">Basa<br>(Caustik Soda)</td>
                            <td> <input type="number" step="any" name="basa-c-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Cart 30 -->
                            <td class="custom-black-bg">Catridge<br>(30")</td>
                            <td> <input type="number" step="any" name="cart-30-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Cart 40  -->
                            <td class="custom-black-bg">Catridge<br>(40")</td>
                            <td> <input type="number" step="any" name="cart-40-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>     

                    <?php } ?>
                </table>
                <div class="form-group text-center" style="margin-top: 10px;">
                <button type="submit" name="add" class="btn btn-primary"><i class="fas fa-save"><a href="ro"></a></i> TAMBAH DATA</button>
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
            $anti_scalant = emptyToNull($_REQUEST['anti-'.$i]);
            $alkalinity_booster = emptyToNull($_REQUEST['alkalinity-'.$i]);
            $asam_s4241 = emptyToNull($_REQUEST['asam-s-'.$i]);
            $asam_hcl = emptyToNull($_REQUEST['asam-h-'.$i]);
            $basa_s4243 = emptyToNull($_REQUEST['basa-s-'.$i]);
            $basa_caustik = emptyToNull($_REQUEST['basa-c-'.$i]);
            $cartridge_40 = emptyToNull($_REQUEST['cart-40-'.$i]);
            $cartridge_30 = emptyToNull($_REQUEST['cart-30-'.$i]);

            //Query Insert
            $query = "INSERT INTO ro(ro_id, tanggal, anti_scalant, alkalinity_booster, asam_s4241, 
                    asam_hcl, basa_s4243, basa_caustik, cartridge_40, cartridge_30, m3_air) 
                    VALUES(uuid_generate_v4(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);"; 
            
            //Prepare
            $prep = $koneksi_wtp -> prepare($query);

            //bind parameter
            $prep ->bindParam(1, $tanggal);
            $prep ->bindParam(2, $anti_scalant);
            $prep ->bindParam(3, $alkalinity_booster);
            $prep ->bindParam(4, $asam_s4241);
            $prep ->bindParam(5, $asam_hcl);
            $prep ->bindParam(6, $basa_s4243);
            $prep ->bindParam(7, $basa_caustik);
            $prep ->bindParam(8, $cartridge_40);
            $prep ->bindParam(9, $cartridge_30);
            $prep ->bindParam(10, $m3_air);

            
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
                            window.location = 'ro_input';
                        } else {
                            window.location = 'ro';
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