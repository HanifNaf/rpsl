<?php
require_once("../../config/config.php");

// Cek role
if (!in_array($_SESSION['role'], ['hse', 'admin'])) {
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
                window.location.href = '../hse/kecelakaan_kerja.php';
            });
        </script>
    ";
}

require_once(SITE_ROOT . "/src/header-admin.php");
require_once(SITE_ROOT . "/src/footer-admin.php");

// Pastikan parameter maintenance_id telah diterima
if (isset($_GET['kecelakaan_kerja_id'])) {
    $kecelakaan_kerja_id = $_GET['kecelakaan_kerja_id'];

    // Proses penghapusan data berdasarkan ID
    try {
        $delete_query = "DELETE FROM kecelakaan_kerja WHERE kecelakaan_kerja_id = ?";
        $prepare_delete = $koneksi->prepare($delete_query);
        $prepare_delete->bindParam(1, $kecelakaan_kerja_id, PDO::PARAM_INT);

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
                        window.location.href = 'kecelakaan_kerja';
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
    header("Location: kecelakaan_kerja");
    exit();
}
?>
