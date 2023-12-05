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
<iframe title="Dashboard Operasional" src="https://app.powerbi.com/reportEmbed?reportId=1c59b26a-33e4-4963-b98a-d53402115ae7&autoAuth=true&ctid=a1fe51c7-a2dc-4275-be53-27bd31e8c551&navContentPaneEnabled=false" navContentPaneEnabled=false frameborder="0" allowFullScreen="true" marginwidth="0" marginheight="0"></iframe>
</body>