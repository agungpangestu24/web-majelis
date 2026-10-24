<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}

# Hapus Data Santri
if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    mysqli_query($conn, "DELETE FROM santri WHERE id=$id");
    header("Location: admin.php");
    exit;
}

# Update Data Santri
if (isset($_POST['update_santri'])) {
    $id = (int)$_POST['id'];
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $nama_ortu = mysqli_real_escape_string($conn, $_POST['nama_ortu']);
    $usia = (int)$_POST['usia'];
    $no_hp = mysqli_real_escape_string($conn, $_POST['no_hp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);

    mysqli_query($conn, "UPDATE santri SET nama='$nama', nama_ortu='$nama_ortu', usia=$usia, no_hp='$no_hp', alamat='$alamat' WHERE id=$id");
    header("Location: admin.php");
    exit;
}

$dataSantri = mysqli_query($conn, "SELECT * FROM santri ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Majelis Al Husein</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-slate-100 text-slate-800 font-['Plus_Jakarta_Sans',sans-serif]">

    <!-- Admin Header -->
    <header class="bg-emerald-950 text-white py-4 px-6 shadow-md flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <i class="fa-solid fa-user-shield text-amber-400 text-2xl"></i>
            <div>
                <h1 class="font-bold text-lg leading-tight">Dashboard Pengurus Majelis Al Husein</h1>
                <p class="text-xs text-emerald-300">Kelola Data Anak Mengaji</p>
            </div>
        </div>
        <div class="flex items-center space-x-4">
            <a href="index.php" target="_blank" class="text-xs bg-emerald-800 hover:bg-emerald-700 px-3 py-2 rounded-lg transition"><i class="fa-solid fa-globe mr-1"></i> Lihat Web</a>
            <a href="logout.php" class="text-xs bg-red-600 hover:bg-red-500 text-white font-bold px-3 py-2 rounded-lg transition"><i class="fa-solid fa-right-from-bracket mr-1"></i> Logout</a>
        </div>
    </header>

    <div class="max-w-7xl mx-auto p-6">
        <div class="bg-white p-6 rounded-2xl shadow-md border border-slate-200">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-xl font-bold text-emerald-950">Daftar Anak Baru Mengaji</h3>
                    <p class="text-xs text-slate-500">Pengurus dapat mengubah (update) nama atau menghapus data anak terdaftar.</p>
                </div>
            </div>

            <!-- Tabel Data Santri -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-100 text-slate-700 text-xs font-bold uppercase tracking-wider border-b border-slate-200">
                            <th class="p-3">No</th>
                            <th class="p-3">Nama Anak</th>
                            <th class="p-3">Nama Orang Tua</th>
                            <th class="p-3">Usia</th>
                            <th class="p-3">No. WhatsApp</th>
                            <th class="p-3">Alamat</th>
                            <th class="p-3 text-center">Aksi (Update / Hapus)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        <?php 
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($dataSantri)): 
                        ?>
                        <tr class="hover:bg-slate-50">
                            <form method="POST" action="admin.php">
                                <td class="p-3 font-semibold text-slate-500"><?php echo $no++; ?></td>
                                <td class="p-3">
                                    <input type="text" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required class="px-2 py-1 rounded border border-slate-300 w-full text-sm">
                                </td>
                                <td class="p-3">
                                    <input type="text" name="nama_ortu" value="<?php echo htmlspecialchars($row['nama_ortu']); ?>" required class="px-2 py-1 rounded border border-slate-300 w-full text-sm">
                                </td>
                                <td class="p-3">
                                    <input type="number" name="usia" value="<?php echo $row['usia']; ?>" required class="px-2 py-1 rounded border border-slate-300 w-16 text-sm">
                                </td>
                                <td class="p-3">
                                    <input type="text" name="no_hp" value="<?php echo htmlspecialchars($row['no_hp']); ?>" required class="px-2 py-1 rounded border border-slate-300 w-full text-sm">
                                </td>
                                <td class="p-3">
                                    <input type="text" name="alamat" value="<?php echo htmlspecialchars($row['alamat']); ?>" required class="px-2 py-1 rounded border border-slate-300 w-full text-sm">
                                </td>
                                <td class="p-3 text-center">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="update_santri" class="bg-amber-500 hover:bg-amber-600 text-emerald-950 px-3 py-1.5 rounded-lg font-bold text-xs shadow transition mb-1">
                                        <i class="fa-solid fa-pen-to-square"></i> Simpan
                                    </button>
                                    <a href="admin.php?hapus=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="bg-red-600 hover:bg-red-500 text-white px-3 py-1.5 rounded-lg font-bold text-xs shadow transition inline-block">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </a>
                                </td>
                            </form>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
