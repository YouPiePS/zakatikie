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
$stmt = $con->prepare('SELECT id_kategori, nama_kategori, jumlah_hak FROM kategori_mustahik WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($id_kategori, $nama_kategori, $jumlah_hak);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mustahik</title>
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
    <h2>Data Mustahik</h2>
    <a href="input_mustahik.php">Input Data Mustahik</a>
    <div>
        <h1>Detail informasi Mustahik </h1>
        <table cellspacing='0' align="center">
            <thead>
            <tr>
                <th>No</th>
                <th>ID</th>
                <th>Nama</th>
                <th>Jumlah Hak</th>
                <th>Konfigurasi</th>
            </tr>
            </thead>
            <?php
            $no = 1;
            $data = mysqli_query($con,"select * from kategori_mustahik");
            while($d = mysqli_fetch_array($data)){
                ?>
                    <tbody>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $d['id_kategori']; ?></td>
                    <td><?php echo $d['nama_kategori']; ?></td>
                    <td><?php echo $d['jumlah_hak']; ?></td>
                    <td>
                        <a href="edit_mustahik.php?id=<?php echo $d['id']; ?>">Edit</a>
                        <a href="hapus_mustahik.php?id=<?php echo $d['id']; ?>">Hapus</a>
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
