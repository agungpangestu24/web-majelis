<?php
include 'koneksi.php';
$error = "";
$sukses = "";

if (isset($_POST['register'])) {
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $username     = mysqli_real_escape_string($conn, $_POST['username']);
    $password     = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Cek apakah username sudah dipakai
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Username sudah digunakan, silakan pilih yang lain!";
    } else {
        // Simpan sebagai role 'user'
        $query = "INSERT INTO users (username, password, role, nama_lengkap) VALUES ('$username', '$password', 'user', '$nama_lengkap')";
        if (mysqli_query($conn, $query)) {
            $sukses = "Pendaftaran berhasil! Silakan login.";
        } else {
            $error = "Terjadi kesalahan, coba lagi.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User - Majelis Al Husein</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-slate-900 text-slate-100 flex items-center justify-center min-h-screen py-10">
    <div class="bg-slate-800 p-8 rounded-3xl shadow-2xl w-full max-w-md border border-[#078B4F]">
        <div class="text-center mb-6">
            <div class="bg-[#078B4F] text-white w-16 h-16 rounded-2xl flex items-center justify-center text-2xl mx-auto mb-4 shadow-lg">
                <i class="fa-solid fa-user-plus"></i>
            </div>
            <h2 class="text-2xl font-bold font-['Amiri']">Daftar Akun Jamaah / Wali Santri</h2>
            <p class="text-xs text-slate-400 mt-1">Buat akun sesuai nama Anda untuk memantau kegiatan & absensi</p>
        </div>

        <?php if($error != "") { ?>
            <div class="mb-4 p-3 bg-red-500/20 border border-red-500 text-red-300 rounded-xl text-xs"><?= $error; ?></div>
        <?php } ?>
        <?php if($sukses != "") { ?>
            <div class="mb-4 p-3 bg-emerald-500/20 border border-emerald-500 text-emerald-300 rounded-xl text-xs"><?= $sukses; ?> <a href="login.php" class="underline font-bold text-amber-400">Login di sini</a></div>
        <?php } ?>

        <form action="" method="POST" class="space-y-4">
            <div>
                <label class="block text-xs uppercase font-bold text-slate-300 mb-1">Nama Lengkap Sesuai Identitas</label>
                <input type="text" name="nama_lengkap" required placeholder="Contoh: Bapak Ahmad / Ibu Fatimah" class="w-full px-4 py-3 rounded-xl bg-slate-700 border border-slate-600 text-white focus:outline-none focus:border-[#078B4F]">
            </div>
            <div>
                <label class="block text-xs uppercase font-bold text-slate-300 mb-1">Username Unik</label>
                <input type="text" name="username" required placeholder="Contoh: ahmad2026" class="w-full px-4 py-3 rounded-xl bg-slate-700 border border-slate-600 text-white focus:outline-none focus:border-[#078B4F]">
            </div>
            <div>
                <label class="block text-xs uppercase font-bold text-slate-300 mb-1">Password</label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-3 rounded-xl bg-slate-700 border border-slate-600 text-white focus:outline-none focus:border-[#078B4F]">
            </div>
            <button type="submit" name="register" class="w-full bg-[#078B4F] hover:bg-[#05663a] text-white font-bold py-3.5 rounded-xl shadow-lg transition">
                <i class="fa-solid fa-user-check mr-2"></i> Daftar Sekarang
            </button>
        </form>

        <div class="mt-6 text-center text-xs text-slate-400 space-y-2">
            <div>Sudah punya akun? <a href="login.php" class="text-amber-400 hover:underline font-bold">Login di sini</a></div>
            <div><a href="index.php" class="hover:text-amber-400"><i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Beranda Website</a></div>
        </div>
    </div>
</body>
</html>
