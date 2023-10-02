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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Distribusi</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
</head>
<body class="loggedin">
<nav class="navtop">
    <div>
    <img src="asset/logo2.png" alt="">
        <h1>Si Zarah</h1>
        <a href="cetakzakat.php"><i class="fas fa-user-circle"></i>Laporan</a>
        <a href="list_distribusi.php"><i class="fas fa-user-circle"></i>distribusi</a>
        <a href="bayarzakat.php"><i class="fas fa-user-circle"></i>Bayar</a>
        <a href="warga.php"><i class="fas fa-user-circle"></i>warga</a>
        <a href="muzakki.php"><i class="fas fa-user-circle"></i>Muzakki</a>
        <a href="mustahik.php"><i class="fas fa-user-circle"></i>Mustahik</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
</nav>
<div class="content">
    <h2>Distribusi zakat</h2>
    <div>
        <p>Silahkan Masukkan list Distribusi zakat</p>
        <form method="post" action="input_data_distribusi.php">
        <table>
            
            <tr>
                <td>Nama:</td>
                <td><input type="text" name="nama"></td>
            </tr>
            <tr>
                <td>Kategori:</td>
                <td><input type="text" name="kategori"></td>
            </tr>
                <td>Tanggungan:</td>
                <td><input type="text" name="jml_tanggungan" id= "jml2" onchange = "update()"></td>
            </tr>
            <tr>
                <td>Nominal:</td>
                <td><input type="float" id="input" name="besar"></td>
            </tr>

            <tr>
                <td>Waktu:</td>
                <td><input type="date" id="inputs" name="waktu"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Simpan"></td>
            </tr>
        </table>
    </div>
</div>
<script type="text/javascript">
    var jmlDibayarInput = document.getElementById('jml2');
    var bayarBerasInput = document.getElementById('input');
    var bayarUangInput = document.getElementById('inputs');
    jmlDibayarInput.addEventListener('input', function() {
        var jmlDibayar = parseFloat(jmlDibayarInput.value);
        var satuanBeras = 2.5; // Satuan beras per tanggungan (kg)
        var satuanUang = 10000; // Satuan uang per tanggungan (Rp)
        var bayarBeras = jmlDibayar  * satuanBeras;
        var bayarUang = jmlDibayar * satuanUang;
        bayarBerasInput.value = bayarBeras + ' '+'Kg';
        bayarUangInput.value = bayarUang ;

    });
   </script>
</body>
</html>