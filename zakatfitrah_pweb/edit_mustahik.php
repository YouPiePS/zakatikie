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
        <h1>Sistem Informasi Zakat Fitrah</h1>
        <a href="muzakki.php"><i class="fas fa-user-circle"></i>Muzakki</a>
        <a href="mustahik.php"><i class="fas fa-user-circle"></i>Mustahik</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
</nav>
<div class="content">
    <h2>Data Mustahik</h2>
    <a href="mustahik.php">Kembali</a>
    <div>
        <p>Edit informasi Mustahik :</p>
        <table border="1">
            <?php
            $id = $_GET['id'];
            $data = mysqli_query($con,"select * from kategori_mustahik where id='$id'");
            while($d = mysqli_fetch_array($data)){
                ?>
                <form method="post" action="update_mustahik.php">
                    <table>
                        <tr>
                            <td>ID</td>
                            <td><input type="text" name="id_kategori" value="<?php echo $d['id_kategori']; ?>"></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>
                                <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
                                <input type="text" name="nama_kategori" value="<?php echo $d['nama_kategori']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Jumlah Hak</td>
                            <td><input type="number" name="jumlah_hak" value="<?php echo $d['jumlah_hak']; ?>"></td>
                        </tr>
                        <tr>
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
