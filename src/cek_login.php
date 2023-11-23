<?php 
require_once("../config/config.php");
require_once(SITE_ROOT. "/src/koneksi.php");

if(isset($_REQUEST['username'], $_REQUEST['password'])){
	$username 	= $_REQUEST['username'];
	$password	= $_REQUEST['password'];

	//Query database users
	$query = "SELECT users_id, username, password, role
			FROM users
			WHERE username= :uname;";
	$prep = $koneksi_users->prepare($query);

	try{
		$prep->execute(array(":uname"=>$username));

		$data = $prep->fetch(PDO::FETCH_ASSOC);

		if($data){
			$stored_hash = $data['password'];

			if(password_verify($password, $stored_hash)){
				session_start();
				$_SESSION['name'] = $data['username'];
				$_SESSION['id'] = $data['users_id'];
				$_SESSION['role'] = $data['role'];
				$_SESSION['logged_in'] = true;
				header("location:../public/index.php");

			} else{
				setcookie("login_error", "Password tidak sesuai, silahkan coba kembali!", time()+3);
				header("location: ../index.php");			
			}
	
		} else{
			setcookie("login_error", "Pengambilan data gagal, silahkan coba kembali!", time()+3);
			header("location: ../index.php");
		}

	} catch(PDOException $e){
		echo "PDO ERROR: ". $e->getMessage();
	}

} else{
	setcookie("login_error", "Request Invalid, silahkan coba kembali!", time()+3);
	header("location: ../index.php");
}	

?>
