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
$data_json = json_encode($boiler_arr);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PEMAKAIAN CHEMICAL BOILER</title>
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
                { data: 'alkalinity_booster' },
                { data: 'oxygen_scavenger' },
                { data: 'internal_treatment' },
                { data: 'condensate_treatment' },
				{ data: 'solid_additive' },
				{ data: 'm3_air' },
				{ data: 'cost_solid_additive', 
				render: function(data, type, row){ //kolom cost harian
					var cost_alkalinity_booster = (row.cost_alkalinity_booster || 0)*row.alkalinity_booster;
        			var cost_oxygen_scavenger = (row.cost_oxygen_scavenger || 0)*row.oxygen_scavenger;
        			var cost_internal_treatment = (row.cost_internal_treatment || 0)*row.internal_treatment;
        			var cost_condensate_treatment = (row.cost_condensate_treatment || 0)*row.condensate_treatment;
        			var cost_solid_additive = (row.cost_solid_additive || 0)*row.solid_additive;

					return "Rp."+Math.round((cost_alkalinity_booster+cost_oxygen_scavenger+cost_internal_treatment+cost_condensate_treatment+cost_solid_additive))
				} }, 
				{ data: 'm3_air',
				render: function(data, type, row){
					var cost_alkalinity_booster = (row.cost_alkalinity_booster || 0)*row.alkalinity_booster;
        			var cost_oxygen_scavenger = (row.cost_oxygen_scavenger || 0)*row.oxygen_scavenger;
        			var cost_internal_treatment = (row.cost_internal_treatment || 0)*row.internal_treatment;
        			var cost_condensate_treatment = (row.cost_condensate_treatment || 0)*row.condensate_treatment;
        			var cost_solid_additive = (row.cost_solid_additive || 0)*row.solid_additive;

					return "Rp."+Math.round((cost_alkalinity_booster+cost_oxygen_scavenger+cost_internal_treatment+cost_condensate_treatment+cost_solid_additive)/row.m3_air)
 				}}, //kolom cost/m3,
                {
                    "data": null,
                    "render": function(data, type, row, meta) {
                        var encodedID = encodeURIComponent(row.boiler_id);
                        var editButton = '<a href="boiler_edit.php?boiler_id=' + encodedID + '" class="btn btn-success btn-custom d-flex justify-content-center align-items-center">Edit</a>';
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
            window.location.href = "boiler_harga";
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
            window.location.href = "boiler_input";
        });
    });
</script>
</script>
<script>
    function confirmDelete(boilerID) {
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
                window.location.href = 'boiler_delete.php?boiler_id=' + boilerID;
            }
        });
    }
</script>

</head>

<body class="container-fluid">
    <center><h3>PEMAKAIAN CHEMICAL BOILER</h3></center>
    <br>
    <!-- Menampilkan tabel -->
    <table id="myTable" class="table table-bordered">
        <!--Header Tabel berwarna gelap-->    
		<thead class="thead-dark">
				<tr class="text-center">
					<tr>
			        	<th rowspan="2">No.</th>
						<th rowspan="2">Tanggal</th>
						<th colspan="5">Pemakaian Chemical</th>
			        	<th rowspan="2">Meteran Air(m<sup>3</sup>)</th>
						<th rowspan="2">Cost Harian</th>
			        	<th rowspan="2">Cost/m<sup>3</sup></th>
			        	<th rowspan="2">Opsi</th>
			        </tr>
			        <tr>
			        	<!-- Pemakaian Chemical -->
				        <th>Alkalinity Boster<br>(S–2001)</th>
				        <th>Oxygen Scavenger<br>(S-2101)</th>
				        <th>Internal Treatment<br>(S-2201)</th>
				        <th>Condensate Treatment<br>(S-2301)</th>
				        <th>Solid Additive<br>(S-6001)</th>
			       	</tr>
                </tr>
        </thead>
    </table>
</body>
</html>