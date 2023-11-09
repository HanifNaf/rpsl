<?php 
	require_once("../koneksi.php"); 
	require_once("header-admin.php");
	error_reporting(0);

	$chk = $_POST['checked_operasional'];
	if(!isset($chk)){
		if(isset($_POST['edit'])){
	        for($i=0; $i<count($_POST['operasional_id']); $i++){
	            $tanggal    		= $_POST['tanggal'][$i];
	            $shift        		= $_POST['shift'][$i];
	            $generation     	= $_POST['generation'][$i];
	            $pm_kwh_pltbm    	= $_POST['pm_kwh_pltbm'][$i];
	            $ekspor         	= $_POST['ekspor'][$i];
	            $pemakaian_sendiri 	= $_POST['kosong'][$i];
	            $kwh_loss			= $_POST['kwh_loss'][$i];
	            $bahan_bakar		= $_POST['bahan_bakar'][$i];

	            $edit = pg_query($koneksi, "UPDATE rpsl_operasional SET tanggal = '$tanggal', shift = '$shift', generation = '$generation', pm_kwh_pltbm = '$pm_kwh_pltbm', ekspor = '$ekspor', pemakaian_sendiri = '$pemakaian_sendiri', kwh_loss = '$kwh_loss', bahan_bakar = '$bahan_bakar' WHERE operasional_id = '$operasional_id'");

	            if($edit){
	            	$datastok = mysqli_query($koneksi, "SELECT stok FROM stokpile WHERE id_stokpile = '$id_stokpile'");
				    $stokygada = mysqli_fetch_array($datastok);
				    $totalstok = $stokygada['stok'] - $volume; 

				    $fiks = $totalstok + $volumebaru; 
				    $perbarui = mysqli_query($koneksi, "UPDATE stokpile SET stok = '$fiks' WHERE id_stokpile = '$id_stokpile'");
	                echo "<script>window.location='produksi?m=ubah';  </script>";
	            }else{
	                echo "<script>window.location='produksi?m=gagal';</script>";
	            }
	        }
	    }
	    else{ 
	    	?> <script>window.location='produksi?m=mana';</script> <?php 
	    }
	}else{
?>
	<div class="container">
	<div class="col-md-6 col-sm-12 col" style="margin-left: -15px;">
		<h3 style="display: flex; float: left;">DATA OPERASIONAL</h3></div> 
	<?php
		?> <script src="../js/sweetalert2.all.min.js"></script> <?php

		if($_GET['m']=="sama"){ ?>
			<script type="text/javascript">
				Swal.fire({
				  title: 'Duplikat Data',
				  text: "Data Gagal disimpan!",
				  type: 'warning',
				  confirmButtonColor: '#3085d6',
				  confirmButtonText: 'OK',
				})
			</script>
		<?php }

		?>
		<div class="table-responsive-md table-responsive-sm table-responsive-lg">
			<form action="" method="post">
				<table class="table table-bordered table-hover table-sm" style="margin: 0 auto">
					<thead class="thead-dark">
						<tr class="text-center">
						<th>No</th>
                        <th>Tanggal</th>
                        <th>Shift</th>
                        <th>Generasi</th>
                        <th>PM Kwh PLTBM</th>
                        <th>Ekspor</th>
                        <th>Pemakaian Sendiri</th>
                        <th>Kwh Loss</th>
                        <th>Bahan Bakar</th>
                        <th>Supervisor</th>
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
	require("footer-admin.php"); 
?> 