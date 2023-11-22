<?php
require_once ("../../config/config.php");
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
    <title>JADWAL MAINTENANCE</title>
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
                        var editButton = '<a href="maintenance_edit/' + data.maintenance_id + '" class="btn btn-warning btn-custom d-flex justify-content-center align-items-center">Edit</a>';
                        var deleteButton = '<a href="maintenance_delete/' + data.maintenance_id + '" class="btn btn-danger btn-custom d-flex justify-content-center align-items-center" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">Hapus</a>';
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
        $('#tambahButton').css({
            'margin-left': '380px', // Sesuaikan dengan margin yang diinginkan
            'margin-right': '380px', // Sesuaikan dengan margin yang diinginkan
        });

        // Center-align the text in the header cells
        $('#myTable thead th, #myTable tbody td').css('text-align', 'center');
        
        // Atur aksi klik untuk tombol Tambah Data
        $('#tambahButton').on('click', function() {
            window.location.href = "operasional_maintenance_input";
        });
    });
</script>

</head>

<body class="container-fluid">
    <center><h3>JADWAL MAINTENANCE</h3></center>
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
                <!-- Tanggal -->
                <th>Before</th>
                <th>After</th>

				<!-- Sparepart -->
                <th>Sparepart</th>
                <th>Quantity</th>
				<th>Satuan</th>
            </tr>
        </thead>
    </table>
</body>
</html>
