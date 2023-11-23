<?php 
require_once("../../config/config.php");
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
            <h2 style="display: flex; float: left;">PEMAKAIAN CHEMICAL BOILER</h2>
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
                            <!-- M3 Air -->
                            <td class="custom-black-bg" width="30%">  M<sup>3</sup>  </td>
                            <td><input type="number" name="m3-air-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>

                        <tr>
                            <!-- Pemisah -->
                           <td> </td> 
                        </tr>
                        <th>Pemakaian Chemical</th>
                        <tr>
                            <!-- Alkalinity -->
                            <td class="custom-black-bg">Alkalinity Boster<br>(S–2001)</td>
                            <td> <input type="number" name="alkalinity-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Oxygen -->
                            <td class="custom-black-bg">Oxygen Scavenger<br>(S-2101)</td>
                            <td> <input type="number" name="oxygen-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Internal -->
                            <td class="custom-black-bg">Internal Treatment<br>(S-2201)</td>
                            <td> <input type="number" name="internal-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>                        
                        <tr>
                            <!-- Condensate-->
                            <td class="custom-black-bg">Condensate Treatment<br>(S-2301)</td>
                            <td> <input type="number" name="condensate-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Solid -->
                            <td class="custom-black-bg">Solid Additive<br>(S-6001)</td>
                            <td> <input type="number" name="solid-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>

                    <?php } ?>
                </table>
                <div class="form-group text-center" style="margin-top: 10px;">
                <button type="submit" name="add" class="btn btn-primary"><i class="fas fa-save"><a href="boiler"></a></i> TAMBAH DATA</button>
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
            $alkalinity = emptyToNull($_REQUEST['alkalinity-'.$i]);
            $oxygen = emptyToNull($_REQUEST['oxygen-'.$i]);
            $internal = emptyToNull($_REQUEST['internal-'.$i]);
            $condensate = emptyToNull($_REQUEST['condensate-'.$i]);
            $solid = emptyToNull($_REQUEST['solid-'.$i]);

            //Query Insert
            $query = "INSERT INTO chemical_boiler(boiler_id, tanggal, alkalinity_booster, oxygen_scavenger, 
                    internal_treatment, condensate_treatment, solid_additive, m3_air) 
                    VALUES(uuid_generate_v4(), ?, ?, ?, ?, ?, ?, ?);"; 
            
            //Prepare
            $prep = $koneksi_wtp -> prepare($query);

            //bind parameter
            $prep ->bindParam(1, $tanggal);
            $prep ->bindParam(2, $alkalinity);
            $prep ->bindParam(3, $oxygen);
            $prep ->bindParam(4, $internal);
            $prep ->bindParam(5, $condensate);
            $prep ->bindParam(6, $solid);
            $prep ->bindParam(7, $m3_air);
            
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
                            window.location = 'boiler_input';
                        } else {
                            window.location = 'boiler';
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