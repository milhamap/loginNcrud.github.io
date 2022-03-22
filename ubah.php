<?php 
require 'function.php';

session_start();

if(!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

//ambil data di url
$id = $_GET["id"];

//query data mahasiswa berdasarkan id
$listProduct = query("SELECT * FROM daftarproduk WHERE id = $id")[0];

// cek tombol submit sudah di klik atau belum
if ( isset($_POST["submit"]) ) {
    // cek hasil input data berhasil atau tidak
    if ( ubahData($_POST) > 0 ) {
        echo "<script>
                alert ('data berhasil diubah!');
                document.location.href = 'index.php'; 
            </script>";
    }else {
        echo "<script>
                alert ('data gagal diubah!');
                document.location.href = 'index.php'; 
            </script>";
        echo "<br>";
        echo mysqli_error($connect);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ubah</title>
</head>
<body>
    <h1>Ubah Data Mahasiswa 1 D4 IT A</h1>
    <a href="index.php" style="float: right; margin-bottom:1rem; text-decoration:none;">Kembali ke halaman utama</a>
    <form action="" method="post">
        <input type="hidden" name="id" id="id" value="<?= $listProduct["id"]?>">
    <ul>
        <li style="margin:1rem; list-style:none;">
            <label for="nama">Nama :</label>
            <input style="margin-left:55px;" type="text" name="nama" id="nama" required
            value="<?= $listProduct["nama"]?>">
        </li>
        <li style="margin:1rem; list-style:none;">
            <label for="jenis">Jenis :</label>
            <input style="margin-left:63px;" type="text" name="jenis" id="jenis" required
            value="<?= $listProduct["jenis"]?>">
        </li>
        <li style="margin:1rem; list-style:none;">
            <label for="harga">Harga :</label>
            <input style="margin-left:29px;" type="text" name="harga" id="harga" required
            value="<?= $listProduct["harga"]?>">
        </li>
        <li style="margin:1rem; list-style:none;">
            <label for="deskripsi">Deskripsi :</label>
            <input style="margin-left:9px;" type="text" name="deskripsi" id="deskripsi" required
            value="<?= $listProduct["deskripsi"]?>">
        </li>
        <li style="margin:1rem; list-style:none;">
            <label for="jumlah">Jumlah :</label>
            <input style="margin-left:9px;" type="text" name="jumlah" id="jumlah" required
            value="<?= $listProduct["jumlah"]?>">
        </li>
        <li style="margin:1rem; list-style:none;">
            <button type="submit" name="submit">Ubah Data!</button>
        </li>
    </ul>
</form>
</body>
</html>