<?php
//Koneksi ke DB
$koneksi_operasional = pg_connect("host=localhost dbname=rpsl_operasional user=rpsl password=pass_rpsl") or die ("Koneksi Gagal");
$koneksi_boiler = pg_connect("host=localhost dbname=rpsl_boiler user=rpsl password=pass_rpsl") or die ("Koneksi Gagal");
$koneksi_timbangan = pg_connect("host=localhost dbname=rpsl_timbangan user=rpsl password=pass_rpsl") or die ("Koneksi Gagal");
$koneksi_turbin = pg_connect("host=localhost dbname=rpsl_turbin user=rpsl password=pass_rpsl") or die ("Koneksi Gagal");
$koneksi_wtp = pg_connect("host=localhost dbname=rpsl_wtp user=rpsl password=pass_rpsl") or die ("Koneksi Gagal");
$koneksi_elektrikal = pg_connect("host=localhost dbname=rpsl_elektrikal user=rpsl password=pass_rpsl") or die ("Koneksi Gagal");
$koneksi_hse = pg_connect("host=localhost dbname=rpsl_hse user=rpsl password=pass_rpsl") or die ("Koneksi Gagal");
$koneksi_mekanikal = pg_connect("host=localhost dbname=rpsl_mekanikal user=rpsl password=pass_rpsl") or die ("Koneksi Gagal");
?>