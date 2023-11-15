<?php
date_default_timezone_set("Asia/Bangkok");

$koneksi = mysqli_connect("localhost", "root", "", "basisdata2");

// Initialize the notification variable
$notification = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $email = $_POST['email'];
    $jk = $_POST['jk'];
    $submit = $_POST['submit'];

    // Check if any required field is empty
    if (empty($nim) || empty($nama) || empty($kelas) || empty($email) || empty($jk) || empty($submit)) {
        $notification = "Please fill out all required fields.";
    } else {
        // Check if NIM already exists
        $checkQuery = "SELECT * FROM inputdata WHERE nim = '$nim'";
        $result = mysqli_query($koneksi, $checkQuery);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // Data with the same NIM already exists
                $notification = "Data nim nya ada yang sama, ganti yang lain kalau dia (nim nya) udah ada yang memiliki";
            } else {
                // Data doesn't exist, proceed with insertion
                $insertQuery = "INSERT INTO inputdata VALUES('$nim', '$nama', '$kelas', '$email', '$jk', '$submit', '')";
                $insertResult = mysqli_query($koneksi, $insertQuery);

                if ($insertResult) {
                    $notification = "Data inserted successfully!";
                } else {
                    $notification = "Error inserting data: " . mysqli_error($koneksi);
                }
            }
        } else {
            $notification = "Error checking NIM existence: " . mysqli_error($koneksi);
        }
    }

    mysqli_close($koneksi);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        label {
            display: inline-block;
            width: 60px;
        }
    </style>
</head>
<body>
    <h2> Input Data </h2>
    <!-- Display the notification -->
    <p><?php echo $notification; ?></p>

    <form class="" action="index.php" method="post">
        <label for="Nim">Nim</label>
        : <input type="text" name="nim" autocomplete="off" required> <br>
        
        <label for="Nama">Nama</label>
        : <input type="text" name="nama" autocomplete="off" required> <br>
        
        <label for="Kelas">Kelas</label>
        : <input type="text" name="kelas" autocomplete="off" required> <br>
        
        <label for="Email">Email</label>
        : <input type="text" name="email" autocomplete="off" required> <br>
        
        <label for="JenisKelamin">JK</label>
        : <input type="radio" name="jk" value="Pria" required>Pria 
        <input type="radio" name="jk" value="Wanita" required>Wanita <br>
        
        <button type="submit" name="submit" value="<?php echo date("h:i:sa")?>">Submit</button>
    </form>
    <br>
    <a href="laporan.php">Laporan Data input</a>
</body>
</html>
