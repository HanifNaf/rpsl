<?php 
require_once ("../../config/config.php");
require(SITE_ROOT."/src/header-admin.php");
require(SITE_ROOT."/src/footer-admin.php");
require (SITE_ROOT."/src/koneksi.php");
?>

<head>
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
        <script src="<?= SITE_URL?>/public/assets/js/sweetalert2.all.min.js"></script>

        <div class="row">
            <!--Nama Divisi-->
		    <div class="col-md-6 col-sm-12 col">
		    <h2 style="display: flex; float: left;">INPUT DATA OPERASIONAL</h2>
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
            <form action="" method="post">
                <input type="hidden" name="total" value="<?= @$_POST['count_add'] ?>">
                <table class="table table-hover table-bordered table-sm">
                    <?php for($i=1; $i<=$_POST['count_add']; $i++){ ?>
                        <tr>
                            <!-- Tanggal -->
                            <td class="custom-black-bg">Tanggal</td>
                            <td> <input type="date" value="<? date('Y-m-d') ?>" name="tanggal-<?=$i?>" class="form-control" width=50%> </td>
                        </tr>
                        <tr>
                            <!-- Shift -->
                            <td class="custom-black-bg">Shift</td>
                            <td>
                                <select name="shift-<?=$i?>" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </td>
                        </tr>
                            <!-- Generasi -->
                            <td class="custom-black-bg">Generasi</td>
                            <td><input type="number" name="generasi-<?=$i?>" style="form-control" width=50%></td>
                        </tr>
                        <tr>    
                            <!-- PM Kwh PLTBM -->
                            <td class="custom-black-bg">PM Kwh PLTBM</td>
                            <td><input type="number" name="pm-kwh-pltbm-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Ekspor -->
                            <td class="custom-black-bg">Ekspor</td>
                            <td><input type="number" name="ekspor-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pemakaian Sendiri -->
                            <td class="custom-black-bg">Pemakaian Sendiri</td>
                            <td><input type="number" name="pemakaian-sendiri-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Kwh Loss -->
                            <td class="custom-black-bg">Kwh Loss</td>
                            <td><input type="number" name="kwh-loss-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pemakaian Cangkang -->
                            <td class="custom-black-bg">Pemakaian Cangkang</td>
                            <td><input type="number" name="cangkang-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian Palm Fiber -->
                            <td class="custom-black-bg">Pemakaian Palm Fiber</td>
                            <td><input type="number" name="palm-fiber-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian Wood Chips -->
                            <td class="custom-black-bg">Pemakaian Wood Chips</td>
                            <td><input type="number" name="wood-chips-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian Serbuk Kayu -->
                            <td class="custom-black-bg" width="20%">Pemakaian Serbuk Kayu</td>
                            <td><input type="number" name="serbuk-kayu-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian Sabut Kelapa -->
                            <td class="custom-black-bg">Pemakaian Sabut Kelapa</td>
                            <td><input type="number" name="sabut-kelapa-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian EFB Press -->
                            <td class="custom-black-bg">Pemakaian EFB Press</td>
                            <td><input type="number" name="efb-press-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian OPT -->
                            <td class="custom-black-bg">Pemakaian OPT</td>
                            <td><input type="number" name="opt-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- keterangan -->
                            <td class="custom-black-bg">Keterangan</td>
                            <td><input type="text" name="keterangan-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                        </tr>
                    <?php } ?>
                </table>
                <div class="form-group text-center" style="margin-top: 10px;">
                <button type="submit" name="add" class="btn btn-primary"><i class="fas fa-save"><a href="operasional"></a></i> TAMBAH DATA</button>
            	</div>
            </form>
        </div> 
    </div> <!--Akhir Container-->
<!-- Menambahan ke Database -->
<?php 
    if(isset($_POST['add'])){
        $total = $_POST['total'];

        //Menyimpan input dalalm variabel (Menggunakan looping)
        for($i=1; $i<=$total; $i++){
            $tanggal = $_REQUEST['tanggal-'.$i];
            $shift = $_REQUEST['shift-'.$i];
            $generasi = $_REQUEST['generasi-'.$i];
            $pm_kwh_pltbm = $_REQUEST['pm-kwh-pltbm-'.$i];
            $ekspor = $_REQUEST['ekspor-'.$i];
            $pemakaian_sendiri = $_REQUEST['pemakaian-sendiri-'.$i];
            $kwh_loss = $_REQUEST['kwh-loss-'.$i];
            $cangkang = $_REQUEST['cangkang-'.$i];
            $palm_fiber = $_REQUEST['palm-fiber-'.$i];
            $wood_chips = $_REQUEST['wood-chips-'.$i];
            $serbuk_kayu = $_REQUEST['serbuk-kayu-'.$i];
            $sabut_kelapa = $_REQUEST['sabut-kelapa-'.$i];
            $efb = $_REQUEST['efb-press-'.$i];
            $opt = $_REQUEST['opt-'.$i];
            $supervisor = $_REQUEST['supervisor-'.$i];
            $keterangan = emptyToNull($_REQUEST['keterangan-'.$i]);

            //Insert ke database
            $insert_query = "WITH in1 AS(
                INSERT INTO produksi_kwh (produksi_id, shift, generation, pm_kwh_pltbm, tanggal, waktu) VALUES (uuid_generate_v4(), ?,?,?,?, LOCALTIME)
                RETURNING produksi_id AS produksi),
                in2 AS (
                INSERT INTO pemakaian_kwh (pemakaian_id, shift, ekspor, pemakaian_sendiri, kwh_loss, tanggal, waktu) VALUES (uuid_generate_v4(), ?,?,?,?,?, LOCALTIME)
                RETURNING pemakaian_id AS pakai),
                in3 AS (
                INSERT INTO pemakaian_bahan_bakar (pemakaian_bahan_bakar_id, shift, tanggal, waktu, kg_cangkang, kg_palmfiber, kg_woodchips, kg_serbukkayu, kg_sabutkelapa, kg_efbpress, kg_opt) VALUES (uuid_generate_v4(), ?,?, LOCALTIME, ?,?,?,?,?,?,?)
                RETURNING pemakaian_bahan_bakar_id AS bahan_bakar)
                INSERT INTO operasional (operasional_id, produksi_id, pemakaian_id, pemakaian_bahan_bakar_id, supervisor, shift, tanggal, waktu, keterangan)
                SELECT uuid_generate_v4(), (SELECT produksi FROM in1), (SELECT pakai FROM in2), (SELECT bahan_bakar FROM in3), ?,?,?, LOCALTIME, ?;"; 
            
            $prep = $koneksi_operasional -> prepare();

            //bind parameter
            $prep ->bindParam(1, $shift);
            $prep ->bindParam(2, $generasi);
            $prep ->bindParam(3, $pm_kwh_pltbm);
            $prep ->bindParam(4, $tanggal);

            $prep ->bindParam(5, $shift);
            $prep ->bindParam(6, $ekspor);
            $prep ->bindParam(7, $pemakaian_sendiri);
            $prep ->bindParam(8, $kwh_loss);
            $prep ->bindParam(9, $tanggal);

            $prep ->bindParam(10, $shift);
            $prep ->bindParam(11, $tanggal);
            $prep ->bindParam(12, $cangkang);
            $prep ->bindParam(13, $palm_fiber);
            $prep ->bindParam(14, $wood_chips);
            $prep ->bindParam(15, $serbuk_kayu);
            $prep ->bindParam(16, $sabut_kelapa);
            $prep ->bindParam(17, $efb);
            $prep ->bindParam(18, $opt);

            $prep ->bindParam(19, $supervisor);
            $prep ->bindParam(20, $shift);
            $prep ->bindParam(21, $tanggal);
            $prep ->bindParam(22, $keterangan);

            try{
                $koneksi_operasional -> beginTransaction();
                $prep -> execute();
                $koneksi_operasional -> commit();

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
                            window.location = 'operasional_input';
                        } else {
                            window.location = 'operasional';
                        }
                    })
                </script>

                <?php
            } catch(PDOException $e) {
                echo "PDO ERROR: ". $e -> getMessage();
            }
        }
    }
?>
</body>