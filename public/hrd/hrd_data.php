<?php
require_once("../../config/config.php");
require_once(SITE_ROOT."/src/koneksi.php");

$query = "SELECT hrd_id, tanggal, nik, nama, bagian, shift, waktu_pelanggaran, tempat_pelanggaran, bentuk_pelanggaran, potensi_bahaya, sanksi, lampiran
        FROM hrd ORDER BY tanggal DESC;";

$prep = pg_prepare($koneksi_hrd, "select_hrd", $query);
$hrd = pg_execute($koneksi_hrd, "select_hrd", array());

$hrd_arr = pg_fetch_all($hrd);
$hrd_row = pg_num_rows($hrd); 
?>