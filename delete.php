<?php
$id = $_GET['id'];

$koneksi = mysqli_connect("localhost", "root", "", "basisdata2");

function delete($id){
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM inputdata WHERE id = $id");

    return mysqli_affected_rows($koneksi);
}

if ( delete($id) > 0 ){
    echo
    "<script>
    alert('Data Berhasil dihapus'); 
    document.location.href = 'laporan.php';
    </script>";
}
else {
    echo
    "<script>
    alert('Data Gagal dihapus'); 
    document.location.href = 'laporan.php';
    </script>";
}
?>

