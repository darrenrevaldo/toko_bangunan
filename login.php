<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login | Toko Bangunan Modern</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-cover bg-center flex items-center justify-center"
    style="background-image: url('background.png');">

    <div class="absolute inset-0 bg-black bg-opacity-60"></div>

    <div class="relative z-10 w-full max-w-md bg-white rounded-2xl shadow-2xl p-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">Toko Bangunan</h2>
        <p class="text-center text-gray-500 mb-6">Login Admin</p>

        <form action="proses_login.php" method="POST" class="space-y-5">
            <div>
                <label class="block text-gray-700 font-semibold mb-1">Username</label>
                <input type="text" name="username" required
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:outline-none"
                    placeholder="Masukkan username">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-orange-500 focus:outline-none"
                    placeholder="Masukkan password">
            </div>

            <button type="submit"
                class="w-full bg-orange-600 hover:bg-orange-700 text-white font-bold py-3 rounded-lg transition">
                Login
            </button>
        </form>

        <p class="text-center text-gray-500 text-sm mt-6">
            © <?= date('Y') ?> Toko Bangunan
        </p>
    </div>

</body>

</html>