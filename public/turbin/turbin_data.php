<?php
$koneksi_turbin = pg_connect("host=localhost dbname=rpsl_turbin user=rpsl password=pass_rpsl");

$turbin = pg_query($koneksi_turbin, "SELECT * FROM turbin");
$vibration = pg_query($koneksi_turbin, "SELECT * FROM vibration");
$steam = pg_query($koneksi_turbin, "SELECT * FROM steam");
$bearing = pg_query($koneksi_turbin, "SELECT * FROM bearing");
$casing = pg_query($koneksi_turbin, "SELECT * FROM casing");
$generator = pg_query($koneksi_turbin, "SELECT * FROM generator");
$condensor_temperature = pg_query($koneksi_turbin, "SELECT * FROM condensor_temperature");
$oil_cooler_temperature = pg_query($koneksi_turbin, "SELECT * FROM oil_cooler_temperature ");
$thrust_pad = pg_query($koneksi_turbin, "SELECT * FROM thrust_pad");

$turbin_arr = pg_fetch_all($turbin);
$vibration_arr = pg_fetch_all($vibration);
$steam_arr = pg_fetch_all($steam);
$bearing_arr = pg_fetch_all($bearing);
$casing_arr = pg_fetch_all($casing);
$generator_arr = pg_fetch_all($generator);
$condensor_temperature_arr = pg_fetch_all($condensor_temperature);
$oil_cooler_temperature_arr = pg_fetch_all($oil_cooler_temperature);
$thrust_pad_arr = pg_fetch_all($thrust_pad);

$row_turbin = pg_num_rows($turbin);
$row_vibration = pg_num_rows($vibration);
$row_steam = pg_num_rows($steam);
$row_bearing = pg_num_rows($bearing);
$row_casing = pg_num_rows($casing);
$row_generator = pg_num_rows($generator);
$row_condensor_temperature = pg_num_rows($condensor_temperature);
$row_oil_cooler_temperature = pg_num_rows($oil_cooler_temperature);
$row_thrust_pad = pg_num_rows($thrust_pad);

?>