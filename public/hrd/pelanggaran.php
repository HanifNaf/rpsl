<?php
require_once("../../config/config.php");
require_once("hrd_data.php");
require_once(SITE_ROOT . "/src/header-admin.php");
require_once(SITE_ROOT . "/src/footer-admin.php");

// Konversi data menjadi format JSON
$data_json = json_encode($hrd_arr);
// Tampilkan semua jenis error
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRD</title>
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
                { data: 'nik' },
                { data: 'nama' },
                { data: 'bagian' },
                { data: 'shift' },
                { data: 'waktu_pelanggaran' },
                { data: 'tempat_pelanggaran' },
                { data: 'bentuk_pelanggaran' },
                { data: 'potensi_bahaya' },
                { data: 'sanksi' },
                { data: 'lampiran' },
                {
                    "data": null,
                    "render": function(data, type, row, meta) {
                        var editButton = '<a href="pelanggaran_edit' + data.pelanggaran_id + '" class="btn btn-warning btn-custom d-flex justify-content-center align-items-center">Edit</a>';
                        var deleteButton = '<a href="pelanggaran_delete' + data.pelanggaran_id + '" class="btn btn-danger btn-custom d-flex justify-content-center align-items-center" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">Hapus</a>';
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
            window.location.href = "pelanggaran_input";
        });
    });
</script>

</head>

<body class="container-fluid">
    <center><h3>DATA KECELAKAAN KERJA</h3></center>
    <br>
    <!-- Menampilkan tabel -->
    <table id="myTable" class="table table-bordered">
        <!-- Header Tabel berwarna gelap -->
        <thead class="thead-dark">
            <tr class="text-center">
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Tanggal</th>
                    <th rowspan="2">NIK</th>
                    <th rowspan="2">Nama</th>
                    <th rowspan="2">Bagian</th>
                    <th rowspan="2">Shift</th>
                    <th colspan="4">Pelanggaran</th>
                    <th rowspan="2">Sanksi</th>
                    <th rowspan="2">Lampiran</th>
                    <th rowspan="2">Opsi</th>
                </tr>
                <tr>
                    <!-- Pelanggaran -->
                    <th>Waktu</th>
                    <th>Tempat</th>
                    <th>Bentuk Pelanggaran</th>
                    <th>Potensi Bahaya</th>
                </tr>
        </thead>
    </table>
</body>
</html>
