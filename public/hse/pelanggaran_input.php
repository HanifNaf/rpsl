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
		    <h2 style="display: flex; float: left;">PELANGGARAN</h2>
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
                            <!-- NIK -->
                            <td class="custom-black-bg">NIK</td>
                            <td><input type="number" name="nik-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Nama -->
                            <td class="custom-black-bg">Nama</td>
                            <td><input type="text" name="nama-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Bagian -->
                            <td class="custom-black-bg">Bagian</td>
                                <td><select name="bagian-<?= $i ?>" class="form-control">
                                        <option value="--/--">--Pilih Bagian--</option>
                                        <option value="Timbangan">Timbangan</option>
                                        <option value="Chipper dan Moving Floor">Chipper dan Moving Floor</option>
                                        <option value="Boiler">Boiler</option>
                                        <option value="WTP">WTP</option>
                                        <option value="Turbin">Turbin</option>
                                        <option value="Mekanikal">Mekanikal</option>
                                        <option value="Mekanikal">Lstrik</option>
                                </select>
                                </td>
                        </tr>
                        <tr>    
                            <!-- Jenis Pelanggaran -->
                            <td class="custom-black-bg">Jenis Pelanggaran</td>
                            <td>
                            <input type="radio" id="radio" value="APD" name="jenis-<?=$i?>" style="form-control">
                            <label for="radio">APD</label> &nbsp &nbsp &nbsp &nbsp
                            <input type="radio" id="radio"value="Merokok" name="jenis-<?=$i?>" style="form-control">
                            <label for="radio">Merokok</label> &nbsp &nbsp &nbsp &nbsp
                            <input type="radio" id="radio"value="Merokok" name="merokok-<?=$i?>" style="form-control">
                            <label for="radio">Tidur</label> &nbsp &nbsp &nbsp &nbsp
                            </td>
                        </tr>
                        <tr>
                            <!-- Keterangan -->
                            <td class="custom-black-bg" width="30%">Keterangan</td>
                            <td><input type="text" name="keterangan-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Nama Barang -->
                            <td class="custom-black-bg" width="30%">Nama Barang</td>
                            <td><input type="text" name="barang-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Jumlah -->
                            <td class="custom-black-bg" width="30%">Jumlah</td>
                            <td><input type="number" name="jumlah-<?=$i?>" style="form-control"></td>
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
            $nik = $_REQUEST['nik-'.$i];
            $nama = $_REQUEST['nama-'.$i];
            $bagian = $_REQUEST['bagian-'.$i];
            $jenis = $_REQUEST['jenis-'.$i];
            $keterangan = $_REQUEST['keterangan-'.$i];
            $nama_barang = $_REQUEST['barang-'.$i];
            $jumlah = $_REQUEST['jumlah-'.$i];
           
                        
            //Insert ke database
            $insert_query = "INSERT INTO pelanggaran (pelanggaran_id, tanggal, nik, nama, bagian, jenis_pelanggaran, keterangan, pemberian_apd, jumlah_apd) 
            VALUES (uuid_generate_v4(), $1, $2, $3, $4, $5, $6, $7, $8);";
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            $prepare_input = pg_prepare($koneksi_hse, "my_insert", $insert_query);
            $exec_input = pg_execute($koneksi_hse, "my_insert", array($tanggal, $nik, $nama, $bagian, $jenis, $keterangan, $nama_barang, $jumlah));

            if (!$exec_input) {
                echo "Error in SQL query: " . pg_last_error($koneksi_hse);
            } else {
                echo "Record inserted successfully.";
            }

            ?> 
            
            <?php
        }
    }
?>
</body>