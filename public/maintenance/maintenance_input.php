<?php 
require_once("../../config/config.php");

// Cek role
if (!in_array($_SESSION['role'], ['elektrikal', 'wtp', 'mekanikal', 'admin'])) {
    echo "<p style='color: white;'>Akses Dibatasi. Anda tidak memiliki izin yang cukup.</p>";

    // Menambahkan skrip SweetAlert untuk notifikasi yang lebih menarik
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Dibatasi',
            }).then(function() {
                window.location.href = '../maintenance/maintenance.php';
            });
        </script>
    ";
}

require_once(SITE_ROOT."/src/header-admin.php");
require_once(SITE_ROOT."/src/footer-admin.php");
require_once(SITE_ROOT."/src/koneksi.php");
?>


<head>
<meta charset="UTF-8">
    <style>
        .custom-black-bg {
        background-color: #228B22;
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
            <h4 style="display: flex; float: left;">INPUT DATA MAINTENANCE</h4>
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
            <form action="" method="post" id="myForm" enctype="multipart/form-data">
                <input type="hidden" name="total" value="<?= @$_POST['count_add'] ?>">
                <table class="table table-hover table-bordered table-sm">
                    <?php for($i=1; $i<=$_POST['count_add']; $i++){ ?>
                        <tr>
                            <!-- Divisi -->
                            <td class="custom-black-bg">Divisi</td>
                                <td><select name="divisi-<?= $i ?>" class="form-control">
                                        <option value="Umum">-- Pilih Divisi --</option>
                                        <option value="Umum">Umum</option>
                                        <option value="Elektrikal">Elektrikal</option>
                                        <option value="WTP">WTP</option>
                                        <option value="Mekanikal">Mekanikal</option>
                                </select>
                                </td>
                        </tr>
                        <tr>
                            <!-- Unit -->
                            <td class="custom-black-bg">Unit</td>
                            <td><input type="text" name="unit-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Problem -->
                            <td class="custom-black-bg">Problem</td>
                            <td><input type="text" name="problem-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Evaluasi -->
                            <td class="custom-black-bg">Evaluasi</td>
                            <td><input type="text" name="evaluasi-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Penanganan -->
                            <td class="custom-black-bg">Penanganan</td>
                            <td><input type="text" name="penanganan-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                           <td> </td> 
                        </tr>
                        <th>Sparepart</th>
                        <tr>
                            <!-- Sparepart -->
                            <td class="custom-black-bg">Sparepart</td>
                            <td> <input type="text" name="sparepart-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Sparepart Quantity -->
                            <td class="custom-black-bg">Quantity Sparepart</td>
                            <td> <input type="number" name="quantity-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Sparepart Satuan-->
                            <td class="custom-black-bg">Satuan Sparepart</td>
                            <td> <input type="text" name="satuan-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>

                        <tr>
                            <!-- Pemisah -->
                            <td></td>
                        </tr>
                        <th>Tanggal</th>
                        <tr>
                            <!-- Before -->
                            <td class="custom-black-bg" width="30%">  Mulai  </td>
                            <td><input type="date" value="<? date('Y-m-d') ?>" name="tanggal-mulai-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- After -->
                            <td class="custom-black-bg" width="30%">  Selesai  </td>
                            <td><input type="date" value="<? date('Y-m-d') ?>" name="tanggal-selesai-<?=$i?>" class="form-control" width=20%></td>
                        </tr>

                        <tr>
                            <!-- Pemisah -->
                            <td></td>
                        </tr>
                        <tr>    
                            <!-- Tingkat Kerusakan -->
                            <td class="custom-black-bg">Tingkat Kerusakan</td>
                            <td>
                            <input type="radio" id="radio" value="Major" name="tingkat-kerusakan-<?=$i?>" style="form-control">
                            <label for="radio">Major</label><br>
                            <input type="radio" id="radio"value="Minor" name="tingkat-kerusakan-<?=$i?>" style="form-control">
                            <label for="radio">Minor</label>
                            </td>
                        </tr>
                        <tr>
                            <!-- Status -->
                            <td class="custom-black-bg">Status</td>
                            <td><select name="status-<?= $i ?>" class="form-control">
                                        <option value="-">-- Pilih Status --</option>
                                        <option value="Sedang Berlangsung">Sedang Berlangsung</option>
                                        <option value="Selesai">Selesai</option>
                                </select>
                                </td>
                        </tr>
                        <tr>
                            <!-- Keterangan -->
                            <td class="custom-black-bg">Keterangan</td>
                            <td> <input type="text" name="keterangan-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Lampiran -->
                            <td class="custom-black-bg">Lampiran</td>
                            <td> <input type="file" name="lampiran-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                    <?php } ?>
                </table>
                <div class="form-group text-center" style="margin-top: 10px;">
                <button type="submit" name="add" class="btn btn-primary"><i class="fas fa-save"><a href="maintenance"></a></i> TAMBAH DATA</button>
                </div>
            </form>
        </div> 
    </div> <!--Akhir Container-->
<!-- Menambahan ke Database -->
<?php 
    if(isset($_POST['add'])){
        $total = $_POST['total'];

        //Menyimpan input dalam variabel (Menggunakan looping)
        for($i=1; $i<=$total; $i++){
            //Tanggal
            $tanggal_mulai = $_REQUEST['tanggal-mulai-'.$i];
            $tanggal_selesai = emptyToNull($_REQUEST['tanggal-selesai-'.$i]);

            //Sparepart
            $sparepart = $_REQUEST['sparepart-'.$i];
            $quantity = emptyToNull($_REQUEST['quantity-'.$i]);
            $satuan = $_REQUEST['satuan-'.$i];

            //Lampiran
            $nama_lampiran = $_FILES['lampiran-'.$i]['name'];
            $tipe_lampiran = pathinfo($nama_lampiran)['extension'];
            $isi_lampiran = fopen($_FILES['lampiran-'.$i]['tmp_name'], 'rb');

            $divisi = $_REQUEST['divisi-'.$i];
            $unit = $_REQUEST['unit-'.$i];
            $problem = $_REQUEST['problem-'.$i];
            $evaluasi = $_REQUEST['evaluasi-'.$i];
            $penanganan = $_REQUEST['penanganan-'.$i];
            $tingkat_kerusakan = $_REQUEST['tingkat-kerusakan-'.$i];
            $status = $_REQUEST['status-'.$i];
            $keterangan = $_REQUEST['keterangan-'.$i];            

            //Query Insert
            $query = "WITH in1 AS(INSERT INTO lampiran (lampiran_id, nama, tipe, file) VALUES (uuid_generate_v4(),?,?,?) 
                    RETURNING lampiran_id AS lampiran)
                    INSERT INTO maintenance (maintenance_id, lampiran_id, divisi, unit, problem, evaluasi, 
                                penanganan, tanggal_mulai, tanggal_selesai, status, 
                                tingkat_kerusakan, keterangan, sparepart, jumlah_sparepart, 
                                satuan_sparepart)   
                    SELECT uuid_generate_v4(), (SELECT lampiran FROM in1), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?;"; 
            
            //Prepare
            $prep = $koneksi_maintenance -> prepare($query);

            //bind parameter
            $prep ->bindParam(1, $nama_lampiran);
            $prep ->bindParam(2, $tipe_lampiran);
            $prep ->bindParam(3, $isi_lampiran, PDO::PARAM_LOB);

            $prep ->bindParam(4, $divisi);
            $prep ->bindParam(5, $unit);
            $prep ->bindParam(6, $problem);
            $prep ->bindParam(7, $evaluasi);
            $prep ->bindParam(8, $penanganan);
            $prep ->bindParam(9, $tanggal_mulai);
            $prep ->bindParam(10, $tanggal_selesai);
            $prep ->bindParam(11, $status);
            $prep ->bindParam(12, $tingkat_kerusakan);
            $prep ->bindParam(13, $keterangan);
            $prep ->bindParam(14, $sparepart);
            $prep ->bindParam(15, $quantity);
            $prep ->bindParam(16, $satuan);
            
            //Insert
            try{
                $koneksi_maintenance -> beginTransaction();
                $prep -> execute();
                $koneksi_maintenance -> commit();

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
                            window.location = 'maintenance_input';
                        } else {
                            window.location = 'maintenance';
                        }
                    })
                </script>
                <?php
            } catch(PDOException $e) {
                echo "PDO ERROR: ". $e -> getMessage();
            }
        }
    }
?>


</body>