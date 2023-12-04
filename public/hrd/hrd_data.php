<?php
require_once("../../config/config.php");
require_once(SITE_ROOT."/src/koneksi.php");

$query = "SELECT pelanggaran_id, tanggal, nik, pelanggaran.nama AS nama_hrd, bagian, shift, waktu_pelanggaran, 
        tempat_pelanggaran, bentuk_pelanggaran, potensi_bahaya, sanksi, lampiran_hrd.nama AS nama_lampiran,
        pelanggaran.lampiran_id
        FROM pelanggaran 
        LEFT JOIN lampiran_hrd ON pelanggaran.lampiran_id=lampiran_hrd.lampiran_id
        ORDER BY tanggal DESC;";

//Prepare 
$prep = $koneksi -> prepare($query);

//Commit Query dan Mengambil Data
try{
        $koneksi -> beginTransaction();
        $prep -> execute();
        $koneksi -> commit();
}catch(PDOException $e){
        echo "PDO ERROR: ". $e -> getMessage();
}finally{
        $hrd_arr = $prep -> fetchAll(PDO::FETCH_ASSOC);
        $hrd_row = $koneksi -> query('SELECT count(*) FROM pelanggaran') -> fetchColumn();

        //Check Array Hasil
        //if (!$hrd_arr){
        //        echo "error \n";
        //        echo pg_last_error();
        //}else{
        //        print_r($hrd_arr);
        //}
} 
?>