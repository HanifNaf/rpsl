<?php
//Define DNS
$dns = "pgsql:host=localhost;dbname=rpsl";

//DB Credentials
$user = "rpsl";
$pass = "pass_rpsl";
$errmode = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

//cek koneksi
try{
    $koneksi = new PDO($dns, $user, $pass, $errmode);

}catch(PDOException $e){
    echo "Error: ". $e->getMessage();
}
?>