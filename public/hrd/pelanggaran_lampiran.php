<?php
require_once("../../config/config.php");

// Cek role
if (!in_array($_SESSION['role'], ['hrd', 'admin', 'manager'])) {
    echo "<p style='color: white;'>Akses Dibatasi. Anda tidak memiliki izin yang cukup.</p>";

    // Menambahkan skrip SweetAlert untuk notifikasi yang lebih menarik
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Dibatasi',
            }).then(function() {
                window.location.href = '../hrd/pelanggaran.php';
            });
        </script>
    ";
}

require_once(SITE_ROOT."/src/koneksi.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    //Query Select
    $query = "SELECT lampiran_id, nama, tipe, file 
            FROM lampiran_hrd WHERE lampiran_id=:id";
    
    //Prepare 
    $prep = $koneksi -> prepare($query);
    $prep->bindParam(":id", $id);

    try{
        //Select lampiran
        $koneksi -> beginTransaction();
        $prep -> execute();
        $koneksi -> commit();

    }catch(PDOException $e){
        echo "PDO ERROR: ". $e -> getMessage();
            
        echo "PDO ERROR: ". $e -> getMessage();
            echo "SQLSTATE: " . $errorInfo[0] . "<br>";
            echo "Code: " . $errorInfo[1] . "<br>";
            echo "Message: " . $errorInfo[2] . "<br>";

            $koneksi -> rollBack();
    }finally{
        //Fetch Lampiran
        $lampiran = $prep -> fetch(PDO::FETCH_ASSOC);

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
    echo "Invalid Request!";
}
?>