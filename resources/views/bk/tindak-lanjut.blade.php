
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tindak Lanjut | SMEGA Learn</title>

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

        /* SIDEBAR */
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

        /* KONTEN UTAMA */
        .main {
            margin-left: 250px;
            padding: 28px;
            min-height: 100vh;
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

        .notice {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 15px 17px;
            margin-bottom: 22px;
            background: #eaf2ff;
            color: #345ba8;
            border: 1px solid #d6e5ff;
            border-radius: 12px;
            font-size: 12px;
            line-height: 1.7;
        }

        .notice i {
            font-size: 17px;
            margin-top: 2px;
        }

        /* KARTU RINGKASAN */
        .summary {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 22px;
        }

        .summary-card {
            display: flex;
            align-items: center;
            gap: 14px;
            background: white;
            border: 1px solid #e5edf8;
            border-radius: 14px;
            padding: 19px;
            min-width: 0;
        }

        .summary-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            font-size: 19px;
            flex-shrink: 0;
        }

        .purple {
            background: #eee8ff;
            color: #8056d9;
        }

        .orange {
            background: #fff0db;
            color: #e99427;
        }

        .green {
            background: #dcf8e9;
            color: #178755;
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

        /* PANEL DAN FILTER */
        .panel {
            background: white;
            border: 1px solid #e5edf8;
            border-radius: 15px;
            padding: 20px;
            min-width: 0;
            margin-bottom: 20px;
        }

        .panel-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .panel h3 {
            font-size: 14px;
            margin-bottom: 7px;
        }

        .filters {
            display: grid;
            grid-template-columns: 1fr 1.2fr 1.5fr auto auto;
            gap: 10px;
            margin-bottom: 18px;
        }

        select, input, textarea, button {
            font-family: inherit;
            font-size: 11px;
            padding: 11px;
            border: 1px solid #dce5f2;
            border-radius: 8px;
            min-width: 0;
        }

        select, input, textarea {
            width: 100%;
            background: white;
            color: #26364d;
            outline: none;
        }

        select:focus, input:focus, textarea:focus {
            border-color: #3478f6;
        }

        button {
            border: none;
            color: white;
            background: #3478f6;
            cursor: pointer;
            white-space: nowrap;
            transition: .2s;
        }

        button:hover {
            background: #2860d8;
        }

        .reset {
            background: #eef4ff;
            color: #3478f6;
            border: 1px solid #dce7ff;
        }

        .reset:hover {
            background: #dce7ff;
        }

        /* TABEL */
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
            vertical-align: middle;
        }

        tbody tr:hover {
            background: #fafcff;
        }

        .student-name {
            font-weight: bold;
            color: #35435b;
        }

        .student-nis {
            display: block;
            font-size: 10px;
            color: #8492a6;
            margin-top: 5px;
        }

        .status {
            display: inline-block;
            padding: 5px 9px;
            border-radius: 20px;
            font-size: 10px;
            white-space: nowrap;
        }

        .status-belum {
            background: #fee2e2;
            color: #b91c1c;
        }

        .status-proses {
            background: #fef3c7;
            color: #92400e;
        }

        .status-selesai {
            background: #dcfce7;
            color: #166534;
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .btn-detail, .btn-follow {
            padding: 8px 10px;
        }

        .btn-detail {
            background: #eef4ff;
            color: #3478f6;
        }

        .btn-detail:hover {
            background: #dce7ff;
        }

        .btn-follow {
            background: #3478f6;
            color: white;
        }

        .empty {
            text-align: center;
            padding: 25px;
            color: #8492a6;
        }

        .table-footer {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 15px;
        }

        /* ALUR TINDAK LANJUT */
        .followup-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .followup-item {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            padding: 16px;
            border: 1px solid #e5edf8;
            border-radius: 12px;
        }

        .followup-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: grid;
            place-items: center;
            flex-shrink: 0;
            background: #eaf2ff;
            color: #3478f6;
        }

        .followup-item h4 {
            font-size: 12px;
            margin-bottom: 7px;
        }

        .followup-item p {
            color: #8492a6;
            font-size: 11px;
            line-height: 1.7;
        }

        /* MODAL */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 100;
            background: rgba(24, 39, 70, .45);
            padding: 20px;
            align-items: center;
            justify-content: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            width: 100%;
            max-width: 480px;
            max-height: 90vh;
            overflow-y: auto;
            background: white;
            border-radius: 15px;
            padding: 24px;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 20px;
        }

        .modal-header h2 {
            font-size: 18px;
        }

        .close-btn {
            background: #eef4ff;
            color: #3478f6;
            padding: 8px 11px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .form-group p {
            font-size: 12px;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        textarea {
            min-height: 90px;
            resize: vertical;
        }

        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 9px;
            margin-top: 20px;
        }

        .btn-cancel {
            background: #eef4ff;
            color: #3478f6;
        }

        .btn-cancel:hover {
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

            .followup-grid {
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

    <a href="/bk/data-siswa" class="menu">
        <i class="fa-solid fa-users"></i> Data Siswa
    </a>

    <a href="/bk/riwayat-presensi" class="menu">
        <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Presensi
    </a>

    <a href="/bk/tren-kehadiran" class="menu">
        <i class="fa-solid fa-chart-line"></i> Tren Kehadiran
    </a>

    <a href="/bk/tindak-lanjut" class="menu active">
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
            <h1>Tindak Lanjut Siswa</h1>
            <p class="muted">
                Pemantauan dan pencatatan penanganan masalah kehadiran siswa.
            </p>
        </div>

        <div class="profile">
            <i class="fa-solid fa-user-tie"></i> Guru BK
        </div>
    </header>

    <div class="notice">
        <i class="fa-solid fa-circle-info"></i>
        <div>
            <strong>Informasi Pemantauan</strong><br>
            Data berikut merupakan data contoh untuk tampilan awal. Perubahan catatan belum tersimpan ke database.
        </div>
    </div>

    <section class="summary">
        <div class="summary-card">
            <div class="summary-icon purple">
                <i class="fa-solid fa-clipboard-list"></i>
            </div>
            <div>
                <div class="summary-label">Total Kasus Contoh</div>
                <div class="summary-number" id="totalKasus">6</div>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon orange">
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
            <div>
                <div class="summary-label">Belum Ditangani</div>
                <div class="summary-number" id="belumDitangani">3</div>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon green">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div>
                <div class="summary-label">Selesai Ditangani</div>
                <div class="summary-number" id="selesaiDitangani">1</div>
            </div>
        </div>
    </section>

    <section class="panel">
        <div class="panel-heading">
            <div>
                <h3><i class="fa-solid fa-filter"></i> Daftar Tindak Lanjut</h3>
                <p class="muted">Cari siswa dan pantau status penanganannya.</p>
            </div>
        </div>

        <form class="filters" id="filterForm">
            <select id="filterKelas" aria-label="Filter kelas">
                <option value="">Semua Kelas</option>
                <option value="XI RPL 1">XI RPL 1</option>
                <option value="XI RPL 2">XI RPL 2</option>
                <option value="XI TKJ 1">XI TKJ 1</option>
            </select>

            <select id="filterMasalah" aria-label="Filter masalah">
                <option value="">Semua Masalah</option>
                <option value="Sering Terlambat">Sering Terlambat</option>
                <option value="Tidak Hadir">Tidak Hadir</option>
                <option value="Izin Berulang">Izin Berulang</option>
                <option value="Campuran">Campuran</option>
            </select>

            <input type="search" id="cariSiswa"
                placeholder="Cari nama atau NIS..."
                aria-label="Cari nama atau NIS">

            <button type="submit">
                <i class="fa-solid fa-magnifying-glass"></i> Cari
            </button>

            <button type="button" class="reset" id="resetFilter">Reset</button>
        </form>

        <p class="muted" style="margin-bottom: 15px;">
            Data berikut masih contoh dan belum terhubung ke database.
        </p>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Masalah</th>
                        <th>Jumlah Kejadian</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="studentRows"></tbody>
            </table>
        </div>

        <div class="table-footer">
            <p class="muted" id="filterInfo">Menampilkan 6 data contoh.</p>
            <p class="muted">Data simulasi</p>
        </div>
    </section>

    <section class="panel">
        <div class="panel-heading">
            <div>
                <h3><i class="fa-solid fa-list-check"></i> Alur Tindak Lanjut</h3>
                <p class="muted">Tahapan penanganan masalah kehadiran siswa.</p>
            </div>
        </div>

        <div class="followup-grid">
            <div class="followup-item">
                <div class="followup-icon">
                    <i class="fa-solid fa-magnifying-glass-chart"></i>
                </div>
                <div>
                    <h4>1. Identifikasi Masalah</h4>
                    <p>Periksa riwayat kehadiran dan kenali pola keterlambatan atau ketidakhadiran siswa.</p>
                </div>
            </div>

            <div class="followup-item">
                <div class="followup-icon">
                    <i class="fa-solid fa-comments"></i>
                </div>
                <div>
                    <h4>2. Konseling Siswa</h4>
                    <p>Komunikasikan kendala yang dihadapi siswa untuk memahami situasinya.</p>
                </div>
            </div>

            <div class="followup-item">
                <div class="followup-icon">
                    <i class="fa-solid fa-pen-to-square"></i>
                </div>
                <div>
                    <h4>3. Catat Tindak Lanjut</h4>
                    <p>Catat tindakan, tanggal penanganan, dan status perkembangannya.</p>
                </div>
            </div>

            <div class="followup-item">
                <div class="followup-icon">
                    <i class="fa-solid fa-chart-simple"></i>
                </div>
                <div>
                    <h4>4. Evaluasi Perkembangan</h4>
                    <p>Pantau perubahan kehadiran untuk menentukan langkah selanjutnya.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- MODAL DETAIL SISWA -->
<div class="modal" id="modalDetail">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Detail Tindak Lanjut</h2>
            <button type="button" class="close-btn"
                onclick="tutupModal('modalDetail')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div id="detailContent"></div>

        <div class="modal-actions">
            <button type="button" class="btn-cancel"
                onclick="tutupModal('modalDetail')">Tutup</button>
        </div>
    </div>
</div>

<!-- MODAL CATATAN TINDAK LANJUT -->
<div class="modal" id="modalCatatan">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Catat Tindak Lanjut</h2>
            <button type="button" class="close-btn"
                onclick="tutupModal('modalCatatan')">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form id="formCatatan">
            <input type="hidden" id="idSiswa">

            <div class="form-group">
                <label for="namaSiswa">Nama Siswa</label>
                <input type="text" id="namaSiswa" readonly>
            </div>

            <div class="form-group">
                <label for="tanggalPenanganan">Tanggal Penanganan</label>
                <input type="date" id="tanggalPenanganan" required>
            </div>

            <div class="form-group">
                <label for="jenisTindakan">Tindakan yang Dilakukan</label>
                <select id="jenisTindakan" required>
                    <option value="">Pilih tindakan</option>
                    <option value="Pemanggilan siswa">Pemanggilan siswa</option>
                    <option value="Konseling individu">Konseling individu</option>
                    <option value="Koordinasi wali kelas">Koordinasi wali kelas</option>
                    <option value="Komunikasi dengan orang tua">Komunikasi dengan orang tua</option>
                    <option value="Pemantauan lanjutan">Pemantauan lanjutan</option>
                </select>
            </div>

            <div class="form-group">
                <label for="catatanPenanganan">Catatan Penanganan</label>
                <textarea id="catatanPenanganan"
                    placeholder="Tuliskan ringkasan tindakan atau hasil penanganan..."
                    required></textarea>
            </div>

            <div class="form-group">
                <label for="statusPenanganan">Status Penanganan</label>
                <select id="statusPenanganan" required>
                    <option value="Belum Ditangani">Belum Ditangani</option>
                    <option value="Dalam Proses">Dalam Proses</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel"
                    onclick="tutupModal('modalCatatan')">Batal</button>
                <button type="submit">Simpan Catatan</button>
            </div>
        </form>
    </div>
</div>

<script>
    const dataSiswa = [
        {
            id: 1,
            nis: '1001',
            nama: 'Andi Saputra',
            kelas: 'XI RPL 1',
            masalah: 'Sering Terlambat',
            kejadian: 5,
            status: 'Belum Ditangani',
            tanggal: '2026-10-20',
            tindakan: '',
            catatan: ''
        },
        {
            id: 2,
            nis: '1002',
            nama: 'Budi Santoso',
            kelas: 'XI RPL 2',
            masalah: 'Sering Terlambat',
            kejadian: 4,
            status: 'Dalam Proses',
            tanggal: '2026-10-19',
            tindakan: 'Pemanggilan siswa',
            catatan: 'Perlu pemantauan kebiasaan datang tepat waktu.'
        },
        {
            id: 3,
            nis: '1003',
            nama: 'Citra Lestari',
            kelas: 'XI TKJ 1',
            masalah: 'Tidak Hadir',
            kejadian: 3,
            status: 'Belum Ditangani',
            tanggal: '2026-10-18',
            tindakan: '',
            catatan: ''
        },
        {
            id: 4,
            nis: '1004',
            nama: 'Dinda Putri',
            kelas: 'XI RPL 1',
            masalah: 'Izin Berulang',
            kejadian: 4,
            status: 'Dalam Proses',
            tanggal: '2026-10-17',
            tindakan: 'Koordinasi wali kelas',
            catatan: 'Perlu konfirmasi alasan izin berulang.'
        },
        {
            id: 5,
            nis: '1005',
            nama: 'Eko Prasetyo',
            kelas: 'XI RPL 2',
            masalah: 'Tidak Hadir',
            kejadian: 2,
            status: 'Selesai',
            tanggal: '2026-10-16',
            tindakan: 'Komunikasi dengan orang tua',
            catatan: 'Penanganan awal sudah dilakukan.'
        },
        {
            id: 6,
            nis: '1006',
            nama: 'Fajar Ramadhan',
            kelas: 'XI TKJ 1',
            masalah: 'Campuran',
            kejadian: 5,
            status: 'Belum Ditangani',
            tanggal: '2026-10-15',
            tindakan: '',
            catatan: ''
        }
    ];

    function escapeHTML(teks) {
        return String(teks ?? '').replace(/[&<>"']/g, function (karakter) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            }[karakter];
        });
    }

    function kelasStatus(status) {
        if (status === 'Belum Ditangani') return 'status-belum';
        if (status === 'Dalam Proses') return 'status-proses';
        return 'status-selesai';
    }

    function tampilkanData(data = dataSiswa) {
        const tbody = document.getElementById('studentRows');

        if (data.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" class="empty">
                        <i class="fa-solid fa-folder-open"></i><br><br>
                        Data tindak lanjut tidak ditemukan.
                    </td>
                </tr>
            `;
        } else {
            tbody.innerHTML = data.map((siswa, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td>
                        <span class="student-name">${escapeHTML(siswa.nama)}</span>
                        <span class="student-nis">NIS: ${escapeHTML(siswa.nis)}</span>
                    </td>
                    <td>${escapeHTML(siswa.kelas)}</td>
                    <td>${escapeHTML(siswa.masalah)}</td>
                    <td>${siswa.kejadian} kali</td>
                    <td>
                        <span class="status ${kelasStatus(siswa.status)}">
                            ${escapeHTML(siswa.status)}
                        </span>
                    </td>
                    <td>
                        <div class="actions">
                            <button type="button" class="btn-detail"
                                onclick="lihatDetail(${siswa.id})"
                                title="Lihat detail">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button type="button" class="btn-follow"
                                onclick="bukaCatatan(${siswa.id})"
                                title="Tindak lanjuti">
                                <i class="fa-solid fa-clipboard-list"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        document.getElementById('filterInfo').textContent =
            `Menampilkan ${data.length} data contoh.`;

        document.getElementById('totalKasus').textContent =
            dataSiswa.length;

        document.getElementById('belumDitangani').textContent =
            dataSiswa.filter(s => s.status === 'Belum Ditangani').length;

        document.getElementById('selesaiDitangani').textContent =
            dataSiswa.filter(s => s.status === 'Selesai').length;
    }

    function terapkanFilter() {
        const kelas = document.getElementById('filterKelas').value;
        const masalah = document.getElementById('filterMasalah').value;
        const cari = document.getElementById('cariSiswa')
            .value.trim().toLowerCase();

        const hasil = dataSiswa.filter(siswa => {
            const cocokKelas = !kelas || siswa.kelas === kelas;
            const cocokMasalah = !masalah || siswa.masalah === masalah;
            const cocokCari =
                !cari ||
                siswa.nama.toLowerCase().includes(cari) ||
                siswa.nis.toLowerCase().includes(cari);

            return cocokKelas && cocokMasalah && cocokCari;
        });

        tampilkanData(hasil);
    }

    function resetFilter() {
        document.getElementById('filterForm').reset();
        tampilkanData();
    }

    function bukaModal(id) {
        document.getElementById(id).classList.add('show');
    }

    function tutupModal(id) {
        document.getElementById(id).classList.remove('show');
    }

    function lihatDetail(id) {
        const siswa = dataSiswa.find(item => item.id === id);
        if (!siswa) return;

        document.getElementById('detailContent').innerHTML = `
            <div class="form-group">
                <label>Nama Siswa</label>
                <p>${escapeHTML(siswa.nama)} (${escapeHTML(siswa.nis)})</p>
            </div>
            <div class="form-group">
                <label>Kelas</label>
                <p>${escapeHTML(siswa.kelas)}</p>
            </div>
            <div class="form-group">
                <label>Masalah Kehadiran</label>
                <p>${escapeHTML(siswa.masalah)} — ${siswa.kejadian} kali kejadian</p>
            </div>
            <div class="form-group">
                <label>Status Penanganan</label>
                <p>
                    <span class="status ${kelasStatus(siswa.status)}">
                        ${escapeHTML(siswa.status)}
                    </span>
                </p>
            </div>
            <div class="form-group">
                <label>Tindakan Terakhir</label>
                <p>${escapeHTML(siswa.tindakan || 'Belum ada tindakan tercatat.')}</p>
            </div>
            <div class="form-group">
                <label>Catatan</label>
                <p>${escapeHTML(siswa.catatan || 'Belum ada catatan penanganan.')}</p>
            </div>
            <div class="form-group">
                <label>Tanggal Penanganan</label>
                <p>${escapeHTML(siswa.tanggal || '-')}</p>
            </div>
        `;

        bukaModal('modalDetail');
    }

    function bukaCatatan(id) {
        const siswa = dataSiswa.find(item => item.id === id);
        if (!siswa) return;

        document.getElementById('idSiswa').value = siswa.id;
        document.getElementById('namaSiswa').value = siswa.nama;
        document.getElementById('tanggalPenanganan').value =
            siswa.tanggal || new Date().toISOString().slice(0, 10);
        document.getElementById('jenisTindakan').value = siswa.tindakan || '';
        document.getElementById('catatanPenanganan').value = siswa.catatan || '';
        document.getElementById('statusPenanganan').value = siswa.status;

        bukaModal('modalCatatan');
    }

    document.getElementById('formCatatan').addEventListener('submit', function (event) {
        event.preventDefault();

        const id = Number(document.getElementById('idSiswa').value);
        const siswa = dataSiswa.find(item => item.id === id);
        if (!siswa) return;

        siswa.tanggal = document.getElementById('tanggalPenanganan').value;
        siswa.tindakan = document.getElementById('jenisTindakan').value;
        siswa.catatan = document.getElementById('catatanPenanganan').value.trim();
        siswa.status = document.getElementById('statusPenanganan').value;

        tutupModal('modalCatatan');
        terapkanFilter();

        alert('Catatan diperbarui untuk simulasi. Data belum tersimpan ke database.');
    });

    document.getElementById('filterForm').addEventListener('submit', function (event) {
        event.preventDefault();
        terapkanFilter();
    });

    document.getElementById('resetFilter').addEventListener('click', resetFilter);

    document.getElementById('cariSiswa').addEventListener('input', terapkanFilter);
    document.getElementById('filterKelas').addEventListener('change', terapkanFilter);
    document.getElementById('filterMasalah').addEventListener('change', terapkanFilter);

    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.classList.remove('show');
            }
        });
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            document.querySelectorAll('.modal').forEach(modal => {
                modal.classList.remove('show');
            });
        }
    });

    tampilkanData();
</script>

</body>
</html>
