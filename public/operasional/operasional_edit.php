<?php 
require_once("../../config/config.php");
require_once(SITE_ROOT."/src/header-admin.php");
require_once(SITE_ROOT."/src/footer-admin.php");
require_once(SITE_ROOT."/src/koneksi.php");
error_reporting(0);
?>
	

<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href='../img/rpsl1.png' rel='icon' type='image/x-icon'/>
  <title>Input Data Operasional PT. Rezeki Perkasa Sejahera Lestari</title>
  <link rel="stylesheet" href="css/style.css"> <!-- Perhatikan Directory (tambahkan ../) -->
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap.min.css.map">
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap-grid.min.css.map">
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap-reboot.min.css.map">
</head>
<style>
    .custom-black-bg {
    background-color: #228B22;
    color: white;
}

</style>
<body>
    <div class="container">
        <!-- Import JS Sweet Alert -->
        <script src="../js/sweetalert2.all.min.js"></script>

        <!-- Buat Konfirmasi Penambahan Data -->
        <?php if($_GET['m']=="simpan"){ ?>
                <script type="text/javascript">
                    Swal.fire({
                      title: 'Tambah Data Lagi?',
                      text: "Data Berhasil disimpan!",
                      type: 'success',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Iya!',
                      cancelButtonText : 'Tidak!',
                    }).then((result) => {
                      if (result.value) {
                        window.location = 'operasional_input';
                      }else{
                        window.location = 'operasional';
                      }
                    })
                </script>
        <?php } ?>
        <?php 
                    $no = 1;
                    if($row_operasional>0){
                        foreach($operasional_arr as $array){ ?>


        <div class="row">
            <!--Nama Divisi-->
            <div class="col-md-6 col-sm-12 col">
            <h2 style="display: flex; float: left;">OPERASIONAL</h2>
            </div> 
        </div>
        <div class="table-responsive-sm table-responsie-md table-responsive-lg">
            <form action="" method="post">
                <table class="table table-hover table-bordered table-sm">
                        <tr>
                            <!-- Tanggal -->
                            <td class="custom-black-bg">Tanggal</td>
                            <td> <input type="date" value="<? date('Y-m-d') ?>" name="tanggal-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Shift -->
                            <td class="custom-black-bg">Shift</td>
                            <td><input type="number" name="shift-<?=$i?>" style="form-control" value="<?= $array['shift']; ?>"></td>
                        </tr>
                        <tr>
                            <!-- Generasi -->
                            <td class="custom-black-bg">Generasi</td>
                            <td><input type="number" name="generasi-<?=$i?>" style="form-control" value="<?= $array['generation']; ?>"></td>
                        </tr>
                        <tr>    
                            <!-- PM Kwh PLTBM -->
                            <td class="custom-black-bg">PM Kwh PLTBM</td>
                            <td><input type="number" name="pm-kwh-pltbm-<?=$i?>" style="form-control" value="<?= $array['pm_kwh_pltbm']; ?>"></td>
                        </tr>
                        <tr>    
                            <!-- Ekspor -->
                            <td class="custom-black-bg">Ekspor</td>
                            <td><input type="number" name="ekspor-<?=$i?>" style="form-control" value="<?= $array['ekspor']; ?>"></td>
                        </tr>
                        <tr>    
                            <!-- Pemakaian Sendiri -->
                            <td class="custom-black-bg">Pemakaian Sendiri</td>
                            <td><input type="number" name="pemakaian-sendiri-<?=$i?>" style="form-control" value="<?= $array['pemakaian_sendiri']; ?>"></td>
                        </tr>
                        <tr>
                            <!-- Kwh Loss -->
                            <td class="custom-black-bg">Kwh Loss</td>
                            <td><input type="number" name="kwh-loss-<?=$i?>" style="form-control" value="<?= $array['kwh_loss']; ?>"></td>
                        </tr>
                        <tr>    
                            <!-- Pemakaian Cangkang -->
                            <td class="custom-black-bg">Pemakaian Cangkang</td>
                            <td><input type="number" name="cangkang-<?=$i?>" style="form-control" value="<?= $array['kg_cangkang']; ?>"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian Palm Fiber -->
                            <td class="custom-black-bg">Pemakaian Palm Fiber</td>
                            <td><input type="number" name="palm-fiber-<?=$i?>" style="form-control" value="<?= $array['kg_palmfiber']; ?>"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian Wood Chips -->
                            <td class="custom-black-bg">Pemakaian Wood Chips</td>
                            <td><input type="number" name="wood-chips-<?=$i?>" style="form-control" value="<?= $array['kg_woodchips']; ?>"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian Serbuk Kayu -->
                            <td class="custom-black-bg" width="20%">Pemakaian Serbuk Kayu</td>
                            <td><input type="number" name="serbuk-kayu-<?=$i?>" style="form-control" value="<?= $array['kg_serbukkayu']; ?>"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian Sabut Kelapa -->
                            <td class="custom-black-bg">Pemakaian Serbuk Kelapa</td>
                            <td><input type="number" name="sabut-kelapa-<?=$i?>" style="form-control" value="<?= $array['kg_sabutkelapa']; ?>"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian EFB Press -->
                            <td class="custom-black-bg">Pemakaian EFB Press</td>
                            <td><input type="number" name="efb-press-<?=$i?>" style="form-control" value="<?= $array['kg_efbpress']; ?>"></td>
                        </tr>
                        <tr>
                            <!-- Pemakaian OPT -->
                            <td class="custom-black-bg">Pemakaian OPT</td>
                            <td><input type="number" name="opt-<?=$i?>" style="form-control" value="<?= $array['kg_opt']; ?>"></td>
                        </tr>
                        <tr>
                            <!-- Supervisor -->
                            <td class="custom-black-bg">Supervisor</td>
                            <td><input type="text" name="supervisor-<?=$i?>" style="form-control" value="<?= $array['supervisor']; ?>"></td>
                        </tr>
                        <tr>
                            <!-- keterangan -->
                            <td class="custom-black-bg">Keterangan</td>
                            <td><input type="text" name="keterangan-<?=$i?>" style="form-control" value="<?= $array['keterangan']; ?>"></td>
                        </tr>
                </table>
             <?php }} ?>
                <div class="form-group text-center" style="margin-top: 10px;">
                <button type="submit" name="update" class="btn btn-primary"><i class="fas fa-save"><a href="operasional"></a></i> EDIT DATA</button>
                </div>
            </form>
        </div> 
    </div> <!--Akhir Container-->
<!-- Menambahan ke Database -->
<?php 
    if(isset($_POST['update'])){
        $total = $_POST['total'];
				    $fiks = $totalstok + $volumebaru; 
				    $perbarui = mysqli_query($koneksi, "UPDATE stokpile SET stok = '$fiks' WHERE id_stokpile = '$id_stokpile'");
	                echo "<script>window.location='produksi?m=ubah';  </script>";
	            }else{
	                echo "<script>window.location='produksi?m=gagal';</script>";
	            }
	        }
	    }
	    else{ echo "halaman edit"; 
	    	?> <script>//window.location='produksi?m=mana';</script> <?php 
	    }
	}else{
?>
	<div class="container">
	<div class="col-md-6 col-sm-12 col" style="margin-left: -15px;">
		<h3 style="display: flex; float: left;">PRODUKSI BATUBARA</h3></div> 
	<?php
		?> <script src="../js/sweetalert2.all.min.js"></script> <?php

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
            $keterangan = $_REQUEST['keterangan-'.$i];


		?>
		<div class="table-responsive-md table-responsive-sm table-responsive-lg">
			<form action="" method="post">
				<table class="table table-bordered table-hover table-sm" style="margin: 0 auto">
					<thead class="thead-dark">
						<tr class="text-center">
							<th>NO</th>
							<th>Tanggal</th>
							<th>Shift</th>
							<th>Truk</th>
							<th>Kode Lahan</th>
							<th>Muatan</th>
							<th>Kosong</th>
							<th>Volume</th>
						</tr>
					</thead>
					<?php 
						$no =1;
						foreach($chk as $id_produksi){
							$sql = mysqli_query($koneksi, "SELECT * FROM produksi INNER JOIN truk ON produksi.id_truk = truk.id_truk INNER JOIN stokpile ON produksi.id_stokpile = stokpile.id_stokpile WHERE id_produksi = '$id_produksi'");
							while($data = mysqli_fetch_array($sql)){?>
							<tr class="text-center">
								<td><?= $no++ ?></td>
								<td>
									<input type="date" name="tgl[]" value="<?= $data['tgl'] ?>" class="form-control">
								</td>
								<td>
								<select name="shift[]" value="<?= $data['shift'] ?>" class="form-control">
						<?php 
							if($data['shift'] == ""){
								echo "<option value=''>-PILIH-</option>";
								echo "<option value='Siang'>Siang</option>";
								echo "<option value='Malam'>Malam</option>";
							}else if($data['shift'] == "Siang"){
								echo "<option value='Siang'>Siang</option>";
								echo "<option value='Malam'>Malam</option>";
							}else if($data['shift'] == "Malam"){
								echo "<option value='Siang'>Siang</option>";
								echo "<option value='Malam'>Malam</option>";
							}
						?>
			    		</select>
								</td>
								<td>
									<input type="hidden" name="id_produksi[]" value="<?= $data['id_produksi'] ?>" >
									<select name="id_truk[]" class="form-control" required>
										<option value="<?php echo $data['id_truk'] ?>"><?= $data['kode_truk'] ?></option>
											<?php
												$ahay = mysqli_query($koneksi, "SELECT * FROM `truk` INNER JOIN mitra ON truk.id_mitra = mitra.id_mitra WHERE nama_cv = 'PD. Baramarta' ORDER BY kode_truk ASC");
							    				while($baris = mysqli_fetch_array($ahay)) {
							    					?>
							    						<option value="<?= $baris[id_truk] ?>"><?= $baris['kode_truk'] ?></option>
							    					<?php
							    				} 
							    			?>
							    	</select>
								</td>
								<td>
									<select name="id_stokpile[]" class="form-control" required>
										<option value="<?php echo $data['id_stokpile'] ?>"><?= $data['kode_lahan'] ?></option>
											<?php
												$ahay = mysqli_query($koneksi, "SELECT * FROM stokpile WHERE NOT kode_lahan = '$data[kode_lahan]' ORDER BY kode_lahan");
							    				while ($row = mysqli_fetch_array($ahay)) {  
							    					?>
							    						<option value="<?= $row[id_stokpile] ?>"><?= $row['kode_lahan'] ?></option>
							    					<?php
							    				}  
							    				?>
							    			?>
							    	</select>
								</td>
								<td>
									<input type="number" name="muatan[]" step="any" value="<?= $data['muatan'] ?>" class="form-control" >
								</td>
								<td>
									<input type="number" name="kosong[]" step="any" value="<?= $data['kosong'] ?>" class="form-control" >
								</td>
								<td>
									<input type="number" name="volume[]" step="any" value="<?= $data['volume'] ?>" class="form-control" readonly>
								</td>
							</tr>
					<?php 		} 
							}
					?>
				</table>
				<div class="form-group" style="text-align: center; margin-top: 10px;">
					<button type="submit" name="edit" class="btn btn-primary"><i class="fas fa-save"></i> SIMPAN SEMUA</button>
				</div>
			</form>
		</div>
	
	</div> <!-- akhir container -->
<?php
            $update_query= "WITH update_pemakaian_kwh AS(
            UPDATE pemakaian_kwh 
            SET ekspor=$ekspor,
            pemakaian_sendiri=$pemakaian_sendiri,
            kwh_loss=$kwh_loss,
            tanggal=$1,
            shift=$2
            WHERE tanggal=$1 AND shift=$2
            RETURNING pemakaian_id),

            update_produksi_kwh AS (
            UPDATE produksi_kwh
            SET generation=$generasi,
            pm_kwh_pltbm=$pm_kwh_pltbm,
            tanggal=$1,
            shift=$2
            WHERE tanggal=$1 AND shift=$2
            RETURNING produksi_id),

            update_pemakaian_bahan_bakar AS(
            UPDATE pemakaian_bahan_bakar 
            SET kg_cangkang=$,
            kg_palmfiber=$palm_fiber,
            kg_woodchips=$wood_chips,
            kg_serbukkayu=$serbuk_kayu,
            kg_sabutkelapa=$sabut_kelapa,
            kg_efbpress=$efb,
            kg_opt=$opt,
            tanggal=$1,
            shift=$2
            WHERE tanggal=$1 AND shift=$2
            RETURNING pemakaian_bahan_bakar_id)

            UPDATE operasional
            SET keterangan=$keterangan,
            supervisor=$supervisor,
            tanggal=$1,
            shift=$2
            WHERE (produksi_id, pemakaian_id, pemakaian_bahan_bakar_id) IN (SELECT (SELECT produksi_id FROM update_produksi_kwh), (SELECT pemakaian_id FROM update_pemakaian_kwh), (SELECT pemakaian_bahan_bakar_id FROM update_pemakaian_bahan_bakar));"; 
            $prepare_update = pg_prepare($koneksi_operasional, "my_update", $update_query);
            $exec_update = pg_execute($koneksi_operasional, "my_update", array($tanggal, $shift));";


            $rs = pg_fetch_assoc($exec_update);
            if (!$rs) {
            echo "0 records";
            }
            ?> 
            
            <?php
        }
    }
?>
</body>