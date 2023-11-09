<?php
	//$koneksi = mysqli_connect('localhost', 'root', '', 'operasional') or die ("Koneksi Gagal");
	$koneksi_operasional = pg_connect("host=localhost dbname=rpsl_operasional user=postgres password=bayu0510") or die ("Koneksi Gagal");
	$koneksi_boiler = pg_connect("host=localhost dbname=rpsl_boiler user=postgres password=bayu0510") or die ("Koneksi Gagal");
	$koneksi_timbangan = pg_connect("host=localhost dbname=rpsl_timbangan user=postgres password=bayu0510") or die ("Koneksi Gagal");
	$koneksi_turbin = pg_connect("host=localhost dbname=rpsl_turbin user=postgres password=bayu0510") or die ("Koneksi Gagal");
	$koneksi_wtp = pg_connect("host=localhost dbname=rpsl_wtp user=postgres password=bayu0510") or die ("Koneksi Gagal");

?>