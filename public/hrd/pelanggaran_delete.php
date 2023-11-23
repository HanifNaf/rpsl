<?php
require_once("../../config/config.php");

// Cek role
if (!in_array($_SESSION['role'], ['hrd', 'admin'])) {
    print_r($_SESSION);
    header("location: ../index.php");
}

require_once(SITE_ROOT . "/src/header-admin.php");
require_once(SITE_ROOT . "/src/footer-admin.php");

// Pastikan parameter maintenance_id telah diterima
if (isset($_GET['hrd_id'])) {
    $hrd_id = $_GET['hrd_id'];

    // Proses penghapusan data berdasarkan ID
    try {
        $delete_query = "DELETE FROM hrd WHERE hrd_id = ?";
        $prepare_delete = $koneksi_hrd->prepare($delete_query);
        $prepare_delete->bindParam(1, $hrd_id, PDO::PARAM_INT);

        if ($prepare_delete->execute()) {
            // Set pesan JavaScript untuk notifikasi
            echo "<script>
                Swal.fire({
                    text: 'Data berhasil dihapus!',
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = 'pelanggaran';
                    }
                });
            </script>";
        } else {
            echo "Gagal menghapus data.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Jika parameter maintenance_id tidak diterima, kembali ke halaman utama
    header("Location: pelanggaran");
    exit();
}
?>
