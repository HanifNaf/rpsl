<?php 
require_once ("../../config/config.php");

// Cek role
if (!in_array($_SESSION['role'], ['operasional', 'admin'])) {
    echo "<p style='color: white;'>Akses Dibatasi. Anda tidak memiliki izin yang cukup.</p>";

    // Menambahkan skrip SweetAlert untuk notifikasi yang lebih menarik
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Dibatasi',
            }).then(function() {
                window.location.href = '../operasional/operasional.php';
            });
        </script>
    ";
}

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
        <br>

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
                            <!-- Downtime -->
                            <td class="custom-black-bg">Downtime (Jam)</td>
                            <td><input type="number" name="downtime-<?=$i?>" style="form-control"></td>
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
                <a href="operasional" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> CANCEL</a>
            	</div>
            </form>
        </div> 
    </div> <!--Akhir Container-->
<!-- Menambahan ke Database -->
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

    if(isset($_POST['add'])){
        $total = $_POST['total'];

        //Menyimpan input dalalm variabel (Menggunakan looping)
        for($i=1; $i<=$total; $i++){
            
            // Produksi
            $shift = $_REQUEST['shift-'.$i];
            $generasi = $_REQUEST['generasi-'.$i];
            $pm_kwh_pltbm = $_REQUEST['pm-kwh-pltbm-'.$i];

            //Pemakaian
            $ekspor = $_REQUEST['ekspor-'.$i];
            $pemakaian_sendiri = $_REQUEST['pemakaian-sendiri-'.$i];
            $kwh_loss = $_REQUEST['kwh-loss-'.$i];

            //Bahan Bakar
            $cangkang = $_REQUEST['cangkang-'.$i];
            $palm_fiber = $_REQUEST['palm-fiber-'.$i];
            $wood_chips = $_REQUEST['wood-chips-'.$i];
            $serbuk_kayu = $_REQUEST['serbuk-kayu-'.$i];
            $sabut_kelapa = $_REQUEST['sabut-kelapa-'.$i];
            $efb = $_REQUEST['efb-press-'.$i];
            $opt = $_REQUEST['opt-'.$i];

            //Operasional
            $downtime = $_REQUEST['downtime-'.$i];
            $keterangan = emptyToNull($_REQUEST['keterangan-'.$i]);

            // Tanggal
            $tanggal = $_REQUEST['tanggal-'.$i];
            $tanggalid = insertOrSelectTanggal($tanggal, $koneksi);


            // Mulai Statement
            $koneksi->beginTransaction();

            try {
                // Insert produksi_kwh
                $produksi_query = "INSERT INTO produksi_kwh (produksi_id, shift, generation, pm_kwh_pltbm, tanggal, tanggal_id, waktu)
                                VALUES (UUID(), ?, ?, ?, ?, ?, CURRENT_TIME())";
                $prep_produksi = $koneksi->prepare($produksi_query);
                $prep_produksi->bindParam(1, $shift);
                $prep_produksi->bindParam(2, $generasi);
                $prep_produksi->bindParam(3, $pm_kwh_pltbm);
                $prep_produksi->bindParam(4, $tanggal);
                $prep_produksi->bindParam(5, $tanggalid);

                $prep_produksi->execute();
            
                // produksi_id
                $produksi_id = $koneksi->lastInsertId();


                // Insert pemakaian_kwh
                $pemakaian_query = "INSERT INTO pemakaian_kwh (pemakaian_id, shift, ekspor, pemakaian_sendiri, kwh_loss, tanggal, tanggal_id, waktu)
                                        VALUES (UUID(), ?, ?, ?, ?, ?, ?, CURRENT_TIME())";
                $prep_pemakaian = $koneksi->prepare($pemakaian_query);
                $prep_pemakaian->bindParam(1, $shift);
                $prep_pemakaian->bindParam(2, $ekspor);
                $prep_pemakaian->bindParam(3, $pemakaian_sendiri);
                $prep_pemakaian->bindParam(4, $kwh_loss);
                $prep_pemakaian->bindParam(5, $tanggal);
                $prep_pemakaian->bindParam(6, $tanggalid);

                $prep_pemakaian->execute();

                // pemakaian_id
                $pemakaian_id = $koneksi->lastInsertId();


                // Insert pemakaian_bahan_bakar
                $bahan_bakar_query = "INSERT INTO pemakaian_bahan_bakar (pemakaian_bahan_bakar_id, shift, tanggal, waktu, kg_cangkang, kg_palmfiber, kg_woodchips, kg_serbukkayu, kg_sabutkelapa, kg_efbpress, kg_opt, tanggal_id)
                                        VALUES (UUID(), ?, ?, CURRENT_TIME(), ?, ?, ?, ?, ?, ?, ?, ?)";
                $prep_bahan_bakar = $koneksi->prepare($bahan_bakar_query);
                $prep_bahan_bakar->bindParam(1, $shift);
                $prep_bahan_bakar->bindParam(2, $tanggal);
                $prep_bahan_bakar->bindParam(3, $cangkang);
                $prep_bahan_bakar->bindParam(4, $palm_fiber);
                $prep_bahan_bakar->bindParam(5, $wood_chips);
                $prep_bahan_bakar->bindParam(6, $serbuk_kayu);
                $prep_bahan_bakar->bindParam(7, $sabut_kelapa);
                $prep_bahan_bakar->bindParam(8, $efb);
                $prep_bahan_bakar->bindParam(9, $opt);
                $prep_bahan_bakar->bindParam(10, $tanggalid);

                $prep_bahan_bakar->execute();

                // bahan_bakar_id
                $bahan_bakar_id = $koneksi->lastInsertId();


                // Insert operasional
                $operasional_query = "INSERT INTO operasional (operasional_id, produksi_id, pemakaian_id, pemakaian_bahan_bakar_id, shift, tanggal, waktu, downtime, keterangan, tanggal_id)
                                        VALUES (UUID(), (SELECT produksi_id FROM produksi_kwh WHERE tanggal=? AND shift=?), (SELECT pemakaian_id FROM pemakaian_kwh WHERE tanggal=? AND shift=?), (SELECT pemakaian_bahan_bakar_id FROM pemakaian_bahan_bakar WHERE tanggal=? AND shift=?), ?, ?, CURRENT_TIME(), ?, ?, ?)";
                $prep_operasional = $koneksi->prepare($operasional_query);
                $prep_operasional->bindParam(1, $tanggal);
                $prep_operasional->bindParam(2, $shift);
                $prep_operasional->bindParam(3, $tanggal);
                $prep_operasional->bindParam(4, $shift);
                $prep_operasional->bindParam(5, $tanggal);
                $prep_operasional->bindParam(6, $shift);

                $prep_operasional->bindParam(7, $shift);
                $prep_operasional->bindParam(8, $tanggal);
                $prep_operasional->bindParam(9, $downtime);
                $prep_operasional->bindParam(10, $keterangan);
                $prep_operasional->bindParam(11, $tanggalid);

                $prep_operasional->execute();

                
                // Commit Statement
                $koneksi->commit();
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
                echo "\n PDO ERROR: ". $e -> getMessage();

                $koneksi -> rollBack();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();

                $koneksi -> rollBack();
            }
        }
    }
?>
</body>