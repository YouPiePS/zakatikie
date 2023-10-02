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
$id = $_POST['id'];
$nama_muzakki = $_POST['nama_muzakki'];
$jumlah_tanggungan = $_POST['jumlah_tanggungan'];
$beras = $_POST['beras'];
$uang = $_POST['uang'];
$keterangan = $_POST['keterangan'];

// update data ke database
mysqli_query($con," UPDATE muzakki SET id = '$id', nama_muzakki = '$nama_muzakki', jumlah_tanggungan = '$jumlah_tanggungan', beras = '$beras', uang = '$uang', keterangan = '$keterangan' WHERE id = '$id' ");

// mengalihkan halaman kembali ke index.php
header("location:muzakki.php");
?>