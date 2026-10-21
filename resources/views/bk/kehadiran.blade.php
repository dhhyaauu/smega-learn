
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kehadiran | SMEGA Learn</title>

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
            margin-bottom: 17px;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 22px;
        }

        .summary-card {
            background: white;
            border: 1px solid #e5edf8;
            border-radius: 14px;
            padding: 19px;
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

        .filters {
            display: grid;
            grid-template-columns: 1.2fr 1fr 1fr 1.2fr auto auto;
            gap: 10px;
            margin-bottom: 18px;
        }

        select, input, button {
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
            padding: 13px 10px;
            color: #8492a6;
            background: #f7f9fd;
            font-weight: 600;
        }

        td {
            padding: 14px 10px;
            border-bottom: 1px solid #edf1f7;
        }

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 10px;
        }

        .hadir {
            background: #dcfce7;
            color: #166534;
        }

        .terlambat {
            background: #fef3c7;
            color: #92400e;
        }

        .izin, .sakit {
            background: #e8f0ff;
            color: #1d4ed8;
        }

        .alpa, .belum {
            background: #fee2e2;
            color: #b91c1c;
        }

        .empty {
            text-align: center;
            padding: 25px;
            color: #8492a6;
        }

        .reset {
            background: #eef4ff;
            color: #3478f6;
            border: 1px solid #dce7ff;
        }

        .reset:hover {
            background: #dce7ff;
        }

        @media (max-width: 1100px) {
            .filters {
                grid-template-columns: repeat(2, minmax(0, 1fr));
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

            .summary {
                grid-template-columns: 1fr;
            }

            .filters {
                grid-template-columns: 1fr;
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

    <a href="/bk/kehadiran" class="menu active">
        <i class="fa-solid fa-calendar-check"></i> Kehadiran
    </a>

    <a href="/bk/data-siswa" class="menu">
        <i class="fa-solid fa-users"></i> Data Siswa
    </a>

    <a href="/bk/riwayat-presensi" class="menu">
        <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Presensi
    </a>

    <a href="/bk/tren-kehadiran" class="menu">
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
            <h1>Data Kehadiran Siswa</h1>
            <p class="muted">
                Lihat dan saring data presensi siswa berdasarkan tanggal, kelas, dan status.
            </p>
        </div>

        <div class="profile">
            <i class="fa-solid fa-user-tie"></i> Guru BK
        </div>
    </header>

    <section class="summary">
        <div class="summary-card">
            <div class="summary-label">Total Data Contoh</div>
            <div class="summary-number" id="totalData">6</div>
        </div>

        <div class="summary-card">
            <div class="summary-label">Hadir Tepat Waktu</div>
            <div class="summary-number" id="totalHadir">1</div>
        </div>

        <div class="summary-card">
            <div class="summary-label">Perlu Dipantau</div>
            <div class="summary-number" id="totalPantau">3</div>
        </div>
    </section>

    <section class="panel">
        <h3><i class="fa-solid fa-filter"></i> Filter Kehadiran</h3>

        <form class="filters" id="filterForm">
            <input type="date" id="filterTanggal" aria-label="Tanggal presensi">

            <select id="filterKelas" aria-label="Kelas">
                <option value="">Semua Kelas</option>
                <option value="XI RPL 1">XI RPL 1</option>
                <option value="XI RPL 2">XI RPL 2</option>
                <option value="XI TKJ 1">XI TKJ 1</option>
            </select>

            <select id="filterStatus" aria-label="Status">
                <option value="">Semua Status</option>
                <option value="Hadir">Hadir</option>
                <option value="Terlambat">Terlambat</option>
                <option value="Izin">Izin</option>
                <option value="Sakit">Sakit</option>
                <option value="Alpa">Alpa</option>
                <option value="Belum Hadir">Belum Hadir</option>
            </select>

            <input type="search" id="filterNama"
                placeholder="Cari nama atau NIS..." aria-label="Cari nama atau NIS">

            <button type="submit">
                <i class="fa-solid fa-magnifying-glass"></i> Cari
            </button>

            <button type="button" class="reset" id="resetFilter">
                Reset
            </button>
        </form>

        <p class="muted" style="margin-bottom:15px;">
            Data berikut masih contoh untuk tampilan. Belum diambil dari database.
        </p>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody id="studentRows">
                    <tr data-nis="1001" data-nama="Andi Saputra"
                        data-kelas="XI RPL 1" data-status="Hadir">
                        <td>1</td>
                        <td>1001</td>
                        <td>Andi Saputra</td>
                        <td>XI RPL 1</td>
                        <td>2026-10-21</td>
                        <td>06:45</td>
                        <td>15:00</td>
                        <td><span class="status hadir">Hadir</span></td>
                    </tr>

                    <tr data-nis="1002" data-nama="Budi Santoso"
                        data-kelas="XI RPL 2" data-status="Terlambat">
                        <td>2</td>
                        <td>1002</td>
                        <td>Budi Santoso</td>
                        <td>XI RPL 2</td>
                        <td>2026-10-21</td>
                        <td>07:15</td>
                        <td>15:05</td>
                        <td><span class="status terlambat">Terlambat</span></td>
                    </tr>

                    <tr data-nis="1003" data-nama="Citra Lestari"
                        data-kelas="XI TKJ 1" data-status="Belum Hadir">
                        <td>3</td>
                        <td>1003</td>
                        <td>Citra Lestari</td>
                        <td>XI TKJ 1</td>
                        <td>2026-10-21</td>
                        <td>—</td>
                        <td>—</td>
                        <td><span class="status belum">Belum Hadir</span></td>
                    </tr>

                    <tr data-nis="1004" data-nama="Dinda Putri"
                        data-kelas="XI RPL 1" data-status="Izin">
                        <td>4</td>
                        <td>1004</td>
                        <td>Dinda Putri</td>
                        <td>XI RPL 1</td>
                        <td>2026-10-21</td>
                        <td>—</td>
                        <td>—</td>
                        <td><span class="status izin">Izin</span></td>
                    </tr>

                    <tr data-nis="1005" data-nama="Eko Prasetyo"
                        data-kelas="XI RPL 2" data-status="Sakit">
                        <td>5</td>
                        <td>1005</td>
                        <td>Eko Prasetyo</td>
                        <td>XI RPL 2</td>
                        <td>2026-10-21</td>
                        <td>—</td>
                        <td>—</td>
                        <td><span class="status sakit">Sakit</span></td>
                    </tr>

                    <tr data-nis="1006" data-nama="Fajar Ramadhan"
                        data-kelas="XI TKJ 1" data-status="Alpa">
                        <td>6</td>
                        <td>1006</td>
                        <td>Fajar Ramadhan</td>
                        <td>XI TKJ 1</td>
                        <td>2026-10-21</td>
                        <td>—</td>
                        <td>—</td>
                        <td><span class="status alpa">Alpa</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="muted" id="filterInfo" style="margin-top:15px;">
            Menampilkan 6 data contoh.
        </p>
    </section>
</main>

<script>
    const form = document.getElementById('filterForm');
    const rows = Array.from(document.querySelectorAll('#studentRows tr'));

    function filterData() {
        const tanggal = document.getElementById('filterTanggal').value;
        const kelas = document.getElementById('filterKelas').value;
        const status = document.getElementById('filterStatus').value;
        const nama = document.getElementById('filterNama').value
            .trim().toLowerCase();

        let jumlah = 0;
        let jumlahHadir = 0;
        let jumlahPantau = 0;

        rows.forEach(function (row) {
            const cocokTanggal =
                !tanggal || row.cells[4].textContent.trim() === tanggal;

            const cocokKelas =
                !kelas || row.dataset.kelas === kelas;

            const cocokStatus =
                !status || row.dataset.status === status;

            const cocokNama =
                !nama ||
                row.dataset.nama.toLowerCase().includes(nama) ||
                row.dataset.nis.includes(nama);

            const tampil =
                cocokTanggal && cocokKelas && cocokStatus && cocokNama;

            row.style.display = tampil ? '' : 'none';

            if (tampil) {
                jumlah++;

                if (row.dataset.status === 'Hadir') {
                    jumlahHadir++;
                }

                if (
                    row.dataset.status === 'Terlambat' ||
                    row.dataset.status === 'Izin' ||
                    row.dataset.status === 'Sakit' ||
                    row.dataset.status === 'Alpa'
                ) {
                    jumlahPantau++;
                }
            }
        });

        document.getElementById('totalData').textContent = jumlah;
        document.getElementById('totalHadir').textContent = jumlahHadir;
        document.getElementById('totalPantau').textContent = jumlahPantau;

        document.getElementById('filterInfo').textContent =
            'Menampilkan ' + jumlah + ' data contoh.';
    }

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        filterData();
    });

    document.getElementById('resetFilter').addEventListener('click', function () {
        form.reset();
        filterData();
    });
</script>

</body>
</html>
