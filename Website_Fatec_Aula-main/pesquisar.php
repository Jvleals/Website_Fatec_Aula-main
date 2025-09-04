<?php
include('conexao.php');

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
  <title>Resultado da Busca - Visualização</title>
  <link rel="stylesheet" href="pesquisar.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>

<header>
  <a href="index.php" class="logo" aria-label="Página inicial FatecAmbiental">🌿 FatecAGRO</a>

  <form action="pesquisar.php" method="GET" class="search-form" role="search" aria-label="Busca de árvores">
    <input
      type="text"
      name="q"
      placeholder="Pesquisar..."
      value="<?= htmlspecialchars($busca) ?>"
      autocomplete="off"
      aria-label="Campo de busca"
    />
    <button type="submit" class="search-btn" aria-label="Buscar">
      🔍
    </button>
  </form>
</header>

<main>
  <h1>Resultado da busca por: "<?= htmlspecialchars($busca) ?>"</h1>

  <?php if ($result && $result->num_rows > 0): ?>
  <table>
    <thead>
      <tr>
        <th scope="col">Imagem</th>
        <th scope="col">Nome Popular</th>
        <th scope="col">Nome Científico</th>
        <th scope="col">Bioma</th>
        <th scope="col">Classificação</th>
        <th scope="col">Espaço</th>
        <th scope="col">Nº Indivíduos</th>
        <th scope="col">Estado Fitossanitário</th>
        <th scope="col">Estado do Tronco</th>
        <th scope="col">Estado das Raízes</th>
        <th scope="col">Danos no Pavimento</th>
        <th scope="col">Fiação</th>
        <th scope="col">Sinalização</th>
        <th scope="col">DAP</th>
        <th scope="col">Nativa</th>
        <th scope="col">Medicinal</th>
        <th scope="col">Venenosa</th>
        <th scope="col">Descrição</th>
        <th scope="col">Localização</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td>
            <?php if (!empty($row['imagem'])): ?>
              <img
                src="imagens/<?= htmlspecialchars($row['imagem']) ?>"
                alt="Imagem da árvore <?= htmlspecialchars($row['nome_popular']) ?>"
                width="100"
                height="100"
                loading="lazy"
                style="object-fit: cover; border-radius: 6px;"
              />
            <?php else: ?>
              <span class="no-image">Sem imagem</span>
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
