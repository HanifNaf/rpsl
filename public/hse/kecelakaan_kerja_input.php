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
					    window.location = 'kecelakaan_kerja_input';
					  }else{
					  	window.location = 'kecelakaan_kerja';
					  }
					})
				</script>
		<?php } ?>


        <div class="row">
            <!--Nama Divisi-->
		    <div class="col-md-6 col-sm-12 col">
		    <h2 style="display: flex; float: left;">KECELAKAAN KERJA</h2>
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
                            <!-- Jam -->
                            <td class="custom-black-bg">Jenis Kecelakaan Kerja</td>
                                <td><select name="jenis-<?= $i ?>" class="form-control">
                                        <option value="Ringan">Ringan</option>
                                        <option value="Sedang">Sedang</option>
                                        <option value="Berat">Berat</option>
                                </select>
                                </td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>Kejadian</th>
                        <tr>
                            <!-- Area -->
                            <td class="custom-black-bg" width="30%">Area</td>
                            <td><input type="text" name="area-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Waktu -->
                            <td class="custom-black-bg" width="30%">Waktu</td>
                            <td><input type="time" name="waktu-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Jam Kerja -->
                            <td class="custom-black-bg" width="30%">Jam Kerja</td>
                            <td><select name="jam-<?= $i ?>" class="form-control">
                                        <option value="Pagi">Pagi</option>
                                        <option value="Sore">Sore</option>
                                        <option value="Malam">Malam</option>
                                        <option value="Non-Shift">Non-Shift</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                       <tr>    
                            <!-- Penyebab -->
                            <td class="custom-black-bg">Penyebab</td>
                            <td><input type="text" name="penyebab-<?=$i?>" style="form-control"></td>
                        </tr>
                    <?php } ?>
                </table>
                <div class="form-group text-center" style="margin-top: 10px;">
                <button type="submit" name="add" class="btn btn-primary"><i class="fas fa-save"><a href="kecelakaan_kerja"></a></i> TAMBAH DATA</button>
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
            $jenis_kecelakaan_kerja = $_REQUEST['jenis-'.$i];
            $area = $_REQUEST['area-'.$i];
            $waktu = $_REQUEST['waktu-'.$i].':00';
            $jam_kerja = $_REQUEST['jam-'.$i];
            $penyebab = $_REQUEST['penyebab-'.$i];
                        
            //Insert ke database
            $insert_query = "INSERT INTO kecelakaan_kerja (kecelakaan_kerja_id, tanggal, jenis_kecelakaan_kerja, area_kejadian, waktu_kejadian, jam_kerja_kejadian, penyebab) 
    VALUES (uuid_generate_v4(), $1, $2, $3, $4, $5, $6);";
error_reporting(E_ALL);
ini_set('display_errors', 1);
$prepare_input = pg_prepare($koneksi_hse, "my_insert", $insert_query);
$exec_input = pg_execute($koneksi_hse, "my_insert", array($tanggal, $jenis_kecelakaan_kerja, $area, $waktu, $jam_kerja, $penyebab));

if (!$exec_input) {
    echo "Error in SQL query: " . pg_last_error($koneksi_hse);
} else {
    echo "Record inserted successfully.";
}


            echo $tanggal;
            echo $jenis_kecelakaan_kerja;
            echo $area;
            echo $waktu;
            echo $jam_kerja;
            echo $penyebab;
            ?> 
            
            <?php
        }
    }
?>
</body>