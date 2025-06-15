<?php
session_start();
include("conexao.php");  // seu arquivo de conexão que define $conn

$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $conn->real_escape_string($_POST['login']);
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM admins WHERE login = '$login' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($senha === $row['senha']) {  // texto puro, só para teste
            $_SESSION['login'] = $login;
            $_SESSION['cod'] = $row['cod'];

            header("Location: tela_adm.php");  // redireciona para index.php
            exit();
        } else {
            $erro = "Senha incorreta.";
        }
    } else {
        $erro = "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Login - FatecAGRO</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .login-container {
      max-width: 400px;
      margin: 100px auto;
      background-color: #ffffff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .login-container h2 {
      margin-bottom: 30px;
      color: #007f5f;
      text-align: center;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 12px 15px;
      margin-bottom: 20px;
      border: 2px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      outline: none;
      transition: border-color 0.3s;
    }

    .login-container input:focus {
      border-color: #007f5f;
    }

    .login-container .btn-login {
      width: 100%;
      padding: 12px;
      background-color: #007f5f;
      border: none;
      color: white;
      font-size: 16px;
      cursor: pointer;
      border-radius: 8px;
      transition: background-color 0.3s;
    }

    .login-container .btn-login:hover {
      background-color: #005f40;
    }

    .login-container .link {
      display: block;
      margin-top: 15px;
      text-align: center;
      color: #007f5f;
      text-decoration: none;
      font-size: 0.9em;
    }

    .login-container .link:hover {
      text-decoration: underline;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      background-color: #e6f0ea;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      font-family: Arial, sans-serif;
    }

    .logo {
  text-decoration: none;
  color: #007f5f;
  font-size: 1.5em;
  font-weight: bold;
  transition: color 0.2s, text-decoration 0.2s;
}

.logo:hover {
  color: #005f40;
  text-decoration: underline;
}

    .btn-outline {
      background: none;
      border: 2px solid #007f5f;
      color: #007f5f;
      padding: 8px 15px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s, color 0.3s;
    }

    .btn-outline:hover {
      background-color: #007f5f;
      color: white;
    }
  </style>
</head>
<body>
<header>
  <a href="index.php" class="logo">🌿 FatecAGRO</a>
  <button class="btn-outline" onclick="history.back()">Voltar</button>
</header>

  <div class="login-container">
    <h2>Entrar na sua conta</h2>
    <?php if (!empty($erro)) : ?>
        <p style="color:red;"><?php echo htmlspecialchars($erro); ?></p>
    <?php endif; ?>
    <form action="" method="post">
      <input type="text" name="login" placeholder="Login" required />
      <input type="password" name="senha" placeholder="Senha" required />
      <button type="submit" class="btn-login">Login</button>
    </form>
    <a href="#" class="link">Esqueceu a senha?</a>
  </div>
</body>
</html>
