<?php 
require_once ("../../config/config.php");
require_once (SITE_ROOT. "/src/koneksi.php");

$query = "SELECT t1.produksi_id, t1.generation, t1.pm_kwh_pltbm, 
        t2.operasional_id, t2.tanggal, t2.waktu, t2.shift, t2.keterangan, t2.downtime,
        t3.pemakaian_id, t3.ekspor, t3.pemakaian_sendiri, t3.kwh_loss, 
        t4.pemakaian_bahan_bakar_id, t4.kg_cangkang, t4.kg_palmfiber, t4.kg_woodchips, t4.kg_serbukkayu, t4.kg_sabutkelapa, t4.kg_efbpress, t4.kg_opt
        FROM produksi_kwh t1
        INNER JOIN operasional t2 ON t1.produksi_id=t2.produksi_id
        INNER JOIN pemakaian_kwh t3 ON t2.pemakaian_id=t3.pemakaian_id
        INNER JOIN pemakaian_bahan_bakar t4 ON t2.pemakaian_bahan_bakar_id=t4.pemakaian_bahan_bakar_id ORDER BY tanggal DESC, shift DESC;";

$prep = $koneksi -> prepare($query);


try{
    //Select
    $koneksi -> beginTransaction();
    $prep -> execute();
    $koneksi -> commit();

}catch(PDOException $e){
    echo "PDO ERROR: ". $e -> getMessage();
    
    $koneksi -> rollBack();
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
    
    $koneksi -> rollBack();
} finally{

    $operasional_arr = $prep -> fetchAll(PDO::FETCH_ASSOC);
    $operasional_row = $koneksi -> query('SELECT count(*) FROM operasional') -> fetchColumn();

    //Check Array Hasil
    //if (!$operasional_arr){
    //        echo "error \n";
    //        echo pg_last_error();
    //}else{
    //        print_r($operasional_arr);
    //}
}
?>