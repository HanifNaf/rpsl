<?php
require_once ("../../config/config.php");
require_once ("turbin_data.php");
require_once (SITE_ROOT. "/src/header-admin.php");
require_once (SITE_ROOT. "/src/footer-admin.php");
?>

<head>
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
			<h2 style="display: flex; float: left;">DATA TURBIN</h2> 
			<div style="display: flex; float: right" id="pencarian1">
				<input type="text" placeholder="Cari.." name="cari" autofocus>
				<button type="submit" class="btn-sm btn-dark" style="border:none;"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" /></svg></button>
		</form>
	</div>
	<br>
	<hr>

    <!-- Menampilkan Tombol CRUD -->
    <div class="container">
		<form name="produksi_proses" method="POST">
			<div class="form-group">
                <!--Menempatkan icon cetak dan tambah-->
          <button type="button" data-toggle="tooltip" data-placement="top" title="Tambah" class="btn btn-success"><a id="log" href="turbin_input"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg></a></button>
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
				            <th colspan="8">Turbin</th>
				            <th colspan="4">Vibration</th>
				            <th colspan="5">Steam</th>
				            <th colspan="13">Bearing</th>
				            <th colspan="4">Casing</th>
				            <th colspan="14">Generator</th>
				            <th colspan="6">Condensor Temperature</th>
				            <th colspan="8">Oil Cooler Temperature</th>
				            <th colspan="10">Thrust Pad</th>
				            <th rowspan="2">Opsi</th>
			        	</tr>
			        	<tr>
			        		<!-- Turbin -->
				            <th>Axial Disp.(ZE5140)</th>
				            <th>Heat Exp.(ZT5240)</th>
				            <th>Stroke Position (ZS6200)</th>
				            <th>Oil Tank Level (LI6105)</th>
	                        <th>Safety Oil Pressure (SAFETY_O)</th>
	                        <th>Lube Oil Pressure (SAFETY_O)</th>
	                        <th>Speed (SE5102)</th>
	                        <th>Vacuum </th>
	                        <!-- Vibration -->
	                        <th>Bearing 1 (VE5190)</th>
	                        <th>Bearing 2 (VE5191)</th>
	                        <th>Bearing 3 (VE5192)</th>
	                        <th>Bearing 4 (VE5193)</th>
	                        <!-- Steam -->
	                        <th>Pressure (Boiler 1)</th>
	                        <th>Before MSV Temperature (TE2100)</th>
	                        <th>After 1st Stage Temperature (TE2120)</th>
	                        <th>After MSV Temperature (TE2123)</th>
	                        <th>Exhaust Chamber Temperature (TIE2140)</th>
	                        <!-- Bearing -->
	                        <th>Temperature 1 A (TE4201A)</th>
	                        <th>Temperature 1 B (TE4201B)</th>
	                        <th>Temperature 2 A (TE4203A)</th>
	                        <th>Temperature 2 B (TE4203B)</th>
	                        <th>Temperature 3 A (TE4204A)</th>
	                        <th>Temperature 3 B (TE4204B)</th>
	                        <th>Temperature 4 (TE4205)</th>
	                        <th>Return Oil Temperature 1 (TIE4101)</th>
	                        <th>Return Oil Temperature 2 (TIE4102)</th>
	                        <th>Return Oil Temperature 3 (TIE4103)</th>
	                        <th>Return Oil Temperature 4 (TIE4104)</th>
	                        <th>Thrust Pad A (TIE4100A)</th>
	                        <th>Thrust Pad B (TIE4100B)</th>
	                        <!-- Casing -->
	                        <th>Upper Temperature (TE2110)</th>
	                        <th>Lower Temperature (TE2111)</th>
	                        <th>Flange Temperature A (TE2121A)</th>
	                        <th>Flange Temperature B (TE2121B)</th>
	                        <!-- Generator -->
	                        <th>Outlet Air Temperature</th>
	                        <th>Inlet Air Temperature</th>
	                        <th>Stator Coil Temperature 1 (T1_GEN)</th>
	                        <th>Stator Coil Temperature 2 (T2_GEN)</th>
	                        <th>Stator Coil Temperature 3 (T3_GEN)</th>
	                        <th>Stator Coil Temperature 4 (T4_GEN)</th>
	                        <th>Stator Coil Temperature 5 (T5_GEN)</th>
	                        <th>Stator Coil Temperature 6 (T6_GEN)</th>
	                        <th>Stator Core Temperature 7 (T7_GEN)</th>
	                        <th>Stator Core Temperature 8 (T8_GEN)</th>
	                        <th>Stator Core Temperature 9 (T9_GEN)</th>
	                        <th>Stator Core Temperature 10 (T10_GEN)</th>
	                        <th>Stator Core Temperature 11 (T11_GEN)</th>
	                        <th>Stator Core Temperature 12 (T12_GEN)</th>
	                        <!-- Condensor Temperature -->
	                        <th>Inlet Stream (TE2201)</th>
	                        <th>Cond (TE2202)</th>
	                        <th>Cooling Inlet A (TE2203A)</th>
	                        <th>Cooling Inlet B (TE2203B)</th>
	                        <th>Cooling Outlet A (TE2204A)</th>
	                        <th>Cooling Outlet B (TE2204B)</th>
	                        <!-- Oil Cooler Temperature -->
	                        <th>Cooling Inlet A (TIE2260A)</th>
	                        <th>Cooling Inlet B (TIE2260B)</th>
	                        <th>Cooling Outlet A (TIE2261A)</th>
	                        <th>Cooling Outlet B (TIE2261B)</th>
	                        <th>Oil Inlet A (TIE4110A)</th>
	                        <th>Oil Inlet B (TIE4110B)</th>
	                        <th>Oil Outlet A (TIE4111A)</th>
	                        <th>Oil Outlet B (TIE4111B)</th>
	                        <!-- Thrust Pad -->
	                        <th>Pad A (TIE4100A)</th>
	                        <th>Pad B (TIE4100B)</th>
	                        <th>Pad C (TIE4100C)</th>
	                        <th>Pad D (TIE4100D)</th>
	                        <th>Pad E (TIE4100E)</th>
	                        <th>Pad F (TIE4100F)</th>
	                        <th>Pad G (TIE4100G)</th>
	                        <th>Pad H (TIE4100H)</th>
	                        <th>Pad I (TIE4100I)</th>
	                        <th>Pad J (TIE4100J)</th>
			       	 	</tr>
                    </tr>

                   <?php 
                    $no = 1;
                    if($row_turbin>0){ //nama variablenya disesuaikan lagi
                       for ($i = 0; $i < $row_casing; $i++) {
                       		$array_turbin = $turbin_arr[$i];
                       		$array_vibration = $vibration_arr[$i];
                       		$array_steam = $steam_arr[$i];
                       		$array_bearing = $bearing_arr[$i];
                       		$array_casing = $casing_arr[$i];
                       		$array_generator = $generator_arr[$i];
                       		$array_condensor = $condensor_temperature_arr[$i];
                       		$array_oil = $oil_cooler_temperature_arr[$i];
                       		$array_thrust = $thrust_pad_arr[$i];
						
                        	{ ?>
                        <tr class="text-center table-row-border">
								<td>
									<!--Nomor-->
									<?= $no++; ?>
								</td>
								<td>
									<!--Tanggal-->
									<?= $array_turbin['tanggal']; ?>
								</td>
								<td>
									<!--jam-->
									<?= $array_turbin['jam']; ?>
								</td>
								<td>
								<!--Turbin-->
									<!-- Axial Disp -->
									<?= $array_turbin['axial_disp']; ?>
								</td>
								<td>
									<!--Heat Exp-->
									<?= $array_turbin['heat_exp']; ?>
								</td>
								<td>
									<!--Stroke Position-->
									<?= $array_turbin['stroke_position']; ?>	
								</td>
								<td>
									<!--Oil Tank Level-->
									<?= $array_turbin['oil_tank_level']; ?>	
								</td>
								<td>
									<!--Safety Oil Pressure-->
									<?= $array_turbin['safety_oil_pressure']; ?>	
								</td>
								<td>
									<!--Lube Oil Pressure-->
									<?= $array_turbin['lube_oil_pressure']; ?>	
								</td>
								<td>
									<!--Speed-->
									<?= $array_turbin['speed']; ?>	
								</td>
								<td>
									<!--Vacuum-->
									<?= $array_turbin['vacuum']; ?>	
								</td>
								<td>
								<!--Vibration-->
									<!--Bearing 1-->
									<?= $array_vibration['bearing1']; ?>	
								</td>
								<td>
									<!--Bearing 2-->
									<?= $array_vibration['bearing2']; ?>	
								</td>
								<td>
									<!--Bearing 3-->
									<?= $array_vibration['bearing3']; ?>	
								</td>
								<td>
									<!--Bearing 4-->
									<?= $array_vibration['bearing4']; ?>	
								</td>
								<td>
								<!--Steam-->
									<!--Pressure-->
									<?= $array_steam['pressure']; ?>
								</td>
								<td>
									<!--Before MSV Temp-->
									<?= $array_steam['before_msv_temp']; ?>
								</td>
								<td>
									<!--After Stage 1 Temp-->
									<?= $array_steam['after_stage_1_temp']; ?>
								</td>
								<td>
									<!--After MSV Temp-->
									<?= $array_steam['after_msv_temp']; ?>
								</td>
								<td>
									<!--Exhaust Chamber Temp-->
									<?= $array_steam['exhaust_chamber_temp']; ?>
								</td>
								<td>
								<!--Bearing-->
									<!--Temperature 1 A-->
									<?= $array_bearing['temperature_1a']; ?>
								</td>
								<td>
									<!--Temperature 1 B-->
									<?= $array_bearing['temperature_1b']; ?>
								</td>
								<td>
									<!--Temperature 2 A-->
									<?= $array_bearing['temperature_2a']; ?>
								</td>
								<td>
									<!--Temperature 2 B-->
									<?= $array_bearing['temperature_2b']; ?>
								</td>
								<td>
									<!--Temperature 3 A-->
									<?= $array_bearing['temperature_3a']; ?>
								</td>
								<td>
									<!--Temperature 3 B-->
									<?= $array_bearing['temperature_3b']; ?>
								</td>
								<td>
									<!--Temperature 4 -->
									<?= $array_bearing['temperature_4']; ?>
								</td>
								<td>
									<!--Return Oil Temperature 1 -->
									<?= $array_bearing['return_oil_temp_1']; ?>
								</td>
								<td>
									<!--Return Oil Temperature 2 -->
									<?= $array_bearing['return_oil_temp_2']; ?>
								</td>
								<td>
									<!--Return Oil Temperature 3 -->
									<?= $array_bearing['return_oil_temp_3']; ?>
								</td>
								<td>
									<!--Return Oil Temperature 4 -->
									<?= $array_bearing['return_oil_temp_4']; ?>
								</td>
								<td>
									<!--Thrust Pad A -->
									<?= $array_bearing['thrust_pad_a']; ?>
								</td>
								<td>
									<!--Thrust Pad B-->
									<?= $array_bearing['thrust_pad_b']; ?>
								</td>
								<td>
								<!--Casing-->
									<!--Upper Temperature-->
									<?= $array_casing['upper_temp']; ?>
								</td>
								<td>
									<!--Lower Temperature-->
									<?= $array_casing['lower_temp']; ?>
								</td>
								<td>
									<!--Flange Temperature A-->
									<?= $array_casing['flange_temp_a']; ?>
								</td>
								<td>
									<!--Flange Temperature B-->
									<?= $array_casing['flange_temp_b']; ?>
								</td>
								<td>
								<!--Generator-->
									<!--Outlet Air-->
									<?= $array_generator['outlet_air']; ?>
								</td>
								<td>
									<!--Inlet Air-->
									<?= $array_generator['inlet_air']; ?>
								</td>
								<td>
									<!--Stator Coil Temperature 1-->
									<?= $array_generator['stator_coil_temp_1']; ?>
								</td>
								<td>
									<!--Stator Coil Temperature 2-->
									<?= $array_generator['stator_coil_temp_2']; ?>
								</td>
								<td>
									<!--Stator Coil Temperature 3-->
									<?= $array_generator['stator_coil_temp_3']; ?>
								</td>
								<td>
									<!--Stator Coil Temperature 4-->
									<?= $array_generator['stator_coil_temp_4']; ?>
								</td>
								<td>
									<!--Stator Coil Temperature 5-->
									<?= $array_generator['stator_coil_temp_5']; ?>
								</td>
								<td>
									<!--Stator Coil Temperature 6-->
									<?= $array_generator['stator_coil_temp_6']; ?>
								</td>
								<td>
									<!--Stator Core Temperature 7-->
									<?= $array_generator['stator_core_temp_7']; ?>
								</td>
								<td>
									<!--Stator Core Temperature 8-->
									<?= $array_generator['stator_core_temp_8']; ?>
								</td>
								<td>
									<!--Stator Core Temperature 9-->
									<?= $array_generator['stator_core_temp_9']; ?>
								</td>
								<td>
									<!--Stator Core Temperature 10-->
									<?= $array_generator['stator_core_temp_10']; ?>
								</td>
								<td>
									<!--Stator Core Temperature 11-->
									<?= $array_generator['stator_core_temp_11']; ?>
								</td>
								<td>
									<!--Stator Core Temperature 12-->
									<?= $array_generator['stator_core_temp_12']; ?>
								</td>
								<td>
								<!--Condensor Temperature-->
									<!--Inlet Steam-->
									<?= $array_condensor['inlet_steam']; ?>
								</td>
								<td>
									<!--Cond-->
									<?= $array_condensor['cond']; ?>
								</td>
								<td>
									<!--Cooling Inlet A-->
									<?= $array_condensor['cooling_inlet_a']; ?>
								</td>
								<td>
									<!--Cooling Inlet B-->
									<?= $array_condensor['cooling_inlet_b']; ?>
								</td>
								<td>
									<!--Cooling Outlet A-->
									<?= $array_condensor['cooling_outlet_a']; ?>
								</td>
								<td>
									<!--Cooling Outlet B-->
									<?= $array_condensor['cooling_outlet_b']; ?>
								</td>
								<td>
								<!--Oil Cooler Temperature -->
									<!--Cooling Inlet A-->
									<?= $array_oil['cooling_inlet_a']; ?>
								</td>
								<td>
									<!--Cooling Inlet B-->
									<?= $array_oil['cooling_inlet_b']; ?>
								</td>
								<td>
									<!--Cooling Outlet A-->
									<?= $array_oil['cooling_outlet_a']; ?>
								</td>
								<td>
									<!--Cooling Outlet B-->
									<?= $array_oil['cooling_outlet_b']; ?>
								</td>
								<td>
									<!--Oil Inlet A-->
									<?= $array_oil['oil_inlet_a']; ?>
								</td>
								<td>
									<!--Oil Inlet B-->
									<?= $array_oil['oil_inlet_b']; ?>
								</td>
								<td>
									<!--Oil Outlet A-->
									<?= $array_oil['oil_outlet_a']; ?>
								</td>
								<td>
									<!--Oil Outlet B-->
									<?= $array_oil['oil_outlet_b']; ?>
								</td>
								<td>
								<!--Thrust Pad-->
									<!--Pad A-->
									<?= $array_thrust['pad_a']; ?>
								</td>
								<td>
									<!--Pad B-->
									<?= $array_thrust['pad_b']; ?>
								</td>
								<td>
									<!--Pad C-->
									<?= $array_thrust['pad_c']; ?>
								</td>
								<td>
									<!--Pad D-->
									<?= $array_thrust['pad_d']; ?>
								</td>
								<td>
									<!--Pad E-->
									<?= $array_thrust['pad_e']; ?>
								</td>
								<td>
									<!--Pad F-->
									<?= $array_thrust['pad_f']; ?>
								</td>
								<td>
									<!--Pad G-->
									<?= $array_thrust['pad_g']; ?>
								</td>
								<td>
									<!--Pad H-->
									<?= $array_thrust['pad_h']; ?>
								</td>
								<td>
									<!--Pad I-->
									<?= $array_thrust['pad_i']; ?>
								</td>
								<td>
									<!--Pad J-->
									<?= $array_thrust['pad_j']; ?>
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