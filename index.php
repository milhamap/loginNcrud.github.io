<?php
    require 'function.php';

    session_start();

    if(!isset($_SESSION["login"])) {
        header("Location: login.php");
        exit;
    }

    //ambil data dari tabel mahasiswa / query data mahasiswa 1 it a
    $listProduct = query("SELECT * FROM daftarproduk");

    //tombol cari ditekan
    if ( isset($_POST["cari"])) {
        $listProduct = cari($_POST["key"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>

    <a style="text-decoration:none;" href="logout.php">Logout</a>

    <h1>Daftar Product yang dijual</h1> 
    <br>
    <a href="tambah.php" style="text-decoration:none;">Tambahkan data</a>
    <br>
    <br>
    <form action="" method="post" style="float:left; margin-bottom:1rem;">

        <input type="text" name="key" size="40" autofocus
        placeholder="Masukkan nama yang akan dicari!" autocomplete="off">
        <button type="submit" name="cari">Cari!</button>

    </form>
    <a href="index.php" style="float: right; margin-bottom:1rem; text-decoration:none; display:flex;">Lihat semua</a>
    <table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>No </th>
            <th>Aksi</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Jumlah</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($listProduct as $row):?>
        <tr>
            <td><?= $i; ?></td>
            <td>
                <a href="ubah.php?id=<?= $row["id"];?>" style=" text-decoration:none;">Ubah</a>
                <a href="hapus.php?id=<?= $row["id"];?>" onclick="return confirm('yakin?');" style=" text-decoration:none;">Hapus</a>
            </td>
            <td><?= $row["nama"];?></td>
            <td><?= $row["jenis"];?></td>
            <td><?= $row["harga"];?></td>
            <td><?= $row["deskripsi"];?></td>
            <td><?= $row["jumlah"];?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
</body>
</html>