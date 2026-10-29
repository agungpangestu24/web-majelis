<?php
include 'koneksi.php';
if (!isset($_SESSION['user']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'developer')) {
    header("Location: login.php");
    exit();
}
$pesan = "";
if (isset($_POST['tambah_santri'])) {
    $nama  = mysqli_real_escape_string($conn, $_POST['nama']);
    $ortu  = mysqli_real_escape_string($conn, $_POST['ortu']);
    $usia  = (int)$_POST['usia'];
    $jk    = mysqli_real_escape_string($conn, $_POST['jk']);
    $absen = mysqli_real_escape_string($conn, $_POST['absen']);
    $ket   = mysqli_real_escape_string($conn, $_POST['ket']);
    mysqli_query($conn, "INSERT INTO anak_mengaji (nama_lengkap, nama_ortu, usia, jenis_kelamin, status_absen, keterangan) VALUES ('$nama', '$ortu', '$usia', '$jk', '$absen', '$ket')");
    $pesan = "Data santri berhasil ditambahkan!";
}
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($conn, "DELETE FROM anak_mengaji WHERE id = $id");
    header("Location: admin.php");
    exit();
}
$data_santri = mysqli_query($conn, "SELECT * FROM anak_mengaji ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Pengurus & Guru - Majelis Al Husein</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100 font-['Plus_Jakarta_Sans',sans-serif]">
    <nav class="bg-[#078B4F] text-white sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-3">
                    <img src="img/logo.png" alt="Logo" class="w-12 h-12 object-contain rounded-lg" onerror="this.onerror=null; this.src='https://via.placeholder.com/50/078B4F/FFFFFF?text=Majelis';">
                    <div>
                        <span class="text-xl font-bold tracking-wide block font-['Amiri']">Panel Pengurus & Guru Majelis</span>
                        <span class="text-xs text-emerald-100 tracking-wider">Pusat Pembinaan Santri</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-xs bg-emerald-800 px-3 py-1.5 rounded-lg border border-emerald-600"><i class="fa-solid fa-chalkboard-user mr-1"></i> <?= $_SESSION['nama']; ?></span>
                    <a href="index.php" class="bg-amber-500 hover:bg-amber-600 text-slate-900 px-4 py-2 rounded-xl text-xs font-bold transition">Lihat Web Utama</a>
                    <a href="logout.php" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition"><i class="fa-solid fa-power-off mr-1"></i> Keluar</a>
                </div>
            </div>
        </div>
    </nav>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">
        <?php if($pesan != "") { ?>
            <div class="p-4 bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 rounded-xl text-sm font-semibold border border-emerald-300">
                <i class="fa-solid fa-circle-check mr-2"></i> <?= $pesan; ?>
            </div>
        <?php } ?>
        <section class="bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-xl border border-slate-200 dark:border-slate-700">
            <h3 class="text-2xl font-bold font-['Amiri'] text-[#078B4F] mb-6"><i class="fa-solid fa-user-plus mr-2"></i> Kelola & Input Absensi Santri</h3>
            <form action="" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs uppercase font-bold text-slate-600 dark:text-slate-300 mb-1">Nama Lengkap Santri</label>
                    <input type="text" name="nama" required placeholder="Contoh: Zaid" class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-900">
                </div>
                <div>
                    <label class="block text-xs uppercase font-bold text-slate-600 dark:text-slate-300 mb-1">Nama Orang Tua</label>
                    <input type="text" name="ortu" required placeholder="Contoh: Bapak Umar" class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-900">
                </div>
                <div>
                    <label class="block text-xs uppercase font-bold text-slate-600 dark:text-slate-300 mb-1">Usia (Tahun)</label>
                    <input type="number" name="usia" required placeholder="8" class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-900">
                </div>
                <div>
                    <label class="block text-xs uppercase font-bold text-slate-600 dark:text-slate-300 mb-1">Jenis Kelamin</label>
                    <select name="jk" class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-900">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs uppercase font-bold text-slate-600 dark:text-slate-300 mb-1">Status Absen</label>
                    <select name="absen" class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-900">
                        <option value="Hadir">Hadir</option>
                        <option value="Izin">Izin</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Alpa">Alpa</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs uppercase font-bold text-slate-600 dark:text-slate-300 mb-1">Keterangan / Perkembangan</label>
                    <input type="text" name="ket" placeholder="Lancar Iqro 3" class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-slate-700 dark:bg-slate-900">
                </div>
                <div class="md:col-span-3">
                    <button type="submit" name="tambah_santri" class="w-full bg-[#078B4F] hover:bg-[#05663a] text-white font-bold py-3.5 rounded-xl shadow-lg transition">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Data Santri
                    </button>
                </div>
            </form>
        </section>
        <section class="bg-white dark:bg-slate-800 p-8 rounded-3xl shadow-xl border border-slate-200 dark:border-slate-700">
            <h3 class="text-2xl font-bold font-['Amiri'] text-[#078B4F] mb-6"><i class="fa-solid fa-clipboard-user mr-2"></i> Data Absensi & Anak Mengaji Aktif</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-[#078B4F] text-white text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">Nama Santri</th>
                            <th class="px-4 py-3">Orang Tua</th>
                            <th class="px-4 py-3">Usia</th>
                            <th class="px-4 py-3">Absen</th>
                            <th class="px-4 py-3">Keterangan</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        <?php 
                        $no = 1;
                        while($s = mysqli_fetch_assoc($data_santri)) { ?>
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50">
                            <td class="px-4 py-3"><?= $no++; ?></td>
                            <td class="px-4 py-3 font-semibold"><?= htmlspecialchars($s['nama_lengkap']); ?></td>
                            <td class="px-4 py-3"><?= htmlspecialchars($s['nama_ortu']); ?></td>
                            <td class="px-4 py-3"><?= $s['usia']; ?> Th</td>
                            <td class="px-4 py-3">
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold <?= $s['status_absen'] == 'Hadir' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800'; ?>">
                                    <?= $s['status_absen']; ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-xs"><?= htmlspecialchars($s['keterangan']); ?></td>
                            <td class="px-4 py-3 text-center">
                                <a href="admin.php?hapus=<?= $s['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded-lg text-xs">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
