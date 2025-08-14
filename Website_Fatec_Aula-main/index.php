<?php
// Conexão com banco de dados
$pdo = new PDO("mysql:host=localhost;dbname=arvores", "root", "");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>FatecAGRO</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Sidebar à direita */
    .menu-btn {
      position: fixed;
      top: 20px;
      right: 20px;
      font-size: 28px;
      background-color: transparent;
      border: none;
      cursor: pointer;
      z-index: 1101;
    }

    .sidebar {
      height: 100%;
      width: 0;
      position: fixed;
      top: 0;
      right: 0;
      background-color: #007f5f;
      overflow-x: hidden;
      transition: 0.3s;
      padding-top: 60px;
      z-index: 1100;
    }

    .sidebar a {
      padding: 15px 25px;
      text-decoration: none;
      font-size: 18px;
      color: white;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: 0.2s;
    }

    .sidebar a:hover {
      background-color: #026348;
    }

    .sidebar img {
      width: 24px;
      height: 24px;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      left: 20px;
      font-size: 36px;
      color: white;
      text-decoration: none;
    }

    header {
      padding-right: 60px;
    }
  </style>
</head>
<body>

  <!-- Botão do menu (lado direito) -->
  <button onclick="abrirSidebar()" class="menu-btn">☰</button>

  <!-- Sidebar direita -->
  <div id="sidebar" class="sidebar">
    <a href="javascript:void(0)" class="close-btn" onclick="fecharSidebar()">×</a>
    <a href="index.php">🏠 Início</a>
    <a href="login.php"><img src="img/login-icon.png" alt="Login">Login Admin</a>
    <a href="Equipe.html">👥 Equipe</a>
  </div>

 <header>
  <div class="header-content">
    <div class="logo">🌿 FatecAGRO</div>

    <form class="search-form" action="pesquisar.php" method="GET">
      <input type="text" name="q" placeholder="Buscar árvore..." required />
      <span class="search-icon" onclick="this.closest('form').submit();">🔍</span>
    </form>

    <!-- Espaço reservado para manter alinhamento com o botão -->
    <div class="header-spacer"></div>
  </div>
</header>

  <main class="hero-with-bg">
    <div class="hero-overlay">
      <div class="hero-text">
        <h1>Bem-vindo ao FatecAGRO 🌿</h1>
        <p>Juntos pela preservação do meio ambiente e um futuro sustentável.</p>
      </div>
    </div>
  </main>

  <section class="ads-section">
    <h2 class="ads-title">Nossos Projetos em Destaque</h2>
    <div class="ads-grid">
      <?php
      $stmt = $pdo->query("SELECT * FROM arvore WHERE nome_popular IS NOT NULL");
      while ($row = $stmt->fetch()):
        $id = $row['id'];
        $nome = $row['nome_popular'];
        $descricao = $row['descricao'] ?: 'Sem descrição disponível.';
        $imagem = $row['imagem'] ? "imagens/{$row['imagem']}" : "https://via.placeholder.com/300x180.png?text=Sem+Imagem";
      ?>
        <div class="ad-card fade-in">
          <img src="<?= $imagem ?>" alt="<?= htmlspecialchars($nome) ?>">
          <h3><?= htmlspecialchars($nome) ?></h3>
          <p><?= substr($descricao, 0, 100) ?>...</p>
          <a class="btn-fill" href="exibicao.php?id=<?= $id ?>">Ver Mais</a>
        </div>
      <?php endwhile; ?>
    </div>
  </section>

  <footer class="footer">
    <p class="footer-title">Parceiros:</p>
    <div class="logo-slider">
      <span>Nextflows</span>
      <span>Fancywear</span>
      <span>DataBites</span>
      <span>ExDone</span>
      <span>Arktico</span>
      <span>PayScale</span>
    </div>

    <div class="footer-nav">
      <a href="#">Our Focus</a>
      <a href="#">Project</a>
      <a href="#">News & Events</a>
      <a href="#">About Us</a>
    </div>

    <p class="footer-copy">© <?= date('Y') ?> FatecAGRO. Todos os direitos reservados.</p>
  </footer>

  <script>
    function abrirSidebar() {
      document.getElementById("sidebar").style.width = "250px";
    }

    function fecharSidebar() {
      document.getElementById("sidebar").style.width = "0";
    }
  </script>

  <script src="script.js"></script>
</body>
</html>
