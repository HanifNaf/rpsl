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

$drum_level_arr = pg_fetch_all($drum_level);
$main_stream_arr = pg_fetch_all($main_stream);
$furnace_arr = pg_fetch_all($furnace);
$feed_pump_arr = pg_fetch_all($feed_pump);
$superheater_arr = pg_fetch_all($superheater);
$idf_arr = pg_fetch_all($idf);
$air_arr = pg_fetch_all($air);
$feed_water_arr = pg_fetch_all($feed_water);
$desuperheater_arr = pg_fetch_all($desuperheater);
$header_arr = pg_fetch_all($header);
$exhaust_gas_arr = pg_fetch_all($exhaust_gas);
$scraper_arr = pg_fetch_all($scraper);
$soot_arr = pg_fetch_all($soot);
$fuel_arr = pg_fetch_all($fuel);
$fdf_arr = pg_fetch_all($fdf);
$sdf_arr = pg_fetch_all($sdf);
$economizer_arr = pg_fetch_all($economizer);

$row_drum_level = pg_num_rows($drum_level);
$row_main_stream = pg_num_rows($main_stream);
$row_furnace = pg_num_rows($furnace);
$row_feed_pump = pg_num_rows($feed_pump);
$row_superheater = pg_num_rows($superheater);
$row_idf = pg_num_rows($idf);
$row_air = pg_num_rows($air);
$row_feed_water = pg_num_rows($feed_water);
$row_desuperheater = pg_num_rows($desuperheater);
$row_header = pg_num_rows($header);
$row_exhaust_gas = pg_num_rows($exhaust_gas);
$row_scraper = pg_num_rows($scraper);
$row_soot = pg_num_rows($soot);
$row_fuel = pg_num_rows($fuel);
$row_fdf = pg_num_rows($fdf);
$row_sdf = pg_num_rows($sdf);
$row_economizer = pg_num_rows($economizer);

?>