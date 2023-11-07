<?php
ini_set("display_errors", 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$num = $_POST["num"];
$nome = $_POST["nome"];
$desc = $_POST["desc"];

$hostname = "localhost"; 
$user = "root";
$password = "ifsp";
$database = "eleicao";

$conn = mysqli_connect($hostname, $user, $password, $database);

if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

$query = "select * from candidatos where numero_candidato = '$num'";

$res = mysqli_query($conn, $query);

if ($res->num_rows <= 0) {
    $query = "insert into candidatos (nome_candidato, numero_candidato, desc_candidato) values ('$nome', '$num', '$desc');";

    $res = mysqli_query($conn, $query);

    mysqli_close($conn);
    header("Location: http://127.0.0.1:5500/pages/admin.html");
    exit();
}
else {
    echo "Já existe um candidato com esse número!<br>";
    echo "<button onclick='history.go(-1);'>Retornar</button>";
    mysqli_close($conn);
    exit();
}
?>