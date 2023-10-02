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
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT id_zakat, nama_kk,besar_bayar, kategori FROM bayar_zakat WHERE id_zakat = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id_zakat']);
$stmt->execute();
$stmt->bind_result($id_zakat, $nama_kk, $besar_bayar, $kategori);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bayar zakat</title>
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
    <h2>Bayar zakat</h2>
    <a href="tambah_bayar.php">Input Pembayar zakat</a>
    <div>
        <h1>Detail informasi Pembayar zakat </h1>
        <table cellspacing='0' align="center">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Besar bayar(kg/rp)</th>
                <th>Kategori</th>
                <th>Konfigurasi</th>
            </tr>
            </thead>
            <?php
            $no = 1;
            $data = mysqli_query($con,"select * from bayar_zakat");
            while($d = mysqli_fetch_array($data)){
                ?>
                    <tbody>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['nama_kk']; ?></td>
                    <td><?php echo $d['besar_bayar']; ?></td>
                    <td><?php echo $d['kategori']; ?></td>
                    <td>
                        <a href="edit_bayar.php?id_zakat=<?php echo $d['id_zakat']; ?>">Edit</a>
                        <a href="hapus_bayar.php?id_zakat=<?php echo $d['id_zakat']; ?>">Hapus</a>
                    </td>
                </tr>
                    </tbody>
                <?php
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>
