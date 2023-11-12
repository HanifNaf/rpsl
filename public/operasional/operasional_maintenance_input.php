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
  <title>Input Data Operasional PT. Rezeki Perkasa Sejahera Lestari</title>
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
    background-color: #228B22;
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
                        window.location = 'operasional_input';
                      }else{
                        window.location = 'operasional';
                      }
                    })
                </script>
        <?php } ?>


        <div class="row">
            <!--Nama Divisi-->
            <div class="col-md-6 col-sm-12 col">
            <h2 style="display: flex; float: left;">Jadwal Maintenance</h2>
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
            <form action="" method="post" id="myForm">
                <input type="hidden" name="total" value="<?= @$_POST['count_add'] ?>">
                <table class="table table-hover table-bordered table-sm">
                    <?php for($i=1; $i<=$_POST['count_add']; $i++){ ?>
                        <tr>
                            <!-- Nomor -->
                            <td class="custom-black-bg">No</td>
                            <td> <?= $i ?> </td>
                        </tr>
                        <tr>
                            <!-- Divisi -->
                            <td class="custom-black-bg">Divisi</td>
                                <td><select name="divisi-<?= $i ?>" class="form-control">
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
                                        <option value="Dijadwalkan">Dijadwalkan</option>
                                        <option value="Sedang Berlangsung">Sedang Berlangsung</option>
                                        <option value="Selesai">Selesai</option>
                                </select>
                                </td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td></td>
                        </tr>
                        <th>Tanggal</th>
                        <tr>
                            <!-- Before -->
                            <td class="custom-black-bg" width="30%">  Before  </td>
                            <td><input type="date" value="<? date('Y-m-d') ?>" name="tanggal-mulai-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- After -->
                            <td class="custom-black-bg" width="30%">  After  </td>
                            <td><input type="date" value="<? date('Y-m-d') ?>" name="tanggal-selesai-<?=$i?>" class="form-control" width=20%></td>
                        </tr>
                    <?php } ?>
                </table>
                <div class="form-group text-center" style="margin-top: 10px;">
                <button type="submit" name="add" class="btn btn-primary"><i class="fas fa-save"><a href="operasional_maintenance"></a></i> TAMBAH DATA</button>
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
            $tanggal_mulai = $_REQUEST['tanggal-mulai-'.$i];
            $tanggal_selesai = $_REQUEST['tanggal-selesai-'.$i];
            $status = $_REQUEST['status-'.$i];
            $divisi = $_REQUEST['divisi-'.$i];
            $unit = $_REQUEST['unit-'.$i];
            $problem = $_REQUEST['problem-'.$i];
            $evaluasi = $_REQUEST['evaluasi-'.$i];
            $penanganan = $_REQUEST['penanganan-'.$i];
            $tingkat_kerusakan = $_REQUEST['tingkat-kerusakan-'.$i];

            //Insert ke database
            $insert_query = "INSERT INTO maintenance (maintenance_id, jam, divisi, unit, problem, evaluasi, penanganan, tingkat_kerusakan, status, tanggal_mulai, tanggal_selesai)
            VALUES (uuid_generate_v4(), LOCALTIME, $1, $2, $3, $4, $5, $6, $7, $8, $9);"; 
            $prepare_input = pg_prepare($koneksi_operasional, "my_insert", $insert_query);
            $exec_input = pg_execute($koneksi_operasional, "my_insert", array($divisi, $unit, $problem, $evaluasi, $penanganan, $tingkat_kerusakan, $status, $tanggal_mulai, $tanggal_selesai));


            /*$rs = pg_fetch_assoc($exec_input);
            if (!$rs) {
                echo "0 records";
            }*/
        }
    }
?>


</body>