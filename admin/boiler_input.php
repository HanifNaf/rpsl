<?php 
require ("header-admin.php");
require ("../koneksi.php");
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
		    <h2 style="display: flex; float: left;">BOILER</h2>
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
                            <td class="custom-black-bg">Jam</td>
                                <td><select name="jam-<?= $i ?>" class="form-control">
                                        <option value="00.00">00.00</option>
                                        <option value="Malam">01.00</option>
                                        <option value="00.00">02.00</option>
                                        <option value="Malam">03.00</option>
                                        <option value="00.00">04.00</option>
                                        <option value="Malam">05.00</option>
                                        <option value="00.00">06.00</option>
                                        <option value="Malam">07.00</option>
                                        <option value="00.00">08.00</option>
                                        <option value="Malam">09.00</option>
                                        <option value="00.00">10.00</option>
                                        <option value="Malam">11.00</option>
                                        <option value="00.00">12.00</option>
                                        <option value="Malam">13.00</option>
                                        <option value="00.00">14.00</option>
                                        <option value="Malam">15.00</option>
                                        <option value="00.00">16.00</option>
                                        <option value="Malam">17.00</option>
                                        <option value="00.00">18.00</option>
                                        <option value="Malam">19.00</option>
                                        <option value="00.00">20.00</option>
                                        <option value="Malam">21.00</option>
                                        <option value="00.00">22.00</option>
                                        <option value="Malam">23.00</option>
                                </select>
                                </td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th>DRUM LEVEL</th>
                        <tr>
                            <!-- Level 1 -->
                            <td class="custom-black-bg" width="30%">Level 1</td>
                            <td><input type="number" name="level1-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Level 2 -->
                            <td class="custom-black-bg">Level 2</td>
                            <td><input type="number" name="level2-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure -->
                            <td class="custom-black-bg">Pressure</td>
                            <td><input type="number" name="pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Main Stream </th>
                        <tr>    
                            <!-- Temperatur -->
                            <td class="custom-black-bg">Temperatur</td>
                            <td><input type="number" name="temperatur-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure -->
                            <td class="custom-black-bg">Pressure</td>
                            <td><input type="number" name="pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow -->
                            <td class="custom-black-bg">Flow</td>
                            <td><input type="number" name="flow-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow Total -->
                            <td class="custom-black-bg">Flow Total</td>
                            <td><input type="number" name="flow_total-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Furnace </th>
                       <tr>    
                            <!-- Temperatur L -->
                            <td class="custom-black-bg">Temperatur L</td>
                            <td><input type="number" name="temperatur_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Temperatur R-->
                            <td class="custom-black-bg">Temperatur R</td>
                            <td><input type="number" name="temperatur_r-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Pressure L -->
                            <td class="custom-black-bg">Pressure L</td>
                            <td><input type="number" name="pressure_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure R -->
                            <td class="custom-black-bg">Pressure R</td>
                            <td><input type="number" name="pressure_r-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Feed Pump </th>
                        <tr>
                            <!-- Freq 1 -->
                            <td class="custom-black-bg">Freq 1</td>
                            <td><input type="number" name="freq_1-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq 2 -->
                            <td class="custom-black-bg">Freq 2</td>
                            <td><input type="number" name="freq_2-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Curr 1 -->
                            <td class="custom-black-bg">Curr 1</td>
                            <td><input type="number" name="curr_1-<?=$i?>" style="form-control"></td>
                        </tr>
                         <tr>
                            <!-- Curr 2 -->
                            <td class="custom-black-bg">Curr 2</td>
                            <td><input type="number" name="curr_2-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Superheater </th>
                         <tr>    
                            <!-- Temperatur L -->
                            <td class="custom-black-bg">Temperatur L</td>
                            <td><input type="number" name="temperatur_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Temperatur R-->
                            <td class="custom-black-bg">Temperatur R</td>
                            <td><input type="number" name="temperatur_r-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Pressure L -->
                            <td class="custom-black-bg">Pressure L</td>
                            <td><input type="number" name="pressure_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure R -->
                            <td class="custom-black-bg">Pressure R</td>
                            <td><input type="number" name="pressure_r-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> IDF </th>
                        <tr>
                            <!-- Freq 1 -->
                            <td class="custom-black-bg">Freq 1</td>
                            <td><input type="number" name="freq_1-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq 2 -->
                            <td class="custom-black-bg">Freq 2</td>
                            <td><input type="number" name="freq_2-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Curr 1 -->
                            <td class="custom-black-bg">Curr 1</td>
                            <td><input type="number" name="curr_1-<?=$i?>" style="form-control"></td>
                        </tr>
                         <tr>
                            <!-- Curr 2 -->
                            <td class="custom-black-bg">Curr 2</td>
                            <td><input type="number" name="curr_2-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Air </th>
                        <tr>
                            <!-- Primary Temperature -->
                            <td class="custom-black-bg"> Primary Temperature </td>
                            <td><input type="number" name="primary_temperature-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Secondary Temperature -->
                            <td class="custom-black-bg"> Secondary Temperature </td>
                            <td><input type="number" name="secondary_temperature-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Primary Pressure -->
                            <td class="custom-black-bg"> Primary Pressure </td>
                            <td><input type="number" name="primary_pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Secondary Pressure -->
                            <td class="custom-black-bg"> Secondary Pressure </td>
                            <td><input type="number" name="secondary_pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Feed Water </th>
                        <tr>    
                            <!-- Temperatur -->
                            <td class="custom-black-bg">Temperatur</td>
                            <td><input type="number" name="temperatur-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow -->
                            <td class="custom-black-bg">Flow</td>
                            <td><input type="number" name="flow-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow Total -->
                            <td class="custom-black-bg">Flow Total</td>
                            <td><input type="number" name="flow_total-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure -->
                            <td class="custom-black-bg">Pressure</td>
                            <td><input type="number" name="pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                         <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Desuperheater </th>
                        <tr>    
                            <!-- Temperatur -->
                            <td class="custom-black-bg">Temperatur</td>
                            <td><input type="number" name="temperatur-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow -->
                            <td class="custom-black-bg">Flow</td>
                            <td><input type="number" name="flow-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow Total -->
                            <td class="custom-black-bg">Flow Total</td>
                            <td><input type="number" name="flow_total-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Header </th>
                        <tr>    
                            <!-- Temperatur -->
                            <td class="custom-black-bg">Temperatur</td>
                            <td><input type="number" name="temperatur-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure -->
                            <td class="custom-black-bg">Pressure</td>
                            <td><input type="number" name="pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Exhaust Gas </th>
                         <tr>    
                            <!-- Temperatur L -->
                            <td class="custom-black-bg">Temperatur L</td>
                            <td><input type="number" name="temperatur_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Temperatur R-->
                            <td class="custom-black-bg">Temperatur R</td>
                            <td><input type="number" name="temperatur_r-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Pressure L -->
                            <td class="custom-black-bg">Pressure L</td>
                            <td><input type="number" name="pressure_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure R -->
                            <td class="custom-black-bg">Pressure R</td>
                            <td><input type="number" name="pressure_r-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Scraper </th>
                        <tr>
                            <!-- Freq -->
                            <td class="custom-black-bg">Freq</td>
                            <td><input type="number" name="freq-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Curr -->
                            <td class="custom-black-bg">Curr</td>
                            <td><input type="number" name="curr-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Soot </th>
                        <tr>    
                            <!-- Temperature -->
                            <td class="custom-black-bg">Temperature</td>
                            <td><input type="number" name="temperatur-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure -->
                            <td class="custom-black-bg">Pressure</td>
                            <td><input type="number" name="pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Fuel </th>
                        <tr>
                            <!-- Freq 1 -->
                            <td class="custom-black-bg">Freq 1</td>
                            <td><input type="number" name="freq_1-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq 2 -->
                            <td class="custom-black-bg">Freq 2</td>
                            <td><input type="number" name="freq_2-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq 3 -->
                            <td class="custom-black-bg">Freq 3</td>
                            <td><input type="number" name="freq_1-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq 4 -->
                            <td class="custom-black-bg">Freq 4</td>
                            <td><input type="number" name="freq_2-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> FDF </th>
                         <tr>
                            <!-- Out Pressure -->
                            <td class="custom-black-bg">Out Pressure</td>
                            <td><input type="number" name="out_pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq -->
                            <td class="custom-black-bg">Freq</td>
                            <td><input type="number" name="freq-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Curr -->
                            <td class="custom-black-bg">Curr</td>
                            <td><input type="number" name="curr-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> SDF </th>
                         <tr>
                            <!-- Out Pressure -->
                            <td class="custom-black-bg">Out Pressure</td>
                            <td><input type="number" name="out_pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq -->
                            <td class="custom-black-bg">Freq</td>
                            <td><input type="number" name="freq-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Curr -->
                            <td class="custom-black-bg">Curr</td>
                            <td><input type="number" name="curr-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Economizer </th>
                        <tr>    
                            <!-- In Temperatur L -->
                            <td class="custom-black-bg">In Temperatur L</td>
                            <td><input type="number" name="intemperatur_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- In Temperatur R-->
                            <td class="custom-black-bg">In Temperatur R</td>
                            <td><input type="number" name="intemperatur_r-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- In Pressure L -->
                            <td class="custom-black-bg">In Pressure L</td>
                            <td><input type="number" name="inpressure_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- In Pressure R -->
                            <td class="custom-black-bg">In Pressure R</td>
                            <td><input type="number" name="inpressure_r-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Out Temperatur Water -->
                            <td class="custom-black-bg">Out Temperatur Water</td>
                            <td><input type="number" name="out_temperatur_water-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- In Temperatur Water -->
                            <td class="custom-black-bg">In Temperatur Water</td>
                            <td><input type="number" name="in_temperatur_water-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Out Temperatur L -->
                            <td class="custom-black-bg">Out Temperatur L</td>
                            <td><input type="number" name="outtemperatur_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Out Temperatur R-->
                            <td class="custom-black-bg">Out Temperatur R</td>
                            <td><input type="number" name="outtemperatur_r-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Out Pressure L -->
                            <td class="custom-black-bg">Out Pressure L</td>
                            <td><input type="number" name="outpressure_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Out Pressure R -->
                            <td class="custom-black-bg">Out Pressure R</td>
                            <td><input type="number" name="outpressure_r-<?=$i?>" style="form-control"></td>
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