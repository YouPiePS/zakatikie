<?php
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

// menangkap data yang di kirim dari form
$nama_kk = $_POST['nama_kk'];
$besar_bayar = $_POST['besar_bayar'];
$kategori = $_POST['kategori'];

// menginput data ke database
mysqli_query($con,"insert into bayar_zakat values('','$nama_kk','$besar_bayar','$kategori')");

// mengalihkan halaman kembali ke index.php
header("location:bayarzakat.php");

?>