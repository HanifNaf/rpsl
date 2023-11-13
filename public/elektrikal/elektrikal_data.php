<?php
require_once("../../config/config.php");
require_once(SITE_ROOT."/src/koneksi.php");

$query = "SELECT tanggal, area_kerja, permasalahan, alat, status, jam_mulai, jam_selesai, keterangan, pekerjaan, personil
        FROM elektrikal ORDER BY $1 DESC;";

$prep = pg_prepare($koneksi_elektrikal, "my_query", $query);
$elektrikal = pg_execute($koneksi_elektrikal, "my_query", array("tanggal"));

$elektrikal_arr = pg_fetch_all($elektrikal);
$elektrikal_row = pg_num_rows($elektrikal);
?>