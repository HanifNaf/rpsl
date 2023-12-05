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
            }).then(function() {
                window.location.href = '../maintenance/maintenance.php';
            });
        </script>
    ";
}

require_once("maintenance_data.php");

//Mengambil data file lampiran
if(isset($_GET['la'])){
    $id = $_GET['la'];

    //Query Select lampiran
    $query = "SELECT nama, tipe, file
            FROM lampiran_maintenance WHERE lampiran_id = :id";
    $prep = $koneksi -> prepare($query);
    $prep->bindParam(":id", $id);

    try{
        //Select lampiran
        $koneksi->beginTransaction();
        $prep->execute();
        $koneksi->commit();

    } catch(PDOException $e){
        echo "PDO ERROR: ". $e->getMessage();
            
        $koneksi -> rollBack();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        
        $koneksi -> rollBack();
    } finally{
        //Fetch lampiran
        $lampiran = $prep->fetch(PDO::FETCH_ASSOC);

        if($lampiran){
            $nama = $lampiran['nama'];
            $isi = $lampiran['file'];
            $tipe = $lampiran['tipe'];

            // Create stream
            $stream = fopen('php://memory', 'r+');
            fwrite($stream, $isi);
            rewind($stream);

            //download lampiran
            header("Content-Type: $tipe");
            header("Content-Disposition: attachment; filename=$nama");
            fpassthru($stream);

            fclose($stream);
            exit;

        } else{
            echo "tidak ada data";
        }
    }
} else{
    echo "Invalid Request";
}
?>