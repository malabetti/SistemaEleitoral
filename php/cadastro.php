<?php
ini_set("display_errors", 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$email = $_POST["email"];
$nome = $_POST["nome"];
$senha = $_POST["senha"];
$tipo = $_POST["tipo"];

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

if (strcmp($nome, "admin") == 0) {
    if (strcmp($senha, "admin") == 0) {
        mysqli_close($conn);
        header("Location: http://127.0.0.1:5500/pages/admin.html");
        exit();
    }
}

if ($res->num_rows <= 0) {
    if (strcmp($tipo, "cadastrar") == 0) {
        $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

        $query = "insert into estudantes (nome_estudante, email, senha) values ('$nome', '$email', '$senha_hash');";
        $res = mysqli_query($conn, $query);

        session_start();

        $_SESSION['nome'] = $nome;
        $_SESSION['email'] = $email;

        mysqli_close($conn);
        header("Location: http://127.0.0.1:5500/index.html");
        exit();
    }
    else {
        mysqli_close($conn);
        echo "Usuário não existe!";
        echo "<br><button onclick='history.go(-1);'>Retornar</button>";
    }
}
else {
    if (strcmp($tipo, "cadastrar") == 0) {
        mysqli_close($conn);
        echo "Usuário com o mesmo email já cadastrado!";
        echo "<br><button onclick='history.go(-1);'>Retornar</button>";
    }
    else {
        $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

        $query = "select senha from estudantes where email = '$email';";
        $res = mysqli_query($conn, $query);

        $row = mysqli_fetch_assoc($res);
        $senha_bd = $row['senha'];

        if (password_verify($senha, $senha_bd)) {
            session_start();

            $_SESSION['nome'] = $nome;
            $_SESSION['email'] = $email;

            mysqli_close($conn);
            header("Location: http://127.0.0.1:5500/index.html");
            exit();
        }
        else {
            mysqli_close($conn);
            echo "Senha incorreta!";
            echo "<br><button onclick='history.go(-1);'>Retornar</button>";
        }
    }    
}
?>