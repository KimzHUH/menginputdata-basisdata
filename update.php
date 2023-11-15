<?php
date_default_timezone_set("Asia/Bangkok");
?>
<?php
$koneksi = mysqli_connect("localhost", "root", "", "basisdata2");
$id = $_GET['id'];
$data = query("SELECT *FROM inputdata WHERE id = $id")[0];

function query($data){
    global $koneksi;

    $hasil = mysqli_query($koneksi, $data);
    $rows = [];
    while ($row = mysqli_fetch_assoc($hasil)) {
        $rows[] = $row;
    }

    return $rows;
}

if(isset($_POST["submit"])) {
    if(update($_POST) > 0 ){
        echo "<script> alert('Data Berhasil Diubah'); </script>";
        header('Location: laporan.php');
    }
    else {
        echo "<script> alert('Data Gagal Diubah'); </script>";
        header('Location: laporan.php');
    }
}

function update ($sambung){
    global $koneksi;

    $id = $sambung['id'];
    $nim = $sambung['nim'];
    $nama = $sambung['nama'];
    $kelas = $sambung['kelas'];
    $email = $sambung['email'];
    $jk = $sambung['jk'];
    $submit = $sambung['submit'];

    $query = "UPDATE inputdata SET nim = '$nim', nama = '$nama', kelas = '$kelas', email = '$email', jk = '$jk', submit = '$submit' WHERE id = $id";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        label {
            display: inline-block;
            width: 60px; 
        }
    </style>
</head>
<body>
    <h2> Ubah Data </h2>
    <form class="" action="" method="post">
        <input type="hidden" name="id" value="<?php echo $data["id"]; ?>">
        <label for="Nim">Nim</label>
        : <input type="text" name="nim" autocomplete="off" value="<?php echo $data["nim"]; ?>"> <br>
        
        <label for="Nama">Nama</label>
        : <input type="text" name="nama" autocomplete="off" value="<?php echo $data["nama"]; ?>"> <br>
        
        <label for="Kelas">Kelas</label>
        : <input type="text" name="kelas" autocomplete="off" value="<?php echo $data["kelas"]; ?>"> <br>
        
        <label for="Email">Email</label>
        : <input type="text" name="email" autocomplete="off" value="<?php echo $data["email"]; ?>"> <br>
        
        <label for="JenisKelamin">JK</label>
        : <input type="radio" name="jk" value="Pria" <?php if($data['jk'] == 'Pria') echo 'checked'; ?> >Pria 
        <input type="radio" name="jk" value="Wanita" <?php if($data['jk'] == 'Wanita') echo 'checked'; ?>>Wanita <br>
        
        <button type="submit" name="submit" value="<?php echo date("h:i:sa")?>">Submit</button>
    </form>
</body>
</html>
