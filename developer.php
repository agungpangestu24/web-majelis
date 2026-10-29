<?php
include 'koneksi.php';
if (!isset($_SESSION['user']) || $_SESSION['role'] != 'developer') {
    header("Location: login.php");
    exit();
}
$pesan = "";

// Proses Tambah Foto Galeri Lengkap dengan Tahun & Keterangan
if (isset($_POST['upload_galeri'])) {
    $tahun = (int)$_POST['tahun'];
    $ket   = mysqli_real_escape_string($conn, $_POST['keterangan']);
    
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $nama_file = time() . '_' . basename($_FILES['foto']['name']);
        $target    = "img/" . $nama_file;
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $target)) {
            mysqli_query($conn, "INSERT INTO galeri_majelis (nama_file, tahun, keterangan) VALUES ('$nama_file', $tahun, '$ket')");
            $pesan = "Foto galeri berhasil diunggah!";
        } else {
            $pesan = "Gagal mengunggah file foto.";
        }
    } else {
        $pesan = "Pilih foto terlebih dahulu!";
    }
}

// Proses Hapus Galeri
if (isset($_GET['hapus_galeri'])) {
    $id = (int)$_GET['hapus_galeri'];
    $q = mysqli_query($conn, "SELECT * FROM galeri_majelis WHERE id = $id");
    if ($data = mysqli_fetch_assoc($q)) {
        if (file_exists("img/" . $data['nama_file'])) {
            unlink("img/" . $data['nama_file']);
        }
        mysqli_query($conn, "DELETE FROM galeri_majelis WHERE id = $id");
    }
    header("Location: developer.php");
    exit();
}

$galeri_data = mysqli_query($conn, "SELECT * FROM galeri_majelis ORDER BY id DESC");
$users_data  = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Developer (Super Admin) - Majelis Al Husein</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-slate-900 text-slate-100 font-['Plus_Jakarta_Sans',sans-serif]">
    <nav class="bg-slate-950 text-white sticky top-0 z-50 shadow-lg border-b border-amber-500/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center space-x-3">
                    <div class="bg-amber-500 text-slate-900 w-10 h-10 rounded-xl flex items-center justify-center font-bold">
                        <i class="fa-solid fa-code"></i>
                    </div>
                    <div>
                        <span class="text-xl font-bold tracking-wide block font-['Amiri']">Panel Developer & Kontrol Sistem</span>
                        <span class="text-xs text-amber-400">Hak Akses Khusus Pembuat Web</span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-xs bg-slate-800 px-3 py-1.5 rounded-lg border border-slate-700"><i class="fa-solid fa-user-shield text-amber-400 mr-1"></i> <?= $_SESSION['nama']; ?></span>
                    <a href="index.php" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition">Lihat Website</a>
                    <a href="logout.php" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl text-xs font-bold transition"><i class="fa-solid fa-power-off mr-1"></i> Keluar</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">
        <?php if($pesan != "") { ?>
            <div class="p-4 bg-emerald-900/50 border border-emerald-500 text-emerald-200 rounded-xl text-sm font-semibold">
                <i class="fa-solid fa-circle-check mr-2"></i> <?= $pesan; ?>
            </div>
        <?php } ?>

        <!-- SECTION UPLOAD GALERI SKALA BESAR DENGAN KETERANGAN & TAHUN -->
        <section class="bg-slate-800 p-8 rounded-3xl shadow-xl border border-amber-500/40">
            <h3 class="text-2xl font-bold font-['Amiri'] text-amber-400 mb-6"><i class="fa-solid fa-images mr-2"></i> Unggah Galeri Momen Majelis (Skala Besar)</h3>
            <form action="" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs uppercase font-bold text-slate-300 mb-1">Pilih File Foto</label>
                    <input type="file" name="foto" required accept="image/*" class="w-full px-4 py-2.5 rounded-xl bg-slate-700 border border-slate-600 text-xs text-slate-200">
                </div>
                <div>
                    <label class="block text-xs uppercase font-bold text-slate-300 mb-1">Tahun Kegiatan</label>
                    <input type="number" name="tahun" required value="2026" class="w-full px-4 py-2.5 rounded-xl bg-slate-700 border border-slate-600 text-white text-sm">
                </div>
                <div class="md:col-span-3">
                    <label class="block text-xs uppercase font-bold text-slate-300 mb-1">Keterangan / Pesan / Kata-Kata Mutiara Foto</label>
                    <textarea name="keterangan" rows="2" required placeholder="Contoh: Suasana khidmat pengajian akbar malam jumat bersama para asatidz dan jamaah..." class="w-full px-4 py-3 rounded-xl bg-slate-700 border border-slate-600 text-white text-sm"></textarea>
                </div>
                <div class="md:col-span-3">
                    <button type="submit" name="upload_galeri" class="w-full bg-amber-500 hover:bg-amber-400 text-slate-900 font-bold py-3.5 rounded-xl shadow-lg transition">
                        <i class="fa-solid fa-cloud-arrow-up mr-2"></i> Upload Foto ke Galeri Majelis
                    </button>
                </div>
            </form>
        </section>

        <!-- DAFTAR GALERI YANG TELAH DI-UPLOAD -->
        <section class="bg-slate-800 p-8 rounded-3xl shadow-xl border border-slate-700">
            <h3 class="text-2xl font-bold font-['Amiri'] text-amber-400 mb-6"><i class="fa-solid fa-photo-film mr-2"></i> Kelola Arsip Foto Galeri (<?= mysqli_num_rows($galeri_data); ?> Foto)</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                <?php while($g = mysqli_fetch_assoc($galeri_data)) { ?>
                    <div class="bg-slate-900 rounded-2xl overflow-hidden border border-slate-700 flex flex-col justify-between">
                        <div class="h-48 relative">
                            <img src="img/<?= htmlspecialchars($g['nama_file']); ?>" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://via.placeholder.com/400x300/078B4F/FFFFFF?text=Foto+Majelis';">
                            <span class="absolute top-2 right-2 bg-amber-500 text-slate-900 font-bold text-xs px-2.5 py-1 rounded-full shadow">Tahun <?= $g['tahun']; ?></span>
                        </div>
                        <div class="p-4 space-y-2 flex-grow">
                            <p class="text-xs text-slate-300 italic">"<?= htmlspecialchars($g['keterangan']); ?>"</p>
                        </div>
                        <div class="p-4 pt-0">
                            <a href="developer.php?hapus_galeri=<?= $g['id']; ?>" onclick="return confirm('Yakin ingin menghapus foto ini dari galeri?');" class="block text-center bg-red-600 hover:bg-red-700 text-white py-2 rounded-xl text-xs font-bold">
                                <i class="fa-solid fa-trash mr-1"></i> Hapus Foto
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </section>

        <!-- KONTROL PENGGUNA SISTEM -->
        <section class="bg-slate-800 p-8 rounded-3xl shadow-xl border border-slate-700">
            <h3 class="text-2xl font-bold font-['Amiri'] text-amber-400 mb-6"><i class="fa-solid fa-users-gear mr-2"></i> Manajemen Akun Pengguna Sistem</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-slate-700 text-amber-300 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Nama Lengkap</th>
                            <th class="px-4 py-3">Username</th>
                            <th class="px-4 py-3">Role / Hak Akses</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        <?php while($u = mysqli_fetch_assoc($users_data)) { ?>
                        <tr>
                            <td class="px-4 py-3"><?= $u['id']; ?></td>
                            <td class="px-4 py-3 font-semibold"><?= htmlspecialchars($u['nama_lengkap']); ?></td>
                            <td class="px-4 py-3 font-mono text-xs text-slate-400"><?= htmlspecialchars($u['username']); ?></td>
                            <td class="px-4 py-3">
                                <span class="px-2.5 py-1 rounded-full text-xs font-bold <?= $u['role'] == 'developer' ? 'bg-amber-500/20 text-amber-300 border border-amber-500/40' : ($u['role'] == 'admin' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/40' : 'bg-slate-700 text-slate-300'); ?>">
                                    <?= strtoupper($u['role']); ?>
                                </span>
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
