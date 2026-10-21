
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa | SMEGA Learn</title>

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

        .panel {
            background: white;
            border: 1px solid #e5edf8;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            min-width: 0;
        }

        .panel h3 {
            font-size: 14px;
            margin-bottom: 17px;
        }

        .filters {
            display: grid;
            grid-template-columns: 1fr 1fr 1.5fr auto auto;
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

        .student-name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .student-email {
            color: #8492a6;
            font-size: 10px;
        }

        .class-badge {
            background: #e8f0ff;
            color: #2860d8;
            padding: 5px 8px;
            border-radius: 7px;
            font-size: 10px;
        }

        .detail-btn {
            color: #3478f6;
            background: #eef4ff;
            padding: 8px 10px;
            border-radius: 7px;
            font-size: 10px;
        }

        .detail-btn:hover {
            background: #dce7ff;
        }

        .empty {
            text-align: center;
            padding: 25px;
            color: #8492a6;
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

        @media (max-width: 1100px) {
            .summary {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

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

            .summary,
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

    <a href="/bk/kehadiran" class="menu">
        <i class="fa-solid fa-calendar-check"></i> Kehadiran
    </a>

    <a href="/bk/data-siswa" class="menu active">
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
            <h1>Data Siswa</h1>
            <p class="muted">
                Lihat informasi siswa untuk membantu pemantauan dan pembinaan.
            </p>
        </div>

        <div class="profile">
            <i class="fa-solid fa-user-tie"></i> Guru BK
        </div>
    </header>

    <section class="summary">
        <div class="summary-card">
            <div class="summary-icon">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="summary-label">Total Siswa Contoh</div>
            <div class="summary-number" id="totalSiswa">6</div>
        </div>

        <div class="summary-card">
            <div class="summary-icon">
                <i class="fa-solid fa-school"></i>
            </div>
            <div class="summary-label">Jumlah Kelas</div>
            <div class="summary-number" id="totalKelas">3</div>
        </div>

        <div class="summary-card">
            <div class="summary-icon">
                <i class="fa-solid fa-user-check"></i>
            </div>
            <div class="summary-label">Jurusan</div>
            <div class="summary-number" id="totalJurusan">2</div>
        </div>
    </section>

    <section class="panel">
        <h3><i class="fa-solid fa-filter"></i> Cari dan Filter Siswa</h3>

        <form class="filters" id="filterForm">
            <select id="filterKelas" aria-label="Filter kelas">
                <option value="">Semua Kelas</option>
                <option value="XI RPL 1">XI RPL 1</option>
                <option value="XI RPL 2">XI RPL 2</option>
                <option value="XI TKJ 1">XI TKJ 1</option>
            </select>

            <select id="filterJurusan" aria-label="Filter jurusan">
                <option value="">Semua Jurusan</option>
                <option value="RPL">RPL</option>
                <option value="TKJ">TKJ</option>
            </select>

            <input type="search" id="filterNama"
                placeholder="Cari nama atau NIS siswa..."
                aria-label="Cari nama atau NIS">

            <button type="submit">
                <i class="fa-solid fa-magnifying-glass"></i> Cari
            </button>

            <button type="button" id="resetFilter"
                style="background:#eef4ff;color:#3478f6;border:1px solid #dce7ff;">
                Reset
            </button>
        </form>

        <p class="muted" style="margin-bottom:15px;">
            Data berikut merupakan contoh tampilan, belum diambil dari database.
        </p>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Jenis Kelamin</th>
                        <th>Detail</th>
                    </tr>
                </thead>

                <tbody id="studentRows">
                    <tr data-nis="1001" data-nama="Andi Saputra"
                        data-kelas="XI RPL 1" data-jurusan="RPL">
                        <td>1</td>
                        <td>1001</td>
                        <td><div class="student-name">Andi Saputra</div></td>
                        <td><span class="class-badge">XI RPL 1</span></td>
                        <td>RPL</td>
                        <td>Laki-laki</td>
                        <td>
                            <button type="button" class="detail-btn"
                                data-info="NIS: 1001 | Kelas: XI RPL 1 | Jurusan: RPL | Jenis kelamin: Laki-laki">
                                Lihat
                            </button>
                        </td>
                    </tr>

                    <tr data-nis="1002" data-nama="Budi Santoso"
                        data-kelas="XI RPL 2" data-jurusan="RPL">
                        <td>2</td>
                        <td>1002</td>
                        <td><div class="student-name">Budi Santoso</div></td>
                        <td><span class="class-badge">XI RPL 2</span></td>
                        <td>RPL</td>
                        <td>Laki-laki</td>
                        <td>
                            <button type="button" class="detail-btn"
                                data-info="NIS: 1002 | Kelas: XI RPL 2 | Jurusan: RPL | Jenis kelamin: Laki-laki">
                                Lihat
                            </button>
                        </td>
                    </tr>

                    <tr data-nis="1003" data-nama="Citra Lestari"
                        data-kelas="XI TKJ 1" data-jurusan="TKJ">
                        <td>3</td>
                        <td>1003</td>
                        <td><div class="student-name">Citra Lestari</div></td>
                        <td><span class="class-badge">XI TKJ 1</span></td>
                        <td>TKJ</td>
                        <td>Perempuan</td>
                        <td>
                            <button type="button" class="detail-btn"
                                data-info="NIS: 1003 | Kelas: XI TKJ 1 | Jurusan: TKJ | Jenis kelamin: Perempuan">
                                Lihat
                            </button>
                        </td>
                    </tr>

                    <tr data-nis="1004" data-nama="Dinda Putri"
                        data-kelas="XI RPL 1" data-jurusan="RPL">
                        <td>4</td>
                        <td>1004</td>
                        <td><div class="student-name">Dinda Putri</div></td>
                        <td><span class="class-badge">XI RPL 1</span></td>
                        <td>RPL</td>
                        <td>Perempuan</td>
                        <td>
                            <button type="button" class="detail-btn"
                                data-info="NIS: 1004 | Kelas: XI RPL 1 | Jurusan: RPL | Jenis kelamin: Perempuan">
                                Lihat
                            </button>
                        </td>
                    </tr>

                    <tr data-nis="1005" data-nama="Eko Prasetyo"
                        data-kelas="XI RPL 2" data-jurusan="RPL">
                        <td>5</td>
                        <td>1005</td>
                        <td><div class="student-name">Eko Prasetyo</div></td>
                        <td><span class="class-badge">XI RPL 2</span></td>
                        <td>RPL</td>
                        <td>Laki-laki</td>
                        <td>
                            <button type="button" class="detail-btn"
                                data-info="NIS: 1005 | Kelas: XI RPL 2 | Jurusan: RPL | Jenis kelamin: Laki-laki">
                                Lihat
                            </button>
                        </td>
                    </tr>

                    <tr data-nis="1006" data-nama="Fajar Ramadhan"
                        data-kelas="XI TKJ 1" data-jurusan="TKJ">
                        <td>6</td>
                        <td>1006</td>
                        <td><div class="student-name">Fajar Ramadhan</div></td>
                        <td><span class="class-badge">XI TKJ 1</span></td>
                        <td>TKJ</td>
                        <td>Laki-laki</td>
                        <td>
                            <button type="button" class="detail-btn"
                                data-info="NIS: 1006 | Kelas: XI TKJ 1 | Jurusan: TKJ | Jenis kelamin: Laki-laki">
                                Lihat
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p class="muted" id="filterInfo" style="margin-top:15px;">
            Menampilkan 6 data siswa contoh.
        </p>

        <div class="note">
            <i class="fa-solid fa-circle-info"></i>
            Data siswa akan menggunakan data sebenarnya setelah dihubungkan
            dengan database SMEGA Learn.
        </div>
    </section>
</main>

<script>
    const form = document.getElementById('filterForm');
    const rows = Array.from(document.querySelectorAll('#studentRows tr'));

    function filterSiswa() {
        const kelas = document.getElementById('filterKelas').value;
        const jurusan = document.getElementById('filterJurusan').value;
        const nama = document.getElementById('filterNama').value
            .trim().toLowerCase();

        let jumlah = 0;
        const kelasDitemukan = new Set();
        const jurusanDitemukan = new Set();

        rows.forEach(function (row) {
            const cocokKelas =
                !kelas || row.dataset.kelas === kelas;

            const cocokJurusan =
                !jurusan || row.dataset.jurusan === jurusan;

            const cocokNama =
                !nama ||
                row.dataset.nama.toLowerCase().includes(nama) ||
                row.dataset.nis.includes(nama);

            const tampil = cocokKelas && cocokJurusan && cocokNama;

            row.style.display = tampil ? '' : 'none';

            if (tampil) {
                jumlah++;
                kelasDitemukan.add(row.dataset.kelas);
                jurusanDitemukan.add(row.dataset.jurusan);
            }
        });

        document.getElementById('totalSiswa').textContent = jumlah;
        document.getElementById('totalKelas').textContent = kelasDitemukan.size;
        document.getElementById('totalJurusan').textContent = jurusanDitemukan.size;

        document.getElementById('filterInfo').textContent =
            'Menampilkan ' + jumlah + ' data siswa contoh.';
    }

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        filterSiswa();
    });

    document.getElementById('resetFilter').addEventListener('click', function () {
        form.reset();
        filterSiswa();
    });

    document.querySelectorAll('.detail-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            alert(button.dataset.info);
        });
    });
</script>

</body>
</html>
