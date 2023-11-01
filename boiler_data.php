<?php
$koneksi_boiler = pg_connect("host=localhost dbname=rpsl_boiler user=rpsl password=pass_rpsl");

$drum_level = pg_query($koneksi_boiler, "SELECT * FROM drum_level");
$main_stream = pg_query($koneksi_boiler, "SELECT * FROM main_stream");
$furnace = pg_query($koneksi_boiler, "SELECT * FROM furnace");
$feed_pump = pg_query($koneksi_boiler, "SELECT * FROM feed_pump");
$superheater = pg_query($koneksi_boiler, "SELECT * FROM superheater");
$idf = pg_query($koneksi_boiler, "SELECT * FROM idf");
$air = pg_query($koneksi_boiler, "SELECT * FROM air");
$feed_water = pg_query($koneksi_boiler, "SELECT * FROM feed_water");
$desuperheater = pg_query($koneksi_boiler, "SELECT * FROM desuperheater");
$header = pg_query($koneksi_boiler, "SELECT * FROM header");
$exhaust_gas = pg_query($koneksi_boiler, "SELECT * FROM exhaust_gas");
$scraper = pg_query($koneksi_boiler, "SELECT * FROM scraper");
$soot = pg_query($koneksi_boiler, "SELECT * FROM soot");
$fuel = pg_query($koneksi_boiler, "SELECT * FROM fuel");
$fdf = pg_query($koneksi_boiler, "SELECT * FROM fdf");
$sdf = pg_query($koneksi_boiler, "SELECT * FROM sdf");
$economizer = pg_query($koneksi_boiler, "SELECT * FROM economizer");

$boiler_arr = pg_fetch_all($drum_level, $main_stream, $furnace, $feed_pump, $superheater, $idf, $air, $feed_water, $desuperheater, $header, $exhaust_gas, $scraper, $soot, $fuel, $fdf, $sdf, $economizer);

$row_boiler = pg_num_rows($boiler_arr);

?>