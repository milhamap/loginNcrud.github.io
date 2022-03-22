<?php
require 'function.php';
    if (isset($_POST["register"])) {
        if (registrasi($_POST) > 0) {
            echo "<script>
                    alert('User baru berhasil ditambahkan!');
                </script>";
        } else {
            echo "<script>
                alert ('user baru gagal ditambahkan!');
            </script>";
            echo "<br>";
            echo mysqli_error($connect);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Registrasi</title>
</head>
<body>
    
    <h1>Halaman Registrasi</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label style="display:block;" for="fullname">Fullname :</label>
                <input type="text" name="fullname" id="fullname">
            </li>
            <li>
                <label style="display:block;" for="email">Email :</label>
                <input type="email" name="email" id="email">
            </li>
            <li>
                <label style="display:block;" for="password">Password :</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label style="display:block;" for="confirm">Confirm Password :</label>
                <input type="password" name="confirm" id="confirm">
            </li>
            <li>
                <button type="submit" name="register">Register!</button>
            </li>
        </ul>
    </form>

    <p>Sudah punya akun? <a style="text-decoration:none;" href="login.php">Login</a></p>

</body>
</html>