<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'admin';
$DATABASE_PASS = 'secret';
$DATABASE_NAME = 'zakatfitrah';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$id_warga = $_POST['id_warga'];
$nama = $_POST['nama'];
$kategori = $_POST['kategori'];

// update data ke database
mysqli_query($con,"update warga set id_warga='$id_warga', nama='$nama', kategori='$kategori' where id_warga = '$id_warga'");

// mengalihkan halaman kembali ke index.php
header("location:warga.php");
?>