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

    <!-- Add DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css">

    <!-- Add DataTables JavaScript -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>

    <!-- DataTables Initialization -->
    <script>
        var jsonData = <?php echo $data_json; ?>;
        
        $(document).ready(function () {
            for (var i = 0; i < jsonData.length; i++) {
                jsonData[i].nomor = i + 1;
            }

            var table = $('#myTable').DataTable({
                data: jsonData,
                columns: [
                    { data: 'nomor', title: 'No' },
                    { data: 'tanggal' },
                    { data: 'nik' },
                    { data: 'nama_hrd' },
                    { data: 'bagian' },
                    { data: 'shift' },
                    { data: 'waktu_pelanggaran' },
                    { data: 'tempat_pelanggaran' },
                    { data: 'bentuk_pelanggaran' },
                    { data: 'potensi_bahaya' },
                    { data: 'sanksi' },
                    { data: 'nama_lampiran',
                        render: function(data, type, row) {
                            if (data) {
                                var encodedLampiranId = encodeURIComponent(row.lampiran_id);
                                return '<a href="pelanggaran_lampiran.php?id=' + encodedLampiranId + '" target="_blank">' + data + '</a>';
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        "data": null,
                        "render": function(data, type, row, meta) {
                            var encodedID = encodeURIComponent(row.hrd_id);
                            var editButton = '<a href="pelanggaran_edit.php?hrd_id=' + encodedID + '" class="btn btn-warning btn-custom d-flex justify-content-center align-items-center">Edit</a>';
                            var deleteButton = '<button class="btn btn-danger btn-custom d-flex justify-content-center align-items-center" onclick="confirmDelete(\'' + encodedID + '\')">Hapus</button>';
                            return editButton + deleteButton;
                        }
                    }
                ],
                "dom": 'Blfrtip',
                "buttons": [
                    'excel', 'pdf', 'print'
                ],
                fixedHeader: true
            });

            // Style the DataTables search, length, and info elements
            $('.dataTables_filter, .dataTables_length, .dataTables_info').addClass('mt-3');

            // Style for the buttons
            $('.dt-buttons').addClass('mt-3');

            // Add custom styles to the search input
            $('div.dataTables_filter input').addClass('form-control');

            // Add custom styles to the pagination
            $('div.dataTables_paginate').addClass('mt-3');

            // Add 'Tambah Data' button
            var tambahButton = '<button id="tambahButton" class="btn btn-info mt-3">Tambah Data</button>';
            $('.dt-buttons').append(tambahButton);

            // Center-align the text in the header cells
            $('#myTable thead th, #myTable tbody td').css('text-align', 'center');

            // Add click event for 'Tambah Data' button
            $('#tambahButton').on('click', function() {
                window.location.href = "pelanggaran_input";
            });
        });

        function confirmDelete(hrdID) {
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
                    window.location.href = 'pelanggaran_delete.php?hrd_id=' + hrdID;
                }
            });
        }
    </script>
</head>

<body class="container-fluid">
    <center>
        <h3>DATA PELANGGARAN</h3>
    </center>
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
