<?php
require_once("../../config/config.php");
require_once(SITE_ROOT."/src/koneksi.php");

$query = "SELECT * FROM kecelakaan_kerja
        ORDER BY tanggal DESC;";

//Prepare 
$prep = $koneksi_hse -> prepare($query);

//Commit Query dan Mengambil Data
try{
        $koneksi_hse -> beginTransaction();
        $prep -> execute();
        $koneksi_hse -> commit();
}catch(PDOException $e){
        echo "PDO ERROR: ". $e -> getMessage();
}finally{
        $kecelakaan_kerja_arr = $prep -> fetchAll(PDO::FETCH_ASSOC);
        $kecelakan_kerja_row = $koneksi_hse -> query('SELECT count(*) FROM kecelakaan_kerja') -> fetchColumn();

        //Check Array Hasil
        //if (!$hrd_arr){
        //        echo "error \n";
        //        echo pg_last_error();
        //}else{
        //        print_r($hrd_arr);
        //}
}


//$pengawasan = pg_query($koneksi_hse, "SELECT * FROM pengawasan");
//$potensi_bahaya = pg_query($koneksi_hse, "SELECT * FROM potensi_bahaya");
//$pelanggaran = pg_query($koneksi_hse, "SELECT * FROM pelanggaran");

//$pengawasan_arr = pg_fetch_all($pengawasan);
//$potensi_bahaya_arr = pg_fetch_all($potensi_bahaya);
//$pelanggaran_arr = pg_fetch_all($pelanggaran);

//$row_pengawasan = pg_num_rows($pengawasan);
//$row_potensi_bahaya = pg_num_rows($potensi_bahaya);
//$row_pelanggaran = pg_num_rows($pelanggaran);

?>