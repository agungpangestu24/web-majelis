<?php
include 'koneksi.php';
$error = "";
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    if (mysqli_num_rows($query) == 1) {
        $row = mysqli_fetch_assoc($query);
        $_SESSION['user'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['nama'] = $row['nama_lengkap'];
        if ($row['role'] == 'admin') { header("Location: admin.php"); } 
        else { header("Location: index.php"); }
        exit();
    } else { $error = "Username atau password salah!"; }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Majelis Al Husein</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-slate-900 text-slate-100 flex items-center justify-center min-h-screen">
    <div class="bg-slate-800 p-8 rounded-3xl shadow-2xl w-full max-w-md border border-[#078B4F]">
        <div class="text-center mb-8">
            <div class="bg-[#078B4F] text-white w-16 h-16 rounded-2xl flex items-center justify-center text-2xl mx-auto mb-4 shadow-lg">
                <i class="fa-solid fa-mosque"></i>
            </div>
            <h2 class="text-2xl font-bold font-['Amiri']">Login Majelis Al Husein</h2>
            <p class="text-xs text-slate-400 mt-1">Masuk untuk Manager (Admin) atau Jamaah / Wali Santri</p>
        </div>
        <?php if($error != "") { ?>
            <div class="mb-4 p-3 bg-red-500/20 border border-red-500 text-red-300 rounded-xl text-xs"><?= $error; ?></div>
        <?php } ?>
        <form action="" method="POST" class="space-y-4">
            <div>
                <label class="block text-xs uppercase font-bold text-slate-300 mb-1">Username</label>
                <input type="text" name="username" required class="w-full px-4 py-3 rounded-xl bg-slate-700 border border-slate-600 text-white focus:outline-none focus:border-[#078B4F]">
            </div>
            <div>
                <label class="block text-xs uppercase font-bold text-slate-300 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 rounded-xl bg-slate-700 border border-slate-600 text-white focus:outline-none focus:border-[#078B4F]">
            </div>
            <button type="submit" name="login" class="w-full bg-[#078B4F] hover:bg-[#05663a] text-white font-bold py-3.5 rounded-xl shadow-lg transition">
                <i class="fa-solid fa-right-to-bracket mr-2"></i> Masuk Sekarang
            </button>
        </form>
        <div class="mt-6 text-center text-xs text-slate-400 space-y-2">
            <div>Belum punya akun jamaah? <a href="register.php" class="text-amber-400 hover:underline font-bold">Daftar (Register) di sini</a></div>
            <div><a href="index.php" class="hover:text-amber-400"><i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Beranda Website</a></div>
        </div>
        <div class="mt-4 pt-4 border-t border-slate-700 text-center text-[11px] text-slate-500">
            Login Manager (Admin): <code class="text-amber-400">admin</code> / <code class="text-amber-400">password123</code>
        </div>
    </div>
</body>
</html>
