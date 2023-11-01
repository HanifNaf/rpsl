<?php 
require ("header-admin.php");
require ("../koneksi.php");
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
            <h2 style="display: flex; float: left;">OPERASIONAL</h2>
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
                            <td class="custom-black-bg">NO</td>
                            <td><?= $i ?> </td>
                        </tr>
                        <tr>
                            <!-- Divisi -->
                            <td class="custom-black-bg">Divisi</td>
                                <td><select name="divisi-<?= $i ?>" class="form-control">
                                        <option value="00.00">Chiper</option>
                                        <option value="Malam">Boiler</option>
                                        <option value="00.00">WTP</option>
                                        <option value="Malam">Turbin</option>
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
                            <td><input type="number" name="evaluasi-<?=$i?>" style="form-control"></td>
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
                            <input type="checkbox" id="checkbox" value="Major" name="major-<?=$i?>" style="form-control">
                            <label for="checkbox">Major</label><br>
                            <input type="checkbox" id="checkbox"value="Minor" name="minor-<?=$i?>" style="form-control">
                            <label for="checkbox">Minor</label>
                            </td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th>Tanggal</th>
                        <tr>
                            <!-- Before -->
                            <td class="custom-black-bg" width="30%">Before</td>
                            <td><input type="date" value="<? date('Y-m-d') ?>" name="tanggal-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- After -->
                            <td class="custom-black-bg" width="30%">After</td>
                            <td><input type="date" value="<? date('Y-m-d') ?>" name="tanggal-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <tr>
                            <!-- Jumlah Problem -->
                            <td class="custom-black-bg">Jumlah Problem</td>
                            <td><input type="number" name="jumlah_problem-<?=$i?>" style="form-control"></td>
                        </tr>
                    <?php } ?>
                </table>
                <div class="form-group text-center" style="margin-top: 10px;">
                <button type="submit" name="add" class="btn btn-primary"><i class="fas fa-save"><a href="operasional"></a></i> TAMBAH DATA</button>
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
            $shift = $_REQUEST['shift-'.$i];
            $generasi = $_REQUEST['generasi-'.$i];
            $pm_kwh_pltbm = $_REQUEST['pm-kwh-pltbm-'.$i];
            $ekspor = $_REQUEST['ekspor-'.$i];
            $pemakaian_sendiri = $_REQUEST['pemakaian-sendiri-'.$i];
            $kwh_loss = $_REQUEST['kwh-loss-'.$i];
            $cangkang = $_REQUEST['cangkang-'.$i];
            $palm_fiber = $_REQUEST['palm-fiber-'.$i];
            $wood_chips = $_REQUEST['wood-chips-'.$i];
            $serbuk_kayu = $_REQUEST['serbuk-kayu-'.$i];
            $sabut_kelapa = $_REQUEST['sabut-kelapa-'.$i];
            $efb = $_REQUEST['efb-press-'.$i];
            $opt = $_REQUEST['opt-'.$i];
            $supervisor = $_REQUEST['supervisor-'.$i];
            $keterangan = $_REQUEST['keterangan-'.$i];

            //Insert ke database
            $insert_query = "WITH in1 AS(
                INSERT INTO produksi_kwh (produksi_id, shift, generation, pm_kwh_pltbm, tanggal, waktu) VALUES (uuid_generate_v4(), $1, $2, $3, $4, LOCALTIME)
                RETURNING produksi_id AS produksi),
                in2 AS (
                INSERT INTO pemakaian_kwh (pemakaian_id, shift, ekspor, pemakaian_sendiri, kwh_loss, tanggal, waktu) VALUES (uuid_generate_v4(), $1, $5, $6, $7, $4, LOCALTIME)
                RETURNING pemakaian_id AS pakai),
                in3 AS (
                INSERT INTO pemakaian_bahan_bakar (pemakaian_bahan_bakar_id, shift, tanggal, waktu, kg_cangkang, kg_palmfiber, kg_woodchips, kg_serbukkayu, kg_sabutkelapa, kg_efbpress, kg_opt) VALUES (uuid_generate_v4(), $1, $4, LOCALTIME, $8, $9, $10, $11, $12, $13, $14)
                RETURNING pemakaian_bahan_bakar_id AS bahan_bakar)
                INSERT INTO operasional (operasional_id, produksi_id, pemakaian_id, pemakaian_bahan_bakar_id, supervisor, shift, tanggal, waktu, keterangan)
                SELECT uuid_generate_v4(), (SELECT produksi FROM in1), (SELECT pakai FROM in2), (SELECT bahan_bakar FROM in3), $15, $1, $4, LOCALTIME, $16;"; 
            $prepare_input = pg_prepare($koneksi_operasional, "my_insert", $insert_query);
            $exec_input = pg_execute($koneksi_operasional, "my_insert", array($shift, $generasi, $pm_kwh_pltbm, $tanggal, $ekspor, $pemakaian_sendiri, $kwh_loss, $cangkang, $palm_fiber, $wood_chips, $serbuk_kayu, $sabut_kelapa, $efb, $opt, $supervisor, $keterangan));


            $rs = pg_fetch_assoc($exec_input);
            if (!$rs) {
            echo "0 records";
            }
            ?> 
            
            <?php
        }
    }
?>
</body>