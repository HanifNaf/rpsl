<?php
require_once("../../config/config.php");
require_once("hse_data.php");
require_once(SITE_ROOT."/src/header-admin.php");
require_once(SITE_ROOT."/src/footer-admin.php");
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
			<h2 style="display: flex; float: left;">Data Pengawasan Pekerjaan</h2> 
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
          <button type="button" data-toggle="tooltip" data-placement="top" title="Tambah" class="btn btn-success"><a id="log" href="pengawasan_input"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg></a></button>
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
			            <th rowspan="2">Jam Kerja</th>
						<th rowspan="2">Personil HSE</th>
			            <th colspan="6">Timbangan</th>
			            <th colspan="6">Chipper dan Moving Floor</th>
			            <th colspan="6">Boiler</th>
			            <th colspan="6">WTP</th>
			            <th colspan="6">Turbin</th>
			            <th colspan="6">Mekanik</th>
			            <th colspan="6">Listrik</th>
			            <th colspan="6">Bahan Bakar</th>
			            <th rowspan="2">Opsi</th>
			        	</tr>
			        	<tr>
			        		<!-- Timbangan -->
				            <th>Pengawasan</th>
				            <th>Keterangan Pengawasan</th>
			            	<th>Kondisi 5R</th>
			            	<th>Keterangan 5R</th>
			            	<th>Pemberian APD</th>
				            <th>Jumlah</th>
				            <!-- Chipper dan Moving Floor -->
				            <th>Pengawasan</th>
				            <th>Keterangan Pengawasan</th>
			            	<th>Kondisi 5R</th>
			            	<th>Keterangan 5R</th>
			            	<th>Pemberian APD</th>
				            <th>Jumlah</th>
				            <!-- Boiler -->
				            <th>Pengawasan</th>
				            <th>Keterangan Pengawasan</th>
			            	<th>Kondisi 5R</th>
			            	<th>Keterangan 5R</th>
			            	<th>Pemberian APD</th>
				            <th>Jumlah</th>
				            <!-- WTP -->
				            <th>Pengawasan</th>
				            <th>Keterangan Pengawasan</th>
			            	<th>Kondisi 5R</th>
			            	<th>Keterangan 5R</th>
			            	<th>Pemberian APD</th>
				            <th>Jumlah</th>
				            <!-- Turbin -->
				            <th>Pengawasan</th>
				            <th>Keterangan Pengawasan</th>
			            	<th>Kondisi 5R</th>
			            	<th>Keterangan 5R</th>
			            	<th>Pemberian APD</th>
				            <th>Jumlah</th>
				            <!-- Mekanik -->
				            <th>Pengawasan</th>
				            <th>Keterangan Pengawasan</th>
			            	<th>Kondisi 5R</th>
			            	<th>Keterangan 5R</th>
			            	<th>Pemberian APD</th>
				            <th>Jumlah</th>
				            <!-- Listrik -->
				            <th>Pengawasan</th>
				            <th>Keterangan Pengawasan</th>
			            	<th>Kondisi 5R</th>
			            	<th>Keterangan 5R</th>
			            	<th>Pemberian APD</th>
				            <th>Jumlah</th>
				            <!-- Bahan Bakar -->
				            <th>Pengawasan</th>
				            <th>Keterangan Pengawasan</th>
			            	<th>Kondisi 5R</th>
			            	<th>Keterangan 5R</th>
			            	<th>Pemberian APD</th>
				            <th>Jumlah</th>
			       	 	</tr>
                    </tr>
                  <?php 
                    $no = 1;
                    if($row_pengawasan>0){
                        foreach($pengawasan_arr as $array){ ?>
                        <tr class="text-center table-row-border">
								<td>
									<!--Nomor-->
									<?= $no++; ?>
								</td>
								<td>
									<!--Tanggal-->
									<?= $array['tanggal']; ?>
								</td>
								<td>
									<!--Jam Kerja-->
									<?= $array['jam_kerja']; ?>
								</td>
								<td>
									<!--Personil HSE-->
									<?= $array['personil_hse']; ?>
								</td>
								<td>
									<!--Timbangan-->
									<!--Pengawasan-->
									<?= $array['pengawasan_timbangan']; ?>
								</td>
								<td>
									<!--Keterangan Pengawasan-->
									<?= $array['keterangan_pengawasan_timbangan']; ?>
								</td>
								<td>
									<!--Kondisi 5R-->
									<?= $array['kondisi_5r_timbangan']; ?>
								</td>
								<td>
									<!--Keterangan 5R-->
									<?= $array['keterangan_5r_timbangan']; ?>
								</td>
								<td>
									<!--Pemberian APD-->
									<?= $array['pemberian_apd_timbangan']; ?>
								</td>
								<td>
									<!--Jumlah-->
									<?= $array['jumlah_apd_timbangan']; ?>
								</td>
								<td>
									<!--Chiper dan Moving Floor-->
									<!--Pengawasan-->
									<?= $array['pengawasan_chipper']; ?>
								</td>
								<td>
									<!--Keterangan Pengawasan-->
									<?= $array['keterangan_pengawasan_chipper']; ?>
								</td>
								<td>
									<!--Kondisi 5R-->
									<?= $array['kondisi_5r_chipper']; ?>
								</td>
								<td>
									<!--Keterangan 5R-->
									<?= $array['keterangan_5r_chipper']; ?>
								</td>
								<td>
									<!--Pemberian APD-->
									<?= $array['pemberian_apd_chipper']; ?>
								</td>
								<td>
									<!--Jumlah-->
									<?= $array['jumlah_apd_chipper']; ?>
								</td>
								<td>
									<!--Boiler-->
									<!--Pengawasan-->
									<?= $array['pengawasan_boiler']; ?>
								</td>
								<td>
									<!--Keterangan Pengawasan-->
									<?= $array['keterangan_pengawasan_boiler']; ?>
								</td>
								<td>
									<!--Kondisi 5R-->
									<?= $array['kondisi_5r_boiler']; ?>
								</td>
								<td>
									<!--Keterangan 5R-->
									<?= $array['keterangan_5r_boiler']; ?>
								</td>
								<td>
									<!--Pemberian APD-->
									<?= $array['pemberian_apd_boiler']; ?>
								</td>
								<td>
									<!--Jumlah-->
									<?= $array['jumlah_apd_boiler']; ?>
								</td>
								<td>
									<!--WTP-->
									<!--Pengawasan-->
									<?= $array['pengawasan_wtp']; ?>
								</td>
								<td>
									<!--Keterangan Pengawasan-->
									<?= $array['keterangan_pengawasan_wtp']; ?>
								</td>
								<td>
									<!--Kondisi 5R-->
									<?= $array['kondisi_5r_wtp']; ?>
								</td>
								<td>
									<!--Keterangan 5R-->
									<?= $array['keterangan_5r_wtp']; ?>
								</td>
								<td>
									<!--Pemberian APD-->
									<?= $array['pemberian_apd_wtp']; ?>
								</td>
								<td>
									<!--Jumlah-->
									<?= $array['jumlah_apd_wtp']; ?>
								</td>
								<td>
									<!--Turbin-->
									<!--Pengawasan-->
									<?= $array['pengawasan_turbin']; ?>
								</td>
								<td>
									<!--Keterangan Pengawasan-->
									<?= $array['keterangan_pengawasan_turbin']; ?>
								</td>
								<td>
									<!--Kondisi 5R-->
									<?= $array['kondisi_5r_turbin']; ?>
								</td>
								<td>
									<!--Keterangan 5R-->
									<?= $array['keterangan_5r_turbin']; ?>
								</td>
								<td>
									<!--Pemberian APD-->
									<?= $array['pemberian_apd_turbin']; ?>
								</td>
								<td>
									<!--Jumlah-->
									<?= $array['jumlah_apd_turbin']; ?>
								</td>
								<td>
									<!--Mekanik-->
									<!--Pengawasan-->
									<?= $array['pengawasan_mekanik']; ?>
								</td>
								<td>
									<!--Keterangan Pengawasan-->
									<?= $array['keterangan_pengawasan_mekanik']; ?>
								</td>
								<td>
									<!--Kondisi 5R-->
									<?= $array['kondisi_5r_mekanik']; ?>
								</td>
								<td>
									<!--Keterangan 5R-->
									<?= $array['keterangan_5r_mekanik']; ?>
								</td>
								<td>
									<!--Pemberian APD-->
									<?= $array['pemberian_apd_mekanik']; ?>
								</td>
								<td>
									<!--Jumlah-->
									<?= $array['jumlah_apd_mekanik']; ?>
								</td>
								<td>
									<!--Listrik-->
									<!--Pengawasan-->
									<?= $array['pengawasan_listrik']; ?>
								</td>
								<td>
									<!--Keterangan Pengawasan-->
									<?= $array['keterangan_pengawasan_listrik']; ?>
								</td>
								<td>
									<!--Kondisi 5R-->
									<?= $array['kondisi_5r_listrik']; ?>
								</td>
								<td>
									<!--Keterangan 5R-->
									<?= $array['keterangan_5r_listrik']; ?>
									<td>
									<!--Pemberian APD-->
									<?= $array['pemberian_apd_listrik']; ?>
								</td>
								<td>
									<!--Jumlah-->
									<?= $array['jumlah_apd_listrik']; ?>
								</td>
								</td>
								<td>
									<!--Bahan Bakar-->
									<!--Pengawasan-->
									<?= $array['pengawasan_bahan_bakar']; ?>
								</td>
								<td>
									<!--Keterangan Pengawasan-->
									<?= $array['keterangan_pengawasan_bahan_bakar']; ?>
								</td>
								<td>
									<!--Kondisi 5R-->
									<?= $array['kondisi_5r_bahan_bakar']; ?>
								</td>
								<td>
									<!--Keterangan 5R-->
									<?= $array['keterangan_5r_bahan_bakar']; ?>
								</td>
								<td>
									<!--Pemberian APD-->
									<?= $array['pemberian_apd_bahan_bakar']; ?>
								</td>
								<td>
									<!--Jumlah-->
									<?= $array['jumlah_apd_bahan_bakar']; ?>
								</td>
								<td>
									<a href="operasional_edit"><button class="btn btn-warning custom-button my-2" type="button" title="Edit">Edit</button></a>
            			<a href="operasional_delete"><button class="btn btn-danger custom-button" type="button" title="Hapus">Hapus</button></a>
								</td> 
                    <?php }} else{
                        echo "<tr><td colspan=\"10\" align=\"center\"><b style='font-size:18px;'>DATA TIDAK DAPAT DITEMUKAN!</b></td></tr>";
                    } ?>
            </table>
</div>


</body>