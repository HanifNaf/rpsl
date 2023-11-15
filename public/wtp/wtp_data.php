<?php
require_once("../../config/config.php");
require_once(SITE_ROOT."/src/koneksi.php");


$query = "SELECT tanggal, permasalahan, tindak_lanjut, sparepart, jumlah_sparepart, satuan_sparepart, keterangan, nama_absensi, keterangan_absensi, catatan
        FROM wtp ORDER BY tanggal DESC;";

$prep = pg_prepare($koneksi_wtp, "select_wtp", $query);
$wtp_data = pg_execute($koneksi_wtp, "select_wtp", array());

$wtp_arr = pg_fetch_all($wtp_data);
$wtp_row = pg_num_rows($wtp_data);
?>