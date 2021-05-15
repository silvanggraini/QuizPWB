<?php 
session_start();

if (!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}
?>

<?php
$data = file_get_contents('https://api.kawalcorona.com/indonesia/provinsi');
$parseData = json_decode($data, true);
// print_r($parseData);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Covid 19 di Provinsi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h3>Data Covid 19 Berdasarkan Provinsi</h3>
        <div class="m-1 pb-1 d-flex flex-row-reverse">
            <a href="logout.php" class="btn btn-warning shadow-lg">Logout</a>
        </div>
        <table class="table table-striped" >
            <thead class="thead-dark">
                <tr>
                    <th>FID</th>
                    <th>Kode Provinsi</th>
                    <th>Provinsi</th>
                    <th>Positif</th>
                    <th>Sembuh</th>
                    <th>Meninggal</th>
                </tr>
            </thead>
            <?php foreach ($parseData as $a ) :?>
                <tr>
                    <td><?php echo($a["attributes"]["FID"]);?></td>
                    <td><?php echo($a["attributes"]["Kode_Provi"]);?></td>
                    <td><?php echo($a["attributes"]["Provinsi"]);?></td>
                    <td><?php echo($a["attributes"]["Kasus_Posi"]);?></td>
                    <td><?php echo($a["attributes"]["Kasus_Semb"]);?></td>
                    <td><?php echo($a["attributes"]["Kasus_Meni"]);?></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</body>
</html>