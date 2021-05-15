<?php 

$koneksi = mysqli_connect('localhost','root','','cookiessession');

function query($query) {
    global $koneksi;
    $result = mysqli_error($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function btnRegister($data) {
    global $koneksi;
    $username = $data['username'];
    $password = mysqli_real_escape_string($koneksi, $data['password']);
    $passwordK = mysqli_real_escape_string($koneksi, $data['passwordK']);

    $result = mysqli_query($koneksi, "SELECT Username FROM login WHERE 
    Username = '$username'");

    if(mysqli_fetch_assoc($result)) {
        echo"<script>
            alert ('Username sudah terdaftar')
            </script>";
            return false;
    }

    if ($password !== $passwordK) {
        echo "<script>
            alert ('Konfirmasi password tidak sesuai')
        </script>";
        return false;
    } 
    
    $pass = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($koneksi, "INSERT INTO login VALUES('', '$username','$pass')");
    return mysqli_affected_rows($koneksi);

}

?>