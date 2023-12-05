<?php
// Define DNS
$dns = "mysql:host=localhost;dbname=rpsl";

// DB Credentials for MySQL
$user = "rpsl";
$pass = "pass_rpsl";
$errmode = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

// Cek Koneksi
try {
    $koneksi = new PDO($dns, $user, $pass, $errmode);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>