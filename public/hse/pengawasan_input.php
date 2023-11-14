<?php 
require_once("../../config/config.php");
require_once(SITE_ROOT."/src/header-admin.php");
require_once(SITE_ROOT."/src/footer-admin.php");
require_once(SITE_ROOT."/src/koneksi.php");
?>

<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href='../img/rpsl1.png' rel='icon' type='image/x-icon'/>
  <title>Input Data Boiler PT. Rezeki Perkasa Sejahera Lestari</title>
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
    background-color: #2ca143;
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
					    window.location = 'boiler_input';
					  }else{
					  	window.location = 'boiler';
					  }
					})
				</script>
		<?php } ?>


        <div class="row">
            <!--Nama Divisi-->
		    <div class="col-md-6 col-sm-12 col">
		    <h2 style="display: flex; float: left;">PENGAWASAN PEKERJAAN</h2>
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
                            <td> <input type="date" value="<? date('Y-m-d') ?>" name="tanggal-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>    
                            <!-- Jam Kerja -->
                            <td class="custom-black-bg">Jam Kerja</td>
                            <td>
                            <input type="radio" id="radio" value="Pagi" name="jam-<?=$i?>" style="form-control">
                            <label for="radio">Pagi</label> &nbsp &nbsp &nbsp &nbsp
                            <input type="radio" id="radio"value="Sore" name="jam-<?=$i?>" style="form-control">
                            <label for="radio">Sore</label> &nbsp &nbsp &nbsp &nbsp
                            <input type="radio" id="radio"value="Malam" name="jam-<?=$i?>" style="form-control">
                            <label for="radio">Malam</label> &nbsp &nbsp &nbsp &nbsp
                            <input type="radio" id="radio"value="Non-Shift" name="jam-<?=$i?>" style="form-control">
                            <label for="radio">Non-Shift</label>
                            </td>
                        </tr>
                        <tr>
                            <!-- Personil HSE-->
                            <td class="custom-black-bg">Personil HSE</td>
                            <td> <input type="text" name="personil-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>Timbangan</th>
                        <tr>
                            <!-- Pengawasan Pekerjaan -->
                            <td class="custom-black-bg" width="30%">Pengawasan Pekerjaan</td>
                            <td><select name="pengawasan-timbangan-<?= $i ?>" class="form-control">
                                        <option value="">--/--</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Keterangan Pengawasan -->
                            <td class="custom-black-bg" width="30%">Keterangan Pengawasan</td>
                            <td><input type="text" name="keterangan-timbangan-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Kondisi 5R -->
                            <td class="custom-black-bg">Kondisi 5R</td>
                            <td><input type="text" name="kondisi-timbangan-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Keterangan 5R-->
                            <td class="custom-black-bg">Keterangan 5R</td>
                            <td><input type="text" name="keterangan-5r-timbangan-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>Chipper dan Moving Floor</th>
                        <tr>
                            <!-- Pengawasan Pekerjaan -->
                            <td class="custom-black-bg" width="30%">Pengawasan Pekerjaan</td>
                            <td><select name="pengawasan-chiper-<?= $i ?>" class="form-control">
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Keterangan Pengawasan -->
                            <td class="custom-black-bg" width="30%">Keterangan Pengawasan</td>
                            <td><input type="text" name="keterangan-chiper-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Kondisi 5R -->
                            <td class="custom-black-bg">Kondisi 5R</td>
                            <td><input type="text" name="kondisi-chiper-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Keterangan 5R-->
                            <td class="custom-black-bg">Keterangan 5R</td>
                            <td><input type="text" name="keterangan-5r-chiper-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>Boiler</th>
                        <tr>
                            <!-- Pengawasan Pekerjaan -->
                            <td class="custom-black-bg" width="30%">Pengawasan Pekerjaan</td>
                            <td><select name="pengawasan-boiler-<?= $i ?>" class="form-control">
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Keterangan Pengawasan -->
                            <td class="custom-black-bg" width="30%">Keterangan Pengawasan</td>
                            <td><input type="text" name="keterangan-boiler-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Kondisi 5R -->
                            <td class="custom-black-bg">Kondisi 5R</td>
                            <td><input type="text" name="kondisi-boiler-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Keterangan 5R-->
                            <td class="custom-black-bg">Keterangan 5R</td>
                            <td><input type="text" name="keterangan-5r-boiler-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>WTP</th>
                        <tr>
                            <!-- Pengawasan Pekerjaan -->
                            <td class="custom-black-bg" width="30%">Pengawasan Pekerjaan</td>
                            <td><select name="pengawasan-wtp-<?= $i ?>" class="form-control">
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Keterangan Pengawasan -->
                            <td class="custom-black-bg" width="30%">Keterangan Pengawasan</td>
                            <td><input type="text" name="keterangan-wtp-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Kondisi 5R -->
                            <td class="custom-black-bg">Kondisi 5R</td>
                            <td><input type="text" name="kondisi-wtp-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Keterangan 5R-->
                            <td class="custom-black-bg">Keterangan 5R</td>
                            <td><input type="text" name="keterangan-5r-wtp-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>Turbin</th>
                        <tr>
                            <!-- Pengawasan Pekerjaan -->
                            <td class="custom-black-bg" width="30%">Pengawasan Pekerjaan</td>
                            <td><select name="pengawasan-turbin-<?= $i ?>" class="form-control">
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Keterangan Pengawasan -->
                            <td class="custom-black-bg" width="30%">Keterangan Pengawasan</td>
                            <td><input type="text" name="keterangan-turbin-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Kondisi 5R -->
                            <td class="custom-black-bg">Kondisi 5R</td>
                            <td><input type="text" name="kondisi-turbin-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Keterangan 5R-->
                            <td class="custom-black-bg">Keterangan 5R</td>
                            <td><input type="text" name="keterangan-5r-turbin-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>Mekanik</th>
                        <tr>
                            <!-- Pengawasan Pekerjaan -->
                            <td class="custom-black-bg" width="30%">Pengawasan Pekerjaan</td>
                            <td><select name="pengawasan-mekanik-<?= $i ?>" class="form-control">
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Keterangan Pengawasan -->
                            <td class="custom-black-bg" width="30%">Keterangan Pengawasan</td>
                            <td><input type="text" name="keterangan-mekanik-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Kondisi 5R -->
                            <td class="custom-black-bg">Kondisi 5R</td>
                            <td><input type="text" name="kondisi-mekanik-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Keterangan 5R-->
                            <td class="custom-black-bg">Keterangan 5R</td>
                            <td><input type="text" name="keterangan-5r-mekanik-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>Listrik</th>
                        <tr>
                            <!-- Pengawasan Pekerjaan -->
                            <td class="custom-black-bg" width="30%">Pengawasan Pekerjaan</td>
                            <td><select name="pengawasan-listrik-<?= $i ?>" class="form-control">
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Keterangan Pengawasan -->
                            <td class="custom-black-bg" width="30%">Keterangan Pengawasan</td>
                            <td><input type="text" name="keterangan-listrik-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Kondisi 5R -->
                            <td class="custom-black-bg">Kondisi 5R</td>
                            <td><input type="text" name="kondisi-listrik-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Keterangan 5R-->
                            <td class="custom-black-bg">Keterangan 5R</td>
                            <td><input type="text" name="keterangan-5r-listrik-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>Bahan Bakar</th>
                        <tr>
                            <!-- Pengawasan Pekerjaan -->
                            <td class="custom-black-bg" width="30%">Pengawasan Pekerjaan</td>
                            <td><select name="pengawasan-bahan-bakar-<?= $i ?>" class="form-control">
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Keterangan Pengawasan -->
                            <td class="custom-black-bg" width="30%">Keterangan Pengawasan</td>
                            <td><input type="text" name="keterangan-bahan-bakar-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Kondisi 5R -->
                            <td class="custom-black-bg">Kondisi 5R</td>
                            <td><input type="text" name="kondisi-bahan-bakar-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Keterangan 5R-->
                            <td class="custom-black-bg">Keterangan 5R</td>
                            <td><input type="text" name="keterangan-5r-bahan-bakar-<?=$i?>" style="form-control"></td>
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

        //Menyimpan input dalalm variabel (Menggunakan looping)
        for($i=1; $i<=$total; $i++){
            $tanggal = $_REQUEST['tanggal-'.$i];
            $jam_kerja = $_REQUEST['jam-'.$i];
            $personil = $_REQUEST['personil-'.$i];
            $pengawasan_timbangan = $_REQUEST['pengawasan-timbangan-'.$i];
            $keterangan_timbangan = $_REQUEST['keterangan-timbangan-'.$i];
            $kondisi_timbangan = $_REQUEST['kondisi-timbangan-'.$i];
            $keterangan_5r_timbangan = $_REQUEST['keterangan-5r-timbangan-'.$i];
            $pengawasan_chiper = $_REQUEST['pengawasan-chiper-'.$i];
            $keterangan_chiper = $_REQUEST['keterangan-chiper-'.$i];
            $kondisi_chiper = $_REQUEST['kondisi-chiper-'.$i];
            $keterangan_5r_chiper = $_REQUEST['keterangan-5r-chiper-'.$i];
            $pengawasan_boiler = $_REQUEST['pengawasan-boiler-'.$i];
            $keterangan_boiler = $_REQUEST['keterangan-boiler-'.$i];
            $kondisi_boiler = $_REQUEST['kondisi-boiler-'.$i];
            $keterangan_5r_boiler = $_REQUEST['keterangan-5r-boiler-'.$i];
            $pengawasan_wtp = $_REQUEST['pengawasan-wtp-'.$i];
            $keterangan_wtp = $_REQUEST['keterangan-wtp-'.$i];
            $kondisi_wtp = $_REQUEST['kondisi-wtp-'.$i];
            $keterangan_5r_wtp = $_REQUEST['keterangan-5r-wtp-'.$i];
            $pengawasan_turbin = $_REQUEST['pengawasan-turbin-'.$i];
            $keterangan_turbin = $_REQUEST['keterangan-turbin-'.$i];
            $kondisi_turbin = $_REQUEST['kondisi-turbin-'.$i];
            $keterangan_5r_turbin = $_REQUEST['keterangan-5r-turbin-'.$i];
            $pengawasan_mekanik = $_REQUEST['pengawasan-mekanik-'.$i];
            $keterangan_mekanik = $_REQUEST['keterangan-mekanik-'.$i];
            $kondisi_mekanik = $_REQUEST['kondisi-mekanik-'.$i];
            $keterangan_5r_mekanik = $_REQUEST['keterangan-5r-mekanik-'.$i];
            $pengawasan_listrik = $_REQUEST['pengawasan-listrik-'.$i];
            $keterangan_listrik = $_REQUEST['keterangan-listrik-'.$i];
            $kondisi_listrik = $_REQUEST['kondisi-listrik-'.$i];
            $keterangan_5r_listrik = $_REQUEST['keterangan-5r-listrik-'.$i];
            $pengawasan_bahan_bakar = $_REQUEST['pengawasan-bahan-bakar-'.$i];
            $keterangan_bahan_bakar = $_REQUEST['keterangan-bahan-bakar-'.$i];
            $kondisi_bahan_bakar = $_REQUEST['kondisi-bahan-bakar-'.$i];
            $keterangan_5r_bahan_bakar = $_REQUEST['keterangan-5r-bahan-bakar-'.$i];

                        
            //Insert ke database
            $insert_query = $insert_query = "INSERT INTO pengawasan (pengawasan_id, tanggal, jam_kerja, personil_hse, pengawasan_timbangan, keterangan_pengawasan_timbangan, kondisi_5r_timbangan, keterangan_5r_timbangan, pengawasan_chipper, keterangan_pengawasan_chipper, kondisi_5r_chipper, keterangan_5r_chipper, pengawasan_boiler, keterangan_pengawasan_boiler, kondisi_5r_boiler, keterangan_5r_boiler, pengawasan_wtp, keterangan_pengawasan_wtp, kondisi_5r_wtp, keterangan_5r_wtp, pengawasan_turbin, keterangan_pengawasan_turbin, kondisi_5r_turbin, keterangan_5r_turbin, pengawasan_mekanik, keterangan_pengawasan_mekanik, kondisi_5r_mekanik, keterangan_5r_mekanik, pengawasan_listrik, keterangan_pengawasan_listrik, kondisi_5r_listrik, keterangan_5r_listrik, pengawasan_bahan_bakar, keterangan_pengawasan_bahan_bakar, kondisi_5r_bahan_bakar, keterangan_5r_bahan_bakar) 
            VALUES (uuid_generate_v4(), $1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16, $17, $18, $19, $20, $21, $22, $23, $24, $25, $26, $27, $28, $29, $30, $31, $32, $33, $34, $35);";
             
            error_reporting(E_ALL);
ini_set('display_errors', 1);               
            $prepare_input = pg_prepare($koneksi_hse, "my_insert", $insert_query);
            $exec_input = pg_execute($koneksi_hse, "my_insert", array($tanggal, $jam_kerja , $personil ,$pengawasan_timbangan, $keterangan_timbangan, $kondisi_timbangan, $keterangan_5r_timbangan, $pengawasan_chiper, $keterangan_chiper, $kondisi_chiper, $keterangan_5r_chiper, $pengawasan_boiler, $keterangan_boiler, $kondisi_boiler, $keterangan_5r_boiler, $pengawasan_wtp, $keterangan_wtp, $kondisi_wtp, $keterangan_5r_wtp, $pengawasan_turbin, $keterangan_turbin, $kondisi_turbin, $keterangan_5r_turbin, $pengawasan_mekanik, $keterangan_mekanik, $kondisi_mekanik, $keterangan_5r_mekanik, $pengawasan_listrik, $keterangan_listrik, $kondisi_listrik, $keterangan_5r_listrik, $pengawasan_bahan_bakar, $keterangan_bahan_bakar, $kondisi_bahan_bakar, $keterangan_5r_bahan_bakar));
            $rs = pg_fetch_assoc($exec_input);
            if (!$rs) {
            echo "0 records";
            }
            ?> 
            
            <?php
        }
    }
?>
</body>