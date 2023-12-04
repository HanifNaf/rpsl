<?php
require_once ("../../config/config.php");
require_once (SITE_ROOT. "/src/koneksi.php");

//Query Select 
$query = "SELECT maintenance_id, maintenance.lampiran_id, divisi, unit, problem, evaluasi, 
        penanganan, tanggal_mulai, tanggal_selesai, status, 
        tingkat_kerusakan, keterangan, sparepart, jumlah_sparepart, 
        satuan_sparepart, nama 
        FROM maintenance 
        LEFT JOIN lampiran_maintenance ON maintenance.lampiran_id=lampiran_maintenance.lampiran_id         
        ORDER BY tanggal_mulai DESC;";

//Prepare Query
$prep = $koneksi -> prepare($query);

//Commit Query dan mengambil Data
try{
        $koneksi -> beginTransaction();
        $prep -> execute();
        $koneksi -> commit();
}catch(PDOException $e){
        echo "PDO Error: ". $e -> getMessage();
}finally{
        
        $maintenance_arr = $prep -> fetchAll(PDO::FETCH_ASSOC);
        $maintenance_row = $koneksi -> query('select count(*) from maintenance') -> fetchColumn();
        
        //Check Array Hasil
        //if (!$maintenance_arr){
        //        echo "error";
        //}else{
        //        print_r($maintenance_arr);
        //}
}
?>