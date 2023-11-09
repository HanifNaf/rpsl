<?php
require_once("../../config/config.php");
require_once("boiler_data.php");
require_once(SITE_ROOT."/src/header-admin.php");
require_once(SITE_ROOT."/src/footer-admin.php");
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href='../img/rpsl1.png' rel='icon' type='image/x-icon'/>
  <title>Dashboard PT RPSL</title>
  <link rel="stylesheet" href="css/style.css"> <!-- Perhatikan Directory (tambahkan ../) -->
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap.min.css.map">
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap-grid.min.css.map">
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="bootstrap4/dist/css/bootstrap-reboot.min.css.map">
<style>
	.flexible-table {
  width: 100%;
  border-collapse: collapse;
}

.flexible-table th {
  padding: 8px;
  text-align: center;
  background-color: #000; /* Warna latar belakang hitam */
  color: white; /* Warna teks putih untuk kontras */
  vertical-align: middle;
  border: 1px solid #ddd;
}
.flexible-table td {
         border-bottom: 1px solid #ddd;
}
.custom-button {
    width: 70px; /* Ganti dengan lebar yang Anda inginkan */
    height: 35px; /* Ganti dengan tinggi yang Anda inginkan */
  }
</style>
</head>


<body>
    <div class="container">	
		<form action="" method="POST">
			<h2 style="display: flex; float: left;">DATA BOILER</h2> 
			<div style="display: flex; float: right" id="pencarian1">
				<input type="text" placeholder="Cari.." name="cari" autofocus>
				<button type="submit" class="btn-sm btn-dark" style="border:none;"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" /></svg></button>
		</form>
	</div>
	<br>
	<hr>

    <!-- Menampilkan Tombol CRUD -->
    <div class="container">
		<form name="boiler_proses" method="POST">
			<div class="form-group">
                <!--Menempatkan icon cetak dan tambah-->
          <button type="button" data-toggle="tooltip" data-placement="top" title="Tambah" class="btn btn-success"><a id="log" href="boiler_input"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg></a></button>
			    <div style="display: inline; float: right;">
			    <button type="button" data-toggle="tooltip" data-placement="top" title="Cetak" class="btn btn-info"><a href="#" data-toggle="modal" data-target="#cetakperiode"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M18,3H6V7H18M19,12A1,1 0 0,1 18,11A1,1 0 0,1 19,10A1,1 0 0,1 20,11A1,1 0 0,1 19,12M16,19H8V14H16M19,8H5A3,3 0 0,0 2,11V17H6V21H18V17H22V11A3,3 0 0,0 19,8Z" /></svg></a></button>
			  </div>
			    
		  </div>
		    		<div class="table-responsive table-responsive-md table-responsive-sm table-responsive-lg">
            <!--Menampilkan tabel-->
            <table class="flexible-table">
                <!--Header Tabel berwarna gelap-->    
                <thead class="thead-dark">
                    <tr class="text-center">
						<tr>
			            <th rowspan="2">No.</th>
			            <th rowspan="2">Tanggal</th>
			            <th rowspan="2">Jam</th>
			            <th colspan="3">Drum Level</th>
			            <th colspan="3">Main Stream</th>
			            <th colspan="4">Furnace</th>
			            <th colspan="4">Feed Pump</th>
			            <th colspan="4">Superheater</th>
			            <th colspan="4">IDF</th>
			            <th colspan="4">AIR</th>
			            <th colspan="4">Feed Water</th>
			            <th colspan="3">Desuperheater</th>
			            <th colspan="2">Header</th>
			            <th colspan="4">Exhaust Gas</th>
			            <th colspan="2">Scraper</th>
			            <th colspan="2">Soot</th>
			            <th colspan="4">Fuel</th>
			            <th colspan="3">FDF</th>
			            <th colspan="3">SDF</th>
			            <th colspan="10">Economizer</th>
			            <th rowspan="2">Opsi</th>
			        	</tr>
			        	<tr>
			        		<!-- Drum Level -->
				            <th>Level 1</th>
				            <th>Level 2</th>
				            <th>Pressure</th>
				            <!-- Main Stream -->
				            <th>Temperature</th>
	                        <th>Flow</th>
	                        <th>Flow Total</th>
	                        <!-- Furnace -->
	                        <th>Temperature Left</th>
	                        <th>Temperature Right</th>
	                        <th>Pressure Left</th>
	                        <th>Pressure Right</th>
	                        <!-- Feed Pump -->
	                        <th>Freq 1</th>
	                        <th>Freq 2</th>
	                        <th>Curr 1</th>
	                        <th>Curr 2</th>
	                        <!-- Superheater` -->
	                        <th>Temperature Left</th>
	                        <th>Temperature Right</th>
	                        <th>Pressure Left</th>
	                        <th>Pressure Right</th>
	                        <!-- IDF -->
	                        <th>Freq 1</th>
	                        <th>Freq 2</th>
	                        <th>Curr 1</th>
	                        <th>Curr 2</th>
	                        <!-- AIR -->
	                        <th>Primary Temperature</th>
	                        <th>Secondary Temperature</th>
	                        <th>Primary Pressure</th>
	                        <th>Secondary Pressure</th>
	                        <!-- Feed Water -->
	                        <th>Temperature</th>
	                        <th>Flow</th>
	                        <th>Flow Total</th>
	                        <th>Pressure</th>	
	                        <!-- Desuperheater -->
	                        <th>Temperature</th>
	                        <th>Flow</th>
	                        <th>Flow Total</th>
	                        <!-- Header -->
	                        <th>Temperature</th>
	                        <th>Pressure</th>
	                        <!-- Exhaust Gas -->
	                        <th>Temperature Left</th>
	                        <th>Temperature Right</th>
	                        <th>Pressure Left</th>
	                        <th>Pressure Right</th>
	                        <!-- Scraper -->
	                        <th>Freq </th>
	                        <th>Curr </th>
	                       	<!-- Soot -->
	                       	<th>Temperature</th>
	                        <th>Pressure</th>
	                        <!-- Fuel -->
	                        <th>Freq 1</th>
	                        <th>Freq 2</th>
	                        <th>Freq 3</th>
	                        <th>Freq 4</th>
	                        <!-- FDF -->
	                        <th>Out Pressure</th>
	                        <th>Freq </th>
	                        <th>Curr</th>
	                        <!-- SDF -->
	                        <th>Out Pressure</th>
	                        <th>Freq </th>
	                        <th>Curr</th>
	                        <!-- Economizer -->
	                        <th>In Temperature (L)</th>
	                        <th>In Temperature (R)</th>
	                        <th>In Pressure (L)</th>
	                        <th>In Pressure (R)</th>
	                        <th>Out Temperature Water</th>
	                        <th>In Temperature Water</th>
	                        <th>Out Temperature (L)</th>
	                        <th>Out Temperature (R)</th>
	                        <th>Out Pressure (L)</th>
	                        <th>Out Pressure (R)</th>
			       	 	</tr>
                    </tr>

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
                        <tr class="text-center table-row-border">
								<td>
									<!--Nomor-->
									<?= $no++; ?>
								</td>
								<td>
									<!--Tanggal-->
									<?= $array_drum_level['tanggal']; ?>
								</td>
								<td>
									<!--jam-->
									<?= $array_drum_level['jam']; ?>
								</td>
								<td>
								<!--Drum Level-->
									<!-- Level 1 -->
									<?= $array_drum_level['level1']; ?>
								</td>
								<td>
									<!--Level 2-->
									<?= $array_drum_level['level2']; ?>
								</td>
								<td>
									<!--Pressure-->
									<?= $array_drum_level['pressure']; ?>	
								</td>
								<td>
								<!--Main Stream-->
									<!--Temperature-->
									<?= $array_main_stream['temperature']; ?>	
								</td>
								<td>
									<!--Flow-->
									<?= $array_main_stream['flow']; ?>	
								</td>
								<td>
									<!--Flow Total-->
									<?= $array_main_stream['flow_total']; ?>
								</td>
								<td>
								<!--Furnace-->
									<!--Temperature L-->
									<?= $array_furnace['temperature_l']; ?>
								</td>
								<td>
									<!--Temperature R-->
									<?= $array_furnace['temperature_r']; ?>
								</td>
								<td>
									<!--Pressure L-->
									<?= $array_furnace['pressure_l']; ?>
								</td>
								<td>
									<!--Pressure R-->
									<?= $array_furnace['pressure_r']; ?>
								</td>
								<td>
								<!--Feed Pump-->
									<!--Freq 1-->
									<?= $array_feed_pump['freq1']; ?>
								</td>
								<td>
									<!--Freq 2-->
									<?= $array_feed_pump['freq2']; ?>
								</td>
								<td>
									<!--Curr 1-->
									<?= $array_feed_pump['curr1']; ?>
								</td>
								<td>
									<!--Curr 2-->
									<?= $array_feed_pump['curr2']; ?>
								</td>
								<td>
								<!--Superheater-->
									<!--Temperature L-->
									<?= $array_superheater['temperature_l']; ?>
								</td>
								<td>
									<!--Temperature R-->
									<?= $array_superheater['temperature_r']; ?>
								</td>
								<td>
									<!--Pressure L-->
									<?= $array_superheater['pressure_l']; ?>
								</td>
								<td>
									<!--Pressure R-->
									<?= $array_superheater['pressure_r']; ?>
								</td>
								<td>
								<!--IDF-->
									<!--Freq 1-->
									<?= $array_idf['freq1']; ?>
								</td>
								<td>
									<!--Freq 2-->
									<?= $array_idf['freq2']; ?>
								</td>
								<td>
									<!--Curr 1-->
									<?= $array_idf['curr1']; ?>
								</td>
								<td>
									<!--Curr 2-->
									<?= $array_idf['curr2']; ?>
								</td>
								<td>
								<!--AIR-->
									<!--Primary Temperature-->
									<?= $array_air['primary_temperature']; ?>
								</td>
								<td>
									<!--Secondary Temperature-->
									<?= $array_air['secondary_temperature']; ?>
								</td>
								<td>
									<!--Primary Pressure-->
									<?= $array_air['primary_pressure']; ?>
								</td>
								<td>
									<!--Pressure R-->
									<?= $array_air['secondary_pressure']; ?>
								</td>
								<td>
								<!--Feed Water-->
									<!--Temperature-->
									<?= $array_feed_water['temperature']; ?>
								</td>
								<td>
									<!--Flow-->
									<?= $array_feed_water['flow']; ?>
								</td>
								<td>
									<!--Flow Total-->
									<?= $array_feed_water['flow_total']; ?>
								</td>
								<td>
									<!--Pressure-->
									<?= $array_feed_water['pressure']; ?>
								</td>
								<td>
								<!--Desuperheater-->
									<!--Temperature-->
									<?= $array_desuperheater['temperature']; ?>
								</td>
								<td>
									<!--Flow-->
									<?= $array_desuperheater['flow']; ?>
								</td>
								<td>
									<!--Flow Total-->
									<?= $array_desuperheater['flow_total']; ?>
								</td>
								<td>
								<!--Header-->
									<!--Temperature-->
									<?= $array_header['temperature']; ?>
								</td>
								<td>
									<!--Pressure-->
									<?= $array_header['pressure']; ?>
								</td>
								<td>
								<!--Exhaust Gas-->
									<!--Temperature L-->
									<?= $array_exhaust_gas['temperature_l']; ?>
								</td>
								<td>
									<!--Temperature R-->
									<?= $array_exhaust_gas['temperature_r']; ?>
								</td>
								<td>
									<!--Pressure L-->
									<?= $array_exhaust_gas['pressure_l']; ?>
								</td>
								<td>
									<!--Pressure R-->
									<?= $array_exhaust_gas['pressure_r']; ?>
								</td>
								<td>
								<!--Scraper-->
									<!--Freq-->
									<?= $array_scraper['freq']; ?>
								</td>
								<td>
									<!--Curr-->
									<?= $array_scraper['curr']; ?>
								</td>
								<td>
								<!--Soot-->
									<!--Temperature-->
									<?= $array_soot['temperature']; ?>
								</td>
								<td>
									<!--Pressure-->
									<?= $array_soot['pressure']; ?>
								</td>
								<td>
								<!--Fuel-->
									<!--Freq 1-->
									<?= $array_fuel['freq1']; ?>
								</td>
								<td>
									<!--Freq 2-->
									<?= $array_fuel['freq2']; ?>
								</td>
								<td>
									<!--Freq 3-->
									<?= $array_fuel['freq3']; ?>
								</td>
								<td>
									<!--Freq 4-->
									<?= $array_fuel['freq4']; ?>
								</td>
								<td>
								<!--FDF-->
									<!--Out Pressure-->
									<?= $array_fdf['outpressure']; ?>
								</td>
								<td>
									<!--Freq-->
									<?= $array_fdf['freq']; ?>
								</td>
								<td>
									<!--Curr-->
									<?= $array_fdf['curr']; ?>
								</td>
								<td>
								<!--SDF-->
									<!--Out Pressure-->
									<?= $array_sdf['outpressure']; ?>
								</td>
								<td>
									<!--Freq-->
									<?= $array_sdf['freq']; ?>
								</td>
								<td>
									<!--Curr-->
									<?= $array_sdf['curr']; ?>
								<td>
								<!--Economizer-->
									<!--In Temperature L-->
									<?= $array_economizer['intemperature_l']; ?>
								</td>
								<td>
									<!--In Temperature R-->
									<?= $array_economizer['intemperature_r']; ?>
								</td>
								<td>
									<!--Out Temperature R-->
									<?= $array_economizer['outtemperature_r']; ?>
								</td>
								<td>
									<!--Out Temperature R-->
									<?= $array_economizer['outtemperature_r']; ?>
								</td>
								<td>
									<!--In Pressure L-->
									<?= $array_economizer['inpressure_l']; ?>
								</td>
								<td>
									<!--In Pressure R-->
									<?= $array_economizer['inpressure_r']; ?>
								</td>
								<td>
									<!--Out Pressure L-->
									<?= $array_economizer['outpressure_l']; ?>
								</td>
								<td>
									<!--Out Pressure L-->
									<?= $array_economizer['outpressure_l']; ?>
								</td>
								<td>
									<!--In Temperature Water-->
									<?= $array_economizer['intemperature_water']; ?>
								</td>
								<td>
									<!--Out Temperature Water-->
									<?= $array_economizer['outtemperature_water']; ?>
								</td>
								<td>
									<a href="operasional_edit"><button class="btn btn-warning custom-button my-2" type="button" title="Edit">Edit</button></a>
            			<a href="operasional_delete"><button class="btn btn-danger custom-button" type="button" title="Hapus">Hapus</button></a>
								</td> 
                    <?php }}} else{
                        echo "<tr><td colspan=\"10\" align=\"center\"><b style='font-size:18px;'>DATA TIDAK DAPAT DITEMUKAN!</b></td></tr>";
                    } ?>
            </table>
</div>


</body>