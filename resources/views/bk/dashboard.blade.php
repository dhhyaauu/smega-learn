<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard BK | SMEGA Learn</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

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
        }

        .welcome {
            padding: 25px;
            color: white;
            border-radius: 17px;
            background: linear-gradient(110deg, #3478f6, #62a0ff);
            margin-bottom: 25px;
        }

        .welcome h2 {
            font-size: 21px;
            margin-bottom: 9px;
        }

        .welcome p {
            font-size: 12px;
            line-height: 1.8;
            color: #edf4ff;
            max-width: 650px;
        }

        .section-title {
            font-size: 16px;
            margin-bottom: 15px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 25px;
        }

        .stat-card {
            background: white;
            border: 1px solid #e5edf8;
            border-radius: 14px;
            padding: 19px;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 11px;
            display: grid;
            place-items: center;
            margin-bottom: 15px;
        }

        .blue { background: #e8f0ff; color: #3478f6; }
        .green { background: #dcfce7; color: #15803d; }
        .yellow { background: #fef3c7; color: #b45309; }
        .red { background: #fee2e2; color: #dc2626; }

        .stat-label {
            font-size: 11px;
            color: #8492a6;
            margin-bottom: 8px;
        }

        .stat-number {
            font-size: 26px;
            font-weight: bold;
        }

        .grid-main {
            display: grid;
            grid-template-columns: minmax(0, 1.6fr) minmax(240px, 1fr);
            gap: 18px;
            margin-bottom: 25px;
        }

        .panel {
            background: white;
            border: 1px solid #e5edf8;
            border-radius: 15px;
            padding: 20px;
            min-width: 0;
        }

        .panel h3 {
            font-size: 14px;
            margin-bottom: 17px;
        }

        .filters {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto;
            gap: 9px;
            margin-bottom: 18px;
        }

        select, input, button {
            font-family: inherit;
            font-size: 11px;
            padding: 10px;
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

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
            font-size: 11px;
        }

        th {
            text-align: left;
            padding: 12px 9px;
            color: #8492a6;
            background: #f7f9fd;
            font-weight: 600;
        }

        td {
            padding: 13px 9px;
            border-bottom: 1px solid #edf1f7;
        }

        .status {
            display: inline-block;
            padding: 5px 8px;
            border-radius: 20px;
            font-size: 10px;
        }

        .status-late {
            background: #fef3c7;
            color: #92400e;
        }

        .status-absent {
            background: #fee2e2;
            color: #b91c1c;
        }

        .status-present {
            background: #dcfce7;
            color: #166534;
        }

        .text-link {
            color: #3478f6;
            text-decoration: none;
            font-size: 11px;
        }

        .chart-row {
            margin-bottom: 19px;
        }

        .chart-label {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            font-size: 11px;
            margin-bottom: 8px;
        }

        .bar {
            height: 8px;
            background: #edf2fb;
            border-radius: 20px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            border-radius: 20px;
        }

        .trend {
            display: flex;
            align-items: end;
            justify-content: space-around;
            height: 130px;
            gap: 12px;
            padding-top: 10px;
            border-bottom: 1px solid #e5edf8;
        }

        .trend-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: end;
            height: 100%;
            flex: 1;
            gap: 7px;
            font-size: 10px;
            color: #8492a6;
        }

        .trend-bar {
            width: 65%;
            max-width: 30px;
            background: linear-gradient(#65a4ff, #3478f6);
            border-radius: 6px 6px 0 0;
            min-height: 5px;
        }

        .activity-item {
            display: flex;
            gap: 11px;
            padding: 12px 0;
            border-bottom: 1px solid #edf1f7;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            border-radius: 10px;
            display: grid;
            place-items: center;
            background: #e8f0ff;
            color: #3478f6;
        }

        .activity-item p {
            font-size: 11px;
            margin-bottom: 5px;
        }

        .activity-item span {
            font-size: 10px;
            color: #8492a6;
        }

        .bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
            margin-bottom: 25px;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 9px;
        }

        .btn-outline {
            display: inline-block;
            color: #3478f6;
            border: 1px solid #cbdcff;
            border-radius: 8px;
            padding: 10px 12px;
            text-decoration: none;
            font-size: 11px;
        }

        .note {
            background: #eef5ff;
            color: #476181;
            border-radius: 10px;
            padding: 13px;
            font-size: 11px;
            line-height: 1.7;
            margin-top: 15px;
        }

        @media (max-width: 1100px) {
            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .grid-main, .bottom-grid {
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

            .filters {
                grid-template-columns: 1fr 1fr;
            }

            .stats {
                gap: 10px;
            }

            .stat-card {
                padding: 14px;
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

    <a href="/bk/dashboard" class="menu active">
        <i class="fa-solid fa-house"></i> Dashboard
    </a>
    <a href="#" class="menu">
        <i class="fa-solid fa-calendar-check"></i> Kehadiran
    </a>
    <a href="#" class="menu">
        <i class="fa-solid fa-users"></i> Data Siswa
    </a>
    <a href="#" class="menu">
        <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Presensi
    </a>
    <a href="#" class="menu">
        <i class="fa-solid fa-chart-line"></i> Tren Kehadiran
    </a>
    <a href="#" class="menu">
        <i class="fa-solid fa-clipboard-list"></i> Tindak Lanjut
    </a>
    <a href="#" class="menu">
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
            <h1>Dashboard Kehadiran</h1>
            <p class="muted">Pantau kehadiran dan tindak lanjuti masalah presensi siswa.</p>
        </div>
        <div class="profile">
            <i class="fa-solid fa-user-tie"></i> Guru BK
        </div>
    </header>

    <section class="welcome">
        <h2>Halo, Guru BK! 👋</h2>
        <p>
            Pantau siswa yang belum hadir, identifikasi keterlambatan,
            dan lihat perkembangan kehadiran siswa dalam satu dashboard.
        </p>
    </section>

    <h2 class="section-title">Ringkasan Kehadiran Hari Ini</h2>

    <section class="stats">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fa-solid fa-users"></i></div>
            <div class="stat-label">Total Siswa</div>
            <div class="stat-number">—</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon green"><i class="fa-solid fa-user-check"></i></div>
            <div class="stat-label">Hadir</div>
            <div class="stat-number">—</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon yellow"><i class="fa-solid fa-clock"></i></div>
            <div class="stat-label">Terlambat</div>
            <div class="stat-number">—</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon red"><i class="fa-solid fa-user-xmark"></i></div>
            <div class="stat-label">Belum Hadir</div>
            <div class="stat-number">—</div>
        </div>
    </section>

    <section class="grid-main">
        <div class="panel">
            <h3><i class="fa-solid fa-list-check"></i> Siswa Perlu Dipantau</h3>

            <form class="filters" id="filterForm">
                <select id="filterKelas" aria-label="Filter kelas">
                    <option value="">Semua Kelas</option>
                    <option value="XI RPL 1">XI RPL 1</option>
                    <option value="XI RPL 2">XI RPL 2</option>
                    <option value="XI TKJ 1">XI TKJ 1</option>
                </select>

                <input type="date" id="filterTanggal" aria-label="Filter tanggal">

                <select id="filterStatus" aria-label="Filter status">
                    <option value="">Semua Status</option>
                    <option value="Terlambat">Terlambat</option>
                    <option value="Belum Hadir">Belum Hadir</option>
                </select>

                <button type="submit">Filter</button>
            </form>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Waktu</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="studentRows">
                        <tr data-kelas="XI RPL 1" data-status="Terlambat">
                            <td>Siswa A</td>
                            <td>XI RPL 1</td>
                            <td>07.12</td>
                            <td><span class="status status-late">Terlambat</span></td>
                        </tr>
                        <tr data-kelas="XI RPL 2" data-status="Belum Hadir">
                            <td>Siswa B</td>
                            <td>XI RPL 2</td>
                            <td>—</td>
                            <td><span class="status status-absent">Belum Hadir</span></td>
                        </tr>
                        <tr data-kelas="XI TKJ 1" data-status="Terlambat">
                            <td>Siswa C</td>
                            <td>XI TKJ 1</td>
                            <td>07.18</td>
                            <td><span class="status status-late">Terlambat</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <p class="muted" id="filterInfo" style="margin-top:12px;">
                Data di atas hanya contoh tampilan.
            </p>
        </div>

        <div class="panel">
            <h3><i class="fa-solid fa-chart-pie"></i> Komposisi Kehadiran</h3>

            <div class="chart-row">
                <div class="chart-label"><span>Hadir</span><span>—</span></div>
                <div class="bar"><div class="bar-fill" style="width:75%;background:#22c55e;"></div></div>
            </div>

            <div class="chart-row">
                <div class="chart-label"><span>Terlambat</span><span>—</span></div>
                <div class="bar"><div class="bar-fill" style="width:15%;background:#f59e0b;"></div></div>
            </div>

            <div class="chart-row">
                <div class="chart-label"><span>Belum Hadir</span><span>—</span></div>
                <div class="bar"><div class="bar-fill" style="width:10%;background:#ef4444;"></div></div>
            </div>

            <p class="muted">Grafik akan menggunakan data presensi sebenarnya setelah dihubungkan.</p>
        </div>
    </section>

    <section class="bottom-grid">
        <div class="panel">
            <h3><i class="fa-solid fa-chart-line"></i> Tren Kehadiran Harian</h3>

            <div class="trend">
                <div class="trend-item">
                    <div class="trend-bar" style="height:60%;"></div>
                    <span>Sen</span>
                </div>
                <div class="trend-item">
                    <div class="trend-bar" style="height:80%;"></div>
                    <span>Sel</span>
                </div>
                <div class="trend-item">
                    <div class="trend-bar" style="height:70%;"></div>
                    <span>Rab</span>
                </div>
                <div class="trend-item">
                    <div class="trend-bar" style="height:90%;"></div>
                    <span>Kam</span>
                </div>
                <div class="trend-item">
                    <div class="trend-bar" style="height:75%;"></div>
                    <span>Jum</span>
                </div>
            </div>

            <p class="muted" style="margin-top:13px;">
                Contoh visual tren, belum mewakili persentase asli.
            </p>
        </div>

        <div class="panel">
            <h3><i class="fa-solid fa-bell"></i> Aktivitas Presensi Terbaru</h3>

            <div class="activity-item">
                <div class="activity-icon"><i class="fa-solid fa-user-check"></i></div>
                <div>
                    <p><strong>Siswa A</strong> — Absen datang</p>
                    <span>06.48 · Tepat waktu</span>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon"><i class="fa-solid fa-clock"></i></div>
                <div>
                    <p><strong>Siswa B</strong> — Absen datang</p>
                    <span>07.12 · Terlambat</span>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
                <div>
                    <p><strong>Siswa C</strong> — Absen pulang</p>
                    <span>14.05 · Berhasil</span>
                </div>
            </div>

            <p class="muted" style="margin-top:10px;">
                Aktivitas di atas hanya contoh.
            </p>
        </div>
    </section>

    <section class="panel">
        <h3><i class="fa-solid fa-clipboard-pen"></i> Tindak Lanjut dan Laporan</h3>
        <p class="muted">
            Catat pembinaan untuk siswa yang sering terlambat atau tidak hadir,
            serta siapkan laporan kehadiran untuk evaluasi.
        </p>

        <div class="actions" style="margin-top:16px;">
            <a href="#" class="btn-outline">Riwayat Siswa</a>
            <a href="#" class="btn-outline">Catatan Pembinaan</a>
            <a href="#" class="btn-outline">Ekspor Excel</a>
            <a href="#" class="btn-outline">Ekspor PDF</a>
        </div>

        <div class="note">
            <i class="fa-solid fa-circle-info"></i>
            Fitur detail foto dan lokasi presensi, riwayat siswa, penyimpanan
            catatan pembinaan, ekspor laporan, dan pembaruan real-time perlu
            dihubungkan ke backend sebelum dapat digunakan.
        </div>
    </section>
</main>

<script>
    const form = document.getElementById('filterForm');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const kelas = document.getElementById('filterKelas').value;
        const status = document.getElementById('filterStatus').value;
        const rows = document.querySelectorAll('#studentRows tr');

        let jumlah = 0;

        rows.forEach(function (row) {
            const cocokKelas = !kelas || row.dataset.kelas === kelas;
            const cocokStatus = !status || row.dataset.status === status;
            const tampil = cocokKelas && cocokStatus;

            row.style.display = tampil ? '' : 'none';

            if (tampil) jumlah++;
        });

        document.getElementById('filterInfo').textContent =
            jumlah + ' data contoh ditemukan. Filter tanggal belum terhubung.';
    });
</script>

</body>
</html>
