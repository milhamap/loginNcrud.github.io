<?php
require 'function.php';
session_start();

    //cek cookie
    if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
        $id = $_COOKIE['id'];
        $key = $_COOKIE['key'];

        //ambil username berdasarkan id
        $result = mysqli_query($connect, "SELECT email FROM user WHERE id = $id");
        $row = mysqli_fetch_assoc($result);

        //cek cookie dan username
        if($key === hash('sha256', $row['username'])) {
            $_SESSION['login'] = true;
        }
    }

    if(isset($_SESSION["login"])) {
        header("Location: index.php");
        exit;
    }

    if(isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $result = mysqli_query($connect, "SELECT * FROM user WHERE email = '$email'");

        //cek username
        if(mysqli_num_rows($result) === 1) {
            //cek password
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row["password"])) {
                //set session
                $_SESSION["login"] = true;

                //cek remember me
                if(isset($_POST["remember"])) {
                    //buat cookie

                    setcookie('id', $row['id'], time()+60);
                    setcookie('key', hash('sha256', $row['email']), time()+60);
                }

                header("Location: index.php");
                exit;
            }
        }

        $error = true;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>
<body>
    
    <h1>Halaman Login</h1>

    <?php if(isset($error)) : ?>
        <p style="color: red; font-style: italic;">Username / Password salah</p>
    <?php endif; ?>

    <form action="" method="post">
        <ul>
            <li>
                <label style="display:block;" for="email">Email :</label>
                <input type="email" name="email" id="email">
            </li>
            <li>
                <label style="display:block;" for="password">Password :</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </li>
            <li>
                <button type="submit" name="login">Login!</button>
            </li>
        </ul>
    </form>

    <p>Belum punya akun? <a style="text-decoration:none;" href="register.php">Daftar</a></p>

</body>
</html>