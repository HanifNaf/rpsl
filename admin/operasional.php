<?php
require("operasional_data.php");
require("admin/header-admin.php");
require("admin/footer-admin.php");
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
</head>


<body>
    <div class="container">	
		<form action="" method="POST">
			<h2 style="display: flex; float: left;">DATA OPERASIONAL</h2> 
			<div style="display: flex; float: right" id="pencarian1">
				<input type="text" placeholder="Cari.." name="cari" autofocus>
				<button type="submit" class="btn-sm btn-dark" style="border:none;"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" /></svg></button>
		</form>
	</div>
	<br>
	<hr>

    <!-- Menampilkan Tombol CRUD -->
    <div class="table-responsive table-responsive-md table-responsive-sm table-responsive-lg">
		<form name="produksi_proses" method="POST">
			<div class="form-group">
                <!--Menempatkan icon cetak dan tambah-->
			    <button type="button" data-toggle="tooltip" data-placement="top" title="Cetak" class="btn btn-info"><a href="#" data-toggle="modal" data-target="#cetakperiode"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M18,3H6V7H18M19,12A1,1 0 0,1 18,11A1,1 0 0,1 19,10A1,1 0 0,1 20,11A1,1 0 0,1 19,12M16,19H8V14H16M19,8H5A3,3 0 0,0 2,11V17H6V21H18V17H22V11A3,3 0 0,0 19,8Z" /></svg></a></button>
			    <button type="button" data-toggle="tooltip" data-placement="top" title="Tambah" class="btn btn-success"><a id="log" href="operasional_input"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z" /></svg></a></button>
			    <!--Menempatkan icon edit dan delete di sebelah kanan-->
                <div style="display: inline; float: right;">
				    <button type="button" onclick="edit_produksi()" data-toggle="tooltip" data-placement="top" title="Ubah" class="btn btn-warning"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M5,3C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V12H19V19H5V5H12V3H5M17.78,4C17.61,4 17.43,4.07 17.3,4.2L16.08,5.41L18.58,7.91L19.8,6.7C20.06,6.44 20.06,6 19.8,5.75L18.25,4.2C18.12,4.07 17.95,4 17.78,4M15.37,6.12L8,13.5V16H10.5L17.87,8.62L15.37,6.12Z" /></svg></a></button>
			        <button type="button" onclick="hapus_produksi()" data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger"><svg style="width:24px;height:24px" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M20.37,8.91L19.37,10.64L7.24,3.64L8.24,1.91L11.28,3.66L12.64,3.29L16.97,5.79L17.34,7.16L20.37,8.91M6,19V7H11.07L18,11V19A2,2 0 0,1 16,21H8A2,2 0 0,1 6,19Z" /></svg></a></button>
			    </div>
		    </div>

            <!--Menampilkan tabel-->
            <table class="table table-hover table-bordered table-sm">
                <!--Header Tabel berwarna gelap-->    
                <thead class="thead-dark">
                    <tr class="text-center">
						<th>No</th>
                        <th>Tanggal</th>
                        <th>Shift</th>
                        <th>Generasi</th>
                        <th>PM Kwh PLTBM</th>
                        <th>Ekspor</th>
                        <th>Pemakaian Sendiri</th>
                        <th>Kwh Loss</th>
                        <th>Pemakaian Cangkang (kg)</th>
                        <th>Pemakaian Palm Fiber (kg)</th>
                        <th>Pemakaian Wood Chips (kg)</th>
                        <th>Pemakaian Serbuk Kayu (kg)</th>
                        <th>Pemakaian Sabut Kelapa (kg)</th>
                        <th>Pemakaian EFB Press (kg)</th>
                        <th>Pemakaian OPT (kg)</th>
                        <th>Supervisor</th>
                        <th>Keterangan</th>
                    </tr>

                    <?php 
                    $no = 1;
                    if($row_operasional>0){
                        foreach($operasional_arr as $array){ ?>
                        <tr class="text-center">
								<td>
									<!--Nomor-->
									<!-- <?= $no++; ?> -->
								</td>
								<td>
									<!--Tanggal-->
									<?= $array['tanggal']; ?>
								</td>
								<td>
									<!--Shift-->
									<?= $array['shift']; ?>
								</td>
								<td>
									<!--Generasi-->
									<?= $array['generation']; ?>
								</td>
								<td>
									<!--PM-Kwh-PLTBM-->
									<?= $array['pm_kwh_pltbm']; ?>
								</td>
								<td>
									<!--Ekspor-->
									<?= $array['ekspor']; ?>	
								</td>
								<td>
									<!--Pemakaian Sendiri-->
									<?= $array['pemakaian_sendiri']; ?>	
								</td>
								<td>
									<!--Kwh Loss-->
									<?= $array['kwh_loss']; ?>	
								</td>
								<td>
									<!--kg palm fiber-->
									<?= $array['kg_palmfiber']; ?>
								</td>
								<td>
									<!--kg wood chips-->
									<?= $array['kg_woodchips']; ?>
								</td>
								<td>
									<!--kg serbuk kayu-->
									<?= $array['kg_serbukkayu']; ?>
								</td>
								<td>
									<!--kg sabut kelapa-->
									<?= $array['kg_sabutkelapa']; ?>
								</td>
								<td>
									<!--kg efb-->
									<?= $array['kg_efbpress']; ?>
								</td>
								<td>
									<!--kg opt-->
									<?= $array['kg_opt']; ?>
								</td>
								<td>
									<!--Supervisor-->
									<?= $array['supervisor']; ?>
								</td>
								<td>
									<!--Keterangan-->
									<?= $array['keterangan']; ?>
								</td>
                    <?php }} else{
                        echo "<tr><td colspan=\"10\" align=\"center\"><b style='font-size:18px;'>DATA TIDAK DAPAT DITEMUKAN!</b></td></tr>";
                    } ?>
            </table>



</body>