<?php 
require_once("../../config/config.php");

// Cek role
if (!in_array($_SESSION['role'], ['hrd', 'admin'])) {
    echo "<p style='color: white;'>Akses Dibatasi. Anda tidak memiliki izin yang cukup.</p>";

    // Menambahkan skrip SweetAlert untuk notifikasi yang lebih menarik
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Dibatasi',
            }).then(function() {
                window.location.href = '../hrd/pelanggaran.php';
            });
        </script>
    ";
}

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
		    <h2 style="display: flex; float: left;">INPUT DATA PELANGGARAN HRD</h2>
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
            <form action="" method="post" enctype="multipart/form-data">
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
                            <td> <input type="text" name="nik-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Nama -->
                            <td class="custom-black-bg">Nama</td>
                            <td> <input type="text" name="nama-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Bagian -->
                            <td class="custom-black-bg">Bagian</td>
                            <td> <input type="text" name="bagian-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Shift -->
                            <td class="custom-black-bg">Shift</td>
                            <td>
                                <select name="shift-<?=$i?>" class="form-control" style="width: 20%;">
                                    <option value="-">-- Pilih Shift --</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>Pelanggaran</th>
                        <tr>
                            <!-- Waktu Pelanggaran -->
                            <td class="custom-black-bg">Waktu Pelanggaran</td>
                            <td> <input type="time" name="waktu-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Tempat Pelanggaran -->
                            <td class="custom-black-bg">Tempat Pelanggaran</td>
                            <td> <input type="text" name="tempat-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Bentuk Pelanggaran-->
                            <td class="custom-black-bg">Bentuk Pelanggaran</td>
                            <td> <input type="text" name="bentuk-pelanggaran-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Potensi Bahaya-->
                            <td class="custom-black-bg">Potensi Bahaya</td>
                            <td> <input type="text" name="potensi-bahaya-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <tr>
                            <!-- Sanksi -->
                            <td class="custom-black-bg">Sanksi</td>
                            <td>
                                <select name="sanksi-<?=$i?>" class="form-control" style="width: 23%;">
                                    <option value="-">-- Pilih Sanksi --</option>
                                    <option value="SP1">SP1</option>
                                    <option value="SP2">SP2</option>
                                    <option value="SP3">SP3</option>
                                    <option value="Teguran Lisan">Teguran Lisan</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <!-- Lampiran -->
                            <td class="custom-black-bg">Lampiran</td>
                            <td> <input type="file" name="lampiran-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                    <?php } ?>
                </table>
                <div class="form-group text-center" style="margin-top: 10px;">
                <button type="submit" name="add" class="btn btn-primary"><i class="fas fa-save"><a href="pelanggaran"></a></i> TAMBAH DATA</button>
                <a href="pelanggaran" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> CANCEL</a>
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
            //Lampiran
            $nama_lampiran = $_FILES['lampiran-'.$i]['name'];
            $tipe_lampiran = pathinfo($nama_lampiran)['extension'];
            $isi_lampiran = fopen($_FILES['lampiran-'.$i]['tmp_name'], 'rb');

            $tanggal = $_REQUEST['tanggal-'.$i];
            $nama = $_REQUEST['nama-'.$i];
            $bagian = $_REQUEST['bagian-'.$i];
            $shift = $_REQUEST['shift-'.$i];
            $bentuk_pelanggaran = $_REQUEST['bentuk-pelanggaran-'.$i];
            $nik = EmptyToNull($_REQUEST['nik-'.$i]);
            $waktu = EmptyToNull($_REQUEST['waktu-'.$i]).":00";
            $tempat = EmptyToNull($_REQUEST['tempat-'.$i]);
            $potensi_bahaya = EmptyToNull($_REQUEST['potensi-bahaya-'.$i]);
            $sanksi = EmptyToNull($_REQUEST['sanksi-'.$i]);
                        
            //QUERY INSERT
            $query = "WITH in1 AS(INSERT INTO lampiran(lampiran_id, nama, tipe, file) 
                    VALUES(uuid_generate_v4(), ?, ?, ?) RETURNING lampiran_id AS lampiran)
                    INSERT INTO hrd (hrd_id, lampiran_id, tanggal, nik, nama, bagian, shift, 
                    waktu_pelanggaran, tempat_pelanggaran, bentuk_pelanggaran, potensi_bahaya, sanksi)
                    SELECT uuid_generate_v4(), (SELECT lampiran FROM in1), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?;";
            
            //Prepare INSERT
            $prep = $koneksi_hrd -> prepare($query);

            //bind parameter
            $prep ->bindParam(1, $nama_lampiran);
            $prep ->bindParam(2, $tipe_lampiran);
            $prep ->bindParam(3, $isi_lampiran, PDO::PARAM_LOB);

            $prep ->bindParam(4, $tanggal);
            $prep ->bindParam(5, $nik);
            $prep ->bindParam(6, $nama);
            $prep ->bindParam(7, $bagian);
            $prep ->bindParam(8, $shift);
            $prep ->bindParam(9, $waktu);
            $prep ->bindParam(10, $tempat);
            $prep ->bindParam(11, $bentuk_pelanggaran);
            $prep ->bindParam(12, $potensi_bahaya);
            $prep ->bindParam(13, $sanksi);

            //INSERT
            try{
                $koneksi_hrd -> beginTransaction();
                $prep -> execute();
                $koneksi_hrd -> commit();

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
                            window.location = 'pelanggaran_input';
                        } else {
                            window.location = 'pelanggaran';
                        }
                    })
                </script>
                <?php
            }catch(PDOException $e){
                echo "PDO ERROR: ". $e -> getMessage();
            }
        }
    }
?>
</body>