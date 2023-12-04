<?php
require_once("../../config/config.php");
require_once(SITE_ROOT."/src/koneksi.php");

$query = "SELECT * FROM kecelakaan_kerja
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
        $kecelakaan_kerja_arr = $prep -> fetchAll(PDO::FETCH_ASSOC);
        $kecelakan_kerja_row = $koneksi -> query('SELECT count(*) FROM kecelakaan_kerja') -> fetchColumn();

        //Check Array Hasil
        //if (!$kecelakaan_kerja_arr){
        //        echo "error \n";
        //        echo pg_last_error();
        //}else{
        //        print_r($kecelakaan_kerja_arr);
        //}
}

?>