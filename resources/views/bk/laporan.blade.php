
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan | SMEGA Learn</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
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
            flex-shrink: 0;
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

        .topbar h1 {
            font-size: 25px;
            margin-bottom: 8px;
        }

        .topbar p {
            color: #7a899e;
            font-size: 13px;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            border: 1px solid #e5edf8;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 12px;
        }

        .profile-icon {
            width: 35px;
            height: 35px;
            background: #e8efff;
            color: #3478f6;
            border-radius: 50%;
            display: grid;
            place-items: center;
        }

        .notice {
            background: #fff8e7;
            border: 1px solid #f4dfaa;
            color: #88651c;
            padding: 13px 16px;
            border-radius: 10px;
            font-size: 12px;
            line-height: 1.6;
            margin-bottom: 22px;
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 22px;
        }

        .summary-card {
            background: white;
            border: 1px solid #e5edf8;
            border-radius: 14px;
            padding: 20px;
        }

        .summary-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 18px;
        }

        .summary-top p {
            color: #7a899e;
            font-size: 12px;
        }

        .summary-icon {
            width: 38px;
            height: 38px;
            border-radius: 11px;
            display: grid;
            place-items: center;
            background: #e8efff;
            color: #3478f6;
        }

        .summary-card h2 {
            font-size: 27px;
            margin-bottom: 6px;
        }

        .summary-card small {
            color: #8996a9;
            font-size: 11px;
        }

        .panel {
            background: white;
            border: 1px solid #e5edf8;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 22px;
        }

        .panel-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .panel-heading h2 {
            font-size: 16px;
            margin-bottom: 6px;
        }

        .panel-heading p {
            color: #8996a9;
            font-size: 12px;
        }

        .filters {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 14px;
            margin-bottom: 17px;
        }

        .field label {
            display: block;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .field input,
        .field select {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #dce5f2;
            border-radius: 9px;
            outline: none;
            background: white;
            color: #26364d;
            font-size: 12px;
        }

        .field input:focus,
        .field select:focus {
            border-color: #3478f6;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .button {
            border: none;
            padding: 11px 15px;
            border-radius: 9px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .button-primary {
            background: #3478f6;
            color: white;
        }

        .button-primary:hover {
            background: #245fd0;
        }

        .button-light {
            background: #edf3ff;
            color: #2860d8;
        }

        .table-wrap {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th {
            text-align: left;
            background: #f5f8ff;
            color: #728198;
            padding: 14px 12px;
            font-size: 11px;
            white-space: nowrap;
        }

        td {
            padding: 15px 12px;
            border-bottom: 1px solid #edf1f7;
            font-size: 12px;
        }

        tbody tr:hover {
            background: #fafcff;
        }

        .status {
            display: inline-block;
            padding: 6px 9px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
        }

        .hadir {
            background: #dcfce7;
            color: #15803d;
        }

        .izin {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .sakit {
            background: #fef3c7;
            color: #92400e;
        }

        .alpha {
            background: #fee2e2;
            color: #b91c1c;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #8996a9;
        }

        .report-footer {
            color: #8996a9;
            font-size: 11px;
            text-align: right;
            margin-top: 16px;
        }

        @media (max-width: 1000px) {
            .summary {
                grid-template-columns: repeat(2, 1fr);
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

        @media print {
            .sidebar,
            .profile,
            .notice,
            .filters,
            .actions,
            .no-print {
                display: none !important;
            }

            body {
                background: white;
                color: black;
            }

            .main {
                margin: 0;
                padding: 0;
            }

            .panel,
            .summary-card {
                border: 1px solid #ddd;
                break-inside: avoid;
            }

            .summary {
                grid-template-columns: repeat(4, 1fr);
            }

            th {
                background: #eee !important;
                color: black;
            }

            .report-footer {
                color: black;
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

        <a href="/bk/tren-kehadiran" class="menu">
            <i class="fa-solid fa-chart-line"></i> Tren Kehadiran
        </a>

        <a href="/bk/tindak-lanjut" class="menu">
            <i class="fa-solid fa-clipboard-list"></i> Tindak Lanjut
        </a>

        <a href="/bk/laporan" class="menu active">
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
                <h1>Laporan Kehadiran</h1>
                <p>Rekap dan cetak laporan presensi siswa.</p>
            </div>

            <div class="profile">
                <div class="profile-icon">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <div>
                    <strong>Guru BK</strong>
                    <p style="color:#8996a9; margin-top:4px;">Bimbingan Konseling</p>
                </div>
            </div>
        </header>

        <div class="notice">
            <i class="fa-solid fa-circle-info"></i>
            Data pada halaman ini masih berupa contoh untuk tampilan. Data belum terhubung ke database aplikasi.
        </div>

        <section class="summary">
            <div class="summary-card">
                <div class="summary-top">
                    <p>Total Data Presensi</p>
                    <div class="summary-icon">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                </div>
                <h2 id="totalData">8</h2>
                <small>Data pada laporan</small>
            </div>

            <div class="summary-card">
                <div class="summary-top">
                    <p>Hadir</p>
                    <div class="summary-icon" style="background:#dcfce7;color:#15803d;">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                </div>
                <h2 id="totalHadir">3</h2>
                <small>Siswa berstatus hadir</small>
            </div>

            <div class="summary-card">
                <div class="summary-top">
                    <p>Izin dan Sakit</p>
                    <div class="summary-icon" style="background:#fef3c7;color:#92400e;">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                </div>
                <h2 id="totalIzinSakit">3</h2>
                <small>Presensi dengan keterangan</small>
            </div>

            <div class="summary-card">
                <div class="summary-top">
                    <p>Tanpa Keterangan</p>
                    <div class="summary-icon" style="background:#fee2e2;color:#b91c1c;">
                        <i class="fa-solid fa-user-xmark"></i>
                    </div>
                </div>
                <h2 id="totalAlpha">2</h2>
                <small>Siswa berstatus alpha</small>
            </div>
        </section>

        <section class="panel">
            <div class="panel-heading">
                <div>
                    <h2><i class="fa-solid fa-filter" style="color:#3478f6;"></i> Filter Laporan</h2>
                    <p>Atur data berdasarkan kelas, status, dan tanggal.</p>
                </div>
            </div>

            <div class="filters">
                <div class="field">
                    <label for="filterKelas">Kelas</label>
                    <select id="filterKelas">
                        <option value="">Semua Kelas</option>
                        <option value="XI RPL 1">XI RPL 1</option>
                        <option value="XI RPL 2">XI RPL 2</option>
                        <option value="XI TKJ 1">XI TKJ 1</option>
                    </select>
                </div>

                <div class="field">
                    <label for="filterStatus">Status Kehadiran</label>
                    <select id="filterStatus">
                        <option value="">Semua Status</option>
                        <option value="Hadir">Hadir</option>
                        <option value="Izin">Izin</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Alpha">Alpha</option>
                    </select>
                </div>

                <div class="field">
                    <label for="filterTanggal">Tanggal Presensi</label>
                    <input type="date" id="filterTanggal">
                </div>
            </div>

            <div class="actions">
                <button type="button" class="button button-light" onclick="resetFilter()">
                    <i class="fa-solid fa-rotate-left"></i> Reset Filter
                </button>

                <button type="button" class="button button-primary" onclick="cetakLaporan()">
                    <i class="fa-solid fa-print"></i> Cetak Laporan
                </button>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Siswa</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody id="tabelLaporan"></tbody>
                </table>
            </div>

            <div class="report-footer">
                Menampilkan <span id="jumlahTampil">8</span> data presensi
            </div>
        </section>
    </main>

    <script>
        // Data contoh, belum berasal dari database.
        const dataPresensi = [
            {
                nama: "Andi Saputra",
                nis: "1001",
                kelas: "XI RPL 1",
                tanggal: "2026-10-19",
                status: "Hadir"
            },
            {
                nama: "Budi Santoso",
                nis: "1002",
                kelas: "XI RPL 2",
                tanggal: "2026-10-19",
                status: "Alpha"
            },
            {
                nama: "Citra Lestari",
                nis: "1003",
                kelas: "XI TKJ 1",
                tanggal: "2026-10-19",
                status: "Izin"
            },
            {
                nama: "Dinda Putri",
                nis: "1004",
                kelas: "XI RPL 1",
                tanggal: "2026-10-20",
                status: "Hadir"
            },
            {
                nama: "Eko Prasetyo",
                nis: "1005",
                kelas: "XI RPL 2",
                tanggal: "2026-10-20",
                status: "Sakit"
            },
            {
                nama: "Fajar Ramadhan",
                nis: "1006",
                kelas: "XI TKJ 1",
                tanggal: "2026-10-20",
                status: "Alpha"
            },
            {
                nama: "Gita Amelia",
                nis: "1007",
                kelas: "XI RPL 1",
                tanggal: "2026-10-21",
                status: "Hadir"
            },
            {
                nama: "Hendra Wijaya",
                nis: "1008",
                kelas: "XI RPL 2",
                tanggal: "2026-10-21",
                status: "Izin"
            }
        ];

        const tabel = document.getElementById("tabelLaporan");

        function tampilkanLaporan() {
            const kelas = document.getElementById("filterKelas").value;
            const status = document.getElementById("filterStatus").value;
            const tanggal = document.getElementById("filterTanggal").value;

            const hasil = dataPresensi.filter(function(data) {
                return (!kelas || data.kelas === kelas) &&
                       (!status || data.status === status) &&
                       (!tanggal || data.tanggal === tanggal);
            });

            tabel.innerHTML = "";

            if (hasil.length === 0) {
                tabel.innerHTML = `
                    <tr>
                        <td colspan="6" class="empty">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <p style="margin-top:8px;">Data presensi tidak ditemukan.</p>
                        </td>
                    </tr>
                `;
            } else {
                hasil.forEach(function(data, index) {
                    let kelasStatus = data.status.toLowerCase();

                    tabel.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td><strong>${data.nama}</strong></td>
                            <td>${data.nis}</td>
                            <td>${data.kelas}</td>
                            <td>${formatTanggal(data.tanggal)}</td>
                            <td>
                                <span class="status ${kelasStatus}">
                                    ${data.status}
                                </span>
                            </td>
                        </tr>
                    `;
                });
            }

            document.getElementById("jumlahTampil").textContent = hasil.length;
            document.getElementById("totalData").textContent = hasil.length;
            document.getElementById("totalHadir").textContent =
                hasil.filter(data => data.status === "Hadir").length;
            document.getElementById("totalIzinSakit").textContent =
                hasil.filter(data => data.status === "Izin" || data.status === "Sakit").length;
            document.getElementById("totalAlpha").textContent =
                hasil.filter(data => data.status === "Alpha").length;
        }

        function formatTanggal(tanggal) {
            const bagian = tanggal.split("-");
            return bagian[2] + "-" + bagian[1] + "-" + bagian[0];
        }

        function resetFilter() {
            document.getElementById("filterKelas").value = "";
            document.getElementById("filterStatus").value = "";
            document.getElementById("filterTanggal").value = "";
            tampilkanLaporan();
        }

        function cetakLaporan() {
            window.print();
        }

        document.getElementById("filterKelas").addEventListener("change", tampilkanLaporan);
        document.getElementById("filterStatus").addEventListener("change", tampilkanLaporan);
        document.getElementById("filterTanggal").addEventListener("change", tampilkanLaporan);

        tampilkanLaporan();
    </script>

</body>
</html>
