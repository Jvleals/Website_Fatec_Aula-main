<?php
$servername = "localhost";  // Ou o endereço do seu servidor MySQL
$username = "root";         // Seu nome de usuário do MySQL
$password = "";             // Sua senha do MySQL
$dbname = "arvores";        // O nome do banco de dados

// Criação de conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificação da conexão
if ($conn->connect_error) {
    die("A conexão falhou: " . $conn->connect_error);
}
?>
