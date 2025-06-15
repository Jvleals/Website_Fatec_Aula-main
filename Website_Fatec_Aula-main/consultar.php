<?php
include('conexao.php');

$busca = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

$sql = "SELECT * FROM arvore 
        WHERE nome_popular LIKE '%$busca%' 
        OR nome_cientifico LIKE '%$busca%' 
        OR bioma LIKE '%$busca%' 
        OR classificacao LIKE '%$busca%'";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Resultado da Busca</title>
<style>
  *, *::before, *::after {
    box-sizing: border-box;
  }

  body {
    font-family: 'Inter', 'Segoe UI', Tahoma, sans-serif;
    background-color: #f0f4f8;
    margin: 0;
    padding: 30px 20px;
    color: #222;
    line-height: 1.5;
  }

  header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    flex-wrap: wrap;
    gap: 20px;
  }

  .logo {
    font-size: 28px;
    font-weight: 700;
    color: #2d6a4f;
    user-select: none;
  }

  .btn-voltar {
    background-color: #2d6a4f;
    color: white;
    padding: 10px 18px;
    border-radius: 6px;
    font-weight: 600;
    text-decoration: none;
    box-shadow: 0 4px 8px rgb(45 106 79 / 0.25);
    transition: background-color 0.25s ease;
  }
  .btn-voltar:hover {
    background-color: #1b4332;
  }

  .search-form {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-grow: 1;
    max-width: 350px;
  }

  .search-form input[type="text"] {
    width: 100%;
    padding: 10px 16px;
    border: 2px solid #a7c4a0;
    border-radius: 9999px;
    font-size: 16px;
    transition: border-color 0.3s ease;
    outline-offset: 2px;
  }
  .search-form input[type="text"]:focus {
    border-color: #2d6a4f;
    outline: none;
  }

  .search-icon {
    font-size: 22px;
    color: #2d6a4f;
    user-select: none;
  }

  main h1 {
    font-weight: 700;
    font-size: 24px;
    margin-bottom: 25px;
    color: #1b4332;
  }

  .table-wrapper {
    overflow-x: auto;
  }

  table {
    width: 100%;
    min-width: 1200px;
    border-collapse: separate;
    border-spacing: 0 12px;
  }

  thead tr {
    background-color: #2d6a4f;
    color: white;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.06em;
  }

  thead th {
    padding: 14px 16px;
    font-size: 13px;
    white-space: nowrap;
  }

  tbody tr {
    background-color: white;
    box-shadow: 0 2px 6px rgb(45 106 79 / 0.1);
    transition: box-shadow 0.3s ease;
    border-radius: 8px;
  }
  tbody tr:hover {
    box-shadow: 0 4px 12px rgb(45 106 79 / 0.3);
  }

  tbody td {
    padding: 14px 16px;
    vertical-align: middle;
    font-size: 14px;
    color: #444;
    max-width: 140px;
    word-wrap: break-word;
  }

  tbody td img {
    max-width: 90px;
    max-height: 90px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgb(45 106 79 / 0.15);
  }

  .botoes-acao {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .botoes-acao a,
  .botoes-acao button {
    padding: 8px 16px;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    border: none;
    color: white;
    box-shadow: 0 2px 6px rgb(0 0 0 / 0.15);
    transition: background-color 0.25s ease;
    text-decoration: none;
    text-align: center;
  }

  .btn-editar {
    background-color: #40916c;
  }
  .btn-editar:hover {
    background-color: #2d6a4f;
  }

  .btn-excluir {
    background-color: #d00000;
  }
  .btn-excluir:hover {
    background-color: #9b0000;
  }

  p {
    font-size: 18px;
    text-align: center;
    margin-top: 40px;
    color: #666;
  }

  @media (min-width: 768px) {
    .botoes-acao {
      flex-direction: row;
    }
  }

  /* Responsividade geral para celular */
  @media (max-width: 900px) {
    thead {
      display: none;
    }

    table, tbody, tr, td {
      display: block;
      width: 100%;
    }

    tbody tr {
      margin-bottom: 25px;
      box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
      border-radius: 10px;
      padding: 15px 20px;
      background-color: white;
    }

    tbody td {
      padding: 10px 10px;
      text-align: right;
      font-size: 14px;
      position: relative;
      max-width: none;
      word-wrap: normal;
      border: none;
    }

    tbody td::before {
      content: attr(data-label);
      float: left;
      font-weight: 700;
      text-transform: uppercase;
      color: #2d6a4f;
      letter-spacing: 0.05em;
    }

    .botoes-acao {
      justify-content: flex-start;
    }
  }
</style>
</head>
<body>

<header>
  <a href="index.php" class="btn-voltar">&#8592; Voltar</a>
  <div class="logo">🌿 FatecAGRO</div>
  <form action="pesquisar.php" method="GET" class="search-form" role="search" aria-label="Busca">
    <input type="text" name="q" placeholder="Pesquisar..." value="<?= htmlspecialchars($busca) ?>" autocomplete="off" />
    <span class="search-icon" aria-hidden="true">&#128269;</span>
  </form>
</header>

<main>
  <h1>Resultado da busca por: "<?= htmlspecialchars($busca) ?>"</h1>

  <?php if ($result && $result->num_rows > 0): ?>
  <div class="table-wrapper">
    <table role="table" aria-label="Tabela de resultados">
      <thead>
        <tr>
          <th>Imagem</th>
          <th>Nome Popular</th>
          <th>Nome Científico</th>
          <th>Bioma</th>
          <th>Classificação</th>
          <th>Espaço</th>
          <th>Nº Indivíduos</th>
          <th>Estado Fitossanitário</th>
          <th>Estado do Tronco</th>
          <th>Estado das Raízes</th>
          <th>Danos no Pavimento</th>
          <th>Fiação</th>
          <th>Sinalização</th>
          <th>DAP</th>
          <th>Nativa</th>
          <th>Medicinal</th>
          <th>Venenosa</th>
          <th>Localização</th>
          <th>Descrição</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td data-label="Imagem">
            <?php if (!empty($row['imagem'])): ?>
              <img src="imagens/<?= htmlspecialchars($row['imagem']) ?>" alt="<?= htmlspecialchars($row['nome_popular']) ?>" />
            <?php else: ?>
              Sem imagem
            <?php endif; ?>
          </td>
          <td data-label="Nome Popular"><?= htmlspecialchars($row['nome_popular']) ?></td>
          <td data-label="Nome Científico"><?= htmlspecialchars($row['nome_cientifico']) ?></td>
          <td data-label="Bioma"><?= htmlspecialchars($row['bioma']) ?></td>
          <td data-label="Classificação"><?= htmlspecialchars($row['classificacao']) ?></td>
          <td data-label="Espaço"><?= htmlspecialchars($row['espaco_arvore']) ?></td>
          <td data-label="Nº Indivíduos"><?= htmlspecialchars($row['numero_individuos']) ?></td>
          <td data-label="Estado Fitossanitário"><?= htmlspecialchars($row['estado_fitossanitario']) ?></td>
          <td data-label="Estado do Tronco"><?= htmlspecialchars($row['estado_tronco']) ?></td>
          <td data-label="Estado das Raízes"><?= htmlspecialchars($row['estado_raizes']) ?></td>
          <td data-label="Danos no Pavimento"><?= htmlspecialchars($row['danos_pavimento']) ?></td>
          <td data-label="Fiação"><?= htmlspecialchars($row['fiacao']) ?></td>
          <td data-label="Sinalização"><?= htmlspecialchars($row['sinalizacao']) ?></td>
          <td data-label="DAP"><?= htmlspecialchars($row['dap']) ?></td>
          <td data-label="Nativa"><?= htmlspecialchars($row['nativa']) ?></td>
          <td data-label="Medicinal"><?= $row['medicinal'] ? 'Sim' : 'Não' ?></td>
          <td data-label="Venenosa"><?= $row['venenosa'] ? 'Sim' : 'Não' ?></td>
          <td data-label="Localização"><?= htmlspecialchars($row['localizacao']) ?></td>
          <td data-label="Descrição"><?= htmlspecialchars($row['descricao']) ?></td>
          <td data-label="Ações" class="botoes-acao">
            <a href="editar.php?id=<?= $row['id'] ?>" class="btn-editar" aria-label="Editar <?= htmlspecialchars($row['nome_popular']) ?>">Editar</a>
            <form action="excluir.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?');">
              <input type="hidden" name="id" value="<?= $row['id'] ?>" />
              <button type="submit" class="btn-excluir" aria-label="Excluir <?= htmlspecialchars($row['nome_popular']) ?>">Excluir</button>
            </form>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
  <?php else: ?>
    <p>Nenhum resultado encontrado para "<strong><?= htmlspecialchars($busca) ?></strong>".</p>
  <?php endif; ?>
</main>

</body>
</html>
