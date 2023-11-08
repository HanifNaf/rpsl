<?php 
require ("../header-admin.php");
require_once ("../../koneksi.php");
?>

<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href='../../img/rpsl1.png' rel='icon' type='image/x-icon'/>
  <title>Input Data Boiler PT. Rezeki Perkasa Sejahera Lestari</title>
  <link rel="stylesheet" href="../../css/style.css"> <!-- Perhatikan Directory (tambahkan ../) -->
  <link rel="stylesheet" href="../../bootstrap4/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../bootstrap4/dist/css/bootstrap.min.css.map">
  <link rel="stylesheet" href="../../bootstrap4/dist/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="../../bootstrap4/dist/css/bootstrap-grid.min.css.map">
  <link rel="stylesheet" href="../../bootstrap4/dist/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="../../bootstrap4/dist/css/bootstrap-reboot.min.css.map">
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
        <script src="../../js/sweetalert2.all.min.js"></script>

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
		    <h2 style="display: flex; float: left;">TURBIN</h2>
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
                        <th>Turbin</th>
                        <tr>
                            <!-- Axial Disp -->
                            <td class="custom-black-bg" width="30%">Axial Disp (ZE5140)</td>
                            <td><input type="number" name="axial_disp-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Heat Exp -->
                            <td class="custom-black-bg" width="30%">Heat Exp (ZT5240)</td>
                            <td><input type="number" name="heat_exp-<?=$i?>" style="form-control"></td>
                        </tr>
                         <tr>
                            <!-- Stroke Position -->
                            <td class="custom-black-bg" width="30%">Stroke Position (ZS6200)</td>
                            <td><input type="number" name="stroke_position-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Oil Tank Level -->
                            <td class="custom-black-bg" width="30%">Oil Tank Level (LI6105)</td>
                            <td><input type="number" name="oil_tank_level-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Safety Oil Pressure -->
                            <td class="custom-black-bg" width="30%">Safety Oil Pressure (SAFETY_O)</td>
                            <td><input type="number" name="safety_oil_pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Lube Oil Pressure -->
                            <td class="custom-black-bg" width="30%">Lube Oil Pressure (SAFETY_O)</td>
                            <td><input type="number" name="lube_oil_pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Speed -->
                            <td class="custom-black-bg" width="30%">Speed (SE5102)</td>
                            <td><input type="number" name="speed-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th>Vibration</th>
                        <tr>
                            <!-- Bearing 1 -->
                            <td class="custom-black-bg" width="30%">Bearing 1 (VE5190)</td>
                            <td><input type="number" name="bearing1-<?=$i?>" style="form-control"></td>
                        </tr>
                         <tr>
                            <!-- Bearing 2 -->
                            <td class="custom-black-bg" width="30%">Bearing 2 (VE5191)</td>
                            <td><input type="number" name="bearing2-<?=$i?>" style="form-control"></td>
                        </tr>
                         <tr>
                            <!-- Bearing 3 -->
                            <td class="custom-black-bg" width="30%">Bearing 3 (VE5192)</td>
                            <td><input type="number" name="bearing3-<?=$i?>" style="form-control"></td>
                        </tr>
                         <tr>
                            <!-- Bearing 4 -->
                            <td class="custom-black-bg" width="30%">Bearing 4 (VE5193)</td>
                            <td><input type="number" name="bearing4-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Steam </th>
                         <tr>    
                            <!-- Pressure Boiler 1 -->
                            <td class="custom-black-bg">Pressure (Boiler 1)</td>
                            <td><input type="number" name="pressure-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Before MSV Temperature -->
                            <td class="custom-black-bg">Before MSV Temperature (TE2100)</td>
                            <td><input type="number" name="before_msv_temp-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- After 1st Stage Temperature -->
                            <td class="custom-black-bg">After 1st Stage Temperature (TE2120)</td>
                            <td><input type="number" name="after_1st_temp-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- After MSV Temperature -->
                            <td class="custom-black-bg">After MSV Temperature (TE2123)</td>
                            <td><input type="number" name="after_msv_temp-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Exhaust Chamber Temperature -->
                            <td class="custom-black-bg">Exhaust Chamber Temperature (TIE2140)</td>
                            <td><input type="number" name="exhaust_chamber_temp-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Bearing </th>
                       <tr>    
                            <!-- Temperatur 1 A -->
                            <td class="custom-black-bg">Temperature 1 A (TE201A)</td>
                            <td><input type="number" name="temperature_1a-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Temperatur 1 B -->
                            <td class="custom-black-bg">Temperature 1 B (TE201B)</td>
                            <td><input type="number" name="temperature_1b-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Temperatur 2 A -->
                            <td class="custom-black-bg">Temperature 2 A (TE4203A)</td>
                            <td><input type="number" name="temperature_2a-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Temperatur 2 B -->
                            <td class="custom-black-bg">Temperature 2 B (TE4203B)</td>
                            <td><input type="number" name="temperature_2b-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Temperature 3 A -->
                            <td class="custom-black-bg">Temperature 3 A (TE4204A)</td>
                            <td><input type="number" name="temperature_3a-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Temperatur 3 B -->
                            <td class="custom-black-bg">Temperature 3 B (TE4204B)</td>
                            <td><input type="number" name="temperature_3b-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Temperatur 4 -->
                            <td class="custom-black-bg">Temperature 4 (TE4205)</td>
                            <td><input type="number" name="temperature_4-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Return Oil Temperature 1 -->
                            <td class="custom-black-bg">Return Oil Temperature 1 (TIE4101)</td>
                            <td><input type="number" name="return_oil_temp_1-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Return Oil Temperature 2 -->
                            <td class="custom-black-bg">Return Oil Temperature 2 (TIE4102)</td>
                            <td><input type="number" name="return_oil_temp_2-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Return Oil Temperature 3 -->
                            <td class="custom-black-bg">Return Oil Temperature 3 (TIE4103)</td>
                            <td><input type="number" name="return_oil_temp_3-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Return Oil Temperature 4 -->
                            <td class="custom-black-bg">Return Oil Temperature 4 (TIE4104)</td>
                            <td><input type="number" name="return_oil_temp_4-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Thrust Pad A -->
                            <td class="custom-black-bg">Thrust Pad A (TIE4100A)</td>
                            <td><input type="number" name="thrust_pad_a-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Thrust Pad B -->
                            <td class="custom-black-bg">Thrust Pad B (TIE4100B)</td>
                            <td><input type="number" name="thrust_pad_b-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Casing </th>
                        <tr>
                            <!-- Upper Temperature -->
                            <td class="custom-black-bg">Upper Temperature (TE2110)</td>
                            <td><input type="number" name="upper_temp-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Lower Temperature -->
                            <td class="custom-black-bg">Lower Temperature (TE2111)</td>
                            <td><input type="number" name="lower_temp-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flange Temperature A -->
                            <td class="custom-black-bg">flange Temperature A (TE2121A)</td>
                            <td><input type="number" name="flange_temp_a-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Flange Temperature B -->
                            <td class="custom-black-bg">flange Temperature B (TE2121B)</td>
                            <td><input type="number" name="flange_temp_b-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Generator </th>
                        <tr>    
                            <!-- Outlet Air Temperature -->
                            <td class="custom-black-bg">Outlet Air Temperature</td>
                            <td><input type="number" name="outlet_air-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Inlet Air Temperature -->
                            <td class="custom-black-bg">Inlet Air Temperature</td>
                            <td><input type="number" name="inlet_air-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Stator Coil Temperature-->
                            <td class="custom-black-bg">Stator Coil Temperature 1 (T1_GEN) </td>
                            <td><input type="number" name="stator_coil_temp_1-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Stator Coil Temperature-->
                            <td class="custom-black-bg">Stator Coil Temperature 2 (T2_GEN) </td>
                            <td><input type="number" name="stator_coil_temp_2-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Stator Coil Temperature-->
                            <td class="custom-black-bg">Stator Coil Temperature 3 (T3_GEN) </td>
                            <td><input type="number" name="stator_coil_temp_3-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Stator Coil Temperature-->
                            <td class="custom-black-bg">Stator Coil Temperature 4 (T4_GEN) </td>
                            <td><input type="number" name="stator_coil_temp_4-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Stator Coil Temperature-->
                            <td class="custom-black-bg">Stator Coil Temperature 5 (T5_GEN) </td>
                            <td><input type="number" name="stator_coil_temp_5-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Stator Coil Temperature-->
                            <td class="custom-black-bg">Stator Coil Temperature 6 (T6_GEN) </td>
                            <td><input type="number" name="stator_coil_temp_6-<?=$i?>" style="form-control"></td>
                        </tr>
                       <tr>    
                            <!-- Stator Core Temperature-->
                            <td class="custom-black-bg">Stator Core Temperature 7 (T7_GEN) </td>
                            <td><input type="number" name="stator_coil_temp_7-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Stator Core Temperature-->
                            <td class="custom-black-bg">Stator Core Temperature 8 (T8_GEN) </td>
                            <td><input type="number" name="stator_coil_temp_8-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Stator Core Temperature-->
                            <td class="custom-black-bg">Stator Core Temperature 9 (T9_GEN) </td>
                            <td><input type="number" name="stator_coil_temp_9-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Stator Core Temperature-->
                            <td class="custom-black-bg">Stator Core Temperature 10 (T10_GEN) </td>
                            <td><input type="number" name="stator_coil_temp_10-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Stator Core Temperature-->
                            <td class="custom-black-bg">Stator Core Temperature 11 (T11_GEN) </td>
                            <td><input type="number" name="stator_coil_temp_11-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Stator Core Temperature-->
                            <td class="custom-black-bg">Stator Core Temperature 12 (T12_GEN) </td>
                            <td><input type="number" name="stator_coil_temp_12-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Condensor Temperature </th>
                        <tr>
                            <!-- Inlet Steam -->
                            <td class="custom-black-bg">Inlet Steam (TE2201)</td>
                            <td><input type="number" name="inlet_steam-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Cond -->
                            <td class="custom-black-bg">Cond (TE2202)</td>
                            <td><input type="number" name="cond-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Cooling Inlet A -->
                            <td class="custom-black-bg">Cooling Inlet A (TE2203A)</td>
                            <td><input type="number" name="cooling_inlet_a-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Cooling Inlet B -->
                            <td class="custom-black-bg">Cooling Inlet B (TE2203B)</td>
                            <td><input type="number" name="cooling_inlet_b-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Cooling Outlet A -->
                            <td class="custom-black-bg">Cooling Outlet A (TE2204A)</td>
                            <td><input type="number" name="cooling_outlet_a-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Cooling Outlet B -->
                            <td class="custom-black-bg">Cooling Outlet B (TE2204B)</td>
                            <td><input type="number" name="cooling_outlet_b-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Oil Cooler Temperature </th>
                         <tr>
                            <!-- Cooling Inlet A -->
                            <td class="custom-black-bg">Cooling Inlet A (TIE2260A)</td>
                            <td><input type="number" name="cooling_inlet_a-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Cooling Inlet B -->
                            <td class="custom-black-bg">Cooling Inlet B (TE2260B)</td>
                            <td><input type="number" name="cooling_inlet_b-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Cooling Outlet A -->
                            <td class="custom-black-bg">Cooling Outlet A (TE2261A)</td>
                            <td><input type="number" name="cooling_outlet_a-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Cooling Outlet B -->
                            <td class="custom-black-bg">Cooling Outlet B (TE2261B)</td>
                            <td><input type="number" name="cooling_outlet_b-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Oil Inlet A -->
                            <td class="custom-black-bg">Oil Inlet A (TIE4110A)</td>
                            <td><input type="number" name="oil_inlet_a-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Oil Inlet B -->
                            <td class="custom-black-bg">Oil Inlet B (TIE4110B)</td>
                            <td><input type="number" name="oil_inlet_b-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Oil Outlet A -->
                            <td class="custom-black-bg">Oil Outlet A (TIE4111A)</td>
                            <td><input type="number" name="oil_outlet_a-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Oil Outlet B -->
                            <td class="custom-black-bg">Oil Outlet B (TIE4111B)</td>
                            <td><input type="number" name="oil_outlet_B-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>
                            <!-- Pemisah -->
                            <td> </td>
                        </tr>
                        <th> Thrust Pad </th>
                        <tr>    
                            <!-- Pad A -->
                            <td class="custom-black-bg">Pad A (TIE4100A)</td>
                            <td><input type="number" name="pad_a-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pad B -->
                            <td class="custom-black-bg">Pad B (TIE4100B)</td>
                            <td><input type="number" name="pad_b-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pad C -->
                            <td class="custom-black-bg">Pad C (TIE4100C)</td>
                            <td><input type="number" name="pad_c-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pad D -->
                            <td class="custom-black-bg">Pad D (TIE4100D)</td>
                            <td><input type="number" name="pad_d-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pad E -->
                            <td class="custom-black-bg">Pad E (TIE4100E)</td>
                            <td><input type="number" name="pad_e-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pad F -->
                            <td class="custom-black-bg">Pad F (TIE4100F)</td>
                            <td><input type="number" name="pad_f-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pad G -->
                            <td class="custom-black-bg">Pad G (TIE4100G)</td>
                            <td><input type="number" name="pad_g-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pad H -->
                            <td class="custom-black-bg">Pad H (TIE4100H)</td>
                            <td><input type="number" name="pad_h-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pad I -->
                            <td class="custom-black-bg">Pad I (TIE4100I)</td>
                            <td><input type="number" name="pad_i-<?=$i?>" style="form-control"></td>
                        </tr>
                        <tr>    
                            <!-- Pad J -->
                            <td class="custom-black-bg">Pad J (TIE4100A)</td>
                            <td><input type="number" name="pad_j-<?=$i?>" style="form-control"></td>
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
            $turbin_axial = $_REQUEST['axial_disp-'.$i];
            $turbin_heat = $_REQUEST['heat_exp-'.$i];
            $turbin_stroke = $_REQUEST['stroke_position-'.$i];
            $turbin_tank = $_REQUEST['oil_tank_level-'.$i];
            $turbin_safety = $_REQUEST['safety_oil_pressure-'.$i];
            $turbin_lube = $_REQUEST['lube_oil_pressure-'.$i];
            $turbin_speed = $_REQUEST['speed-'.$i];
            $turbin_vacuum = $_REQUEST['vacuum-'.$i];
            $vibration_bearing1 = $_REQUEST['bearing1-'.$i];
            $vibration_bearing2 = $_REQUEST['bearing2-'.$i];
            $vibration_bearing3 = $_REQUEST['bearing3-'.$i];
            $vibration_bearing4 = $_REQUEST['bearing4-'.$i];
            $steam_pressure = $_REQUEST['pressure-'.$i];
            $steam_before_msv = $_REQUEST['before_msv_temp-'.$i];
            $steam_after_1st = $_REQUEST['after_stage_1_temp-'.$i];
            $steam_after_msv = $_REQUEST['after_msv_temp-'.$i];
            $steam_exhaust = $_REQUEST['exhaust_chamber_temp-'.$i];
            $bearing_temp_1a = $_REQUEST['temperature_1_a-'.$i];
            $bearing_temp_1b = $_REQUEST['temperature_1_b-'.$i];
            $bearing_temp_2a = $_REQUEST['temperature_2_a-'.$i];
            $bearing_temp_2b = $_REQUEST['temperature_2_b-'.$i];
            $bearing_temp_3a = $_REQUEST['temperature_3_a-'.$i];
            $bearing_temp_3b = $_REQUEST['temperature_3_b-'.$i];
            $bearing_temp_4 = $_REQUEST['temperature_4-'.$i];
            $bearing_return_1 = $_REQUEST['return_oil_temp_1-'.$i];
            $bearing_return_2 = $_REQUEST['return_oil_temp_2-'.$i];
            $bearing_return_3 = $_REQUEST['return_oil_temp_3-'.$i];
            $bearing_return_4 = $_REQUEST['return_oil_temp_4-'.$i];  
            $bearing_pad_a = $_REQUEST['thrust_pad_a-'.$i];
            $bearing_pad_b = $_REQUEST['thrust_pad_b-'.$i]; 
            $casing_upper = $_REQUEST['upper_temp-'.$i];
            $casing_lower = $_REQUEST['lower_temp-'.$i];
            $casing_flange_a = $_REQUEST['flange_temp_a-'.$i];
            $casing_flange_b = $_REQUEST['flange_temp_b-'.$i];
            $generator_outlet = $_REQUEST['outlet_air-'.$i];
            $generator_inlet = $_REQUEST['inlet_air-'.$i];
            $generator_coil_1 = $_REQUEST['stator_coil_temp_1-'.$i];
            $generator_coil_2 = $_REQUEST['stator_coil_temp_2-'.$i];
            $generator_coil_3 = $_REQUEST['stator_coil_temp_3-'.$i];
            $generator_coil_4 = $_REQUEST['stator_coil_temp_4-'.$i];
            $generator_coil_5 = $_REQUEST['stator_coil_temp_5-'.$i];
            $generator_coil_6 = $_REQUEST['stator_coil_temp_6-'.$i];
            $generator_core_7 = $_REQUEST['stator_core_temp_7-'.$i];
            $generator_core_8 = $_REQUEST['stator_core_temp_8-'.$i];
            $generator_core_9 = $_REQUEST['stator_core_temp_9-'.$i];
            $generator_core_10 = $_REQUEST['stator_core_temp_10-'.$i];
            $generator_core_11 = $_REQUEST['stator_core_temp_11-'.$i];
            $generator_core_12 = $_REQUEST['stator_core_temp_12-'.$i];
            $condensor_inlet = $_REQUEST['inlet_steam-'.$i];
            $condensor_cond = $_REQUEST['cond-'.$i];
            $condensor_inlet_a = $_REQUEST['cooling_inlet_a-'.$i];
            $condensor_inlet_b = $_REQUEST['cooling_inlet_b-'.$i];
            $condensor_outlet_a = $_REQUEST['cooling_outlet_a-'.$i];
            $condensor_outlet_b = $_REQUEST['cooling_outlet_b-'.$i];
            $oil_cooling_inlet_a = $_REQUEST['cooling_inlet_a-'.$i];
            $oil_cooling_inlet_b = $_REQUEST['cooling_inlet_b-'.$i];
            $oil_cooling_outlet_a = $_REQUEST['cooling_outlet_a-'.$i];
            $oil_cooling_outlet_b = $_REQUEST['cooling_outlet_b-'.$i];
            $oil_inlet_a = $_REQUEST['oil_inlet_a-'.$i];
            $oil_inlet_b = $_REQUEST['oil_inlet_b-'.$i];
            $oil_outlet_a = $_REQUEST['oil_outlet_a-'.$i];
            $oil_outlet_b = $_REQUEST['oil_outlet_b-'.$i];
            $thrust_pad_a = $_REQUEST['thrust_pad_a-'.$i];
            $thrust_pad_b = $_REQUEST['thrust_pad_b-'.$i];
            $thrust_pad_c = $_REQUEST['thrust_pad_c-'.$i];
            $thrust_pad_d = $_REQUEST['thrust_pad_d-'.$i];
            $thrust_pad_e = $_REQUEST['thrust_pad_e-'.$i];
            $thrust_pad_f = $_REQUEST['thrust_pad_f-'.$i];
            $thrust_pad_g = $_REQUEST['thrust_pad_g-'.$i];
            $thrust_pad_h = $_REQUEST['thrust_pad_h-'.$i];
            $thrust_pad_i = $_REQUEST['thrust_pad_i-'.$i];
            $thrust_pad_j = $_REQUEST['thrust_pad_j-'.$i];

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

            #cek apakah input berhasil
            $rs = pg_fetch_assoc($exec_input);
            if (!$rs) {
            echo "input gagal";
            }
            ?> 
            
            <?php
        }
    }
?>
</body>