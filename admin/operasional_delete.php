<?php
require("../operasional_data.php");
require("header-admin.php");
require("footer-admin.php");
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Tampilkan pesan konfirmasi
    echo "<p>Apakah Anda yakin ingin menghapus data ini?</p>";
    echo "<a href='proses_delete.php?id=$id'><button class='btn btn-danger'>Ya, Hapus</button></a>";
    echo "<a href='index.php'><button class='btn btn-primary'>Batal</button></a>";
} else {
    echo "Data tidak valid.";
}
?>
