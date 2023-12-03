<?php
require_once("../../config/config.php");
require_once("maintenance_data.php");
require_once(SITE_ROOT . "/src/header-admin.php");
require_once(SITE_ROOT . "/src/footer-admin.php");

// Konversi data menjadi format JSON
$data_json = json_encode($maintenance_arr);
?>

<!-- Inisialisasi variabel JSON -->
<script>
    var jsonData = <?php echo $data_json; ?>;
</script>

<!-- Inisialisasi Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Inisialisasi DataTables -->
<script>
    $(document).ready(function () {
        // ... (Bagian lain dari inisialisasi DataTables)

        // Tambahkan div untuk grafik batang Jumlah Maintenance
        var barChartContainer = '<div style="width: 20%; margin: auto; border: 1px solid #ccc; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"><canvas id="barChart"></canvas></div>';
        $('body').append(barChartContainer);

        // Inisialisasi data untuk grafik batang Jumlah Maintenance
        var divisiData = [];
        var jumlahData = [];

        for (var i = 0; i < jsonData.length; i++) {
            var divisi = jsonData[i].divisi;

            if (!divisiData.includes(divisi)) {
                divisiData.push(divisi);
            }

            var jumlah = jumlahData[divisiData.indexOf(divisi)] || 0;
            jumlahData[divisiData.indexOf(divisi)] = jumlah + 1;
        }

        // Tampilkan data menggunakan Chart.js (grafik batang Jumlah Maintenance)
        var barChartCtx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(barChartCtx, {
            type: 'bar',
            data: {
                labels: divisiData,
                datasets: [{
                    label: 'Jumlah Maintenance',
                    data: jumlahData,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1, // Add or adjust this line to set the border width
                    borderRadius: 4 // Add this line to set the border radius
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Tambahkan div untuk grafik donut Selesai/Sedang Berlangsung
        var donutChartContainer = '<div style="width: 20%; margin: auto; border: 1px solid #ccc; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"><canvas id="donutChart"></canvas></div>';
        $('body').append(donutChartContainer);

        // Inisialisasi data untuk grafik donut Selesai/Sedang Berlangsung
        var statusData = [];
        var jumlahStatus = [];

        for (var i = 0; i < jsonData.length; i++) {
            var status = jsonData[i].status;

            if (!statusData.includes(status)) {
                statusData.push(status);
            }

            var jumlah = jumlahStatus[statusData.indexOf(status)] || 0;
            jumlahStatus[statusData.indexOf(status)] = jumlah + 1;
        }

        // Tampilkan data menggunakan Chart.js (grafik donut Selesai/Sedang Berlangsung)
        var donutChartCtx = document.getElementById('donutChart').getContext('2d');
        var donutChart = new Chart(donutChartCtx, {
            type: 'doughnut',
            data: {
                labels: statusData,
                datasets: [{
                    data: jumlahStatus,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1 // Add or adjust this line to set the border width
                }]
            }
        });

        // Tambahkan div untuk grafik batang Major/Minor
        var majorMinorChartContainer = '<div style="width: 20%; margin: auto; border: 1px solid #ccc; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);"><canvas id="majorMinorChart"></canvas></div>';
        $('body').append(majorMinorChartContainer);

        // Inisialisasi data untuk grafik batang Major/Minor
        var majorMinorData = {
            'Major': 0,
            'Minor': 0
        };

        for (var i = 0; i < jsonData.length; i++) {
            var tingkatKerusakan = jsonData[i].tingkat_kerusakan;

            if (tingkatKerusakan === 'Major') {
                majorMinorData['Major']++;
            } else if (tingkatKerusakan === 'Minor') {
                majorMinorData['Minor']++;
            }
        }

        // Tampilkan data menggunakan Chart.js (grafik batang Major/Minor)
        var majorMinorChartCtx = document.getElementById('majorMinorChart').getContext('2d');
        var majorMinorChart = new Chart(majorMinorChartCtx, {
            type: 'bar',
            data: {
                labels: Object.keys(majorMinorData),
                datasets: [{
                    label: 'Tingkat Kerusakan',
                    data: Object.values(majorMinorData),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1 // Add or adjust this line to set the border width
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // ... (Bagian lain dari inisialisasi DataTables)
    });
</script>
