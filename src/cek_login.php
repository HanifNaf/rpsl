<?php 
require_once("../config/config.php");
require_once(SITE_ROOT. "/src/koneksi.php");

if(isset($_REQUEST['username'], $_REQUEST['password'])){
    $username   = $_REQUEST['username'];
    $password   = $_REQUEST['password'];

    //Query database users
    $query = "SELECT users_id, username, password, role
            FROM users
            WHERE username= :uname;";
    $prep = $koneksi->prepare($query);

    try{
        $prep->execute(array(":uname"=>$username));

        //Fetch data sesuai username
        $data = $prep->fetch(PDO::FETCH_ASSOC);

        //cek jika fetch berhasil
        if($data){
            $stored_hash = $data['password'];

            //cek jika password sesuai
            if(password_verify($password, $stored_hash)){

                //mulai session 
                session_start();
                $_SESSION['name'] = $data['username'];
                $_SESSION['id'] = $data['users_id'];
                $_SESSION['role'] = $data['role'];
                $_SESSION['logged_in'] = true;

                //mengarahkan ke index
                header("location:../public/index.php");

            } else{
                setcookie("login_error", "Password tidak sesuai, silahkan coba kembali!", time()+3);

                echo "<p style='color: white;'>Akses Dibatasi. Anda tidak memiliki izin yang cukup.</p>";
                // Menambahkan skrip SweetAlert untuk notifikasi yang lebih menarik
                echo "
                    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Login Gagal',
                            text: 'Password tidak sesuai, silahkan coba kembali!',
                        }).then(function() {
                            window.location.href = '../index.php';
                        });
                    </script>
                ";
                die(); // Menghentikan eksekusi skrip setelah menampilkan pesan dan notifikasi
            }

        } else{
            setcookie("login_error", "Username tidak sesuai, silahkan coba kembali!", time()+3);

            echo "<p style='color: white;'>Akses Dibatasi. Anda tidak memiliki izin yang cukup.</p>";
            // Menambahkan skrip SweetAlert untuk notifikasi yang lebih menarik
            echo "
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Gagal',
                        text: 'Username tidak sesuai, silahkan coba kembali!',
                    }).then(function() {
                        window.location.href = '../index.php';
                    });
                </script>
            ";
            die(); // Menghentikan eksekusi skrip setelah menampilkan pesan dan notifikasi
        }

    } catch(PDOException $e){
        echo "PDO ERROR: ". $e->getMessage();
    }

} else{
    setcookie("login_error", "Request Invalid, silahkan coba kembali!", time()+3);

    echo "<p style='color: white;'>Akses Dibatasi. Anda tidak memiliki izin yang cukup.</p>";
    // Menambahkan skrip SweetAlert untuk notifikasi yang lebih menarik
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: 'Request Invalid, silahkan coba kembali!',
            }).then(function() {
                window.location.href = '../index.php';
            });
        </script>
    ";
    die(); // Menghentikan eksekusi skrip setelah menampilkan pesan dan notifikasi
}   

?>
