<?php
//Define DNS
$dns_maintenance="pgsql:host=localhost;dbname=rpsl_maintenance";
$dns_hrd="pgsql:host=localhost;dbname=rpsl_hrd";
$dns_hse="pgsql:host=localhost;dbname=rpsl_hse";
$dns_operasional="pgsql:host=localhost;dbname=rpsl_operasional";
$dns_wtp="pgsql:host=localhost;dbname=rpsl_wtp";

//DB Credentials
$user = "rpsl";
$pass = "pass_rpsl";
$errmode = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

//cek koneksi
try{
    $koneksi_maintenance = new PDO($dns_maintenance, $user, $pass, $errmode);
    $koneksi_hrd = new PDO($dns_hrd, $user, $pass, $errmode);
    $koneksi_hse = new PDO($dns_hse, $user, $pass, $errmode);
    $koneksi_operasional = new PDO($dns_operasional, $user, $pass, $errmode);
    $koneksi_wtp = new PDO($dns_wtp, $user, $pass, $errmode);
}catch(PDOException $e){
    echo "Error: ". $e->getMessage();
}

//$koneksi_boiler = pg_connect("host=localhost dbname=rpsl_boiler user=rpsl password=pass_rpsl") or die ("Koneksi Gagal");
//$koneksi_timbangan = pg_connect("host=localhost dbname=rpsl_timbangan user=rpsl password=pass_rpsl") or die ("Koneksi Gagal");
//$koneksi_turbin = pg_connect("host=localhost dbname=rpsl_turbin user=rpsl password=pass_rpsl") or die ("Koneksi Gagal");
//$koneksi_elektrikal = pg_connect("host=localhost dbname=rpsl_elektrikal user=rpsl password=pass_rpsl") or die ("Koneksi Gagal");
//$koneksi_mekanikal = pg_connect("host=localhost dbname=rpsl_mekanikal user=rpsl password=pass_rpsl") or die ("Koneksi Gagal");
?>