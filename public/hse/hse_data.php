<?php
require_once("../../config/config.php");
require_once(SITE_ROOT."/src/koneksi.php");

$kecelakaan_kerja = pg_query($koneksi_hse, "SELECT * FROM kecelakaan_kerja");
$pengawasan = pg_query($koneksi_hse, "SELECT * FROM pengawasan");
$potensi_bahaya = pg_query($koneksi_hse, "SELECT * FROM potensi_bahaya");
$pelanggaran = pg_query($koneksi_hse, "SELECT * FROM pelanggaran");

$kecelakaan_kerja_arr = pg_fetch_all($kecelakaan_kerja);
$pengawasan_arr = pg_fetch_all($pengawasan);
$potensi_bahaya_arr = pg_fetch_all($potensi_bahaya);
$pelanggaran_arr = pg_fetch_all($pelanggaran);

$row_kecelakaan_kerja = pg_num_rows($kecelakaan_kerja);
$row_pengawasan = pg_num_rows($pengawasan);
$row_potensi_bahaya = pg_num_rows($potensi_bahaya);
$row_pelanggaran = pg_num_rows($pelanggaran);

?>