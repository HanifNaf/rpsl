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
         <?php 
                    $no = 1;
                    if($row_drum_level>0){ //nama variablenya disesuaikan lagi
                       for ($i = 0; $i < $row_drum_level; $i++) {
                        $array_drum_level = $drum_level_arr[$i];
                        $array_main_stream = $main_stream_arr[$i];
                        $array_furnace = $furnace_arr[$i];
                        $array_feed_pump = $feed_pump_arr[$i];
                        $array_superheater = $superheater_arr[$i];
                        $array_idf = $idf_arr[$i];
                        $array_air = $air_arr[$i];
                        $array_feed_water = $feed_water_arr[$i];
                        $array_desuperheater = $desuperheater_arr[$i];
                        $array_header = $header_arr[$i];
                        $array_exhaust_gas = $exhaust_gas_arr[$i];
                        $array_scraper = $scraper_arr[$i];
                        $array_soot = $soot_arr[$i];
                        $array_fuel = $fuel_arr[$i];
                        $array_fdf = $fdf_arr[$i];
                        $array_sdf = $sdf_arr[$i];
                        $array_economizer = $economizer_arr[$i];
                            { ?>

        <div class="row">
            <!--Nama Divisi-->
            <div class="col-md-6 col-sm-12 col">
            <h2 style="display: flex; float: left;">BOILER</h2>
            </div> 
            <!--Input Jumlah Kolom-->
        </div>
        <div class="table-responsive-sm table-responsie-md table-responsive-lg">
            <form action="" method="post">
                <table class="table table-hover table-bordered table-sm">
                        <tr>
                            <!-- Tanggal -->
                            <td class="custom-black-bg">Tanggal</td>
                            <td> <input type="date" value="<? date('Y-m-d') ?>" name="tanggal-<?=$i?>" class="form-control" width=20%> </td>
                        </tr>
                        <tr>
                            <!-- Jam -->
                            <td class="custom-black-bg">Jam</td>
                                <td><select name="jam-<?= $i ?>" class="form-control">
                                        <option value="00:00:00">00.00</option>
                                        <option value="01:00:00">01.00</option>
                                        <option value="02:00:00">02.00</option>
                                        <option value="03:00:00">03.00</option>
                                        <option value="04:00:00">04.00</option>
                                        <option value="05:00:00">05.00</option>
                                        <option value="06:00:00">06.00</option>
                                        <option value="07:00:00">07.00</option>
                                        <option value="08:00:00">08.00</option>
                                        <option value="09:00:00">09.00</option>
                                        <option value="10:00:00">10.00</option>
                                        <option value="11:00:00">11.00</option>
                                        <option value="12:00:00">12.00</option>
                                        <option value="13:00:00">13.00</option>
                                        <option value="14:00:00">14.00</option>
                                        <option value="15:00:00">15.00</option>
                                        <option value="16:00:00">16.00</option>
                                        <option value="17:00:00">17.00</option>
                                        <option value="18:00:00">18.00</option>
                                        <option value="19:00:00">19.00</option>
                                        <option value="20:00:00">20.00</option>
                                        <option value="21:00:00">21.00</option>
                                        <option value="22:00:00">22.00</option>
                                        <option value="23:00:00">23.00</option>
                                </select>
                                </td>
                        </tr>
                        <tr>
                           <!-- Pemisah -->
                           <td> </td>
                        </tr>
                        <th>DRUM LEVEL</th>f
                        <tr>
                            <!-- Level 1 -->
                            <td class="custom-black-bg" width="30%">Level 1</td>
                            <td><input type="number" name="drum-level1-<?=$i?>" value="<?= $array_drum_level['level1']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Level 2 -->
                            <td class="custom-black-bg">Level 2</td>
                            <td><input type="number" name="drum-level2-<?=$i?>" value="<?= $array_drum_level['level2']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure -->
                            <td class="custom-black-bg">Pressure</td>
                            <td><input type="number" name="drum-pressure-<?=$i?>" value="<?= $array_drum_level['pressure']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Main Stream </th>
                        <tr>    
                            <!-- Temperatur -->
                            <td class="custom-black-bg">Temperature</td>
                            <td><input type="number" step="any" name="stream-temperature-<?=$i?>" value="<?= $array_main_stream['temperature']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure -->
                            <td class="custom-black-bg">Pressure</td>
                            <td><input type="number" step="any" name="stream-pressure-<?=$i?>" value="<?= $array_main_stream['pressure']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow -->
                            <td class="custom-black-bg">Flow</td>
                            <td><input type="number" step="any" name="stream-flow-<?=$i?>" value="<?= $array_main_stream['flow']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow Total -->
                            <td class="custom-black-bg">Flow Total</td>
                            <td><input type="number" step="any" name="stream-flow-total-<?=$i?>" value="<?= $array_main_stream['flow_total']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Furnace </th>
                       <tr>    
                            <!-- Temperatur L -->
                            <td class="custom-black-bg">Temperature L</td>
                            <td><input type="number" name="furnace-temperature-l-<?=$i?>" value="<?= $array_furnace['temperature_l']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Temperatur R-->
                            <td class="custom-black-bg">Temperature R</td>
                            <td><input type="number" name="furnace-temperature-r-<?=$i?>" value="<?= $array_furnace['temperature_r']; ?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Pressure L -->
                            <td class="custom-black-bg">Pressure L</td>
                            <td><input type="number" name="furnace-pressure-l-<?=$i?>" value="<?= $array_furnace['pressure_l']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure R -->
                            <td class="custom-black-bg">Pressure R</td>
                            <td><input type="number" name="furnace-pressure-r-<?=$i?>" value="<?= $array_furnace['pressure_r']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Feed Pump </th>
                        <tr>
                            <!-- Freq 1 -->
                            <td class="custom-black-bg">Freq 1</td>
                            <td><input type="number" name="pump-freq-1-<?=$i?>" value="<?= $array_feed_pump['freq1']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq 2 -->
                            <td class="custom-black-bg">Freq 2</td>
                            <td><input type="number" name="pump-freq-2-<?=$i?>" value="<?= $array_feed_pump['freq2']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Curr 1 -->
                            <td class="custom-black-bg">Curr 1</td>
                            <td><input type="number" name="pump-curr-1-<?=$i?>" value="<?= $array_feed_pump['curr1']; ?>" style="form-control"></td>
                        </tr>
                         <tr>
                            <!-- Curr 2 -->
                            <td class="custom-black-bg">Curr 2</td>
                            <td><input type="number" name="pump-curr-2-<?=$i?>" value="<?= $array_feed_pump['curr2']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Superheater </th>
                         <tr>    
                            <!-- Temperatur L -->
                            <td class="custom-black-bg">Temperature L</td>
                            <td><input type="number" name="superheater-temperature-l-<?=$i?>" value="<?= $array_superheater['temperature_l']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Temperatur R-->
                            <td class="custom-black-bg">Temperature R</td>
                            <td><input type="number" name="superheater-temperature-r-<?=$i?>" value="<?= $array_superheater['temperature_r']; ?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Pressure L -->
                            <td class="custom-black-bg">Pressure L</td>
                            <td><input type="number" name="superheater-pressure-l-<?=$i?>" value="<?= $array_superheater['pressure_l']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure R -->
                            <td class="custom-black-bg">Pressure R</td>
                            <td><input type="number" name="superheater-pressure-r-<?=$i?>" value="<?= $array_superheater['pressure_r']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> IDF </th>
                        <tr>
                            <!-- Freq 1 -->
                            <td class="custom-black-bg">Freq 1</td>
                            <td><input type="number" name="idf-freq-1-<?=$i?>" value="<?= $array_idf['freq1']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq 2 -->
                            <td class="custom-black-bg">Freq 2</td>
                            <td><input type="number" name="idf-freq-2-<?=$i?>" value="<?= $array_idf['freq1']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Curr 1 -->
                            <td class="custom-black-bg">Curr 1</td>
                            <td><input type="number" name="idf-curr-1-<?=$i?>" value="<?= $array_idf['curr1']; ?>" style="form-control"></td>
                        </tr>
                         <tr>
                            <!-- Curr 2 -->
                            <td class="custom-black-bg">Curr 2</td>
                            <td><input type="number" name="idf-curr-2-<?=$i?>" value="<?= $array_idf['curr2']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Air </th>
                        <tr>
                            <!-- Primary Temperature -->
                            <td class="custom-black-bg"> Primary Temperature </td>
                            <td><input type="number" name="air-primary-temperature-<?=$i?>" value="<?= $array_air['primary_temperature']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Secondary Temperature -->
                            <td class="custom-black-bg"> Secondary Temperature </td>
                            <td><input type="number" name="air-secondary-temperature-<?=$i?>" value="<?= $array_air['secondary_temperature']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Primary Pressure -->
                            <td class="custom-black-bg"> Primary Pressure </td>
                            <td><input type="number" name="air-primary-pressure-<?=$i?>" value="<?= $array_air['primary_pressure']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Secondary Pressure -->
                            <td class="custom-black-bg"> Secondary Pressure </td>
                            <td><input type="number" name="air-secondary-pressure-<?=$i?>" value="<?= $array_air['secondary_pressure']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Feed Water </th>
                        <tr>    
                            <!-- Temperatur -->
                            <td class="custom-black-bg">Temperature</td>
                            <td><input type="number" name="water-temperature-<?=$i?>" value="<?= $array_feed_water['temperature']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow -->
                            <td class="custom-black-bg">Flow</td>
                            <td><input type="number" name="water-flow-<?=$i?>" value="<?= $array_feed_water['flow']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow Total -->
                            <td class="custom-black-bg">Flow Total</td>
                            <td><input type="number" name="water-flow-total-<?=$i?>" value="<?= $array_feed_water['flow_total']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure -->
                            <td class="custom-black-bg">Pressure</td>
                            <td><input type="number" name="water-pressure-<?=$i?>" value="<?= $array_feed_water['pressure']; ?>" style="form-control"></td>
                        </tr>
                         <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Desuperheater </th>
                        <tr>    
                            <!-- Temperatur -->
                            <td class="custom-black-bg">Temperature</td>
                            <td><input type="number" name="desuperheater-temperature-<?=$i?>" value="<?= $array_desuperheater['temperature']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow -->
                            <td class="custom-black-bg">Flow</td>
                            <td><input type="number" name="desuperheater-flow-<?=$i?>" value="<?= $array_desuperheater['flow']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flow Total -->
                            <td class="custom-black-bg">Flow Total</td>
                            <td><input type="number" name="desuperheater-flow-total-<?=$i?>" value="<?= $array_desuperheater['flow_total']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Header </th>
                        <tr>    
                            <!-- Temperatur -->
                            <td class="custom-black-bg">Temperature</td>
                            <td><input type="number" name="header-temperature-<?=$i?>" value="<?= $array_header['temperature']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure -->
                            <td class="custom-black-bg">Pressure</td>
                            <td><input type="number" name="header-pressure-<?=$i?>" value="<?= $array_header['pressure']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Exhaust Gas </th>
                         <tr>    
                            <!-- Temperatur L -->
                            <td class="custom-black-bg">Temperature L</td>
                            <td><input type="number" name="exhaust-temperature-l-<?=$i?>" value="<?= $array_exhaust_gas['temperature_l']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Temperatur R-->
                            <td class="custom-black-bg">Temperature R</td>
                            <td><input type="number" name="exhaust-temperature-r-<?=$i?>" value="<?= $array_exhaust_gas['temperature_r']; ?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Pressure L -->
                            <td class="custom-black-bg">Pressure L</td>
                            <td><input type="number" name="exhaust-pressure-l-<?=$i?>" value="<?= $array_exhaust_gas['pressure_l']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure R -->
                            <td class="custom-black-bg">Pressure R</td>
                            <td><input type="number" name="exhaust-pressure-r-<?=$i?>" value="<?= $array_exhaust_gas['pressure_r']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Scraper </th>
                        <tr>
                            <!-- Freq -->
                            <td class="custom-black-bg">Freq</td>
                            <td><input type="number" name="scraper-freq-<?=$i?>" value="<?= $array_scraper['freq']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Curr -->
                            <td class="custom-black-bg">Curr</td>
                            <td><input type="number" name="scraper-curr-<?=$i?>" value="<?= $array_scraper['curr']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Soot </th>
                        <tr>    
                            <!-- Temperature -->
                            <td class="custom-black-bg">Temperature</td>
                            <td><input type="number" name="soot-temperature-<?=$i?>" value="<?= $array_soot['temperature']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pressure -->
                            <td class="custom-black-bg">Pressure</td>
                            <td><input type="number" name="soot-pressure-<?=$i?>" value="<?= $array_soot['pressure']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Fuel </th>
                        <tr>
                            <!-- Freq 1 -->
                            <td class="custom-black-bg">Freq 1</td>
                            <td><input type="number" name="fuel-freq-1-<?=$i?>" value="<?= $array_fuel['freq1']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq 2 -->
                            <td class="custom-black-bg">Freq 2</td>
                            <td><input type="number" name="fuel-freq-2-<?=$i?>" value="<?= $array_fuel['freq2']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq 3 -->
                            <td class="custom-black-bg">Freq 3</td>
                            <td><input type="number" name="fuel-freq-3-<?=$i?>" value="<?= $array_fuel['freq3']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq 4 -->
                            <td class="custom-black-bg">Freq 4</td>
                            <td><input type="number" name="fuel-freq-4-<?=$i?>" value="<?= $array_fuel['freq4']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> FDF </th>
                         <tr>
                            <!-- Out Pressure -->
                            <td class="custom-black-bg">Out Pressure</td>
                            <td><input type="number" name="fdf-out-pressure-<?=$i?>" value="<?= $array_fdf['outpressure']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq -->
                            <td class="custom-black-bg">Freq</td>
                            <td><input type="number" name="fdf-freq-<?=$i?>" value="<?= $array_fdf['freq']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Curr -->
                            <td class="custom-black-bg">Curr</td>
                            <td><input type="number" name="fdf-curr-<?=$i?>" value="<?= $array_fdf['curr']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> SDF </th>
                         <tr>
                            <!-- Out Pressure -->
                            <td class="custom-black-bg">Out Pressure</td>
                            <td><input type="number" name="sdf-out-pressure-<?=$i?>" value="<?= $array_sdf['outpressure']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Freq -->
                            <td class="custom-black-bg">Freq</td>
                            <td><input type="number" name="sdf-freq-<?=$i?>" value="<?= $array_sdf['freq']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Curr -->
                            <td class="custom-black-bg">Curr</td>
                            <td><input type="number" name="sdf-curr-<?=$i?>" value="<?= $array_sdf['curr']; ?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Economizer </th>
                        <tr>    
                            <!-- In Temperatur L -->
                            <td class="custom-black-bg">In Temperature L</td>
                            <td><input type="number" name="economizer-intemperature-l-<?=$i?>" value="<?= $array_economizer['intemperature_l']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- In Temperatur R-->
                            <td class="custom-black-bg">In Temperature R</td>
                            <td><input type="number" name="economizer-intemperature-r-<?=$i?>" value="<?= $array_economizer['intemperature_r']; ?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- In Pressure L -->
                            <td class="custom-black-bg">In Pressure L</td>
                            <td><input type="number" name="economizer-inpressure-l-<?=$i?>" value="<?= $array_economizer['inpressure_l']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- In Pressure R -->
                            <td class="custom-black-bg">In Pressure R</td>
                            <td><input type="number" name="economizer-inpressure-r-<?=$i?>" value="<?= $array_economizer['inpressure_r']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Out Temperatur Water -->
                            <td class="custom-black-bg">Out Temperature Water</td>
                            <td><input type="number" name="economizer-outtemperature-water-<?=$i?>" value="<?= $array_economizer['outtemperature_water']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- In Temperatur Water -->
                            <td class="custom-black-bg">In Temperature Water</td>
                            <td><input type="number" name="economizer-intemperature-water-<?=$i?>" value="<?= $array_economizer['intemperature_water']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Out Temperatur L -->
                            <td class="custom-black-bg">Out Temperature L</td>
                            <td><input type="number" name="economizer-outtemperature-l-<?=$i?>" value="<?= $array_economizer['outtemperature_l']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Out Temperatur R-->
                            <td class="custom-black-bg">Out Temperature R</td>
                            <td><input type="number" name="economizer-outtemperature-r-<?=$i?>" value="<?= $array_economizer['outtemperature_r']; ?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Out Pressure L -->
                            <td class="custom-black-bg">Out Pressure L</td>
                            <td><input type="number" name="economizer-outpressure-l-<?=$i?>" value="<?= $array_economizer['outpressure_l']; ?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Out Pressure R -->
                            <td class="custom-black-bg">Out Pressure R</td>
                            <td><input type="number" name="economizer-outpressure-r-<?=$i?>" value="<?= $array_economizer['outpressure_r']; ?>" style="form-control"></td>
                        </tr>
                </table>
            <?php }}} ?>
                <div class="form-group text-center" style="margin-top: 10px;">
                <button type="submit" name="update" class="btn btn-primary"><i class="fas fa-save"><a href="boiler"></a></i> EDIT DATA</button>
                </div>
            </form>
        </div> 
    </div> <!--Akhir Container-->
<!-- Menambahan ke Database -->
<?php 
    if(isset($_POST['update'])){
        $total = $_POST['total'];

        //Menyimpan input dalalm variabel (Menggunakan looping)
        for($i=1; $i<=$total; $i++){
            $tanggal = $_REQUEST['tanggal-'.$i];
            $jam = $_REQUEST['jam-'.$i];
            $drum_level1 = $_REQUEST['drum-level1-'.$i];
            $drum_level2 = $_REQUEST['drum-level2-'.$i];
            $drum_pressure = $_REQUEST['drum-pressure-'.$i];
            $stream_temperature = $_REQUEST['stream-temperature-'.$i];
            $stream_pressure = $_REQUEST['stream-pressure-'.$i];
            $stream_flow = $_REQUEST['stream-flow-'.$i];
            $stream_flowtotal = $_REQUEST['stream-flow-total-'.$i];
            $furnace_temperature_l = $_REQUEST['furnace-temperature-l-'.$i];
            $furnace_temperature_r = $_REQUEST['furnace-temperature-r-'.$i];
            $furnace_pressure_l = $_REQUEST['furnace-pressure-l-'.$i];
            $furnace_pressure_r = $_REQUEST['furnace-pressure-r-'.$i];
            $pump_freq_1 = $_REQUEST['pump-freq-1-'.$i];
            $pump_freq_2 = $_REQUEST['pump-freq-2-'.$i];
            $pump_curr_1 = $_REQUEST['pump-curr-1-'.$i];
            $pump_curr_2 = $_REQUEST['pump-curr-2-'.$i];
            $superheater_temperature_l = $_REQUEST['superheater-temperature-l-'.$i];
            $superheater_temperature_r = $_REQUEST['superheater-temperature-r-'.$i];
            $superheater_pressure_l = $_REQUEST['superheater-pressure-l-'.$i];
            $superheater_pressure_r = $_REQUEST['superheater-pressure-r-'.$i];
            $idf_freq_1 = $_REQUEST['idf-freq-1-'.$i];
            $idf_freq_2 = $_REQUEST['idf-freq-2-'.$i];
            $idf_curr_1 = $_REQUEST['idf-curr-1-'.$i];
            $idf_curr_2 = $_REQUEST['idf-curr-2-'.$i];
            $air_primary_temperature = $_REQUEST['air-primary-temperature-'.$i];
            $air_secondary_temperature = $_REQUEST['air-secondary-temperature-'.$i];
            $air_primary_pressure = $_REQUEST['air-primary-pressure-'.$i];
            $air_secondary_pressure = $_REQUEST['air-secondary-pressure-'.$i];
            $water_temperature = $_REQUEST['water-temperature-'.$i];
            $water_flow = $_REQUEST['water-flow-'.$i];
            $water_flowtotal = $_REQUEST['water-flow-total-'.$i];
            $water_pressure = $_REQUEST['water-pressure-'.$i];
            $desuperheater_temperature = $_REQUEST['desuperheater-temperature-'.$i];
            $desuperheater_flow = $_REQUEST['desuperheater-flow-'.$i];
            $desuperheater_flowtotal = $_REQUEST['desuperheater-flow-total-'.$i];
            $header_temperature = $_REQUEST['header-temperature-'.$i];
            $header_pressure = $_REQUEST['header-pressure-'.$i];
            $exhaust_temperature_l = $_REQUEST['exhaust-temperature-l-'.$i];
            $exhaust_temperature_r = $_REQUEST['exhaust-temperature-r-'.$i];
            $exhaust_pressure_l = $_REQUEST['exhaust-pressure-l-'.$i];
            $exhaust_pressure_r = $_REQUEST['exhaust-pressure-r-'.$i];
            $scraper_freq = $_REQUEST['scraper-freq-'.$i];
            $scraper_curr = $_REQUEST['scraper-curr-'.$i];
            $soot_temperature = $_REQUEST['soot-temperature-'.$i];
            $soot_pressure = $_REQUEST['soot-pressure-'.$i];
            $fuel_freq_1 = $_REQUEST['fuel-freq-1-'.$i];
            $fuel_freq_2 = $_REQUEST['fuel-freq-2-'.$i];
            $fuel_freq_3 = $_REQUEST['fuel-freq-3-'.$i];
            $fuel_freq_4 = $_REQUEST['fuel-freq-4-'.$i];
            $fdf_outpressure = $_REQUEST['fdf-out-pressure-'.$i];
            $fdf_freq = $_REQUEST['fdf-freq-'.$i];
            $fdf_curr = $_REQUEST['fdf-curr-'.$i];
            $sdf_outpressure = $_REQUEST['sdf-out-pressure-'.$i];
            $sdf_freq = $_REQUEST['sdf-freq-'.$i];
            $sdf_curr = $_REQUEST['sdf-curr-'.$i];
            $economizer_intemperature_l = $_REQUEST['economizer-intemperature-l-'.$i];
            $economizer_intemperature_r = $_REQUEST['economizer-intemperature-r-'.$i];
            $economizer_inpressure_l = $_REQUEST['economizer-inpressure-l-'.$i];
            $economizer_inpressure_r = $_REQUEST['economizer-inpressure-r-'.$i];
            $economizer_outtemperature_water = $_REQUEST['economizer-outtemperature-water-'.$i];
            $economizer_intemperature_water = $_REQUEST['economizer-intemperature-water-'.$i];
            $economizer_outtemperature_l = $_REQUEST['economizer-outtemperature-l-'.$i];
            $economizer_outtemperature_r = $_REQUEST['economizer-outtemperature-r-'.$i];
            $economizer_outpressure_l = $_REQUEST['economizer-outpressure-l-'.$i];
            $economizer_outpressure_r = $_REQUEST['economizer-outpressure-r-'.$i];
                        
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
                VALUES (uuid_generate_v4(), $1, $2, $fdf_outpressure, $fdf_freq, $fdf_curr))
                ,
                in16 AS(INSERT INTO sdf (sdf_id, tanggal, jam, outpressure, freq, curr) 
                VALUES (uuid_generate_v4(), $1, $2, $sdf_outpressure, $sdf_freq, $sdf_curr))
                
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