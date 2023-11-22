<?php
require_once("../../config/config.php");
require_once("operasional_data.php");
require_once(SITE_ROOT . "/src/header-admin.php");
require_once(SITE_ROOT . "/src/footer-admin.php");

// Konversi data menjadi format JSON
$data_json = json_encode($operasional_arr);

// Tampilkan semua jenis error
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPERASIONAL</title>
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
                { data: 'shift' },
                { data: 'generation' },
                { data: 'pm_kwh_pltbm' },
                { data: 'ekspor' },
                { data: 'pemakaian_sendiri' },
                { data: 'kwh_loss' },
                { data: 'kg_cangkang' },
                { data: 'kg_palmfiber' },
                { data: 'kg_woodchips' },
                { data: 'kg_serbukkayu' },
                { data: 'kg_sabutkelapa' },
                { data: 'kg_efbpress' },
                { data: 'kg_opt' },
                { data: 'supervisor' },
                { data: 'keterangan' },
                {
                    "data": null,
                    "render": function(data, type, row, meta) {
                        var editButton = '<a href="operasional_edit.php?operasional_id=' + data.operasional_id + '?produksi_id=' + data.produksi_id + '?pemakaian_id=' + data.pemakaian_id + '?bahan_bakar_id=' + data.pemakaian_bahan_bakar_id + '" class="btn btn-warning btn-custom d-flex justify-content-center align-items-center">Edit</a>';
                        var deleteButton = '<a href="operasional_delete.php?operasional_id=' + data.operasional_id + '?produksi_id=' + data.produksi_id + '?pemakaian_id=' + data.pemakaian_id + '?bahan_bakar_id=' + data.pemakaian_bahan_bakar_id + '" class="btn btn-danger btn-custom d-flex justify-content-center align-items-center" onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\')">Hapus</a>';
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
            window.location.href = "operasional_input";
        });
    });
</script>

</head>

<body class="container-fluid">
    <center><h3>OPERASIONAL</h3></center>
    <br>
    <!-- Menampilkan tabel -->
    <table id="myTable" class="table table-bordered">
        <!-- Header Tabel berwarna gelap -->
        <thead class="thead-dark">
            <tr class="text-center">
                <th>No.</th>
                <th>Tanggal</th>
                <th>Shift</th>
                <th>Generasi</th>
                <th>PM Kwh PLTBM</th>
                <th>Ekspor</th>
                <th>Pemakaian Sendiri</th>
                <th>Kwh Loss</th>
                <th>Pemakaian Cangkang (kg)</th>
                <th>Pemakaian Palm Fiber (kg)</th>
                <th>Pemakaian Wood Chips (kg)</th>
                <th>Pemakaian Serbuk Kayu (kg)</th>
                <th>Pemakaian Sabut Kelapa (kg)</th>
                <th>Pemakaian EFB Press (kg)</th>
                <th>Pemakaian OPT (kg)</th>
                <th>Supervisor</th>
                <th>Keterangan</th>
                <th>Opsi</th>
            </tr>
        </thead>
    </table>
</body>
</html>
