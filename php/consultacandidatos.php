<?php
ini_set("display_errors", 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

$hostname = "localhost";
$user = "root";
$password = "ifsp";
$database = "eleicao";

$conn = mysqli_connect($hostname, $user, $password, $database);

if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}

$query = "select * from candidatos;";
$results = mysqli_query($conn, $query);
$index = 0;
while ($record = mysqli_fetch_row($results)) {
    $candidato = array(
        'id' => $record[0],
        'nome' => $record[1],
        'numero' => $record[2],
        'votos' => $record[4],
        'desc' => $record[3]
    );
    $candidatos[$index] = $candidato;
    $index++;
}

mysqli_close($conn);

echo json_encode($candidatos);

// header("Location: /index.html");
// exit();
?>
