<?php
    //Koneksi ke database
    $connect = mysqli_connect("localhost", "root", "", "product");

function query ($query){
    global $connect;
    $result = mysqli_query($connect, $query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambahData($data) {
    global $connect;

    // ambil data dari tiap elemen dalam form
    // htmlspecialchar mencegah menampilkan html yang di input user
    $nama = htmlspecialchars($data ["nama"]);
    $jenis = htmlspecialchars($data ["jenis"]);
    $harga = htmlspecialchars($data ["harga"]);
    $desc = htmlspecialchars($data ["deskripsi"]);
    $jumlah = htmlspecialchars($data ["jumlah"]);

    // buat data yang akan di query
    $query = "INSERT INTO daftarproduk 
                VALUES
            ('', '$nama', '$jenis', '$harga', '$desc', '$jumlah')
            ";
    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

function hapus ($id) {
    global $connect;
    mysqli_query( $connect , "DELETE FROM daftarproduk WHERE id = $id");
    return mysqli_affected_rows($connect);
}

function ubahData ($data) {
    global $connect;

    // ambil data dari tiap elemen dalam form
    // htmlspecialchar mencegah menampilkan html yang di input user
    $id = $data["id"];
    $nama = htmlspecialchars($data ["nama"]);
    $jenis = htmlspecialchars($data ["jenis"]);
    $harga = htmlspecialchars($data ["harga"]);
    $desc = htmlspecialchars($data ["deskripsi"]);
    $jumlah = htmlspecialchars($data ["jumlah"]);

    // buat data yang akan di query
    $query = "UPDATE daftarproduk SET
                nama = '$nama',
                jenis = '$jenis',
                harga = '$harga',
                deskripsi = '$desc',
                jumlah = '$jumlah'
              WHERE id = $id
            ";
    mysqli_query($connect, $query);

    return mysqli_affected_rows($connect);
}

function cari ($key) {
    $query = "SELECT * FROM daftarproduk
                WHERE
              nama LIKE '%$key%' OR
              jenis LIKE '%$key%'
              ";
            return query($query);
}

function registrasi($data) {
    global $connect;

    //menyimpan data yang diambil
    $fullname = strtolower (stripslashes ($data["fullname"]));
    $email = strtolower (stripslashes ($data["email"]));
    $password = mysqli_real_escape_string ($connect, $data["password"]);
    $confirm = mysqli_real_escape_string ($connect, $data["confirm"]);

    //cek apakah email sudah ada atau belum
    $result = mysqli_query($connect, "SELECT email FROM user WHERE email = '$email'");
    if(mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Email sudah terdaftar!');
              </script>";
        return false;
    }

    // cek konfirmasi password 
    if ($password !== $confirm) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
            </script>";
        return false;
    } else 
        echo mysqli_error($connect);

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($connect, "INSERT INTO user VALUES('', '$fullname', '$email', '$password')");

    return mysqli_affected_rows($connect);
}