<?php
require_once ("../../config/config.php");

// Cek role
if (!in_array($_SESSION['role'], ['elektrikal', 'wtp', 'mekanikal', 'admin', 'manager'])) {
    print_r($_SESSION);
    header("location: ../index.php");
}

require_once("maintenance_data.php");
require_once(SITE_ROOT. "/src/header-admin.php");
require_once(SITE_ROOT. "/src/footer-admin.php");

// Konversi data menjadi format JSON
$data_json = json_encode($maintenance_arr);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAINTENANCE</title>
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
                { data: 'divisi' },
                { data: 'unit' },
                { data: 'problem' },
                { data: 'evaluasi' },
                { data: 'penanganan' },
				{ data: 'sparepart' },
				{ data: 'jumlah_sparepart' },
				{ data: 'satuan_sparepart' },
                { data: 'tingkat_kerusakan' },
                { data: 'tanggal_mulai' },
                { data: 'tanggal_selesai' },
                { data: 'status' },
				{ data: 'keterangan' },
				{ data: 'nama',
				  render: function(data, type, row) {
					if (data){
						var encodedLampiranId = encodeURIComponent(row.lampiran_id);
						return '<a href="maintenance_lampiran.php?id='+ encodedLampiranId +'" target="_blank">'+ data +'</a>';
				}else{
					return data;
				}
				  }},
                {
                    "data": null,
                    "render": function(data, type, row, meta) {
                        var encodedID = encodeURIComponent(row.maintenance_id);
                        var editButton = '<a href="maintenance_edit.php?maintenance_id=' + encodedID + '" class="btn btn-warning btn-custom d-flex justify-content-center align-items-center">Edit</a>';
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
            window.location.href = "maintenance_input";
        });
    });
</script>
<script>
    function confirmDelete(maintenanceID) {
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
                window.location.href = 'maintenance_delete.php?maintenance_id=' + maintenanceID;
            }
        });
    }
</script>


</head>

<body class="container-fluid">
    <center><h3> DATA MAINTENANCE</h3></center>
    <br>
    <!-- Menampilkan tabel -->
    <table id="myTable" class="table table-bordered">
        <!-- Header Tabel berwarna gelap -->
        <thead class="thead-dark">
            <tr class="text-center">
                <th rowspan="2">No</th> <!-- Kolom Nomor -->
                <th rowspan="2">Divisi</th>
                <th rowspan="2">Unit</th>
                <th rowspan="2">Problem</th>
                <th rowspan="2">Evaluasi</th>
                <th rowspan="2">Penanganan</th>
				<th colspan="3">Sparepart</th>
                <th rowspan="2">Tingkat Kerusakan</th>
                <th colspan="2">Tanggal</th>
                <th rowspan="2">Status</th>
				<th rowspan="2">Keterangan</th>
				<th rowspan="2">Lampiran</th>
                <th rowspan="2">Opsi</th>
            </tr>
            <tr>
                <!-- Sparepart -->
                <th>Sparepart</th>
                <th>Quantity</th>
				<th>Satuan</th>

                <!-- Tanggal -->
                <th>Mulai</th>
                <th>Selesai</th>
            </tr>
        </thead>
    </table>
</body>
</html>
