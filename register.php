<?php
require 'function.php';

if (isset($_POST["register"]) ) {

    if( btnRegister($_POST) > 0 ) {
        echo "<script>
                alert ('Data Berhasil Ditambahkan')
            </script>";
    } else {
        echo mysqli_error($koneksi);
    }
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Registrasi</title>
    <link rel="stylesheet" href="quiz.css">
</head>
<body>
    <h1>REGISTRASI</h1>
    <form action="" method="POST">
        <ul>
            <li>
                <label for="username">Username</label>
                <input type="text" name="username" id="username">            
            </li>
            <li>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="passwordK">Konfirmasi Password</label>
                <input type="password" name="passwordK" id="passwordK">
            </li>
            <li>
                <button type="submit" name="register">Register</button>
            </li>
        </ul>
    </form>
</body>
</html>