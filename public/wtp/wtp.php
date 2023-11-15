<?php
require_once("../../config/config.php");
require_once(SITE_ROOT."/src/header-admin.php");
require_once(SITE_ROOT."/src/footer-admin.php");
require_once("wtp_data.php");
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
			<h2 style="display: flex; float: left;">DATA LAPORAN KERJA WTP</h2> 
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
          		<button type="button" data-toggle="tooltip" data-placement="top" title="Tambah" class="btn btn-success"><a id="log" href="wtp_input"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg></a></button>
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
							<th rowspan="2">Permasalahan/Progres</th>
			            	<th rowspan="2">Tindak Lanjut</th>
							<th colspan="3">Sparepart</th>
			            	<th colspan="2">Absensi</th>
							<th rowspan="2">Keterangan</th>
			            	<th rowspan="2">Catatan</th>
			            	<th rowspan="2">Opsi</th>
			        	</tr>
			        	<tr>
			        		<!-- Sparepart -->
				            <th>Sparepart</th>
				            <th>Quantity</th>
				            <th>Satuan</th>
			        		<!-- Absensi -->
				            <th>Nama</th>
				            <th>Keterangan</th>
			       	 	</tr>
                    </tr>

                    <?php 
                    $no = 1;
                    if($wtp_row>0){
                        foreach($wtp_arr as $array){ ?>
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
									<!--Permasalahan-->
									<?= $array['permasalahan']; ?>
								</td>
								<td>
									<!--Tindak Lanjut-->
									<?= $array['tindak_lanjut']; ?>
								</td>
								<td>
									<!--Sparepart-->
									<?= $array['sparepart']; ?>
								</td>
								<td>
									<!--Jumlah Sparepart-->
									<?= $array['jumlah_sparepart']; ?>
								</td>
								<td>
									<!--Satuan Sparepart-->
									<?= $array['satuan_sparepart']; ?>
								</td>
								<td>
									<!--Nama Absensi-->
									<?= $array['nama_absensi']; ?>
								</td>
								<td>
									<!--Keterangan Absensi-->
									<?= $array['keterangan_absensi']; ?>	
								</td>
								<td>
									<!--Keterangan-->
									<?= $array['keterangan']; ?>
								</td>
								<td>
									<!--Catatan-->
									<?= $array['catatan']; ?>	
								</td>
								<td>
									<a href="wtp_edit"><button class="btn btn-warning custom-button my-2" type="button" title="Edit">Edit</button></a>
            						<a href="wtp_delete"><button class="btn btn-danger custom-button" type="button" title="Hapus">Hapus</button></a>
								</td>
                    <?php }} else{
                        echo "<tr><td colspan=\"10\" align=\"center\"><b style='font-size:18px;'>DATA TIDAK DAPAT DITEMUKAN!</b></td></tr>";
                    } ?>
            </table>
			
</div>


</body>