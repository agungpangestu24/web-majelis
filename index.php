<?php
include 'koneksi.php';
// Cek apakah user sudah login atau belum
$is_logged_in = isset($_SESSION['user']);
$santri_query = $is_logged_in ? mysqli_query($conn, "SELECT * FROM anak_mengaji ORDER BY id DESC") : null;
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Majelis Al Husein - Pusat Dakwah & Sholawat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { darkMode: 'class' }</script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100 font-['Plus_Jakarta_Sans',sans-serif]">
    
    <!-- Navbar -->
    <nav class="bg-[#078B4F] dark:bg-slate-950 text-white sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-3">
                    <img src="img/logo.png" alt="Logo" class="w-12 h-12 object-contain rounded-lg" onerror="this.onerror=null; this.src='https://via.placeholder.com/50/078B4F/FFFFFF?text=MAJELIS';">
                    <div>
                        <span class="text-xl font-bold tracking-wide block font-['Amiri']">Majelis Al Husein</span>
                        <span class="text-xs text-emerald-100 tracking-wider">Pusat Dakwah & Pembinaan Umat</span>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-6 font-medium text-sm">
                    <?php if($is_logged_in) { ?>
                        <a href="#beranda" class="hover:text-amber-400 transition">Beranda</a>
                        <a href="#azan-section" class="hover:text-amber-400 transition">Jadwal Azan</a>
                        <a href="#malam-jumat" class="hover:text-amber-400 transition">Malam Jumat</a>
                        <a href="#mengaji" class="hover:text-amber-400 transition">Mengaji</a>
                        <a href="#absen-santri" class="hover:text-amber-400 transition">Absen Santri</a>
                        <a href="#galeri" class="hover:text-amber-400 transition">Galeri</a>
                        
                        <?php if($_SESSION['role'] == 'admin') { ?>
                            <a href="admin.php" class="bg-amber-500 text-slate-900 px-3 py-1.5 rounded-lg font-bold text-xs"><i class="fa-solid fa-user-gear mr-1"></i> Panel Admin</a>
                        <?php } else { ?>
                            <span class="text-xs bg-emerald-800 px-3 py-1.5 rounded-lg border border-emerald-600"><i class="fa-solid fa-user mr-1"></i> <?= $_SESSION['nama']; ?></span>
                        <?php } ?>
                        <a href="logout.php" class="bg-red-600 hover:bg-red-700 px-3 py-1.5 rounded-lg text-xs font-bold transition"><i class="fa-solid fa-power-off"></i></a>
                    <?php } else { ?>
                        <a href="login.php" class="bg-amber-500 text-slate-900 px-4 py-2 rounded-xl font-bold text-xs hover:bg-amber-400 transition"><i class="fa-solid fa-right-to-bracket mr-1"></i> Login</a>
                        <a href="register.php" class="bg-emerald-800 text-white px-4 py-2 rounded-xl font-bold text-xs hover:bg-emerald-700 transition border border-emerald-600"><i class="fa-solid fa-user-plus mr-1"></i> Daftar (Register)</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header / Hero Section -->
    <header id="beranda" class="relative bg-gradient-to-r from-emerald-950 via-[#078B4F] to-teal-900 text-white py-24 md:py-32 text-center">
        <div class="max-w-7xl mx-auto px-4 relative z-10">
            <span class="inline-block bg-amber-500/20 text-amber-300 border border-amber-500/30 px-4 py-1.5 rounded-full text-sm font-semibold mb-6">
                <i class="fa-solid fa-star-and-crescent mr-2"></i> Website Resmi Majelis Al Husein
            </span>
            <h1 class="text-4xl md:text-6xl font-bold font-['Amiri'] mb-6 leading-tight">
                Menyalakan Cahaya Iman & Ilmu <br>Bersama <span class="text-amber-400">Majelis Al Husein</span>
            </h1>
            <p class="text-lg md:text-xl text-emerald-100 max-w-2xl mx-auto mb-10 font-light">
                Pusat dakwah, pengajian rutin anak & pemuda, serta keliling majelis, masjid, dan musala.
            </p>

            <?php if(!$is_logged_in) { ?>
                <!-- TAMPILAN KHUSUS TAMU (BELUM LOGIN) -->
                <div class="bg-slate-900/80 backdrop-blur-md p-8 rounded-3xl max-w-xl mx-auto border border-amber-500/40 shadow-2xl">
                    <div class="text-amber-400 text-3xl mb-3"><i class="fa-solid fa-lock"></i></div>
                    <h3 class="text-xl font-bold font-['Amiri'] mb-2">Akses Konten Lengkap & Absensi Santri</h3>
                    <p class="text-xs text-slate-300 mb-6">Silakan masuk atau daftarkan akun Anda terlebih dahulu untuk melihat jadwal lengkap, galeri, dan memantau absensi anak.</p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="login.php" class="bg-amber-500 hover:bg-amber-400 text-slate-900 font-bold px-6 py-3 rounded-xl text-sm shadow transition">
                            <i class="fa-solid fa-right-to-bracket mr-2"></i> Masuk (Login)
                        </a>
                        <a href="register.php" class="bg-[#078B4F] hover:bg-emerald-700 text-white font-bold px-6 py-3 rounded-xl text-sm shadow transition border border-emerald-600">
                            <i class="fa-solid fa-user-plus mr-2"></i> Daftar Akun Baru
                        </a>
                    </div>
                </div>
            <?php } else { ?>
                <!-- TOMBOL NAVIGASI CEPAT JIKA SUDAH LOGIN -->
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#mengaji" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold px-8 py-3.5 rounded-xl shadow-lg transition">
                        <i class="fa-solid fa-child-reaching mr-2"></i> Jadwal Mengaji Anak
                    </a>
                    <a href="#malam-jumat" class="bg-[#05663a] hover:bg-emerald-800 text-white font-bold px-8 py-3.5 rounded-xl border border-emerald-500 shadow-lg transition">
                        <i class="fa-solid fa-mosque mr-2"></i> Kajian Malam Jumat
                    </a>
                </div>
            <?php } ?>
        </div>
    </header>

    <?php if($is_logged_in) { ?>
        <!-- KONTEN LENGKAP HANYA MUNCUL SETELAH LOGIN -->
        
        <!-- Jadwal Azan 5 Waktu -->
        <section id="azan-section" class="py-12 bg-[#078B4F] text-white border-y border-emerald-700 text-center">
            <div class="max-w-7xl mx-auto px-4">
                <h3 class="text-3xl font-bold font-['Amiri'] mb-2"><i class="fa-solid fa-clock text-amber-400 mr-2"></i> Jadwal Azan 5 Waktu</h3>
                <p class="text-xs text-emerald-200 mb-8">Wilayah Bogor & Sekitarnya</p>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
                    <div class="bg-emerald-900/80 p-4 rounded-xl border border-emerald-600"><span class="block text-xs uppercase text-amber-300 font-bold">Subuh</span><span class="text-2xl font-bold font-mono mt-1 block" id="subuh">--:--</span></div>
                    <div class="bg-emerald-900/80 p-4 rounded-xl border border-emerald-600"><span class="block text-xs uppercase text-amber-300 font-bold">Dzuhur</span><span class="text-2xl font-bold font-mono mt-1 block" id="dzuhur">--:--</span></div>
                    <div class="bg-emerald-900/80 p-4 rounded-xl border border-emerald-600"><span class="block text-xs uppercase text-amber-300 font-bold">Ashar</span><span class="text-2xl font-bold font-mono mt-1 block" id="ashar">--:--</span></div>
                    <div class="bg-emerald-900/80 p-4 rounded-xl border border-emerald-600"><span class="block text-xs uppercase text-amber-300 font-bold">Maghrib</span><span class="text-2xl font-bold font-mono mt-1 block" id="maghrib">--:--</span></div>
                    <div class="bg-emerald-900/80 p-4 rounded-xl border border-emerald-600 col-span-2 md:col-span-1"><span class="block text-xs uppercase text-amber-300 font-bold">Isya</span><span class="text-2xl font-bold font-mono mt-1 block" id="isya">--:--</span></div>
                </div>
                <button onclick="playAzanSound()" class="bg-amber-500 text-slate-900 px-4 py-2 rounded-xl text-xs font-bold hover:bg-amber-400 shadow">
                    <i class="fa-solid fa-volume-high mr-1"></i> Test Suara Azan
                </button>
            </div>
        </section>

        <!-- Pengajian Malam Jumat -->
        <section id="malam-jumat" class="py-20 bg-white dark:bg-slate-900">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <span class="text-[#078B4F] font-bold uppercase tracking-wider text-sm">Agenda Rutin Keliling</span>
                    <h2 class="text-3xl md:text-4xl font-bold font-['Amiri'] mt-2">Pengajian Rutin Malam Jumat</h2>
                    <p class="text-slate-600 dark:text-slate-300 mt-2">Berpindah tempat antara Majelis, Masjid, dan Musala sekitar.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-slate-50 dark:bg-slate-800 p-8 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-xl">
                        <h4 class="text-xl font-bold font-['Amiri'] mb-2">Majelis Utama & Masjid Jami'</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-300">Kamis Malam Jumat, Ba'da Isya - Kitab Riyadhus Shalihin.</p>
                    </div>
                    <div class="bg-slate-50 dark:bg-slate-800 p-8 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-xl">
                        <h4 class="text-xl font-bold font-['Amiri'] mb-2">Musala Warga & Pemuda</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-300">Pekan ke-2 & ke-4, Ba'da Maghrib - Kajian Tematik.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mengaji Senin-Jumat -->
        <section id="mengaji" class="py-20 bg-slate-100 dark:bg-slate-800 text-center">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl md:text-4xl font-bold font-['Amiri'] mb-6">Jadwal Mengaji Santri (Senin - Jumat)</h2>
                <p class="text-slate-600 dark:text-slate-300 mb-8">Pukul 16.00 - 17.30 WIB setiap hari kerja.</p>
            </div>
        </section>

        <!-- Absen Santri -->
        <section id="absen-santri" class="py-20 bg-white dark:bg-slate-900">
            <div class="max-w-7xl mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold font-['Amiri']">Absensi & Perkembangan Anak Mengaji</h2>
                    <p class="text-slate-600 dark:text-slate-300 mt-2">Pemantauan kehadiran santri oleh orang tua / wali.</p>
                </div>
                <div class="overflow-x-auto bg-white dark:bg-slate-800 shadow-xl rounded-3xl border border-slate-200 dark:border-slate-700">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-[#078B4F] text-white text-xs uppercase">
                            <tr>
                                <th class="px-6 py-4">No</th>
                                <th class="px-6 py-4">Nama Santri</th>
                                <th class="px-6 py-4">Orang Tua</th>
                                <th class="px-6 py-4">Usia</th>
                                <th class="px-6 py-4">Status Kehadiran</th>
                                <th class="px-6 py-4">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                            <?php 
                            $no = 1;
                            if($santri_query && mysqli_num_rows($santri_query) > 0) {
                                while($s = mysqli_fetch_assoc($santri_query)) { ?>
                                <tr>
                                    <td class="px-6 py-4 font-bold text-amber-500"><?= $no++; ?></td>
                                    <td class="px-6 py-4 font-semibold"><?= htmlspecialchars($s['nama_lengkap']); ?></td>
                                    <td class="px-6 py-4"><?= htmlspecialchars($s['nama_ortu']); ?></td>
                                    <td class="px-6 py-4"><?= $s['usia']; ?> Tahun</td>
                                    <td class="px-6 py-4"><span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800"><?= $s['status_absen']; ?></span></td>
                                    <td class="px-6 py-4 text-xs"><?= htmlspecialchars($s['keterangan']); ?></td>
                                </tr>
                            <?php } } else { ?>
                                <tr><td colspan="6" class="px-6 py-6 text-center text-slate-400">Belum ada data anak mengaji.</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Galeri -->
        <section id="galeri" class="py-20 bg-slate-50 dark:bg-slate-800 text-center">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-3xl md:text-4xl font-bold font-['Amiri'] mb-4">Galeri Foto Majelis Al Husein</h2>
                <p class="text-slate-600 dark:text-slate-300 mb-12">Dokumentasi kegiatan majelis.</p>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="h-60 rounded-2xl overflow-hidden shadow relative"><img src="img/galeri1.jpg" alt="Galeri 1" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://via.placeholder.com/400x300/078B4F/FFFFFF?text=Galeri+1';"></div>
                    <div class="h-60 rounded-2xl overflow-hidden shadow relative"><img src="img/galeri2.jpg" alt="Galeri 2" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://via.placeholder.com/400x300/078B4F/FFFFFF?text=Galeri+2';"></div>
                    <div class="h-60 rounded-2xl overflow-hidden shadow relative"><img src="img/galeri3.jpg" alt="Galeri 3" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://via.placeholder.com/400x300/078B4F/FFFFFF?text=Galeri+3';"></div>
                    <div class="h-60 rounded-2xl overflow-hidden shadow relative"><img src="img/galeri4.jpg" alt="Galeri 4" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://via.placeholder.com/400x300/078B4F/FFFFFF?text=Galeri+4';"></div>
                </div>
            </div>
        </section>
    <?php } ?>

    <footer class="bg-emerald-950 text-white py-8 text-center text-xs">
        &copy; 2026 Majelis Al Husein. All Rights Reserved.
    </footer>

    <script src="script.js"></script>
</body>
</html>
