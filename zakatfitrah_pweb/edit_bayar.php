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
    <title>Muzakki</title>
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
    <h2>Data Pembayar</h2>
    <a href="bayarzakat.php">Kembali</a>
    <div>
        <p>Edit informasi Pembayar :</p>
        <table border="1">
            <?php
            $id_zakat = $_GET['id_zakat'];
            $data = mysqli_query($con,"select * from bayar_zakat where id_zakat ='$id_zakat'");
            while($d = mysqli_fetch_array($data)){
                ?>
                <form method="post" action="update_bayar.php">
                    <table>
                        <tr>
                            <td>Nama</td>
                            <td>
                                <input type="hidden" name="id_zakat" value="<?php echo $d['id_zakat']; ?>">
                                <input type="text" name="nama_kk" value="<?php echo $d['nama_kk']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Besar bayar</td>
                            <td><input type="float" name="besar_bayar" value="<?php echo $d['besar_bayar']; ?>"></td>
                        </tr>
                        <tr>
                            <td>kategori</td>
                            <td><input type="text" name="kategori" value="<?php echo $d['kategori']; ?>"></td>
                            <td></td>
                            <td><input type="submit" value="Simpan"></td>
                        </tr>
                    </table>
                </form>
                <?php
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>
