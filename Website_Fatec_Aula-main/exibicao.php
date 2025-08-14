<?php
include('conexao.php');

// Verifica se o ID foi passado via GET
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
  <link rel="stylesheet" href="style.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    .exibicao-container {
      padding: 20px;
      max-width: 800px;
      margin: 0 auto;
    }

    .arvore-detalhes {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }

    .imagem-detalhe {
      width: 300px;
      height: auto;
      object-fit: cover;
      border-radius: 10px;
    }

    ul {
      list-style: none;
      padding: 0;
    }

    ul li {
      margin-bottom: 8px;
    }

    .btn-voltar {
      display: inline-block;
      margin-top: 20px;
      background-color: #007f5f;
      color: white;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 5px;
    }

    .btn-voltar:hover {
      background-color: #025d46;
    }
  </style>
</head>
<body>

<header>
  <a href="index.php" class="logo">🌿 FatecAGRO</a>
</header>

<main class="exibicao-container">
  <?php if ($arvore): ?>
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
        <li><strong>Espaço:</strong> <?= htmlspecialchars($arvore['espaco_arvore'] ?? 'Não informado') ?></li>
        <li><strong>Nº Indivíduos:</strong> <?= htmlspecialchars($arvore['numero_individuos'] ?? 'Não informado') ?></li>
        <li><strong>Estado Fitossanitário:</strong> <?= htmlspecialchars($arvore['estado_fitossanitario'] ?? 'Não informado') ?></li>
        <li><strong>Estado do Tronco:</strong> <?= htmlspecialchars($arvore['estado_tronco'] ?? 'Não informado') ?></li>
        <li><strong>Estado das Raízes:</strong> <?= htmlspecialchars($arvore['estado_raizes'] ?? 'Não informado') ?></li>
        <li><strong>Danos no Pavimento:</strong> <?= htmlspecialchars($arvore['danos_pavimento'] ?? 'Não informado') ?></li>
        <li><strong>Fiação:</strong> <?= htmlspecialchars($arvore['fiacao'] ?? 'Não informado') ?></li>
        <li><strong>Sinalização:</strong> <?= htmlspecialchars($arvore['sinalizacao'] ?? 'Não informado') ?></li>
        <li><strong>DAP:</strong> <?= htmlspecialchars($arvore['dap'] ?? 'Não informado') ?></li>
        <li><strong>Nativa:</strong> <?= htmlspecialchars($arvore['nativa'] ?? 'Não informado') ?></li>
        <li><strong>Medicinal:</strong> <?= $arvore['medicinal'] ? 'Sim' : 'Não' ?></li>
        <li><strong>Venenosa:</strong> <?= $arvore['venenosa'] ? 'Sim' : 'Não' ?></li>
        <li><strong>Descrição:</strong> <?= nl2br(htmlspecialchars($arvore['descricao'] ?? 'Sem descrição')) ?></li>
        <li><strong>Localização:</strong> <?= htmlspecialchars($arvore['localizacao'] ?? 'Não informada') ?></li>
      </ul>
    </div>

    <a href="index.php" class="btn-voltar">← Voltar</a>

  <?php else: ?>
    <p>Árvore não encontrada ou ID inválido.</p>
    <a href="index.php" class="btn-voltar">← Voltar</a>
  <?php endif; ?>
</main>

</body>
</html>
