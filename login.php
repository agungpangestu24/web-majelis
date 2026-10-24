<?php
session_start();
include 'koneksi.php';

$error = "";
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
    if (mysqli_num_rows($query) === 1) {
        $row = mysqli_fetch_assoc($query);
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['username'] = $username;
            header("Location: admin.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Majelis Al Husein</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-900 flex items-center justify-center min-h-screen text-slate-100 p-4">
    <div class="bg-slate-800 p-8 rounded-2xl shadow-2xl w-full max-w-md border border-slate-700">
        <div class="text-center mb-6">
            <div class="bg-amber-500 text-slate-900 w-14 h-14 rounded-2xl flex items-center justify-center mx-auto text-2xl font-bold mb-3">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <h2 class="text-2xl font-bold">Login Pengurus Admin</h2>
            <p class="text-xs text-slate-400 mt-1">Majelis Al Husein</p>
        </div>

        <?php if(!empty($error)): ?>
            <div class="bg-red-500/20 border border-red-500 text-red-300 p-3 rounded-xl text-xs mb-4 text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="space-y-4">
            <div>
                <label class="block text-xs font-semibold mb-1 text-slate-300">Username</label>
                <input type="text" name="username" required placeholder="admin" class="w-full px-4 py-2.5 rounded-xl border border-slate-700 bg-slate-900 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
            </div>
            <div>
                <label class="block text-xs font-semibold mb-1 text-slate-300">Password</label>
                <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-2.5 rounded-xl border border-slate-700 bg-slate-900 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 text-sm">
            </div>
            <button type="submit" name="login" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3 rounded-xl transition text-sm">
                Masuk ke Dashboard
            </button>
            <a href="index.php" class="block text-center text-xs text-slate-400 hover:text-white mt-4">← Kembali ke Website Utama</a>
        </form>
    </div>
</body>
</html>
