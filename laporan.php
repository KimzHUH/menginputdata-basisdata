<?php
$koneksi = mysqli_connect("localhost", "root", "", "basisdata2");
$statistik = query("SELECT * FROM inputdata");

function query($data)
{
    global $koneksi;

    $hasil = mysqli_query($koneksi, $data);
    $rows = [];
    while ($row = mysqli_fetch_assoc($hasil)) {
        $rows[] = $row;
    }

    return $rows;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>
    <h2>Laporan Dari Input Data</h2>
    <table border=1 cellpadding=10 cellspacing=0>
        <tr>
            <th>Nomor</th>
            <th>Nim</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Email</th>
            <th>Jenis Kelamin</th>
            <th>Waktu Submit</th>
            <th colspan="2">Tindakan</th>
        </tr>

        <?php $y = 1 ?>
        <?php foreach ($statistik as $data) : ?>
            <tr>
                <td><?php echo $y; ?></td>
                <td><?php echo $data["nim"]; ?></td>
                <td><?php echo $data["nama"]; ?></td>
                <td><?php echo $data["kelas"]; ?></td>
                <td><?php echo $data["email"]; ?></td>
                <td><?php echo $data["jk"]; ?></td>
                <td><?php echo $data["submit"]; ?></td>
                <td><a href="update.php?id=<?php echo$data["id"]; ?>">Update</td>
                <td><a href="delete.php?id=<?php echo$data["id"]; ?>">Delete</td>
            </tr>
        <?php $y++; ?>
        <?php endforeach; ?>
    </table>
    <br>
    <p>Total Data = <?php echo ($y - 1); ?></p>
    <br>
    <a href="index.php">Input Data</a>
    <br> <br>
    <br> <br>
    <a href="login.php">Balik Login Mas</a>
</body>

</html>
