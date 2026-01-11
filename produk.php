<?php
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['tambah'])) {
    $conn->query("INSERT INTO barang (nama_barang,harga,stok) VALUES (
        '$_POST[nama]',
        '$_POST[harga]',
        '$_POST[stok]'
    )");
}

if (isset($_POST['update'])) {
    $conn->query("UPDATE barang SET 
        nama_barang = '$_POST[nama]',
        harga = '$_POST[harga]',
        stok = '$_POST[stok]'
        WHERE id = '$_POST[id]'");

    header("Location: produk.php");
    exit;
}


if (isset($_GET['hapus'])) {
    $conn->query("DELETE FROM barang WHERE id='$_GET[hapus]'");
}

$data = $conn->query("SELECT * FROM barang");
$data = $data->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>barang - Toko Bangunan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

    <div class="flex justify-between items-center mb-5">
        <h1 class="text-3xl font-bold">Data Barang</h1>
        <div>
            <?php if (isset($_SESSION['user'])) : ?>
                <span class="mr-4 text-gray-700">Halo, <?= $_SESSION['user'] ?></span>
            <?php endif; ?>
            <a href="logout.php"
                onclick="return confirm('Yakin ingin logout?')"
                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded shadow">
                Logout
            </a>
        </div>

    </div>


    <!-- Form Tambah -->
    <div class="bg-white p-6 rounded shadow mb-6">
        <form method="POST" class="grid grid-cols-3 gap-4">
            <input type="text" name="nama" placeholder="Nama barang" class="border p-2 rounded" required>
            <input type="number" name="harga" placeholder="Harga" class="border p-2 rounded" required>
            <input type="number" name="stok" placeholder="Stok" class="border p-2 rounded" required>
            <button name="tambah" class="col-span-3 bg-orange-600 text-white py-2 rounded hover:bg-orange-700">
                Tambah barang
            </button>
        </form>
    </div>

    <!-- Tabel barang -->
    <table class="w-full bg-white rounded shadow overflow-hidden">
        <tr class="bg-orange-600 text-white">
            <th>#</th>
            <th class="p-3">Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($data as $i => $p) { ?>
            <tr class="border-t text-center hover:bg-gray-50">
                <td class="p-3"><?= $i + 1 ?></td>
                <td class="p-3"><?= $p['nama_barang'] ?></td>
                <td>Rp <?= number_format($p['harga']) ?></td>
                <td><?= $p['stok'] ?></td>
                <td class="flex justify-center gap-2 p-2">
                    <a href="?edit=<?= $p['id'] ?>" class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>
                    <a href="?hapus=<?= $p['id'] ?>" onclick="return confirm('Hapus?')" class="bg-red-500 text-white px-3 py-1 rounded">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <?php
    if (isset($_GET['edit'])) {
        $e = $conn->query("SELECT * FROM barang WHERE id='$_GET[edit]'")->fetch_assoc();
    ?>
        <!-- Modal Edit -->
        <div class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded w-96">
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $e['id'] ?>">
                    <input type="text" name="nama" value="<?= $e['nama_barang'] ?>" class="border p-2 w-full mb-2">
                    <input type="number" name="harga" value="<?= $e['harga'] ?>" class="border p-2 w-full mb-2">
                    <input type="number" name="stok" value="<?= $e['stok'] ?>" class="border p-2 w-full mb-4">
                    <div class="grid grid-cols-2 gap-4">
                        <a href="produk.php" class="bg-red-600 text-white text-center w-full py-2 rounded">Cancel</a>
                        <button name="update" class="bg-green-600 text-white w-full py-2 rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>
    <?php } ?>

</body>

</html>