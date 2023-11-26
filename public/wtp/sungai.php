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
$data_json = json_encode($sungai_arr);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA PEMAKAIAN CHEMICAL SUNGAI</title>
    <style>
  .btn-container {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .btn-container .btn {
    margin-right: 5px; /* Adjust the margin to add space between buttons */
  }

  .btn-container .btn-danger,
  .btn-container .btn-success {
    font-size: 12px; /* Adjust the font size as needed */
    width: 60px;
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
				{ data: 'koagulan' },
                { data: 'soda_ash'},
                { data: 'flokulan' },
				{ data: 'm3_air'},
				{ data: null,
				render: function(data, type, row){ //Cost per hari

					var cost_koagulan = (row.cost_koagulan || 0) * row.koagulan;
					var cost_soda_ash = (row.cost_soda_ash || 0) * row.soda_ash;
					var cost_flokulan = (row.cost_flokulan || 0) * row.flokulan;

					return "Rp."+Math.round((cost_koagulan+cost_soda_ash+cost_flokulan));
				} },
				{ data: null,
				render: function(data, type, row){ //Cost per m3
					
					var cost_koagulan = (row.cost_koagulan || 0) * row.koagulan;
					var cost_soda_ash = (row.cost_soda_ash || 0) * row.soda_ash;
					var cost_flokulan = (row.cost_flokulan || 0) * row.flokulan;

					return "Rp."+Math.round((cost_koagulan+cost_soda_ash+cost_flokulan)/row.m3_air);
				} },
                {
                    "data": null,
                    "render": function(data, type, row, meta) {
                        var encodedID = encodeURIComponent(row.sungai_id);
                        var editButton = '<a href="sungai_edit.php?sungai_id=' + encodedID + '" class="btn btn-success btn-custom d-flex justify-content-center align-items-center">Edit</a>';
                        var deleteButton = '<button class="btn btn-danger btn-custom d-flex justify-content-center align-items-center" onclick="confirmDelete(\'' + encodedID + '\')">Hapus</button>';
                        return '<div class="btn-container">' + editButton + deleteButton + '</div>';
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

        // Tambahkan tombol Edit Harga Chemical
        var editChemicalButton = '<button id="editChemicalButton" class="btn btn-info">Edit Harga</button>';
                $('.dt-buttons').append(editChemicalButton); // Menambahkan tombol ke div dt-buttons

                // Style untuk menengahkan tombol Edit Harga Chemical
                var buttonMargin = 'auto'; // Sesuaikan dengan margin yang diinginkan atau gunakan 'auto' untuk tengah
                $('#editChemicalButton').css({
                    'margin-left': '10px',  // Sesuaikan dengan jarak yang diinginkan dari tombol sebelumnya
                    'margin-right': buttonMargin,
                });

        // Center-align the text in the header cells
        $('#myTable thead th, #myTable tbody td').css('text-align', 'center');
        
        // Atur aksi klik untuk tombol Edit Harga Chemical
        $('#editChemicalButton').on('click', function() {
            window.location.href = "sungai_harga";
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
            window.location.href = "sungai_input";
        });
    });
</script>
<script>
    function confirmDelete(sungaiID) {
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
                window.location.href = 'sungai_delete.php?sungai_id=' + sungaiID;
            }
        });
    }
</script>

</head>
<body class="container-fluid">
    <center><h3>DATA PEMAKAIAN CHEMICAL SUNGAI</h3></center>
    <br>
    <!-- Menampilkan tabel -->
    <table id="myTable" class="table table-bordered">
        <!--Header Tabel berwarna gelap-->    
		<thead class="thead-dark">
				<tr class="text-center">
					<tr>
			    		<th rowspan="2">No.</th>
						<th rowspan="2">Tanggal</th>
						<th colspan="3">Pemakaian Chemical</th>
			    		<th rowspan="2">Meteran Air(m<sup>3</sup>)</th>
						<th rowspan="2">Cost Harian</th>
			    		<th rowspan="2">Cost/m<sup>3</sup></th>
			    		<th rowspan="2">Opsi</th>
			    	</tr>
			    	<tr>
			    		<!-- Pemakaian Chemical -->
					    <th>Koagulan<br>(S-1009)</th>
					    <th>Soda<br>(Ash)</th>
					    <th>Flokulan<br>(S-1101)</th>
			    	</tr>
                </tr>
        </thead>
    </table>
</body>
</html>