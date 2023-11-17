<?php 
require_once("../../config/config.php");
require_once(SITE_ROOT."/src/header-admin.php");
require_once(SITE_ROOT."/src/footer-admin.php");
require_once(SITE_ROOT."/src/koneksi.php");
?>

<head>
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

        <div class="row">
            <!--Nama Divisi-->
		    <div class="col-md-6 col-sm-12 col">
		    <h2 style="display: flex; float: left;">Elektrikal</h2>
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
                            <!-- Nomor -->
                           	<td class="custom-black-bg">No</td>
                            <td><?= $i ?> </td>
                        </tr>
                        <tr>
                            <!-- Tanggal -->
                            <td class="custom-black-bg">Tanggal</td>
                            <td> <input type="date" value="<? date('Y-m-d') ?>" name="tanggal-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Mulai -->
                            <td class="custom-black-bg">Jam Mulai</td>
                            <td><input type="time" name="mulai-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Selesai -->
                            <td class="custom-black-bg">Jam Selesai</td>
                            <td><input type="time" name="selesai-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Area Kerja -->
                            <td class="custom-black-bg">Area Kerja</td>
                            <td><input type="text" name="area-kerja-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pekerjaan -->
                            <td class="custom-black-bg">Pekerjaan</td>
                            <td><input type="text" name="pekerjaan-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Permasalahan -->
                            <td class="custom-black-bg">Permasalahan</td>
                            <td><input type="text" name="permasalahan-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Alat Yang Digunakan -->
                            <td class="custom-black-bg">Alat Yang Digunakan</td>
                            <td><input type="text" name="alat-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Personil -->
                            <td class="custom-black-bg">Personil</td>
                            <td><input type="text" name="personil-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!--Status-->
                            <td class="custom-black-bg">Status</td>
                                <td>
                                    <select name="status-<?= $i ?>" class="form-control">
                                        <option value="OK">OK</option>
                                        <option value="Tidak OK">Tidak OK</option>
                                    </select>
                                </td>
                        </tr>
                        <tr>
                            <!-- Keterangan -->
                            <td class="custom-black-bg">Keterangan</td>
                            <td><input type="text" name="keterangan-<?=$i?>" style="form-control"></td>
                        </tr>
                    <?php } ?>
                </table>
                <div class="form-group text-center" style="margin-top: 10px;">
                <button type="submit" name="add" class="btn btn-primary"><i class="fas fa-save"><a href="elektrikal"></a></i> TAMBAH DATA</button>
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
            $jam_mulai = $_REQUEST['mulai-'.$i].':00';
            $jam_selesai = $_REQUEST['selesai-'.$i].':00';
            $area_kerja = $_REQUEST['area-kerja-'.$i];
            $permasalahan = $_REQUEST['permasalahan-'.$i];
            $personil = $_REQUEST['personil-'.$i];
            $alat = $_REQUEST['alat-'.$i];
            $status = $_REQUEST['status-'.$i];
            $keterangan = $_REQUEST['keterangan-'.$i];
            $pekerjaan = $_REQUEST['pekerjaan-'.$i];

            //Insert ke database
            $insert_query = "INSERT INTO elektrikal (elektrikal_id, tanggal, jam_mulai, jam_selesai, area_kerja, permasalahan, personil, alat, status, keterangan, pekerjaan)
            VALUES(uuid_generate_v4(), $1, $2, $3, $4, $5, $6, $7, $8, $9, $10);";
            
            $prepare_input = pg_prepare($koneksi_elektrikal, "my_insert", $insert_query);
            $exec_input = pg_execute($koneksi_elektrikal, "my_insert", array($tanggal, $jam_mulai, $jam_selesai, $area_kerja, $permasalahan, $personil, $alat, $status, $keterangan, $pekerjaan));


            $rs = pg_fetch_assoc($exec_input);
            if (!$rs) {
            echo "0 records";
            echo $jam_mulai;
            echo $jam_selesai;
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
                window.location = 'elektrikal_input';
            } else {
                window.location = 'elektrikal';
            }
        })
    </script>
            
            <?php
        }
    }
?>
</body>