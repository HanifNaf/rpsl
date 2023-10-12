<?php
require("koneksi.php");

//$koneksi = pg_connect("host=localhost dbname=rpsl_operasional user=postgres password=hanifnafiis123");

$operasional = pg_query($koneksi_operasional, "SELECT t1.generation, t1.pm_kwh_pltbm, t2.tanggal, t2.waktu, t3.ekspor, t3.pemakaian_sendiri, t3.kwh_loss, t5.nama, t6.shift, t7.bahan_bakar
                                FROM produksi_kwh t1
                                INNER JOIN operasional t2 ON t1.produksi_id=t2.produksi_id
                                INNER JOIN pemakaian_kwh t3 ON t2.pemakaian_id=t3.pemakaian_id
                                INNER JOIN pemakaian_bahan_bakar t4 ON t2.pemakaian_bahan_bakar_id=t4.pemakaian_bahan_bakar_id
                                INNER JOIN users t5 ON t2.users_id=t5.users_id
                                INNER JOIN shift t6 ON t2.shift_id=t6.shift_id
                                INNER JOIN bahan_bakar t7 ON t4.bahan_bakar_id=t7.bahan_bakar_id");
$operasional_arr = pg_fetch_all($operasional);

$row_operasional = pg_num_rows($operasional);

?>