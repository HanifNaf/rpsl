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
        <br>

        <div class="table-responsive-sm table-responsie-md table-responsive-lg">
            <form action="" method="post" id="myForm" enctype="multipart/form-data">
                <input type="hidden" name="total" value="<?= @$_POST['count_add'] ?>">
                <table class="table table-hover table-bordered table-sm">
                    <?php for($i=1; $i<=$_POST['count_add']; $i++){ ?>
                        <tr>
                            <!-- Divisi -->
                            <td class="custom-black-bg">Divisi</td>
                                <td><select name="divisi-<?= $i ?>" class="form-control">
                                        <option value="">-- Pilih Divisi --</option>
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
                <a href="maintenance" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> CANCEL</a>
                </div>
            </form>
        </div> 
    </div> <!--Akhir Container-->

<!-- Menambahan ke Database -->
<?php 

    if(isset($_POST['add'])){
    $total = $_POST['total'];

        for($i=1; $i<=$total; $i++){

            //Menyimpan input dalam variabel

            //Sparepart
            $sparepart = $_POST['sparepart-'.$i];
            $quantity = emptyToNull($_POST['quantity-'.$i]);
            $satuan = $_POST['satuan-'.$i];

            //Lampiran
            if ($_FILES['lampiran-'.$i]['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['lampiran-'.$i]['tmp_name'])) {
                // Upload berhasil
                $nama_lampiran = $_FILES['lampiran-'.$i]['name'];
                $tipe_lampiran = pathinfo($nama_lampiran)['extension'];
                $isi_lampiran = fopen($_FILES['lampiran-'.$i]['tmp_name'], 'rb');
            } else {
                // Upload gagal
                $nama_lampiran = null;
                $tipe_lampiran = null;
                $isi_lampiran = null;
            }

            $divisi = $_POST['divisi-'.$i];
            $unit = $_POST['unit-'.$i];
            $problem = $_POST['problem-'.$i];
            $evaluasi = $_POST['evaluasi-'.$i];
            $penanganan = $_POST['penanganan-'.$i];
            $tingkat_kerusakan = $_POST['tingkat-kerusakan-'.$i];
            $status = $_POST['status-'.$i];
            $keterangan = $_POST['keterangan-'.$i];          
            
            //Handle tanggal
            $tanggal_mulai = $_POST['tanggal-mulai-'.$i];
            $tanggal_selesai = emptyToNull($_POST['tanggal-selesai-'.$i]);
            $tanggalid = insertOrSelectTanggal($tanggal_mulai, $koneksi);

            //Mulai Statement
            $koneksi->beginTransaction();

            try{
                // Insert lampiran
                $lampiran_query = "INSERT INTO lampiran_maintenance (lampiran_id, nama, tipe, file) 
                                VALUES (UUID(),?,?,?)";
                $prep_lampiran = $koneksi->prepare($lampiran_query);
                $prep_lampiran->bindParam(1, $nama_lampiran);
                $prep_lampiran->bindParam(2, $tipe_lampiran);
                $prep_lampiran->bindParam(3, $isi_lampiran, PDO::PARAM_LOB);

                $prep_lampiran->execute();

                // Mulai mengambil lampiran_id
                $lampiran_index = $koneksi->lastInsertId(); //Mengambil index dari kolom kolom_index

                $query = "SELECT lampiran_id FROM lampiran_maintenance WHERE kolom_index=:indeks";
                $prep_index = $koneksi->prepare($query);
                $prep_index->bindParam(':indeks', $lampiran_index);
                $prep_index->execute();

                // Fetch data sesuai kolom_index
                $row = $prep_index->fetch(PDO::FETCH_ASSOC);

                // Get lampiran_id
                $lampiran_id = $row['lampiran_id'];
                //Selesai mengambil lampiran_id
                

                // Insert maintenance
                $maintenance_query = "INSERT INTO maintenance (maintenance_id, lampiran_id, divisi, unit, problem, evaluasi, 
                                                penanganan, tanggal_mulai, tanggal_selesai, status, 
                                                tingkat_kerusakan, keterangan, sparepart, jumlah_sparepart, 
                                                satuan_sparepart, tanggal_id)   
                                    VALUES (UUID(), ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $prep_maintenance = $koneksi->prepare($maintenance_query);
                $prep_maintenance->bindParam(1, $lampiran_id);
                $prep_maintenance->bindParam(2, $divisi);
                $prep_maintenance->bindParam(3, $unit);
                $prep_maintenance->bindParam(4, $problem);
                $prep_maintenance->bindParam(5, $evaluasi);
                $prep_maintenance->bindParam(6, $penanganan);
                $prep_maintenance->bindParam(7, $tanggal_mulai);
                $prep_maintenance->bindParam(8, $tanggal_selesai);
                $prep_maintenance->bindParam(9, $status);
                $prep_maintenance->bindParam(10, $tingkat_kerusakan);
                $prep_maintenance->bindParam(11, $keterangan);

                $prep_maintenance->bindParam(12, $sparepart);
                $prep_maintenance->bindParam(13, $jumlah_sparepart);
                $prep_maintenance->bindParam(14, $satuan);
                $prep_maintenance->bindParam(15, $tanggalid);

                $prep_maintenance->execute();

                
                // Commit Statement
                $koneksi->commit();

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
            } catch (PDOException $e) {
                echo "PDO Error: " . $e->getMessage();

                $koneksi -> rollBack();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();

                $koneksi -> rollBack();
            }
        }
    }
?>


</body>