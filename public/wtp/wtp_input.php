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

        <div class="row">
            <!--Nama Divisi-->
		    <div class="col-md-6 col-sm-12 col">
		    <h2 style="display: flex; float: left;">LAPORAN KERJA WTP</h2>
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
                            <!-- Permasalahan/Progress -->
                            <td class="custom-black-bg">Permasalahan/Progress</td>
                            <td> <input type="text" name="permasalahan-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Tindak Lanjut -->
                            <td class="custom-black-bg">Tindak Lanjut</td>
                            <td> <input type="text" name="tindak-lanjut-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>Sparepart</th>
                        <tr>
                            <!-- Sparepart -->
                            <td class="custom-black-bg">Sparepart</td>
                            <td> <input type="text" name="sparepart-<?=$i?>" value =" " class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Sparepart Quantity -->
                            <td class="custom-black-bg">Quantity Sparepart</td>
                            <td> <input type="number" name="quantity-<?=$i?>" value =" " class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Sparepart Satuan-->
                            <td class="custom-black-bg">Satuan Sparepart</td>
                            <td> <input type="text" name="satuan-<?=$i?>" value =" " class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>Absensi</th>
                        <tr>
                            <!-- Nama -->
                            <td class="custom-black-bg">Nama</td>
                            <td> <input type="text" name="nama-<?=$i?>" value =" " class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Keterangan Absensi-->
                            <td class="custom-black-bg">Keterangan Absensi</td>
                            <td> <input type="text" name="keterangan-absensi-<?=$i?>" value =" " class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <tr>
                            <!-- Keterangan -->
                            <td class="custom-black-bg">Keterangan</td>
                            <td> <input type="text" name="keterangan-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Catatan -->
                            <td class="custom-black-bg">Catatan</td>
                            <td> <input type="text" name="catatan-<?=$i?>" class="form-control" width=20%> </td>
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
            $permasalahan = $_REQUEST['permasalahan-'.$i];
            $tindak_lanjut = $_REQUEST['tindak-lanjut-'.$i];
            $sparepart = EmptyToNull($_REQUEST['sparepart-'.$i]);
            $quantity = EmptyToNull($_REQUEST['quantity-'.$i]);
            $satuan = EmptyToNull($_REQUEST['satuan-'.$i]);
            $nama = EmptyToNull($_REQUEST['nama-'.$i]);
            $keterangan_absensi = EmptyToNull($_REQUEST['keterangan-absensi-'.$i]);
            $keterangan = EmptyToNull($_REQUEST['keterangan-'.$i]);
            $catatan = EmptyToNull($_REQUEST['catatan-'.$i]);

                        
            //Insert ke database
            $insert_query = "INSERT INTO wtp (wtp_id, tanggal, permasalahan, tindak_lanjut, 
                            sparepart, jumlah_sparepart, satuan_sparepart, 
                            nama_absensi, keterangan_absensi, 
                            keterangan, catatan) 
                            VALUES (uuid_generate_v4(), $1, $2, $3, 
                            $4, $5, $6, 
                            $7, $8, 
                            $9, $10);";
             
               
            $prepare_input = pg_prepare($koneksi_wtp, "insert_wtp", $insert_query);
            $exec_input = pg_execute($koneksi_wtp, "insert_wtp", array($tanggal, $permasalahan, $tindak_lanjut,
                        $sparepart, $quantity, $satuan,
                        $nama, $keterangan_absensi, 
                        $keterangan, $catatan));
            
            //Cek Error
            if(!$koneksi_wtp){
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
            echo "Fail! ". pg_last_error($koneksi_wtp);
            }
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
                window.location = 'wtp_input';
            } else {
                window.location = 'wtp';
            }
        })
    </script>
            
            <?php
        }
    }
?>
</body>