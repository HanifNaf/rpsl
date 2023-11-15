<?php
require_once("../../config/config.php");
require_once(SITE_ROOT."/src/koneksi.php");


$query = "SELECT tanggal, permasalahan, tindak_lanjut, sparepart, jumlah_sparepart, satuan_sparepart, keterangan, nama_absensi, keterangan_absensi, catatan
        FROM mekanikal ORDER BY tanggal DESC;";

$prep = pg_prepare($koneksi_mekanikal, "select_mekanikal", $query);
$mekanikal_data = pg_execute($koneksi_mekanikal, "select_mekanikal", array());

$mekanikal_arr = pg_fetch_all($mekanikal_data);
$mekanikal_row = pg_num_rows($mekanikal_data);
?>