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
$id_distribusi = $_POST['id_distribusi'];
$nama = $_POST['nama'];
$kategori = $_POST['kategori'];
$jml_tanggungan = $_POST['jml_tanggungan'];
$besar = $_POST['besar'];
$waktu = $_POST['waktu'];

// update data ke database
mysqli_query($con," UPDATE tb_distribusi SET id_distribusi = '$id_distribusi', nama = '$nama', kategori = '$kategori', jml_tanggungan = '$jml_tanggungan', besar = '$besar', waktu = '$waktu' WHERE id_distribusi = '$id_distribusi' ");

// mengalihkan halaman kembali ke index.php
header("location:list_distribusi.php");
?>