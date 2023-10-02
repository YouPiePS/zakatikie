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
$id_zakat = $_POST['id_zakat'];
$nama_kk = $_POST['nama_kk'];
$besar_bayar = $_POST['besar_bayar'];
$kategori = $_POST['kategori'];

// update data ke database
mysqli_query($con," UPDATE bayar_zakat SET id_zakat = '$id_zakat', nama_kk = '$nama_kk', besar_bayar = '$besar_bayar', kategori = '$kategori' WHERE id_zakat = '$id_zakat' ");

// mengalihkan halaman kembali ke index.php
header("location:bayarzakat.php");
?>