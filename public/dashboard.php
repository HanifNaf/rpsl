<?php 
require_once("../config/config.php");

// Cek role
if (!in_array($_SESSION['role'], ['manager', 'admin'])) {
    echo "<p style='color: white;'>Akses Dibatasi. Anda tidak memiliki izin yang cukup.</p>";

    // Menambahkan skrip SweetAlert untuk notifikasi yang lebih menarik
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Dibatasi',
            }).then(function() {
                window.location.href = 'index.php';
            });
        </script>
    ";
}

require_once(SITE_ROOT."/src/header-admin.php");

?>

<head>
    <style>
    body, html {
    margin: 0;
    padding: 0;
    height: 100%;
}

body {
  background: url("assets/img/inde.png")
    no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  font-family: "HelveticaNeue", "Arial", sans-serif;
  }


    </style>
    <script>
        $(document).ready(function () {                            
            // Set the size of the iframe to 100% of the screen width and height
            var screenWidth = window.innerWidth ||
                document.documentElement.clientWidth ||
                document.body.clientWidth;
            var screenHeight = window.innerHeight ||
                document.documentElement.clientHeight ||
                document.body.clientHeight;
            // Set the iframe dimensions
            var iframe = $("iframe");
            iframe.attr("width", screenWidth-20);
            iframe.attr("height", screenHeight-50);
        });


    </script>
</head>

<body>
<iframe title="Dashboard Operasional" src="https://app.powerbi.com/view?r=eyJrIjoiNjIzNDkzZWEtZjlhNy00ODU5LTkzZjItM2M4OTExYzU1MDAxIiwidCI6ImExZmU1MWM3LWEyZGMtNDI3NS1iZTUzLTI3YmQzMWU4YzU1MSIsImMiOjEwfQ%3D%3D" navContentPaneEnabled=false frameborder="0" allowFullScreen="true" marginwidth="0" marginheight="0"></iframe>
</body>