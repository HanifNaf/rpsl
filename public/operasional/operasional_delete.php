<?php
require_once("../../config/config.php");

// Cek role
if (!in_array($_SESSION['role'], ['operasional', 'admin'])) {
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
                window.location.href = '../index.php';
            });
        </script>
    ";
}

require_once(SITE_ROOT . "/src/header-admin.php");
require_once(SITE_ROOT . "/src/footer-admin.php");

if (isset($_GET['operasional_id'], $_GET['produksi_id'], $_GET['pemakaian_id'], $_GET['bahan_bakar_id'])) {
    $operasional_id = $_GET['operasional_id'];
    $produksi_id = $_GET['produksi_id'];
    $pemakaian_id = $_GET['pemakaian_id'];
    $bahan_bakar_id = $_GET['bahan_bakar_id'];

    // Proses penghapusan data berdasarkan ID
    try {
        // Hapus data dari tabel 'operasional'
        $delete_operasional_query = "DELETE FROM operasional WHERE operasional_id = ?";
        $prep_delete_operasional = $koneksi_operasional->prepare($delete_operasional_query);
        $prep_delete_operasional->bindParam(1, $operasional_id, PDO::PARAM_STR);
        $prep_delete_operasional->execute();

        // Hapus data dari tabel 'produksi'
        $delete_produksi_query = "DELETE FROM produksi_kwh WHERE produksi_id = ?";
        $prep_delete_produksi = $koneksi_operasional->prepare($delete_produksi_query);
        $prep_delete_produksi->bindParam(1, $produksi_id, PDO::PARAM_STR);
        $prep_delete_produksi->execute();

        // Hapus data dari tabel 'pemakaian'
        $delete_pemakaian_query = "DELETE FROM pemakaian_kwh WHERE pemakaian_id = ?";
        $prep_delete_pemakaian = $koneksi_operasional->prepare($delete_pemakaian_query);
        $prep_delete_pemakaian->bindParam(1, $pemakaian_id, PDO::PARAM_STR);
        $prep_delete_pemakaian->execute();

        // Hapus data dari tabel 'bahan_bakar'
        $delete_bahan_bakar_query = "DELETE FROM pemakaian_bahan_bakar WHERE pemakaian_bahan_bakar_id = ?";
        $prep_delete_bahan_bakar = $koneksi_operasional->prepare($delete_bahan_bakar_query);
        $prep_delete_bahan_bakar->bindParam(1, $bahan_bakar_id, PDO::PARAM_STR);
        $prep_delete_bahan_bakar->execute();

        // Set pesan JavaScript untuk notifikasi
        echo "<script>
                Swal.fire({
                    text: 'Data berhasil dihapus!',
                    type: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location.href = 'operasional';
                    }
                });
            </script>";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Jika parameter tidak diterima, kembali ke halaman utama
    header("Location: operasional");
    exit();
}
?>
