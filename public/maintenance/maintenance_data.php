<?php
require_once ("../../config/config.php");
require_once (SITE_ROOT. "/src/koneksi.php");

$query = "SELECT divisi, unit, problem, evaluasi, penanganan, tanggal_mulai, tanggal_selesai, status, tingkat_kerusakan, jam 
        FROM maintenance ORDER BY jam DESC;";

$prepare = pg_prepare($koneksi_operasional, "my_query", $query);
$maintenance = pg_execute($koneksi_operasional, "my_query", array());

$maintenance_arr = pg_fetch_all($maintenance);
$maintenance_row = pg_num_rows($maintenance);
?>