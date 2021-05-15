<?php
session_start();
require 'function.php';

if (isset($_COOKIE['key']) && isset($_COOKIE['word'])) {
    $key = $_COOKIE['key'];
    $word = $_COOKIE['word'];

    $data = mysqli_query($koneksi, "SELECT Username FROM login Where ID = $key");
    $baris = mysqli_fetch_assoc($data);

    if ($word === hash('sha256', $baris['Username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $data = mysqli_query($koneksi, "SELECT * FROM login WHERE username = '$username'");
    
    if (mysqli_num_rows($data) === 1) {
        $baris = mysqli_fetch_assoc($data);
        if ( password_verify($password, $baris["Password"])) {
           
            $_SESSION['login'] = true;

            if (isset($_POST['rememberMe'])) {
                setcookie('key', $baris['ID'], time() + 120);
                setcookie('word', hash('sha256', $baris['Username']), time() + 120);

            }
           
            header("Location: index.php");
           exit;
        }
    }
    $salah = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="quiz.css"> -->
</head>
<body>
    <div class="container p-3 my-3 border shadow-lg ">
        <h1 class="text-sm-center">LOGIN</h1>
        <?php if (isset($salah)):?>
            <p class="alert alert-danger">Username atau Password anda salah</p>
        <?php endif;?>
        <form action="" method="POST" class="rounded p-md-5">
            <div class="form-group mb-3">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter username">            
            </div>
            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
            </div>
            <div class="form-group form-check mb-3">
                <label for="rememberMe" class="form-check-label">
                    <input type="checkbox" name="rememberMe" id="rememberMe" class="form-check-input">Remember Me
                </label>
            </div>
                <button type="submit" name="login" class="btn btn-primary p-2 shadow-lg" style="width: 10%;">Login</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>