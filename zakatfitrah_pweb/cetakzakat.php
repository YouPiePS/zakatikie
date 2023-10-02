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

//Query data guru berdasarkan id
$querynama = "SELECT * FROM tb_distribusi";

$querynama = "SELECT * FROM tb_distribusi";
$penerima = mysqli_query($con, $querynama);

$no = 0;

    date_default_timezone_set('Asia/Jakarta'); 
    $today = date("d-m-Y");
?>
<!DOCTYPE html>
<html>
	<head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
		<script>
			function generatePDF() {
			const element = document.getElementById('container_content');
			var opt = {
				  margin:       0.2,
				  filename:     'Laporan Distribusi.pdf',
				  image:        { type: 'jpeg', quality: 0.98 },
				  html2canvas:  { scale: 2 },
				  jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
				};
				// Choose the element that our invoice is rendered in.
				html2pdf().set(opt).from(element).save();
			}
		</script>
		</head>
	<body style="font-family: 'Work Sans', sans-serif;">
    <div class="container_content" id="container_content" >
        <div style="border: 1px black solid; width: 700px; padding: 10px;">
            <div style="display: flex;">
                <img src="./assets/img/logo2.png" alt="" style="width: 200px; height: 100px;">
                <div>
                    <h3 style="font-weight: 700;">Amil Zakat</h3>
                    <p>Badan Zakat Lokal</p>
                    <p>Indonesia</p>
                </div>
            </div>
            <hr>
            <h4 style="font-weight: 700; text-align: center; text-decoration: underline;">Tanda Bukti Distribusi</h4>

			<h4 style="font-weight: 700; text-align: left; text-decoration: underline;">Detail Nama Penerima Zakat</h4>
            <br>
            <div style="position: absolute;">
                <table border="1">
                    <thead>
                        <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>kategori</th>
                        <th>jumlah tanggungan</th>
                        <th>nominal</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($d = mysqli_fetch_array($penerima)){
                        ?>
                            <tr>
                            <td><?= ++$no; ?>.</td>
                            <td><?php echo $d['nama']; ?></td>
                            <td><?php echo $d['kategori']; ?></td>
                            <td><?php echo $d['jml_tanggungan']; ?></td>
                            <td><?php echo $d['besar']; ?>Kg</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>  
                </div>
            
            <div style="text-align: right;">
                <p style="font-weight: 700;"><?=$today?></p>
                <img src="./img/ttd.png" alt="" style="height: 100px; margin-right: 20px; border-bottom: 1px black solid; text-align: center;">
                <p style="margin-top: 10px; margin: 10px; font-weight: 700;">Amil Zakat</p>
            </div>
        </div>
    </div>
    <script>
        generatePDF();
    </script>
    <meta http-equiv="refresh" content="0.2;url=./home.php" />
</body>
</html>