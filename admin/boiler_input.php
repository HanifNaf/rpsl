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
					    window.location = 'boiler_input';
					  }else{
					  	window.location = 'boiler';
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
                                        <option value="00.00.00">00.00</option>
                                        <option value="01.00.00">01.00</option>
                                        <option value="02.00.00">02.00</option>
                                        <option value="03.00.00">03.00</option>
                                        <option value="04.00.00">04.00</option>
                                        <option value="05.00.00">05.00</option>
                                        <option value="06.00.00">06.00</option>
                                        <option value="07.00.00">07.00</option>
                                        <option value="08.00.00">08.00</option>
                                        <option value="09.00.00">09.00</option>
                                        <option value="10.00.00">10.00</option>
                                        <option value="11.00.00">11.00</option>
                                        <option value="12.00.00">12.00</option>
                                        <option value="13.00.00">13.00</option>
                                        <option value="14.00.00">14.00</option>
                                        <option value="15.00.00">15.00</option>
                                        <option value="16.00.00">16.00</option>
                                        <option value="17.00.00">17.00</option>
                                        <option value="18.00.00">18.00</option>
                                        <option value="19.00.00">19.00</option>
                                        <option value="20.00.00">20.00</option>
                                        <option value="21.00.00">21.00</option>
                                        <option value="22.00.00">22.00</option>
                                        <option value="23.00.00">23.00</option>
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
                            <td><input type="number" name="drum_level1-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Level 2 -->
                            <td class="custom-black-bg">Level 2</td>
                            <td><input type="number" name="drum_level2-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure -->
                            <td class="custom-black-bg">Pressure</td>
                            <td><input type="number" name="drum_pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Main Stream </th>
                        <tr>    
                            <!-- Temperatur -->
                            <td class="custom-black-bg">Temperature</td>
                            <td><input type="number" name="stream_temperature-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure -->
                            <td class="custom-black-bg">Pressure</td>
                            <td><input type="number" name="stream_pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow -->
                            <td class="custom-black-bg">Flow</td>
                            <td><input type="number" name="stream_flow-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow Total -->
                            <td class="custom-black-bg">Flow Total</td>
                            <td><input type="number" name="stream_flow_total-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Furnace </th>
                       <tr>    
                            <!-- Temperatur L -->
                            <td class="custom-black-bg">Temperature L</td>
                            <td><input type="number" name="furnace_temperature_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Temperatur R-->
                            <td class="custom-black-bg">Temperature R</td>
                            <td><input type="number" name="furnace_temperature_r-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Pressure L -->
                            <td class="custom-black-bg">Pressure L</td>
                            <td><input type="number" name="furnace_pressure_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure R -->
                            <td class="custom-black-bg">Pressure R</td>
                            <td><input type="number" name="furnace_pressure_r-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Feed Pump </th>
                        <tr>
                            <!-- Freq 1 -->
                            <td class="custom-black-bg">Freq 1</td>
                            <td><input type="number" name="pump_freq_1-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq 2 -->
                            <td class="custom-black-bg">Freq 2</td>
                            <td><input type="number" name="pump_freq_2-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Curr 1 -->
                            <td class="custom-black-bg">Curr 1</td>
                            <td><input type="number" name="pump_curr_1-<?=$i?>" style="form-control"></td>
                        </tr>
                         <tr>
                            <!-- Curr 2 -->
                            <td class="custom-black-bg">Curr 2</td>
                            <td><input type="number" name="pump_curr_2-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Superheater </th>
                         <tr>    
                            <!-- Temperatur L -->
                            <td class="custom-black-bg">Temperature L</td>
                            <td><input type="number" name="superheater_temperature_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Temperatur R-->
                            <td class="custom-black-bg">Temperature R</td>
                            <td><input type="number" name="superheater_temperature_r-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Pressure L -->
                            <td class="custom-black-bg">Pressure L</td>
                            <td><input type="number" name="superheater_pressure_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure R -->
                            <td class="custom-black-bg">Pressure R</td>
                            <td><input type="number" name="superheater_pressure_r-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> IDF </th>
                        <tr>
                            <!-- Freq 1 -->
                            <td class="custom-black-bg">Freq 1</td>
                            <td><input type="number" name="idf_freq_1-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq 2 -->
                            <td class="custom-black-bg">Freq 2</td>
                            <td><input type="number" name="idf_freq_2-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Curr 1 -->
                            <td class="custom-black-bg">Curr 1</td>
                            <td><input type="number" name="idf_curr_1-<?=$i?>" style="form-control"></td>
                        </tr>
                         <tr>
                            <!-- Curr 2 -->
                            <td class="custom-black-bg">Curr 2</td>
                            <td><input type="number" name="idf_curr_2-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Air </th>
                        <tr>
                            <!-- Primary Temperature -->
                            <td class="custom-black-bg"> Primary Temperature </td>
                            <td><input type="number" name="air_primary_temperature-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Secondary Temperature -->
                            <td class="custom-black-bg"> Secondary Temperature </td>
                            <td><input type="number" name="air_secondary_temperature-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Primary Pressure -->
                            <td class="custom-black-bg"> Primary Pressure </td>
                            <td><input type="number" name="air_primary_pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Secondary Pressure -->
                            <td class="custom-black-bg"> Secondary Pressure </td>
                            <td><input type="number" name="air_secondary_pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Feed Water </th>
                        <tr>    
                            <!-- Temperatur -->
                            <td class="custom-black-bg">Temperature</td>
                            <td><input type="number" name="water_temperature-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow -->
                            <td class="custom-black-bg">Flow</td>
                            <td><input type="number" name="water_flow-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow Total -->
                            <td class="custom-black-bg">Flow Total</td>
                            <td><input type="number" name="water_flow_total-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure -->
                            <td class="custom-black-bg">Pressure</td>
                            <td><input type="number" name="water_pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                         <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Desuperheater </th>
                        <tr>    
                            <!-- Temperatur -->
                            <td class="custom-black-bg">Temperature</td>
                            <td><input type="number" name="desuperheater_temperature-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow -->
                            <td class="custom-black-bg">Flow</td>
                            <td><input type="number" name="desuperheater_flow-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow Total -->
                            <td class="custom-black-bg">Flow Total</td>
                            <td><input type="number" name="desuperheater_flow_total-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Header </th>
                        <tr>    
                            <!-- Temperatur -->
                            <td class="custom-black-bg">Temperature</td>
                            <td><input type="number" name="header_temperature-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure -->
                            <td class="custom-black-bg">Pressure</td>
                            <td><input type="number" name="header_pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Exhaust Gas </th>
                         <tr>    
                            <!-- Temperatur L -->
                            <td class="custom-black-bg">Temperature L</td>
                            <td><input type="number" name="exhaust_temperature_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Temperatur R-->
                            <td class="custom-black-bg">Temperature R</td>
                            <td><input type="number" name="exhaust_temperature_r-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Pressure L -->
                            <td class="custom-black-bg">Pressure L</td>
                            <td><input type="number" name="exhaust_pressure_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure R -->
                            <td class="custom-black-bg">Pressure R</td>
                            <td><input type="number" name="exhaust_pressure_r-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Scraper </th>
                        <tr>
                            <!-- Freq -->
                            <td class="custom-black-bg">Freq</td>
                            <td><input type="number" name="scraper_freq-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Curr -->
                            <td class="custom-black-bg">Curr</td>
                            <td><input type="number" name="scraper_curr-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Soot </th>
                        <tr>    
                            <!-- Temperature -->
                            <td class="custom-black-bg">Temperature</td>
                            <td><input type="number" name="soot_temperature-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure -->
                            <td class="custom-black-bg">Pressure</td>
                            <td><input type="number" name="soot_pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Fuel </th>
                        <tr>
                            <!-- Freq 1 -->
                            <td class="custom-black-bg">Freq 1</td>
                            <td><input type="number" name="fuel_freq_1-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq 2 -->
                            <td class="custom-black-bg">Freq 2</td>
                            <td><input type="number" name="fuel_freq_2-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq 3 -->
                            <td class="custom-black-bg">Freq 3</td>
                            <td><input type="number" name="fuel_freq_3-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq 4 -->
                            <td class="custom-black-bg">Freq 4</td>
                            <td><input type="number" name="fuel_freq_4-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> FDF </th>
                         <tr>
                            <!-- Out Pressure -->
                            <td class="custom-black-bg">Out Pressure</td>
                            <td><input type="number" name="fdf_out_pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq -->
                            <td class="custom-black-bg">Freq</td>
                            <td><input type="number" name="fdf_freq-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Curr -->
                            <td class="custom-black-bg">Curr</td>
                            <td><input type="number" name="fdf_curr-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> SDF </th>
                         <tr>
                            <!-- Out Pressure -->
                            <td class="custom-black-bg">Out Pressure</td>
                            <td><input type="number" name="sdf_out_pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq -->
                            <td class="custom-black-bg">Freq</td>
                            <td><input type="number" name="sdf_freq-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Curr -->
                            <td class="custom-black-bg">Curr</td>
                            <td><input type="number" name="sdf_curr-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Economizer </th>
                        <tr>    
                            <!-- In Temperatur L -->
                            <td class="custom-black-bg">In Temperature L</td>
                            <td><input type="number" name="economizer_intemperature_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- In Temperatur R-->
                            <td class="custom-black-bg">In Temperature R</td>
                            <td><input type="number" name="economizer_intemperature_r-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- In Pressure L -->
                            <td class="custom-black-bg">In Pressure L</td>
                            <td><input type="number" name="economizer_inpressure_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- In Pressure R -->
                            <td class="custom-black-bg">In Pressure R</td>
                            <td><input type="number" name="economizer_inpressure_r-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Out Temperatur Water -->
                            <td class="custom-black-bg">Out Temperature Water</td>
                            <td><input type="number" name="economizer_outtemperature_water-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- In Temperatur Water -->
                            <td class="custom-black-bg">In Temperature Water</td>
                            <td><input type="number" name="economizer_intemperature_water-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Out Temperatur L -->
                            <td class="custom-black-bg">Out Temperature L</td>
                            <td><input type="number" name="economizer_outtemperature_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Out Temperatur R-->
                            <td class="custom-black-bg">Out Temperature R</td>
                            <td><input type="number" name="economizer_outtemperature_r-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Out Pressure L -->
                            <td class="custom-black-bg">Out Pressure L</td>
                            <td><input type="number" name="economizer_outpressure_l-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Out Pressure R -->
                            <td class="custom-black-bg">Out Pressure R</td>
                            <td><input type="number" name="economizer_outpressure_r-<?=$i?>" style="form-control"></td>
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
            $jam = $_REQUEST['jam-'.$i];
            $drum_level1 = $_REQUEST['drum_level1-'.$i];
            $drum_level2 = $_REQUEST['drum_level2-'.$i];
            $drum_pressure = $_REQUEST['drum_pressure-'.$i];
            $stream_temperature = $_REQUEST['steam_temperature-'.$i];
            $stream_pressure = $_REQUEST['steam_pressure-'.$i];
            $stream_flow = $_REQUEST['steam_flow-'.$i];
            $stream_flowtotal = $_REQUEST['steam_flow_total-'.$i];
            $furnace_temperature_l = $_REQUEST['furnace_temperature_l-'.$i];
            $furnace_temperature_r = $_REQUEST['furnace_temperature_r-'.$i];
            $furnace_pressure_l = $_REQUEST['furnace_pressure_l-'.$i];
            $furnace_pressure_r = $_REQUEST['furnace_pressure_r-'.$i];
            $pump_freq_1 = $_REQUEST['pump_freq1-'.$i];
            $pump_freq_2 = $_REQUEST['pump_freq2-'.$i];
            $pump_curr_1 = $_REQUEST['pump_curr1-'.$i];
            $pump_curr_2 = $_REQUEST['pump_curr2-'.$i];
            $superheater_temperature_l = $_REQUEST['superheater_temperature_l-'.$i];
            $superheater_temperature_r = $_REQUEST['superheater_temperature_r-'.$i];
            $superheater_pressure_l = $_REQUEST['superheater_pressure_l-'.$i];
            $superheater_pressure_r = $_REQUEST['superheater_pressure_r-'.$i];
            $idf_freq_1 = $_REQUEST['idf_freq1-'.$i];
            $idf_freq_2 = $_REQUEST['idf_freq2-'.$i];
            $idf_curr_1 = $_REQUEST['idf_curr1-'.$i];
            $idf_curr_2 = $_REQUEST['idf_curr2-'.$i];
            $air_primary_temperature = $_REQUEST['air_primary_temperature-'.$i];
            $air_secondary_temperature = $_REQUEST['air_secondary_temperature-'.$i];
            $air_primary_pressure = $_REQUEST['air_primary_pressure-'.$i];
            $air_secondary_pressure = $_REQUEST['air_secondary_pressure-'.$i];
            $water_temperature = $_REQUEST['water_temperature-'.$i];
            $water_flow = $_REQUEST['water_flow-'.$i];
            $water_flowtotal = $_REQUEST['water_flow_total-'.$i];
            $water_pressure = $_REQUEST['water_pressure-'.$i];
            $desuperheater_temperature = $_REQUEST['desuperheater_temperature-'.$i];
            $desuuperheater_flow = $_REQUEST['desuperheater_flow-'.$i];
            $desuperheater_flowtotal = $_REQUEST['desuperheater_flow_total-'.$i];
            $header_temperature = $_REQUEST['header_temperature-'.$i];
            $header_pressure = $_REQUEST['header_pressure-'.$i];
            $exhaust_temperature_l = $_REQUEST['exhaust_temperature_l-'.$i];
            $exhaust_temperature_r = $_REQUEST['exhaust_temperature_r-'.$i];
            $exhaust_pressure_l = $_REQUEST['exhaust_pressure_l-'.$i];
            $exhaust_pressure_r = $_REQUEST['exhaust_pressure_r-'.$i];
            $scraper_freq = $_REQUEST['scraper_freq-'.$i];
            $scraper_curr = $_REQUEST['scraper_curr-'.$i];
            $soot_temperature = $_REQUEST['soot_temperature-'.$i];
            $soot_pressure = $_REQUEST['soot_pressure-'.$i];
            $fuel_freq_1 = $_REQUEST['fuel_freq1-'.$i];
            $fuel_freq_2 = $_REQUEST['fuel_freq2-'.$i];
            $fuel_freq_3 = $_REQUEST['fuel_freq3-'.$i];
            $fuel_freq_4 = $_REQUEST['fuel_freq4-'.$i];
            $fdf_outpressure = $_REQUEST['fdf_out_pressure-'.$i];
            $fdf_freq = $_REQUEST['fdf_freq-'.$i];
            $fdf_curr = $_REQUEST['fdf_curr-'.$i];
            $sdf_outpressure = $_REQUEST['sdf_out_pressure-'.$i];
            $sdf_freq = $_REQUEST['sdf_freq-'.$i];
            $sdf_curr = $_REQUEST['sdf_curr-'.$i];
            $economizer_intemperature_l = $_REQUEST['economizer_intemperature_l-'.$i];
            $economizer_intemperature_r = $_REQUEST['economizer_intemperature_r-'.$i];
            $economizer_inpressure_l = $_REQUEST['economizer_inpressure_l-'.$i];
            $economizer_inpressure_r = $_REQUEST['economizer_pressure_r-'.$i];
            $economizer_outtemperature_water = $_REQUEST['economizer_outtemperature_water-'.$i];
            $economizer_intemperature_water = $_REQUEST['economizer_intemperature_water-'.$i];
            $economizer_outtemperature_l = $_REQUEST['economizer_outtemperature_l-'.$i];
            $economizer_outtemperature_r = $_REQUEST['economizer_outtemperature_r-'.$i];
            $economizer_outpressure_l = $_REQUEST['economizer_outpressure_l-'.$i];
            $economizer_outpressure_r = $_REQUEST['economizer_outpressure_r-'.$i];

            //Insert ke database
            $insert_query = "WITH in1 AS(INSERT INTO drum_level (drum_id, tanggal, jam, level1, level2, pressure) 
                VALUES (uuid_generate_v4(), $1, $2, $drum_level1, $drum_level2, $drum_pressure))
                ,
                in2 AS( INSERT INTO main_stream (mainstream_id, tanggal, jam, temperature, pressure, flow, flow_total) 
                VALUES (uuid_generate_v4(), $1, $2, $stream_temperature, $stream_pressure, $stream_flow, $stream_flowtotal))
                ,
                in3 AS (INSERT INTO furnace (furnace_id, tanggal, jam, temperature_l, temperature_r, pressure_l, pressure_r) 
                VALUES (uuid_generate_v4(), $1, $2, $furnace_temperature_l, $furnace_temperature_r, $furnace_pressure_r, $furnace_pressure_l))
                ,
                in4 AS(INSERT INTO feed_pump (feedpump_id, tanggal, jam, freq1, freq2, curr1, curr2) 
                VALUES (uuid_generate_v4(), $1, $2, $pump_freq_1, $pump_freq_2, $pump_curr_1, $pump_curr_2))
                ,
                in5 AS(INSERT INTO superheater (superheater_id, tanggal, jam, temperature_l, temperature_r, pressure_l, pressure_r) 
                VALUES (uuid_generate_v4(), $1, $2, $superheater_temperature_l, $superheater_temperature_r, $superheater_pressure_r, $superheater_pressure_l))
                ,
                in6 AS(INSERT INTO idf (idf_id, tanggal, jam, freq1, freq2, curr1, curr2) 
                VALUES (uuid_generate_v4(), $1, $2, $idf_freq_1, $idf_freq_2, $idf_curr_1, $idf_curr_2))
                ,
                in7 AS(INSERT INTO air (air_id, tanggal, jam, primary_temperature, secondary_temperature, primary_pressure, secondary_pressure) 
                VALUES (uuid_generate_v4(), $1, $2, $air_primary_temperature, $air_secondary_temperature, $air_primary_pressure, $air_secondary_pressure))
                ,
                in8 AS(INSERT INTO feed_water (feedwater_id, tanggal, jam, temperature, flow, flow_total, pressure) 
                VALUES (uuid_generate_v4(), $1, $2, $water_temperature, $water_flow, $water_flowtotal, $water_pressure))
                ,
                in9 AS(INSERT INTO desuperheater (desuperheater_id, tanggal, jam, temperature, flow, flow_total) 
                VALUES (uuid_generate_v4(), $1, $2, $desuperheater_temperature, $desuperheater_flow, $desuperheater_flowtotal))
                ,
                in10 AS(INSERT INTO header (header_id, tanggal, jam, temperature, pressure) 
                VALUES (uuid_generate_v4(), $1, $2, $header_temperature, $header_pressure))
                ,
                in11 AS(INSERT INTO exhaust_gas (exhaustgas_id, tanggal, jam, temperature_l, temperature_r, pressure_l, pressure_r) 
                VALUES (uuid_generate_v4(), $1, $2, $exhaust_temperature_l, $exhaust_temperature_r, $exhaust_pressure_l, $exhaust_pressure_r))
                ,
                in12 AS(INSERT INTO scraper (scraper_id, tanggal, jam, freq, curr) 
                VALUES (uuid_generate_v4(), $1, $2, $scraper_freq,$scraper_curr))
                ,
                in13 AS(INSERT INTO soot (soot_id, tanggal, jam, temperature, pressure) 
                VALUES (uuid_generate_v4(), $1, $2, $soot_temperature, $soot_pressure))
                ,
                in14 AS(INSERT INTO fuel (fuel_id, tanggal, jam, freq1, freq2, freq3, freq4) 
                VALUES (uuid_generate_v4(), $1, $2, $fuel_freq_1, $fuel_freq_2, $fuel_freq_3, $fuel_freq_4))
                ,
                in15 AS(INSERT INTO fdf (fdf_id, tanggal, jam, outpressure, freq, curr) 
                VALUES (uuid_generate_v4(), $1, $2, $fdf_out_pressure, $fdf_freq, $fdf_curr))
                ,
                in16 AS(INSERT INTO sdf (sdf_id, tanggal, jam, outpressure, freq, curr) 
                VALUES (uuid_generate_v4(), $1, $2, $sdf_out_pressure, $sdf_freq, $sdf_curr))
                
                INSERT INTO economizer (economizer_id, tanggal, jam, intemperature_l, intemperature_r, inpressure_l, inpressure_r, outtemperature_water, intemperature_water, outtemperature_l, outtemperature_r, outpressure_l, outpressure_r) 
                SELECT uuid_generate_v4(), $1, $2, $economizer_intemperature_l, $economizer_intemperature_r, $economizer_inpressure_l, $economizer_inpressure_r, $economizer_outtemperature_water, $economizer_intemperature_water, $economizer_outtemperature_l, $economizer_outtemperature_r, $economizer_outpressure_l, $economizer_outpressure_r";
                            
            $prepare_input = pg_prepare($koneksi_boiler, "my_insert", $insert_query);
            $exec_input = pg_execute($koneksi_boiler, "my_insert", array($tanggal, $jam));
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