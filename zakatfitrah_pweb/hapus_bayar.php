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
// menangkap data id yang di kirim dari url
$id_zakat = $_GET['id_zakat'];

// menghapus data dari database
mysqli_query($con,"DELETE FROM bayar_zakat WHERE id_zakat='$id_zakat'");

// mengalihkan halaman kembali ke index.php
header("location:bayarzakat.php");
?>