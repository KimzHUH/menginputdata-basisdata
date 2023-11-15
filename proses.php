<?php
date_default_timezone_set("Asia/Bangkok");

$koneksi = mysqli_connect("localhost", "root", "", "basisdata2");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $email = $_POST['email'];
    $jk = $_POST['jk'];
    $submit = $_POST['submit'];

    // Check if NIM already exists
    $checkQuery = "SELECT * FROM inputdata WHERE nim = '$nim'";
    $result = mysqli_query($koneksi, $checkQuery);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Data with the same NIM already exists
            $notification = "Data with this NIM already exists. Please use a different NIM.";
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

    mysqli_close($koneksi);
}

if (isset($_POST["submit"])) {
    header('Location: laporan.php');
    exit;
}
?>
