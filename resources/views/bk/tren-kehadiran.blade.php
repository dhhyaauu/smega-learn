
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tren Kehadiran | SMEGA Learn</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f7ff;
            color: #26364d;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: linear-gradient(160deg, #3478f6, #2147b8);
            padding: 27px 17px;
            color: white;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 35px;
            padding: 0 8px;
        }

        .brand-icon {
            background: white;
            color: #2860d8;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 20px;
        }

        .brand h2 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .brand p {
            color: #d9e6ff;
            font-size: 10px;
        }

        .menu-title {
            color: #c5d8ff;
            font-size: 10px;
            letter-spacing: 1.4px;
            margin: 0 10px 13px;
        }

        .menu {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #e1eaff;
            text-decoration: none;
            padding: 13px;
            border-radius: 10px;
            font-size: 12px;
            margin-bottom: 6px;
        }

        .menu i {
            width: 19px;
            text-align: center;
        }

        .menu:hover {
            background: rgba(255,255,255,.13);
        }

        .menu.active {
            background: white;
            color: #2860d8;
            font-weight: bold;
        }

        .sidebar-note {
            margin-top: auto;
            padding: 15px;
            border-radius: 12px;
            background: rgba(255,255,255,.12);
            font-size: 11px;
            line-height: 1.7;
        }

        .main {
            margin-left: 250px;
            padding: 28px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 7px;
        }

        .muted {
            color: #8492a6;
            font-size: 12px;
            line-height: 1.7;
        }

        .profile {
            background: white;
            padding: 11px 15px;
            border: 1px solid #e5edf8;
            border-radius: 12px;
            font-size: 12px;
            white-space: nowrap;
        }

        .panel {
            background: white;
            border: 1px solid #e5edf8;
            border-radius: 15px;
            padding: 20px;
            min-width: 0;
            margin-bottom: 20px;
        }

        .panel h3 {
            font-size: 14px;
            margin-bottom: 8px;
        }

        .filters {
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 10px;
            margin-top: 18px;
        }

        select, button {
            font-family: inherit;
            font-size: 11px;
            padding: 11px;
            border: 1px solid #dce5f2;
            border-radius: 8px;
            background: white;
            min-width: 0;
        }

        button {
            border: none;
            color: white;
            background: #3478f6;
            cursor: pointer;
        }

        button:hover {
            background: #2860d8;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 22px;
        }

        .summary-card {
            background: white;
            border: 1px solid #e5edf8;
            border-radius: 14px;
            padding: 19px;
            min-width: 0;
        }

        .summary-icon {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            background: #e8f0ff;
            color: #3478f6;
            border-radius: 11px;
            margin-bottom: 13px;
        }

        .summary-label {
            color: #8492a6;
            font-size: 11px;
            margin-bottom: 8px;
        }

        .summary-number {
            font-size: 24px;
            font-weight: bold;
        }

        .summary-description {
            font-size: 10px;
            color: #8492a6;
            margin-top: 7px;
        }

        .chart-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .chart-box {
            position: relative;
            height: 290px;
            margin-top: 20px;
        }

        .chart-box.small {
            height: 260px;
        }

        .chart-title {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 10px;
        }

        .chart-title h3 {
            margin-bottom: 7px;
        }

        .chart-label {
            display: inline-block;
            background: #eef4ff;
            color: #3478f6;
            padding: 6px 9px;
            border-radius: 7px;
            font-size: 10px;
            white-space: nowrap;
        }

        .insight-list {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-top: 18px;
        }

        .insight-item {
            background: #f7f9fd;
            border: 1px solid #edf1f7;
            border-radius: 11px;
            padding: 15px;
        }

        .insight-item i {
            color: #3478f6;
            margin-bottom: 10px;
        }

        .insight-item h4 {
            font-size: 12px;
            margin-bottom: 7px;
        }

        .insight-item p {
            color: #8492a6;
            font-size: 11px;
            line-height: 1.7;
        }

        .note {
            background: #eef5ff;
            color: #476181;
            border-radius: 10px;
            padding: 13px;
            font-size: 11px;
            line-height: 1.7;
            margin-top: 16px;
        }

        @media (max-width: 1200px) {
            .summary {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .chart-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 700px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .sidebar-note {
                margin-top: 18px;
            }

            .main {
                margin-left: 0;
                padding: 18px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .summary,
            .filters,
            .insight-list {
                grid-template-columns: 1fr;
            }

            .chart-box {
                height: 250px;
            }
        }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="brand">
        <div class="brand-icon">
            <i class="fa-solid fa-graduation-cap"></i>
        </div>
        <div>
            <h2>SMEGA Learn</h2>
            <p>Learning Management System</p>
        </div>
    </div>

    <div class="menu-title">MENU BK</div>

    <a href="/bk/dashboard" class="menu">
        <i class="fa-solid fa-house"></i> Dashboard
    </a>

    <a href="/bk/kehadiran" class="menu">
        <i class="fa-solid fa-calendar-check"></i> Kehadiran
    </a>

    <a href="/bk/data-siswa" class="menu">
        <i class="fa-solid fa-users"></i> Data Siswa
    </a>

    <a href="/bk/riwayat-presensi" class="menu">
        <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Presensi
    </a>

    <a href="/bk/tren-kehadiran" class="menu active">
        <i class="fa-solid fa-chart-line"></i> Tren Kehadiran
    </a>

    <a href="/bk/tindak-lanjut" class="menu">
        <i class="fa-solid fa-clipboard-list"></i> Tindak Lanjut
    </a>

    <a href="/bk/laporan" class="menu">
        <i class="fa-solid fa-file-export"></i> Laporan
    </a>

    <div class="sidebar-note">
        <i class="fa-solid fa-circle-info"></i>
        <strong> SMEGA Learn</strong><br>
        Pemantauan kehadiran dan pembinaan siswa.
    </div>
</aside>

<main class="main">
    <header class="topbar">
        <div>
            <h1>Tren Kehadiran</h1>
            <p class="muted">
                Pantau perkembangan kehadiran siswa berdasarkan periode dan kelas.
            </p>
        </div>

        <div class="profile">
            <i class="fa-solid fa-user-tie"></i> Guru BK
        </div>
    </header>

    <section class="panel">
        <h3><i class="fa-solid fa-filter"></i> Filter Tren Kehadiran</h3>
        <p class="muted">
            Pilih periode dan kelas untuk melihat ringkasan data kehadiran.
        </p>

        <form class="filters" id="filterForm">
            <select id="filterPeriode" aria-label="Pilih periode">
                <option value="mingguan">7 Hari Terakhir</option>
                <option value="bulanan">Bulanan</option>
                <option value="semester">Semester</option>
            </select>

            <select id="filterKelas" aria-label="Pilih kelas">
                <option value="">Semua Kelas</option>
                <option value="XI RPL 1">XI RPL 1</option>
                <option value="XI RPL 2">XI RPL 2</option>
                <option value="XI TKJ 1">XI TKJ 1</option>
            </select>

            <button type="submit">
                <i class="fa-solid fa-chart-column"></i> Terapkan
            </button>
        </form>
    </section>

    <section class="summary">
        <div class="summary-card">
            <div class="summary-icon">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div class="summary-label">Persentase Kehadiran</div>
            <div class="summary-number" id="persentaseHadir">85%</div>
            <div class="summary-description">Rata-rata data contoh</div>
        </div>

        <div class="summary-card">
            <div class="summary-icon">
                <i class="fa-solid fa-user-check"></i>
            </div>
            <div class="summary-label">Hadir</div>
            <div class="summary-number" id="jumlahHadir">51</div>
            <div class="summary-description">Catatan kehadiran</div>
        </div>

        <div class="summary-card">
            <div class="summary-icon">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div class="summary-label">Terlambat</div>
            <div class="summary-number" id="jumlahTerlambat">5</div>
            <div class="summary-description">Catatan keterlambatan</div>
        </div>

        <div class="summary-card">
            <div class="summary-icon">
                <i class="fa-solid fa-user-xmark"></i>
            </div>
            <div class="summary-label">Tidak Hadir</div>
            <div class="summary-number" id="jumlahTidakHadir">4</div>
            <div class="summary-description">Izin, sakit, atau alpa</div>
        </div>
    </section>

    <section class="chart-grid">
        <div class="panel">
            <div class="chart-title">
                <div>
                    <h3>Grafik Tren Kehadiran</h3>
                    <p class="muted">
                        Perubahan persentase kehadiran dari waktu ke waktu.
                    </p>
                </div>
                <span class="chart-label" id="labelPeriode">Mingguan</span>
            </div>

            <div class="chart-box">
                <canvas id="trenChart"></canvas>
            </div>
        </div>

        <div class="panel">
            <div class="chart-title">
                <div>
                    <h3>Komposisi Presensi</h3>
                    <p class="muted">
                        Perbandingan status kehadiran.
                    </p>
                </div>
            </div>

            <div class="chart-box small">
                <canvas id="statusChart"></canvas>
            </div>
        </div>
    </section>

    <section class="panel">
        <h3><i class="fa-solid fa-lightbulb"></i> Ringkasan Pemantauan</h3>
        <p class="muted">
            Informasi singkat untuk membantu Guru BK memantau kehadiran siswa.
        </p>

        <div class="insight-list">
            <div class="insight-item">
                <i class="fa-solid fa-arrow-trend-up"></i>
                <h4>Perkembangan Kehadiran</h4>
                <p id="insightHadir">
                    Persentase kehadiran pada data contoh mencapai 85%.
                </p>
            </div>

            <div class="insight-item">
                <i class="fa-solid fa-clock"></i>
                <h4>Perhatian Keterlambatan</h4>
                <p id="insightTerlambat">
                    Terdapat 5 catatan keterlambatan pada data contoh.
                </p>
            </div>

            <div class="insight-item">
                <i class="fa-solid fa-clipboard-check"></i>
                <h4>Tindak Lanjut</h4>
                <p>
                    Periksa riwayat presensi siswa yang sering terlambat atau tidak hadir
                    untuk menentukan tindak lanjut yang sesuai.
                </p>
            </div>
        </div>

        <div class="note">
            <i class="fa-solid fa-circle-info"></i>
            Grafik dan angka di halaman ini masih menggunakan data contoh.
            Hasil sebenarnya akan ditampilkan setelah fitur terhubung dengan database presensi.
        </div>
    </section>
</main>

<script>
    /*
      Data berikut hanya contoh tampilan.
      Angka dapat diganti dengan data dari database saat backend tersedia.
    */

    const dataTren = {
        mingguan: {
            label: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum'],
            semua: [82, 86, 80, 88, 85],
            kelas: {
                'XI RPL 1': [85, 88, 82, 90, 87],
                'XI RPL 2': [78, 82, 79, 85, 81],
                'XI TKJ 1': [83, 87, 80, 89, 86]
            }
        },

        bulanan: {
            label: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
            semua: [80, 84, 82, 88],
            kelas: {
                'XI RPL 1': [83, 87, 85, 90],
                'XI RPL 2': [76, 80, 78, 84],
                'XI TKJ 1': [81, 85, 83, 89]
            }
        },

        semester: {
            label: ['Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            semua: [78, 81, 83, 85, 87, 89],
            kelas: {
                'XI RPL 1': [80, 83, 86, 88, 90, 92],
                'XI RPL 2': [74, 78, 80, 83, 85, 87],
                'XI TKJ 1': [79, 82, 84, 86, 88, 90]
            }
        }
    };

    const dataStatus = {
        '': [51, 5, 2, 2],
        'XI RPL 1': [18, 2, 1, 1],
        'XI RPL 2': [17, 2, 1, 1],
        'XI TKJ 1': [16, 1, 0, 0]
    };

    const namaStatus = ['Hadir', 'Terlambat', 'Izin/Sakit', 'Alpa'];

    const trenCtx = document.getElementById('trenChart');
    const statusCtx = document.getElementById('statusChart');

    const trenChart = new Chart(trenCtx, {
        type: 'line',
        data: {
            labels: dataTren.mingguan.label,
            datasets: [{
                label: 'Kehadiran (%)',
                data: dataTren.mingguan.semua,
                borderColor: '#3478f6',
                backgroundColor: 'rgba(52,120,246,0.12)',
                fill: true,
                tension: 0.35,
                borderWidth: 3,
                pointRadius: 4,
                pointBackgroundColor: '#3478f6'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    min: 0,
                    max: 100,
                    ticks: {
                        callback: function (value) {
                            return value + '%';
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: namaStatus,
            datasets: [{
                data: dataStatus[''],
                backgroundColor: [
                    '#3478f6',
                    '#f5b942',
                    '#55b8a5',
                    '#f07878'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 16,
                        usePointStyle: true,
                        font: {
                            size: 10
                        }
                    }
                }
            }
        }
    });

    function terapkanFilter() {
        const periode = document.getElementById('filterPeriode').value;
        const kelas = document.getElementById('filterKelas').value;

        const dataPeriode = dataTren[periode];

        let dataGrafik = kelas
            ? dataPeriode.kelas[kelas]
            : dataPeriode.semua;

        trenChart.data.labels = dataPeriode.label;
        trenChart.data.datasets[0].data = dataGrafik;
        trenChart.update();

        const status = dataStatus[kelas];
        const total = status.reduce(function (jumlah, nilai) {
            return jumlah + nilai;
        }, 0);

        const jumlahHadir = status[0];
        const jumlahTerlambat = status[1];
        const jumlahTidakHadir = status[2] + status[3];

        const persentase = total > 0
            ? Math.round((jumlahHadir / total) * 100)
            : 0;

        document.getElementById('persentaseHadir').textContent =
            persentase + '%';

        document.getElementById('jumlahHadir').textContent = jumlahHadir;
        document.getElementById('jumlahTerlambat').textContent =
            jumlahTerlambat;
        document.getElementById('jumlahTidakHadir').textContent =
            jumlahTidakHadir;

        document.getElementById('labelPeriode').textContent =
            periode === 'mingguan' ? 'Mingguan'
            : periode === 'bulanan' ? 'Bulanan'
            : 'Semester';

        statusChart.data.datasets[0].data = status;
        statusChart.update();

        document.getElementById('insightHadir').textContent =
            'Persentase kehadiran berdasarkan ringkasan data contoh adalah '
            + persentase + '%.';

        document.getElementById('insightTerlambat').textContent =
            'Terdapat ' + jumlahTerlambat
            + ' catatan keterlambatan pada data contoh.';
    }

    document.getElementById('filterForm').addEventListener(
        'submit',
        function (event) {
            event.preventDefault();
            terapkanFilter();
        }
    );

    terapkanFilter();
</script>

</body>
</html>
