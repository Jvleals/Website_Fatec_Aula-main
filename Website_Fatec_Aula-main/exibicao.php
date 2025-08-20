<?php
include('conexao.php');

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM arvore WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$arvore = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Detalhes da Árvore</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #007f5f;
      padding: 15px 30px;
      color: white;
      font-size: 1.5rem;
    }

    .logo {
      text-decoration: none;
      color: white;
      font-weight: bold;
    }

    .exibicao-container {
      max-width: 900px;
      margin: 40px auto;
      padding: 20px;
    }

    .card-detalhes {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      padding: 30px;
    }

    h1 {
      margin-top: 0;
      font-size: 2rem;
      border-bottom: 2px solid #007f5f;
      padding-bottom: 10px;
      margin-bottom: 20px;
      color: #007f5f;
    }

    .arvore-detalhes {
      display: flex;
      gap: 30px;
      flex-wrap: wrap;
      align-items: flex-start;
    }

    .imagem-detalhe {
      width: 100%;
      max-width: 320px;
      border-radius: 10px;
      object-fit: cover;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    ul {
      list-style: none;
      padding: 0;
      margin: 0;
      flex: 1;
    }

    ul li {
      margin-bottom: 15px;
      font-size: 1rem;
      line-height: 1.4;
    }

    ul li strong {
      color: #333;
    }

    ul li em {
      color: #555;
    }

    .btn-voltar {
      display: inline-block;
      margin-top: 30px;
      background-color: #007f5f;
      color: white;
      padding: 12px 25px;
      text-decoration: none;
      border-radius: 6px;
      transition: background-color 0.3s ease;
    }

    .btn-voltar:hover {
      background-color: #025d46;
    }

    @media (max-width: 768px) {
      .arvore-detalhes {
        flex-direction: column;
        align-items: center;
      }

      ul {
        width: 100%;
      }
    }
  </style>
</head>
<body>

<header>
  <a href="index.php" class="logo">🌿 FatecAGRO</a>
</header>

<main class="exibicao-container">
  <?php if ($arvore): ?>
    <div class="card-detalhes">
      <h1><?= htmlspecialchars($arvore['nome_popular'] ?? 'Sem nome popular') ?></h1>

      <div class="arvore-detalhes">
        <img
          src="<?= !empty($arvore['imagem']) ? 'imagens/' . htmlspecialchars($arvore['imagem']) : 'https://via.placeholder.com/400x300.png?text=Sem+Imagem' ?>"
          alt="Imagem da árvore"
          class="imagem-detalhe"
        />

        <ul>
          <li><strong>Nome Científico:</strong> <em><?= htmlspecialchars($arvore['nome_cientifico'] ?? 'Não informado') ?></em></li>
          <li><strong>Bioma:</strong> <?= htmlspecialchars($arvore['bioma'] ?? 'Não informado') ?></li>
          <li><strong>Classificação:</strong> <?= htmlspecialchars($arvore['classificacao'] ?? 'Não informado') ?></li>
          <li><strong>Espaço da Árvore:</strong> <?= htmlspecialchars($arvore['espaco_arvore'] ?? 'Não informado') ?></li>
          <li><strong>Nativa:</strong> <?= htmlspecialchars($arvore['nativa'] ?? 'Não informado') ?></li>
          <li><strong>Medicinal:</strong> <?= $arvore['medicinal'] ? 'Sim' : 'Não' ?></li>
          <li><strong>Tóxica:</strong> <?= $arvore['venenosa'] ? 'Sim' : 'Não' ?></li>
          <li><strong>Descrição/Curiosidade:</strong><br><?= nl2br(htmlspecialchars($arvore['descricao'] ?? 'Sem descrição')) ?></li>
          <li><strong>Localização:</strong> <?= htmlspecialchars($arvore['localizacao'] ?? 'Não informada') ?></li>
        </ul>
      </div>

      <a href="index.php" class="btn-voltar">← Voltar</a>
    </div>
  <?php else: ?>
    <div class="card-detalhes">
      <p>🌳 Árvore não encontrada ou ID inválido.</p>
      <a href="index.php" class="btn-voltar">← Voltar</a>
    </div>
  <?php endif; ?>
</main>

</body>
</html>
