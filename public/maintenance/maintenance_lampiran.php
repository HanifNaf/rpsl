<?php
require_once("../../config/config.php");

// Cek role
if (!in_array($_SESSION['role'], ['elektrikal', 'wtp', 'mekanikal', 'admin', 'manager'])) {
   echo "<p style='color: white;'>Akses Dibatasi. Anda tidak memiliki izin yang cukup.</p>";

    // Menambahkan skrip SweetAlert untuk notifikasi yang lebih menarik
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Dibatasi',
                text: 'Anda tidak memiliki izin yang cukup.',
            }).then(function() {
                window.location.href = '../maintenance/maintenance.php';
            });
        </script>
    ";
}

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