<?php
session_start();
include_once('conexao.php');  // que define $conn

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $conn->real_escape_string($_POST['login']);
    $senha = $_POST['senha'];

    $sql = "SELECT cod, login, senha FROM admin WHERE login = '$login' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if ($senha === $row['senha']) {  // depois podemos melhorar com hash
            $_SESSION['user_id'] = $row['cod'];
            $_SESSION['user_login'] = $row['login'];

            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['erro_login'] = "Senha incorreta.";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['erro_login'] = "Login não encontrado.";
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
