<?php
    //Cek Jika Input Kosong
    function EmptyToNull($value){
      return empty($value) ? null : $value;
    }

    //Cek tangal di tabel tanggal_gabungan
    function checkTanggal($tanggal, $koneksi_pdo) {
        $query = "SELECT COUNT(*) FROM tanggal_gabungan WHERE tanggal = :tanggal";
        $stmt = $koneksi_pdo->prepare($query);
        $stmt->bindParam(':tanggal', $tanggal);
        $stmt->execute();
        $count = $stmt->fetchColumn();
    
        return $count > 0;
    }

    //Insert atau Select tanggal_id
    function insertOrSelectTanggal($tanggal, $koneksi_pdo){
        if(!checkTanggal($tanggal, $koneksi_pdo)){
            //Jika tanggal belum terdaftar, insert
            $tanggalquery = "INSERT INTO tanggal_gabungan (tanggal_id, tanggal) VALUES (uuid_generate_v4(), ?) RETURNING tanggal_id";
        }else{
            //Jika tanggal terdaftar, select
            $tanggalquery = "SELECT tanggal_id FROM tanggal_gabungan WHERE tanggal=?";
        }
            
            $tanggalstmt = $koneksi_pdo->prepare($tanggalquery);
            $tanggalstmt->bindParam(1, $tanggal);
            $tanggalstmt->execute();
            $row = $tanggalstmt->fetch(PDO::FETCH_ASSOC);
            
            $tanggalid = $row["tanggal_id"];
            return $tanggalid;
    }
?>