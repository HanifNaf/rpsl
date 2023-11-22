<?php
require_once("../../config/config.php");
require_once("maintenance_data.php");

//Mengambil data file lampiran
if(isset($_GET['id'])){
    $id = $_GET['id'];

    //Query Select lampiran
    $query = "SELECT nama, tipe, file
            FROM lampiran WHERE lampiran_id = :id";
    $prep = $koneksi_maintenance -> prepare($query);
    $prep->bindParam(":id", $id);

    try{
        //Select lampiran
        $koneksi_maintenance->beginTransaction();
        $prep->execute();
        $koneksi_maintenance->commit();

    }catch(PDOException $e){
        echo "PDO ERROR: ". $e->getMessage();
        
    }finally{
        //Fetch lampiran
        $lampiran = $prep->fetch(PDO::FETCH_ASSOC);

        if($lampiran){
            $nama = $lampiran['nama'];
            $isi = $lampiran['file'];
            $tipe = $lampiran['tipe'];

            //download lampiran
            header("Content-Type: $tipe");
            header("Content-Disposition: attachment; filename=$nama");
            fpassthru($isi);

            
            exit;
        }else{
            echo "tidak ada data"; //buat sweetalert
        }
    }
}else{
    echo "Invalid Request"; //buat sweetalert
}
?>