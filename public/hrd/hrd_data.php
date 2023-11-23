<?php
require_once("../../config/config.php");
require_once(SITE_ROOT."/src/koneksi.php");

$query = "SELECT hrd_id, tanggal, nik, hrd.nama AS nama_hrd, bagian, shift, waktu_pelanggaran, 
        tempat_pelanggaran, bentuk_pelanggaran, potensi_bahaya, sanksi, lampiran.nama AS nama_lampiran,
        hrd.lampiran_id
        FROM hrd  
        LEFT JOIN lampiran ON hrd.lampiran_id=lampiran.lampiran_id
        ORDER BY tanggal DESC;";

//Prepare 
$prep = $koneksi_hrd -> prepare($query);

//Commit Query dan Mengambil Data
try{
        $koneksi_hrd -> beginTransaction();
        $prep -> execute();
        $koneksi_hrd -> commit();
}catch(PDOException $e){
        echo "PDO ERROR: ". $e -> getMessage();
}finally{
        $hrd_arr = $prep -> fetchAll(PDO::FETCH_ASSOC);
        $hrd_row = $koneksi_hrd -> query('SELECT count(*) FROM hrd') -> fetchColumn();

        //Check Array Hasil
        //if (!$hrd_arr){
        //        echo "error \n";
        //        echo pg_last_error();
        //}else{
        //        print_r($hrd_arr);
        //}
} 
?>