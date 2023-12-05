<?php 
require_once("../../config/config.php");

// Cek role
if (!in_array($_SESSION['role'], ['hse', 'admin'])) {
    echo "<p style='color: white;'>Akses Dibatasi. Anda tidak memiliki izin yang cukup.</p>";

    // Menambahkan skrip SweetAlert untuk notifikasi yang lebih menarik
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Dibatasi',
                text: 'Anda tidak memiliki izin yang cukup.',
            }).then(function() {
                window.location.href = '../hse/kecelakaan_kerja.php';
            });
        </script>
    ";
}

require_once(SITE_ROOT."/src/header-admin.php");
require_once(SITE_ROOT."/src/footer-admin.php");
require_once(SITE_ROOT."/src/koneksi.php");
?>

<head>
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

        <div class="row">
            <!--Nama Divisi-->
		    <div class="col-md-6 col-sm-12 col">
		    <h2 style="display: flex; float: left;">INPUT DATA KECELAKAAN KERJA</h2>
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
                                <td> <input type="date" value="<? date('Y-m-d') ?>" name="tanggal-<?=$i?>" class="form-control" width=20%> </td>
                            </tr>
                            <tr>
                               <!-- Pemisah -->
                               <td> </td>
                            </tr>
                            <th>Kecelakaan Kerja</th>
                            <tr>
                                <!-- Jam -->
                                <td class="custom-black-bg">Jenis Kecelakaan Kerja</td>
                                    <td><select name="jenis-<?= $i ?>" class="form-control">
                                            <option value="-">-- Pilih Jenis Kecelakaan Kerja --</option>
                                            <option value="Ringan">Ringan</option>
                                            <option value="Sedang">Sedang</option>
                                            <option value="Berat">Berat</option>
                                    </select>
                                    </td>
                            </tr>
                            <tr>
                                <!-- Penanganan -->
                                <td class="custom-black-bg" width="30%">Penanganan</td>
                                <td><input type="text" name="penanganan-<?=$i?>" style="form-control"></td>
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
                                            <option value="-">-- Pilih Jam Kerja --</option>
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
                <a href="kecelakaan_kerja" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> CANCEL</a>
            	</div>
            </form>
        </div> 
    </div> <!--Akhir Container-->
<!-- Menambahan ke Database -->
<?php 
    if(isset($_POST['add'])){
        $total = $_POST['total'];

        //Loop setiap iterasi input
        for($i=1; $i<=$total; $i++){

            //Menyimpan input dalalm variabel
            $jenis_kecelakaan_kerja = $_POST['jenis-'.$i];
            $penanganan = $_POST['penanganan-'.$i];
            $area = $_POST['area-'.$i];
            $waktu = $_POST['waktu-'.$i].':00';
            $jam_kerja = $_POST['jam-'.$i];
            $penyebab = $_POST['penyebab-'.$i];

            //handle tanggal
            $tanggal = $_POST['tanggal-'.$i];
            $tanggalid = insertOrSelectTanggal($tanggal, $koneksi);
                        
            //Insert ke database
            $insert_query = "INSERT INTO kecelakaan_kerja (kecelakaan_kerja_id, tanggal, jenis_kecelakaan_kerja, 
                            penanganan, area_kejadian, waktu_kejadian, jam_kerja_kejadian, penyebab, tanggal_id) 
                            VALUES (UUID(), ?,?,?,?,?,?,?,?);";

            //Prepare INSERT
            $prep = $koneksi -> prepare($insert_query);

            //bind parameter
            $prep ->bindParam(1, $tanggal);
            $prep ->bindParam(2, $jenis_kecelakaan_kerja);
            $prep ->bindParam(3, $penanganan);
            $prep ->bindParam(4, $area);
            $prep ->bindParam(5, $waktu);
            $prep ->bindParam(6, $jam_kerja);
            $prep ->bindParam(7, $penyebab);
            $prep ->bindParam(8, $tanggalid);

            //INSERT
            try{
                $koneksi -> beginTransaction();
                $prep -> execute();
                $koneksi -> commit();

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
                            window.location = 'kecelakaan_kerja_input';
                        } else {
                            window.location = 'kecelakaan_kerja';
                        }
                    })
                </script>
                <?php
            }catch(PDOException $e){
                echo "PDO ERROR: ". $e -> getMessage();
            
                $koneksi -> rollBack();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();

                $koneksi -> rollBack();
            }
        }
    }
?>
</body>