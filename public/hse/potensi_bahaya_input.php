<?php 
require_once("../../config/config.php");
require_once(SITE_ROOT."/src/header-admin.php");
require_once(SITE_ROOT."/src/footer-admin.php");
require_once(SITE_ROOT."/src/koneksi.php");
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
		    <h2 style="display: flex; float: left;">POTENSI BAHAYA</h2>
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
                            <!-- Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Potensi Bahaya</td>
                            <td><select name="potensi-timbangan-<?= $i ?>" class="form-control">
                                        <option value="">--/--</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Jenis Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Jenis Potensi Bahaya</td>
                            <td><input type="text" name="jenis-potensi-timbangan-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Tindak Lanjut -->
                            <td class="custom-black-bg">Tindak Lanjut</td>
                            <td><input type="text" name="tindak-lanjut-timbangan-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Keterangan -->
                            <td class="custom-black-bg">Keterangan</td>
                            <td><input type="text" name="keterangan-timbangan-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Kendala -->
                            <td class="custom-black-bg">Kendala</td>
                            <td><input type="text" name="kendala-timbangan-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>Chipper dan Moving Floor</th>
                        <tr>
                            <!-- Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Potensi Bahaya</td>
                            <td><select name="potensi-chipper-<?= $i ?>" class="form-control">
                                        <option value="">--/--</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Jenis Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Jenis Potensi Bahaya</td>
                            <td><input type="text" name="jenis-potensi-chipper-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Tindak Lanjut -->
                            <td class="custom-black-bg">Tindak Lanjut</td>
                            <td><input type="text" name="tindak-lanjut-chipper-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Keterangan -->
                            <td class="custom-black-bg">Keterangan</td>
                            <td><input type="text" name="keterangan-chipper-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Kendala -->
                            <td class="custom-black-bg">Kendala</td>
                            <td><input type="text" name="kendala-chipper-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>Boiler</th>
                        <tr>
                            <!-- Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Potensi Bahaya</td>
                            <td><select name="potensi-boiler-<?= $i ?>" class="form-control">
                                        <option value="">--/--</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Jenis Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Jenis Potensi Bahaya</td>
                            <td><input type="text" name="jenis-potensi-boiler-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Tindak Lanjut -->
                            <td class="custom-black-bg">Tindak Lanjut</td>
                            <td><input type="text" name="tindak-lanjut-boiler-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Keterangan -->
                            <td class="custom-black-bg">Keterangan</td>
                            <td><input type="text" name="keterangan-boiler-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Kendala -->
                            <td class="custom-black-bg">Kendala</td>
                            <td><input type="text" name="kendala-boiler-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>WTP</th>
                        <tr>
                            <!-- Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Potensi Bahaya</td>
                            <td><select name="potensi-wtp-<?= $i ?>" class="form-control">
                                        <option value="">--/--</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Jenis Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Jenis Potensi Bahaya</td>
                            <td><input type="text" name="jenis-potensi-wtp-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Tindak Lanjut -->
                            <td class="custom-black-bg">Tindak Lanjut</td>
                            <td><input type="text" name="tindak-lanjut-wtp-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Keterangan -->
                            <td class="custom-black-bg">Keterangan</td>
                            <td><input type="text" name="keterangan-wtp-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Kendala -->
                            <td class="custom-black-bg">Kendala</td>
                            <td><input type="text" name="kendala-wtp-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>Turbin</th>
                        <tr>
                            <!-- Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Potensi Bahaya</td>
                            <td><select name="potensi-turbin-<?= $i ?>" class="form-control">
                                        <option value="">--/--</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Jenis Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Jenis Potensi Bahaya</td>
                            <td><input type="text" name="jenis-potensi-turbin-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Tindak Lanjut -->
                            <td class="custom-black-bg">Tindak Lanjut</td>
                            <td><input type="text" name="tindak-lanjut-turbin-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Keterangan -->
                            <td class="custom-black-bg">Keterangan</td>
                            <td><input type="text" name="keterangan-turbin-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Kendala -->
                            <td class="custom-black-bg">Kendala</td>
                            <td><input type="text" name="kendala-turbin-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>Mekanik</th>
                        <tr>
                            <!-- Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Potensi Bahaya</td>
                            <td><select name="potensi-mekanik-<?= $i ?>" class="form-control">
                                        <option value="">--/--</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Jenis Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Jenis Potensi Bahaya</td>
                            <td><input type="text" name="jenis-potensi-mekanik-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Tindak Lanjut -->
                            <td class="custom-black-bg">Tindak Lanjut</td>
                            <td><input type="text" name="tindak-lanjut-mekanik-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Keterangan -->
                            <td class="custom-black-bg">Keterangan</td>
                            <td><input type="text" name="keterangan-mekanik-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Kendala -->
                            <td class="custom-black-bg">Kendala</td>
                            <td><input type="text" name="kendala-mekanik-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>Listrik</th>
                        <tr>
                            <!-- Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Potensi Bahaya</td>
                            <td><select name="potensi-listrik-<?= $i ?>" class="form-control">
                                        <option value="">--/--</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Jenis Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Jenis Potensi Bahaya</td>
                            <td><input type="text" name="jenis-potensi-listrik-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Tindak Lanjut -->
                            <td class="custom-black-bg">Tindak Lanjut</td>
                            <td><input type="text" name="tindak-lanjut-listrik-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Keterangan -->
                            <td class="custom-black-bg">Keterangan</td>
                            <td><input type="text" name="keterangan-listrik-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Kendala -->
                            <td class="custom-black-bg">Kendala</td>
                            <td><input type="text" name="kendala-listrik-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        </tr>
                        <th>Jalan Utama</th>
                        <tr>
                            <!-- Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Potensi Bahaya</td>
                            <td><select name="potensi-jalan-<?= $i ?>" class="form-control">
                                        <option value="">--/--</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Jenis Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Jenis Potensi Bahaya</td>
                            <td><input type="text" name="jenis-potensi-jalan-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Tindak Lanjut -->
                            <td class="custom-black-bg">Tindak Lanjut</td>
                            <td><input type="text" name="tindak-lanjut-jalan-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Keterangan -->
                            <td class="custom-black-bg">Keterangan</td>
                            <td><input type="text" name="keterangan-jalan-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Kendala -->
                            <td class="custom-black-bg">Kendala</td>
                            <td><input type="text" name="kendala-jalan-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>Bahan Bakar</th>
                        <tr>
                            <!-- Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Potensi Bahaya</td>
                            <td><select name="potensi-bahan-bakar-<?= $i ?>" class="form-control">
                                        <option value="">--/--</option>
                                        <option value="Ya">Ya</option>
                                        <option value="Tidak">Tidak</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Jenis Potensi Bahaya -->
                            <td class="custom-black-bg" width="30%">Jenis Potensi Bahaya</td>
                            <td><input type="text" name="jenis-potensi-bahan-bakar-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Tindak Lanjut -->
                            <td class="custom-black-bg">Tindak Lanjut</td>
                            <td><input type="text" name="tindak-lanjut-bahan-bakar-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Keterangan -->
                            <td class="custom-black-bg">Keterangan</td>
                            <td><input type="text" name="keterangan-bahan-bakar-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Kendala -->
                            <td class="custom-black-bg">Kendala</td>
                            <td><input type="text" name="kendala-bahan-bakar-<?=$i?>" style="form-control"></td>
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
            //Timbangan
            $potensi_timbangan = $_REQUEST['potensi-timbangan-'.$i];
            $jenis_potensi_timbangan = $_REQUEST['jenis-potensi-timbangan-'.$i];
            $tindak_lanjut_timbangan = $_REQUEST['tindak-lanjut-timbangan-'.$i];
            $keterangan_timbangan = $_REQUEST['keterangan-timbangan-'.$i];
            $kendala_timbangan = $_REQUEST['kendala-timbangan-'.$i];
            //Chipper
            $potensi_chipper = $_REQUEST['potensi-chipper-'.$i];
            $jenis_potensi_chipper = $_REQUEST['jenis-potensi-chipper-'.$i];
            $tindak_lanjut_chipper = $_REQUEST['tindak-lanjut-chipper-'.$i];
            $keterangan_chipper = $_REQUEST['keterangan-chipper-'.$i];
            $kendala_chipper = $_REQUEST['kendala-chipper-'.$i];
            //Boiler
            $potensi_boiler = $_REQUEST['potensi-boiler-'.$i];
            $jenis_potensi_boiler = $_REQUEST['jenis-potensi-boiler-'.$i];
            $tindak_lanjut_boiler = $_REQUEST['tindak-lanjut-boiler-'.$i];
            $keterangan_boiler = $_REQUEST['keterangan-boiler-'.$i];
            $kendala_boiler = $_REQUEST['kendala-boiler-'.$i];
            //WTP
            $potensi_wtp = $_REQUEST['potensi-wtp-'.$i];
            $jenis_potensi_wtp = $_REQUEST['jenis-potensi-wtp-'.$i];
            $tindak_lanjut_wtp = $_REQUEST['tindak-lanjut-wtp-'.$i];
            $keterangan_wtp = $_REQUEST['keterangan-wtp-'.$i];
            $kendala_wtp = $_REQUEST['kendala-wtp-'.$i];
            //Turbin
            $potensi_turbin = $_REQUEST['potensi-turbin-'.$i];
            $jenis_potensi_turbin = $_REQUEST['jenis-potensi-turbin-'.$i];
            $tindak_lanjut_turbin = $_REQUEST['tindak-lanjut-turbin-'.$i];
            $keterangan_turbin = $_REQUEST['keterangan-turbin-'.$i];
            $kendala_turbin = $_REQUEST['kendala-turbin-'.$i];
            //Mekanik
            $potensi_mekanik = $_REQUEST['potensi-mekanik-'.$i];
            $jenis_potensi_mekanik = $_REQUEST['jenis-potensi-mekanik-'.$i];
            $tindak_lanjut_mekanik = $_REQUEST['tindak-lanjut-mekanik-'.$i];
            $keterangan_mekanik = $_REQUEST['keterangan-mekanik-'.$i];
            $kendala_mekanik = $_REQUEST['kendala-mekanik-'.$i];
            //Listrik
            $potensi_listrik = $_REQUEST['potensi-listrik-'.$i];
            $jenis_potensi_listrik = $_REQUEST['jenis-potensi-listrik-'.$i];
            $tindak_lanjut_listrik = $_REQUEST['tindak-lanjut-listrik-'.$i];
            $keterangan_listrik = $_REQUEST['keterangan-listrik-'.$i];
            $kendala_listrik = $_REQUEST['kendala-listrik-'.$i];
            //Jalan Utama
            $potensi_jalan = $_REQUEST['potensi-jalan-'.$i];
            $jenis_potensi_jalan = $_REQUEST['jenis-potensi-jalan-'.$i];
            $tindak_lanjut_jalan = $_REQUEST['tindak-lanjut-jalan-'.$i];
            $keterangan_jalan = $_REQUEST['keterangan-jalan-'.$i];
            $kendala_jalan = $_REQUEST['kendala-jalan-'.$i];
            //Bahan Bakar
            $potensi_bahan_bakar = $_REQUEST['potensi-bahan-bakar-'.$i];
            $jenis_potensi_bahan_bakar = $_REQUEST['jenis-potensi-bahan-bakar-'.$i];
            $tindak_lanjut_bahan_bakar = $_REQUEST['tindak-lanjut-bahan-bakar-'.$i];
            $keterangan_bahan_bakar = $_REQUEST['keterangan-bahan-bakar-'.$i];
            $kendala_bahan_bakar = $_REQUEST['kendala-bahan-bakar-'.$i];

                        
            //Insert ke database
            $insert_query = "INSERT INTO potensi_bahaya (potensi_bahaya_id, tanggal, jam_kerja, personil_hse, 
                                            potensi_bahaya_timbangan, jenis_potensi_timbangan, tindak_lanjut_timbangan, keterangan_timbangan, kendala_timbangan,
                                            potensi_bahaya_chipper, jenis_potensi_chipper, tindak_lanjut_chipper, keterangan_chipper, kendala_chipper,
                                            potensi_bahaya_boiler, jenis_potensi_boiler, tindak_lanjut_boiler, keterangan_boiler, kendala_boiler,
                                            potensi_bahaya_wtp, jenis_potensi_wtp, tindak_lanjut_wtp, keterangan_wtp, kendala_wtp,
                                            potensi_bahaya_turbin, jenis_potensi_turbin, tindak_lanjut_turbin, keterangan_turbin, kendala_turbin,
                                            potensi_bahaya_mekanik, jenis_potensi_mekanik, tindak_lanjut_mekanik, keterangan_mekanik, kendala_mekanik,
                                            potensi_bahaya_listrik, jenis_potensi_listrik, tindak_lanjut_listrik, keterangan_listrik, kendala_listrik,
                                            potensi_bahaya_jalan, jenis_potensi_jalan, tindak_lanjut_jalan, keterangan_jalan, kendala_jalan,
                                            potensi_bahaya_bahan_bakar, jenis_potensi_bahan_bakar, tindak_lanjut_bahan_bakar, keterangan_bahan_bakar, kendala_bahan_bakar) 
                                            VALUES (uuid_generate_v4(), $1, $2, $3, 
                                            $4, $5, $6, $7, $8, 
                                            $9, $10, $11, $12, $13, 
                                            $14, $15, $16, $17, $18, 
                                            $19, $20, $21, $22, $23, 
                                            $24, $25, $26, $27, $28, 
                                            $29, $30, $31, $32, $33, 
                                            $34, $35, $36, $37, $38, 
                                            $39, $40, $41, $42, $43, 
                                            $44, $45, $46, $47, $48);";

            $prepare_input = pg_prepare($koneksi_hse, "my_insert", $insert_query);

            $exec_input = pg_execute($koneksi_hse, "my_insert", array($tanggal, $jam_kerja , $personil ,
                        $potensi_timbangan, $jenis_potensi_timbangan, $tindak_lanjut_timbangan, $keterangan_timbangan, $kendala_timbangan,
                        $potensi_chipper, $jenis_potensi_chipper, $tindak_lanjut_chipper, $keterangan_chipper, $kendala_chipper,
                        $potensi_boiler, $jenis_potensi_boiler, $tindak_lanjut_boiler, $keterangan_boiler, $kendala_boiler,
                        $potensi_wtp, $jenis_potensi_wtp, $tindak_lanjut_wtp, $keterangan_wtp, $kendala_wtp,
                        $potensi_turbin, $jenis_potensi_turbin, $tindak_lanjut_turbin, $keterangan_turbin, $kendala_turbin,
                        $potensi_mekanik, $jenis_potensi_mekanik, $tindak_lanjut_mekanik, $keterangan_mekanik, $kendala_mekanik,
                        $potensi_listrik, $jenis_potensi_listrik, $tindak_lanjut_listrik, $keterangan_listrik, $kendala_listrik,
                        $potensi_jalan, $jenis_potensi_jalan, $tindak_lanjut_jalan, $keterangan_jalan, $kendala_jalan,
                        $potensi_bahan_bakar, $jenis_potensi_bahan_bakar, $tindak_lanjut_bahan_bakar, $keterangan_bahan_bakar, $kendala_bahan_bakar));
            
            //Cek Error
            if(!$koneksi_hse){
                echo "Koneksi gagal! ". pg_last_error(); 
            }

            if(!$insert_query){
                echo "Query gagal! ". pg_last_error(); 
            }

            if(!$prepare_input){
                echo "Prepare gagal! ". pg_last_error(); 
            }

            if(!$exec_input){
                echo "Input gagal! ". pg_last_error(); 
            }

            error_reporting(E_ALL);
            ini_set('display_errors', 1);  

            $rs = pg_fetch_assoc($exec_input);
            if (!$rs) {
            echo "Fail! ". pg_last_error($koneksi_hse);
            }
            ?> 
            
            <?php
        }
    }
?>
</body>