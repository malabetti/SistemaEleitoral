<?php
ini_set("display_errors", 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if (isset($_SESSION["email"])) {
    $id = $_GET["id"];
    $email = $_SESSION["email"];

    $hostname = "localhost"; 
    $user = "root";
    $password = "ifsp";
    $database = "eleicao";

    $conn = mysqli_connect($hostname, $user, $password, $database);

    if (!$conn) {
        die("Conexão falhou: " . mysqli_connect_error());
    }

    $query = "select * from votantes where email = '$email'";

    $res = mysqli_query($conn, $query);

    if ($res->num_rows > 0) {
        mysqli_close($conn);
        echo "Usuário já votou";
        echo "<br><button onclick='history.go(-1);'>Retornar</button>";
    }
    else {
        $query = "insert into votantes (email) values ('$email');";

        $res = mysqli_query($conn, $query);

        $query = "update candidatos set votos = votos + 1 where Id = '$id';";

        $res = mysqli_query($conn, $query);

        echo "Usuário votou com sucesso!";

        $_SESSION = array();

        session_destroy();

        mysqli_close($conn);
        header("Location: http://127.0.0.1:5500/index.html");
        exit();
    }
} else {
    header("Location: http://127.0.0.1:5500/pages/cadastro.html");
    exit();
}

?>