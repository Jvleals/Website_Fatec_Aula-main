<?php
session_start();
include('conexao.php');

// Verifica se o admin está logado
if (!isset($_SESSION['login']) || !isset($_SESSION['cod'])) {
    header("Location: login.php");
    exit();
}

// Logout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$busca = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

$sql = "SELECT * FROM arvore 
        WHERE nome_popular LIKE '%$busca%' 
        OR nome_cientifico LIKE '%$busca%' 
        OR bioma LIKE '%$busca%' 
        OR classificacao LIKE '%$busca%' 
        OR localizacao LIKE '%$busca%'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Admin - Visualização de Árvores</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f5f5f5;
      margin: 0;
      padding: 0;
    }

    header {
      background: #007f5f;
      padding: 20px;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    .logo {
      font-size: 1.5em;
      font-weight: bold;
      text-decoration: none;
      color: white;
    }

    .search-form {
      display: flex;
      gap: 10px;
      margin-top: 10px;
    }

    .search-form input {
      padding: 8px;
      border-radius: 5px;
      border: none;
      width: 200px;
    }

    .search-form button {
      padding: 8px 12px;
      background: white;
      color: #007f5f;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .logout-form {
      margin-top: 10px;
    }

    .logout-btn {
      background: #e74c3c;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      cursor: pointer;
    }

    main {
      padding: 30px;
    }

    h1 {
      color: #007f5f;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    th, td {
      padding: 10px;
      border: 1px solid #ddd;
      font-size: 0.9em;
      text-align: left;
      vertical-align: top;
    }

    th {
      background-color: #007f5f;
      color: white;
    }

    img {
      max-width: 100px;
      max-height: 100px;
      object-fit: cover;
      border-radius: 5px;
    }

    .no-results {
      background: #fff3cd;
      color: #856404;
      padding: 15px;
      border-radius: 6px;
      margin-top: 20px;
    }

    @media (max-width: 768px) {
      table {
        font-size: 0.75em;
        overflow-x: auto;
        display: block;
      }
    }
  </style>
</head>
<body>

<header>
  <a href="dashboard_admin.php" class="logo">🌿 Admin - FatecAGRO</a>

  <form class="search-form" action="visualizar_admin.php" method="GET">
    <input type="text" name="q" placeholder="Pesquisar..." value="<?= htmlspecialchars($busca) ?>" />
    <button type="submit">🔍 Buscar</button>
  </form>

  <form class="logout-form" method="POST">
    <button type="submit" name="logout" class="logout-btn">Sair</button>
  </form>
</header>

<main>
  <h1>Resultado da busca por: "<?= htmlspecialchars($busca) ?>"</h1>

  <?php if ($result && $result->num_rows > 0): ?>
    <table>
      <thead>
        <tr>
          <th>Imagem</th>
          <th>Nome Popular</th>
          <th>Nome Científico</th>
          <th>Bioma</th>
          <th>Classificação</th>
          <th>Espaço</th>
          <th>Nº Indivíduos</th>
          <th>Fitossanitário</th>
          <th>Tronco</th>
          <th>Raízes</th>
          <th>Pavimento</th>
          <th>Fiação</th>
          <th>Sinalização</th>
          <th>DAP</th>
          <th>Nativa</th>
          <th>Medicinal</th>
          <th>Venenosa</th>
          <th>Descrição</th>
          <th>Localização</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td>
              <?php if (!empty($row['imagem'])): ?>
                <img src="imagens/<?= htmlspecialchars($row['imagem']) ?>" alt="Imagem de <?= htmlspecialchars($row['nome_popular']) ?>" />
              <?php else: ?>
                <span>Sem imagem</span>
              <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($row['nome_popular']) ?></td>
            <td><em><?= htmlspecialchars($row['nome_cientifico']) ?></em></td>
            <td><?= htmlspecialchars($row['bioma']) ?></td>
            <td><?= htmlspecialchars($row['classificacao']) ?></td>
            <td><?= htmlspecialchars($row['espaco_arvore']) ?></td>
            <td><?= htmlspecialchars($row['numero_individuos']) ?></td>
            <td><?= htmlspecialchars($row['estado_fitossanitario']) ?></td>
            <td><?= htmlspecialchars($row['estado_tronco']) ?></td>
            <td><?= htmlspecialchars($row['estado_raizes']) ?></td>
            <td><?= htmlspecialchars($row['danos_pavimento']) ?></td>
            <td><?= htmlspecialchars($row['fiacao']) ?></td>
            <td><?= htmlspecialchars($row['sinalizacao']) ?></td>
            <td><?= htmlspecialchars($row['dap']) ?></td>
            <td><?= htmlspecialchars($row['nativa']) ?></td>
            <td><?= $row['medicinal'] ? 'Sim' : 'Não' ?></td>
            <td><?= $row['venenosa'] ? 'Sim' : 'Não' ?></td>
            <td><?= htmlspecialchars($row['descricao']) ?></td>
            <td><?= htmlspecialchars($row['localizacao']) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p class="no-results">Nenhum resultado encontrado para "<strong><?= htmlspecialchars($busca) ?></strong>".</p>
  <?php endif; ?>
</main>

</body>
</html>
