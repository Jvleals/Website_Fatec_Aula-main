<?php
session_start();

// Se o botão "Sair" for clicado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// Verifica se o admin está logado
if (!isset($_SESSION['login']) || !isset($_SESSION['cod'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - FatecAGRO</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .admin-actions {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 30px;
      margin-top: 60px;
    }

    .admin-card {
      background: #ffffff;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
      text-align: center;
      width: 250px;
      transition: transform 0.2s ease;
    }

    .admin-card:hover {
      transform: translateY(-5px);
    }

    .admin-card h3 {
      margin-bottom: 15px;
      color: #007f5f;
    }

    .admin-card p {
      font-size: 0.95em;
      color: #444;
      margin-bottom: 20px;
    }

    .admin-card a {
      display: inline-block;
      padding: 10px 20px;
      background: #007f5f;
      color: white;
      border-radius: 8px;
      text-decoration: none;
    }

    .logout-btn {
      position: absolute;
      top: 20px;
      right: 30px;
      padding: 8px 16px;
      background: #e74c3c;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .logout-btn:hover {
      background: #c0392b;
    }

    .logo {
      font-size: 24px;
      color: #007f5f;
      padding: 20px;
      font-weight: bold;
      text-align: center;
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">🌿 Painel do Administrador - FatecAGRO</div>
    <form method="post" style="position:absolute; top: 20px; right: 30px;">
      <button type="submit" name="logout" class="logout-btn">Sair</button>
    </form>
  </header>

  <main>
    <section class="admin-actions">
      <div class="admin-card">
        <h3>Consultar Dados</h3>
        <p>Visualize e gerencie os dados cadastrados no sistema.</p>
        <a href="consultar.php">Acessar</a>
      </div>

      <div class="admin-card">
        <h3>Adicionar Registro</h3>
        <p>Cadastre novas árvores, categorias ou admins.</p>
        <a href="tela_inf.php">Acessar</a>
      </div>

      <div class="admin-card">
        <h3>Analisar Mensagens</h3>
        <p>Veja mensagens e publicações feitas por usuários.</p>
        <a href="https://accounts.google.com/v3/signin/identifier?continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&ifkv=AdBytiOvb6KW7phcudzu3K1nlZBICkBSAX8kZ1etDuD4Tn8xjNFg9txm3CVxDVf95dq672TpXwDaag&rip=1&sacu=1&service=mail&flowName=GlifWebSignIn&flowEntry=ServiceLogin&dsh=S170210527%3A1755780267412895">Acessar</a>
      </div>
    </section>
  </main>
</body>
</html>
