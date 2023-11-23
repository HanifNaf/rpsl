<?php
//Include session_start in config.php
require_once(realpath(dirname(dirname(__FILE__)))."/config/config.php");

if(!isset($_SESSION['logged_in'])){
    setcookie("Access Error", "Belum login, silahkan login!", time()+3);
    header("location:../index.php");
}
?>