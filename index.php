<?php
include 'koneksi.php';
$santri_query = mysqli_query($conn, "SELECT * FROM anak_mengaji ORDER BY id DESC");
$kajian_query = mysqli_query($conn, "SELECT * FROM jadwal_malam_jumat ORDER BY id DESC");
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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100 font-['Plus_Jakarta_Sans',sans-serif] transition-colors duration-300">
    <nav class="bg-brand dark:bg-slate-950 text-white sticky top-0 z-50 shadow-lg">
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
                    <a href="#beranda" class="hover:text-amber-400 transition">Beranda</a>
                    <a href="#azan-section" class="hover:text-amber-400 transition">Jadwal Azan</a>
                    <a href="#malam-jumat" class="hover:text-amber-400 transition">Malam Jumat</a>
                    <a href="#mengaji" class="hover:text-amber-400 transition">Mengaji Senin-Jumat</a>
                    <a href="#absen-santri" class="hover:text-amber-400 transition">Absen Santri</a>
                    <a href="#galeri" class="hover:text-amber-400 transition">Galeri</a>
                    <?php if(isset($_SESSION['user'])) { ?>
                        <a href="admin.php" class="bg-amber-500 text-slate-900 px-3 py-1.5 rounded-lg font-bold text-xs"><i class="fa-solid fa-user-gear mr-1"></i> Panel Admin</a>
                        <a href="logout.php" class="bg-red-600 px-3 py-1.5 rounded-lg text-xs font-bold"><i class="fa-solid fa-power-off"></i></a>
                    <?php } else { ?>
                        <a href="login.php" class="bg-amber-500 text-slate-900 px-4 py-2 rounded-xl font-bold text-xs hover:bg-amber-400 transition"><i class="fa-solid fa-right-to-bracket mr-1"></i> Login</a>
                    <?php } ?>
                    <button id="theme-toggle" class="p-2 rounded-lg bg-emerald-800 dark:bg-slate-800 hover:bg-emerald-700 transition">
                        <i id="theme-icon" class="fa-solid fa-sun text-amber-400"></i>
                    </button>
                </div>
                <div class="md:hidden flex items-center space-x-2">
                    <button id="theme-toggle-mobile" class="p-2 rounded-lg bg-emerald-800 dark:bg-slate-800"><i class="fa-solid fa-sun text-amber-400"></i></button>
                    <button id="menu-btn" class="text-white focus:outline-none text-2xl"><i class="fa-solid fa-bars"></i></button>
                </div>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden bg-brand-dark px-4 pt-2 pb-6 space-y-3 border-t border-emerald-700">
            <a href="#beranda" class="block py-2 hover:text-amber-400">Beranda</a>
            <a href="#azan-section" class="block py-2 hover:text-amber-400">Jadwal Azan</a>
            <a href="#malam-jumat" class="block py-2 hover:text-amber-400">Pengajian Malam Jumat</a>
            <a href="#mengaji" class="block py-2 hover:text-amber-400">Mengaji Senin-Jumat</a>
            <a href="#absen-santri" class="block py-2 hover:text-amber-400">Absen Santri</a>
            <a href="#galeri" class="block py-2 hover:text-amber-400">Galeri Foto</a>
            <?php if(isset($_SESSION['user'])) { ?>
                <a href="admin.php" class="block py-2 text-amber-400 font-bold">Panel Admin</a>
                <a href="logout.php" class="block py-2 text-red-400">Keluar</a>
            <?php } else { ?>
                <a href="login.php" class="block py-2 text-amber-400 font-bold">Login Pengurus/User</a>
            <?php } ?>
        </div>
    </nav>
    <header id="beranda" data-aos="fade-down" data-aos-duration="1000" class="relative bg-gradient-to-r from-emerald-950 via-[#078B4F] to-teal-900 dark:from-slate-950 dark:via-slate-900 dark:to-emerald-950 text-white py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#d1fae5_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-block bg-amber-500/20 text-amber-300 border border-amber-500/30 px-4 py-1.5 rounded-full text-sm font-semibold mb-6 tracking-wide">
                <i class="fa-solid fa-star-and-crescent mr-2"></i> Selamat Datang di Website Resmi
            </span>
            <h1 class="text-4xl md:text-6xl font-bold font-['Amiri'] mb-6 leading-tight">
                Menyalakan Cahaya Iman & Ilmu <br>Bersama <span class="text-amber-400">Majelis Al Husein</span>
            </h1>
            <p class="text-lg md:text-xl text-emerald-100 max-w-2xl mx-auto mb-10 font-light">
                Pusat dakwah, pengajian rutin anak & pemuda, serta keliling majelis, masjid, dan musala.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#mengaji" class="bg-amber-500 hover:bg-amber-600 text-slate-900 font-bold px-8 py-3.5 rounded-xl shadow-lg transition transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-child-reaching mr-2"></i> Jadwal Mengaji Anak
                </a>
                <a href="#malam-jumat" class="bg-brand-dark hover:bg-emerald-800 text-white font-bold px-8 py-3.5 rounded-xl border border-emerald-500 shadow-lg transition">
                    <i class="fa-solid fa-mosque mr-2"></i> Kajian Malam Jumat
                </a>
            </div>
        </div>
    </header>
    <section id="azan-section" data-aos="fade-up" class="py-12 bg-brand dark:bg-slate-950 text-white border-y border-emerald-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-3xl font-bold font-['Amiri'] mb-2"><i class="fa-solid fa-clock text-amber-400 mr-2"></i> Jadwal Azan 5 Waktu & Pengingat Sholat</h3>
            <p class="text-xs text-emerald-200 mb-8">Waktu otomatis wilayah Bogor & Sekitarnya (Dilengkapi audio pengingat)</p>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
                <div class="bg-brand-dark/80 p-4 rounded-xl border border-emerald-600 shadow"><span class="block text-xs uppercase text-amber-300 font-bold">Subuh</span><span class="text-2xl font-bold font-mono mt-1 block" id="subuh">--:--</span></div>
                <div class="bg-brand-dark/80 p-4 rounded-xl border border-emerald-600 shadow"><span class="block text-xs uppercase text-amber-300 font-bold">Dzuhur</span><span class="text-2xl font-bold font-mono mt-1 block" id="dzuhur">--:--</span></div>
                <div class="bg-brand-dark/80 p-4 rounded-xl border border-emerald-600 shadow"><span class="block text-xs uppercase text-amber-300 font-bold">Ashar</span><span class="text-2xl font-bold font-mono mt-1 block" id="ashar">--:--</span></div>
                <div class="bg-brand-dark/80 p-4 rounded-xl border border-emerald-600 shadow"><span class="block text-xs uppercase text-amber-300 font-bold">Maghrib</span><span class="text-2xl font-bold font-mono mt-1 block" id="maghrib">--:--</span></div>
                <div class="bg-brand-dark/80 p-4 rounded-xl border border-emerald-600 shadow col-span-2 md:col-span-1"><span class="block text-xs uppercase text-amber-300 font-bold">Isya</span><span class="text-2xl font-bold font-mono mt-1 block" id="isya">--:--</span></div>
            </div>
            <div class="inline-flex items-center space-x-3 bg-brand-darker px-4 py-2 rounded-xl border border-emerald-600 text-xs">
                <span><i class="fa-solid fa-volume-high text-amber-400 mr-1"></i> Suara Azan Otomatis:</span>
                <button onclick="playAzanSound()" class="bg-amber-500 text-slate-900 px-3 py-1 rounded-lg font-bold hover:bg-amber-400">Test Suara Azan</button>
            </div>
        </div>
    </section>
    <section id="malam-jumat" class="py-20 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-down">
                <span class="text-brand font-bold uppercase tracking-wider text-sm">Agenda Rutin Keliling</span>
                <h2 class="text-3xl md:text-4xl font-bold font-['Amiri'] text-slate-900 dark:text-white mt-2">Pengajian Rutin Malam Jumat</h2>
                <p class="text-slate-600 dark:text-slate-300 mt-2">Berpindah tempat antara Majelis, Masjid, dan Musala sekitar untuk merangkul umat.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div data-aos="fade-right" class="bg-slate-50 dark:bg-slate-800 p-8 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-xl">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-amber-500 text-slate-900 p-3 rounded-xl font-bold"><i class="fa-solid fa-mosque text-xl"></i></div>
                        <div>
                            <span class="text-xs uppercase font-bold text-amber-600 dark:text-amber-400">Kamis Malam Jumat (Ba'da Isya)</span>
                            <h4 class="text-xl font-bold font-['Amiri'] text-slate-900 dark:text-white">Majelis Utama & Masjid Jami'</h4>
                        </div>
                    </div>
                    <p class="text-sm text-slate-600 dark:text-slate-300 mb-4">Pembacaan Kitab Riyadhus Shalihin & Ratib Al-Haddad bersama pemateri ulama setempat.</p>
                    <div class="text-xs text-slate-500 dark:text-slate-400 space-y-1">
                        <div><i class="fa-solid fa-location-dot text-brand mr-2"></i> Lokasi Bergilir: Aula Majelis & Masjid Al Husein</div>
                        <div><i class="fa-solid fa-user-tie text-brand mr-2"></i> Pemateri: Ustadz H. Ahmad Fauzi, Lc.</div>
                    </div>
                </div>
                <div data-aos="fade-left" class="bg-slate-50 dark:bg-slate-800 p-8 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-xl">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-amber-500 text-slate-900 p-3 rounded-xl font-bold"><i class="fa-solid fa-place-of-worship text-xl"></i></div>
                        <div>
                            <span class="text-xs uppercase font-bold text-amber-600 dark:text-amber-400">Pekan ke-2 & ke-4 (Ba'da Maghrib)</span>
                            <h4 class="text-xl font-bold font-['Amiri'] text-slate-900 dark:text-white">Musala Warga & Pemuda</h4>
                        </div>
                    </div>
                    <p class="text-sm text-slate-600 dark:text-slate-300 mb-4">Kajian tematik khusus remaja dan bapak-bapak serta silaturahim musala keliling.</p>
                    <div class="text-xs text-slate-500 dark:text-slate-400 space-y-1">
                        <div><i class="fa-solid fa-location-dot text-brand mr-2"></i> Lokasi: Musala Al-Ikhlas & Musala Nurul Iman</div>
                        <div><i class="fa-solid fa-user-tie text-brand mr-2"></i> Pemateri: Tim Asatidz Al Husein</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="mengaji" class="py-20 bg-slate-100 dark:bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
                <span class="text-brand font-bold uppercase tracking-wider text-sm">Pendidikan Anak</span>
                <h2 class="text-3xl md:text-4xl font-bold font-['Amiri'] text-slate-900 dark:text-white mt-2">Jadwal Mengaji Santri (Senin - Jumat)</h2>
                <p class="text-slate-600 dark:text-slate-300 mt-2">Pembinaan Al-Qur'an dan akhlak mulia setiap hari kerja.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-16" data-aos="fade-up">
                <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl shadow border border-slate-200 dark:border-slate-700 text-center">
                    <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full">SENIN</span>
                    <h4 class="font-bold text-lg mt-3 text-slate-900 dark:text-white">Iqro' & Tajwid</h4>
                    <p class="text-xs text-slate-500 mt-2">16.00 - 17.30 WIB</p>
                </div>
                <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl shadow border border-slate-200 dark:border-slate-700 text-center">
                    <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full">SELASA</span>
                    <h4 class="font-bold text-lg mt-3 text-slate-900 dark:text-white">Hafalan Juz 30</h4>
                    <p class="text-xs text-slate-500 mt-2">16.00 - 17.30 WIB</p>
                </div>
                <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl shadow border border-slate-200 dark:border-slate-700 text-center">
                    <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full">RABU</span>
                    <h4 class="font-bold text-lg mt-3 text-slate-900 dark:text-white">Praktik Sholat</h4>
                    <p class="text-xs text-slate-500 mt-2">16.00 - 17.30 WIB</p>
                </div>
                <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl shadow border border-slate-200 dark:border-slate-700 text-center">
                    <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full">KAMIS</span>
                    <h4 class="font-bold text-lg mt-3 text-slate-900 dark:text-white">Doa Harian</h4>
                    <p class="text-xs text-slate-500 mt-2">16.00 - 17.30 WIB</p>
                </div>
                <div class="bg-white dark:bg-slate-900 p-5 rounded-2xl shadow border border-slate-200 dark:border-slate-700 text-center">
                    <span class="bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1 rounded-full">JUMAT</span>
                    <h4 class="font-bold text-lg mt-3 text-slate-900 dark:text-white">Kisah Nabi & Maulid</h4>
                    <p class="text-xs text-slate-500 mt-2">16.00 - 17.30 WIB</p>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-900 p-8 rounded-3xl shadow-xl border border-slate-200 dark:border-slate-700 max-w-xl mx-auto text-center" data-aos="zoom-in">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold font-['Amiri'] text-brand" id="calendar-month-year">Bulan & Tahun</h3>
                    <div class="text-xs bg-brand text-white px-3 py-1 rounded-lg">Kalender Majelis</div>
                </div>
                <div class="grid grid-cols-7 gap-2 text-xs font-bold text-slate-400 mb-2">
                    <div>Min</div><div>Sen</div><div>Sel</div><div>Rab</div><div>Kam</div><div>Jum</div><div>Sab</div>
                </div>
                <div class="grid grid-cols-7 gap-2 text-sm" id="calendar-days"></div>
            </div>
        </div>
    </section>
    <section id="absen-santri" class="py-20 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-down">
                <span class="text-brand font-bold uppercase tracking-wider text-sm">Pemantauan Wali Santri</span>
                <h2 class="text-3xl md:text-4xl font-bold font-['Amiri'] text-slate-900 dark:text-white mt-2">Absensi & Perkembangan Anak Mengaji</h2>
                <p class="text-slate-600 dark:text-slate-300 mt-2">Orang tua dapat memantau kehadiran dan perkembangan belajar anak.</p>
            </div>
            <div class="overflow-x-auto bg-white dark:bg-slate-800 shadow-xl rounded-3xl border border-slate-200 dark:border-slate-700" data-aos="fade-up">
                <table class="w-full text-left text-sm">
                    <thead class="bg-brand text-white text-xs uppercase">
                        <tr>
                            <th class="px-6 py-4">No</th>
                            <th class="px-6 py-4">Nama Santri</th>
                            <th class="px-6 py-4">Orang Tua</th>
                            <th class="px-6 py-4">Usia</th>
                            <th class="px-6 py-4">Status Kehadiran</th>
                            <th class="px-6 py-4">Keterangan / Perkembangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        <?php 
                        $no = 1;
                        if(mysqli_num_rows($santri_query) > 0) {
                            while($s = mysqli_fetch_assoc($santri_query)) { ?>
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50">
                                <td class="px-6 py-4 font-bold text-amber-500"><?= $no++; ?></td>
                                <td class="px-6 py-4 font-semibold text-slate-900 dark:text-white"><?= htmlspecialchars($s['nama_lengkap']); ?></td>
                                <td class="px-6 py-4"><?= htmlspecialchars($s['nama_ortu']); ?></td>
                                <td class="px-6 py-4"><?= $s['usia']; ?> Tahun</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold <?= $s['status_absen'] == 'Hadir' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800'; ?>">
                                        <?= $s['status_absen']; ?>
                                    </span>
                                </td>
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
    <section id="galeri" class="py-20 bg-slate-50 dark:bg-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="fade-up">
            <span class="text-brand font-bold uppercase tracking-wider text-sm">Dokumentasi</span>
            <h2 class="text-3xl md:text-4xl font-bold font-['Amiri'] text-slate-900 dark:text-white mt-2 mb-4">Galeri Foto Majelis Al Husein</h2>
            <p class="text-slate-600 dark:text-slate-300 max-w-xl mx-auto mb-12">Tempat foto kegiatan (Masukkan file ke folder <code>img/galeri1.jpg</code> dst).</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <div class="h-60 rounded-2xl overflow-hidden shadow-md relative group" data-aos="zoom-in">
                    <img src="img/galeri1.jpg" alt="Galeri 1" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1584551246679-0daf3d275d0f?q=80&w=600';">
                    <div class="absolute inset-0 bg-black/40 flex items-end p-4 text-white"><p class="font-bold text-sm">Kajian Akbar</p></div>
                </div>
                <div class="h-60 rounded-2xl overflow-hidden shadow-md relative group" data-aos="zoom-in" data-aos-delay="100">
                    <img src="img/galeri2.jpg" alt="Galeri 2" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1564769625905-50e93615e769?q=80&w=600';">
                    <div class="absolute inset-0 bg-black/40 flex items-end p-4 text-white"><p class="font-bold text-sm">Maulid Nabi</p></div>
                </div>
                <div class="h-60 rounded-2xl overflow-hidden shadow-md relative group" data-aos="zoom-in" data-aos-delay="200">
                    <img src="img/galeri3.jpg" alt="Galeri 3" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1590076175571-4b5459efb08c?q=80&w=600';">
                    <div class="absolute inset-0 bg-black/40 flex items-end p-4 text-white"><p class="font-bold text-sm">Santunan Yatim</p></div>
                </div>
                <div class="h-60 rounded-2xl overflow-hidden shadow-md relative group" data-aos="zoom-in" data-aos-delay="300">
                    <img src="img/galeri4.jpg" alt="Galeri 4" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1519817650390-64a93db51149?q=80&w=600';">
                    <div class="absolute inset-0 bg-black/40 flex items-end p-4 text-white"><p class="font-bold text-sm">Silaturahim Warga</p></div>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-brand-darker text-white py-12 border-t border-emerald-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center text-center md:text-left">
            <div class="mb-6 md:mb-0">
                <span class="text-xl font-bold font-['Amiri'] block mb-1">Majelis Al Husein</span>
                <p class="text-xs text-emerald-300">Pusat Dakwah, Kajian, dan Pembinaan Umat</p>
            </div>
            <p class="text-xs text-emerald-400">&copy; 2026 Majelis Al Husein. All Rights Reserved.</p>
        </div>
    </footer>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="script.js"></script>
</body>
</html>
