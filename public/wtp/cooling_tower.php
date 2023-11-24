<?php
require_once("../../config/config.php");

// Cek role
if (!in_array($_SESSION['role'], ['wtp', 'admin', 'manager'])) {
    echo "<p style='color: white;'>Akses Dibatasi. Anda tidak memiliki izin yang cukup.</p>";

    // Menambahkan skrip SweetAlert untuk notifikasi yang lebih menarik
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Dibatasi',
                text: 'Anda tidak memiliki izin yang cukup.',
            }).then(function() {
                window.location.href = '../index.php';
            });
        </script>
    ";

    die(); // Menghentikan eksekusi skrip setelah menampilkan pesan dan notifikasi
}

require_once(SITE_ROOT."/src/header-admin.php");
require_once(SITE_ROOT."/src/footer-admin.php");
require_once("wtp_data.php");

// Konversi data menjadi format JSON
$data_json = json_encode($ct_arr);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEMAKAIAN CHEMICAL COOLING TOWER</title>
    <style>
    body {
        font-family: Arial, sans-serif;
    }
    .btn-custom {
        width: 60px; /* Adjust the width as needed */
        /* Add any other styles as needed */
    }
</style>

    <!-- Inisialisasi variabel JSON -->
    <script>
        var jsonData = <?php echo $data_json; ?>;
    </script>


    <!-- Inisialisasi DataTables -->
   <script>
    console.log(jsonData);
    $(document).ready(function () {
        // Menambah nomor ke setiap objek
        for (var i = 0; i < jsonData.length; i++) {
            jsonData[i].nomor = i + 1;
        }

        $('#myTable').DataTable({
            data: jsonData,
            columns: [
                { data: 'nomor', title: 'No' }, // Menambah kolom nomor
                { data: 'tanggal' },
                { data: 'corrotion_inhibitor' },
                { data: 'cooling_water_dispersant' },
                { data: 'oxy_hg' },
				{ data: 'sulphuric_acid'},
				{ data: null,
				render: function(data, type, row){
					var cost_corrotion_inhibitor = (row.cost_corrotion_inhibitor || 0) * row.corrotion_inhibitor;
					var cost_cooling_water_dispersant = (row.cost_cooling_water_dispersant || 0) * row.cooling_water_dispersant ;
					var cost_oxy_hg = (row.cost_oxy_hg || 0) * row.oxy_hg;
					var cost_sulphuric_acid = (row.cost_sulphuric_acid || 0) * row.sulphuric_acid;

					return "Rp."+Math.round((cost_corrotion_inhibitor+cost_cooling_water_dispersant+cost_oxy_hg+cost_sulphuric_acid))
				} },
                {
                    "data": null,
                    "render": function(data, type, row, meta) {
                        var encodedID = encodeURIComponent(row.cooling_tower_id);
                        var editButton = '<a href="cooling_tower_edit.php?cooling_tower_id=' + encodedID + '" class="btn btn-warning btn-custom d-flex justify-content-center align-items-center">Edit</a>';
                        var deleteButton = '<button class="btn btn-danger btn-custom d-flex justify-content-center align-items-center" onclick="confirmDelete(\'' + encodedID + '\')">Hapus</button>';
                        return editButton + deleteButton;
                    }
                }
            ],
            "dom": 'Bfrtip',
            "buttons": [
                {
                    extend: 'excel', className: 'btn-info',
                    exportOptions: {
                        columns: ':visible:not(:last-child)' // Exclude the last visible column (Opsi column)
                    }
                },
                {
                    extend: 'pdf', className: 'btn-info',
                    exportOptions: {
                        columns: ':visible:not(:last-child)' // Exclude the last visible column (Opsi column)
                    }
                },
                {
                    extend: 'print', className: 'btn-info',
                    exportOptions: {
                        columns: ':visible:not(:last-child)' // Exclude the last visible column (Opsi column)
                    }
                }
            ]
        });

        // Tambahkan tombol Tambah Data
        var tambahButton = '<button id="tambahButton" class="btn btn-info">Tambah Data</button>';
                $('.dt-buttons').append(tambahButton); // Menambahkan tombol ke div dt-buttons

                // Style untuk menengahkan tombol Tambah Data
                var buttonMargin = 'auto'; // Sesuaikan dengan margin yang diinginkan atau gunakan 'auto' untuk tengah
                $('#tambahButton').css({
                    'margin-left': '10px',  // Sesuaikan dengan jarak yang diinginkan dari tombol sebelumnya
                    'margin-right': buttonMargin,
                });

        // Center-align the text in the header cells
        $('#myTable thead th, #myTable tbody td').css('text-align', 'center');
        
        // Atur aksi klik untuk tombol Tambah Data
        $('#tambahButton').on('click', function() {
            window.location.href = "cooling_tower_input";
        });
    });
</script>
<script>
    function confirmDelete(coolingtowerID) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data akan dihapus permanen!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                window.location.href = 'cooling_tower_delete.php?cooling_tower_id=' + coolingtowerID;
            }
        });
    }
</script>

</head>
<body class="container-fluid">
    <center><h3> DATA PEMAKAIAN CHEMICAL COOLING TOWER</h3></center>
    <br>
    <!-- Menampilkan tabel -->
    <table id="myTable" class="table table-bordered">
        <!--Header Tabel berwarna gelap-->    
		<thead class="thead-dark">
				<tr class="text-center">
				<tr>
			    	<th rowspan="2">No.</th>
					<th rowspan="2">Tanggal</th>
					<th colspan="4">Pemakaian Chemical</th>
					<th rowspan="2">Cost Harian</th>
			    	<th rowspan="2">Opsi</th>
			    </tr>
			    <tr>
			    	<!-- Pemakaian Chemical -->
				    <th>Corrotion Inhibitor<br>(S-3006)</th>
				    <th>Cooling Water Dispersant<br>(S-3104)</th>
				    <th>OXY HG<br>(S-1450)</th>
					<th>Sulfuric Acid<br>(H2SO4)</th>
			    </tr>
                </tr>
        </thead>
    </table>
</body>
</html>