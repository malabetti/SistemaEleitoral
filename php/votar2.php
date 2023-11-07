<?php
ini_set("display_errors", 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_POST["id"];
$email = $_POST["email"];

$hostname = "localhost"; 
$user = "root";
$password = "ifsp";
$database = "eleicao";

$conn = mysqli_connect($hostname, $user, $password, $database);

if (!$conn) {
    die("Conexão falhou: " . mysqli_connect_error());
}
echo "Conexão feita com sucesso";

$query = "select * from votantes where email = '$email'";

$res = mysqli_query($conn, $query);

if ($res->num_rows > 0) {
    echo "Usuário já votou";
    echo "<button onclick='history.go(-1);'>Retornar</button>";
}
else {
    $query = "insert into votantes (email) values ('$email');";

    $res = mysqli_query($conn, $query);

    $query = "update candidatos set votos = votos + 1 where numero_candidato = '$id';";

    $res = mysqli_query($conn, $query);

    echo "Usuário votou com sucesso!";
}

mysqli_close($conn);
header("Location: http://127.0.0.1:5500/index.html");
exit();

?>