<?php
//Define DNS
$dns_maintenance="pgsql:host=localhost;dbname=rpsl_maintenance";
$dns_hrd="pgsql:host=localhost;dbname=rpsl_hrd";
$dns_hse="pgsql:host=localhost;dbname=rpsl_hse";
$dns_operasional="pgsql:host=localhost;dbname=rpsl_operasional";
$dns_wtp="pgsql:host=localhost;dbname=rpsl_wtp";
$dns_users="pgsql:host=localhost;dbname=rpsl_users";

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
    $koneksi_users = new PDO($dns_users, $user, $pass, $errmode);

}catch(PDOException $e){
    echo "Error: ". $e->getMessage();
}
?>