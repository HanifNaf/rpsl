<?php 
session_start();
require_once("koneksi.php");

	$username 	= $_REQUEST['username'];
	$password	= $_REQUEST['password'];

	$query = pg_query($koneksi_operasional, "SELECT * FROM users WHERE username='$username' AND password='$password'");
	$cek  = pg_num_rows($query);

	//echo $cek;

	if($cek>0){
		$_SESSION['username'] = $username;
		header("location:admin/index");	
	}else{
		header("location:gagal");
	}			
?>
