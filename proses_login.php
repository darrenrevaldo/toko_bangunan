<?php
include "koneksi.php";

$username = $_POST['username'];
$password = $_POST['password'];

$username = $conn->real_escape_string($username);
$password = $conn->real_escape_string($password);

$query = $conn->query("SELECT * FROM user WHERE username='$username'");

if ($query->num_rows == 1) {
    $user = $query->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        $_SESSION['login'] = true;
        $_SESSION['user'] = $user['username'];

        header("Location: produk.php");
        exit;
    }
} else {
    echo "<script>
        alert('Username atau Password salah!');
        window.location='login.php';
    </script>";
}
?>
