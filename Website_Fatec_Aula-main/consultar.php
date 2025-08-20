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
  <title>Resultado da Busca - Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    *, *::before, *::after {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f4f8;
      margin: 0;
      padding: 20px;
      color: #222;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 30px;
    }

    .logo {
      font-size: 24px;
      font-weight: bold;
      color: #2d6a4f;
    }

    .btn-voltar {
      background-color: #2d6a4f;
      color: white;
      padding: 10px 16px;
      border-radius: 6px;
      text-decoration: none;
      font-weight: bold;
    }

    .btn-voltar:hover {
      background-color: #1b4332;
    }

    .search-form {
      display: flex;
      gap: 8px;
      flex-grow: 1;
      max-width: 400px;
    }

    .search-form input[type="text"] {
      width: 100%;
      padding: 10px 14px;
      border: 2px solid #a7c4a0;
      border-radius: 9999px;
      font-size: 16px;
    }

    .search-icon {
      font-size: 22px;
      color: #2d6a4f;
      user-select: none;
      align-self: center;
    }

    main h1 {
      font-size: 22px;
      margin-bottom: 20px;
      color: #1b4332;
    }

    .table-wrapper {
      overflow-x: auto;
      width: 100%;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      table-layout: auto;
    }

    thead tr {
      background-color: #2d6a4f;
      color: white;
    }

    thead th {
      padding: 10px;
      text-align: left;
      font-size: 13px;
    }

    tbody tr {
      background-color: white;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      margin-bottom: 10px;
    }

    tbody td {
      padding: 10px;
      font-size: 14px;
      word-wrap: break-word;
    }

    tbody td img {
      max-width: 80px;
      max-height: 80px;
      object-fit: cover;
      border-radius: 6px;
    }

    .botoes-acao {
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .botoes-acao a,
    .botoes-acao button {
      padding: 8px 12px;
      border-radius: 5px;
      font-weight: bold;
      border: none;
      color: white;
      cursor: pointer;
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

    @media (max-width: 900px) {
      thead {
        display: none;
      }

      table, tbody, tr, td {
        display: block;
        width: 100%;
      }

      tbody tr {
        margin-bottom: 20px;
        padding: 15px;
        border-radius: 8px;
        background-color: white;
      }

      tbody td {
        padding: 10px 8px;
        text-align: right;
        position: relative;
      }

      tbody td::before {
        content: attr(data-label);
        float: left;
        font-weight: bold;
        text-transform: uppercase;
        color: #2d6a4f;
        font-size: 13px;
      }

      .botoes-acao {
        align-items: flex-end;
      }

      .botoes-acao a,
      .botoes-acao button {
        width: 100%;
      }
    }

    p.no-result {
      font-size: 18px;
      color: #555;
      text-align: center;
      margin-top: 40px;
    }
  </style>
</head>
<body>

<header>
  <a href="dashboard.php" class="btn-voltar">← Voltar</a>
  <div class="logo">🌿 FatecAGRO</div>
  <form action="visualizar_admin.php" method="GET" class="search-form" role="search">
    <input type="text" name="q" placeholder="Pesquisar..." value="<?= htmlspecialchars($busca) ?>" autocomplete="off" />
    <span class="search-icon">&#128269;</span>
  </form>
</header>

<main>
  <h1>Resultado da busca por: "<?= htmlspecialchars($busca) ?>"</h1>

  <?php if ($result && $result->num_rows > 0): ?>
  <div class="table-wrapper">
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
              <img src="imagens/<?= htmlspecialchars($row['imagem']) ?>" alt="<?= htmlspecialchars($row['nome_popular']) ?>">
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
          <td data-label="Fitossanitário"><?= htmlspecialchars($row['estado_fitossanitario']) ?></td>
          <td data-label="Tronco"><?= htmlspecialchars($row['estado_tronco']) ?></td>
          <td data-label="Raízes"><?= htmlspecialchars($row['estado_raizes']) ?></td>
          <td data-label="Pavimento"><?= htmlspecialchars($row['danos_pavimento']) ?></td>
          <td data-label="Fiação"><?= htmlspecialchars($row['fiacao']) ?></td>
          <td data-label="Sinalização"><?= htmlspecialchars($row['sinalizacao']) ?></td>
          <td data-label="DAP"><?= htmlspecialchars($row['dap']) ?></td>
          <td data-label="Nativa"><?= htmlspecialchars($row['nativa']) ?></td>
          <td data-label="Medicinal"><?= $row['medicinal'] ? 'Sim' : 'Não' ?></td>
          <td data-label="Venenosa"><?= $row['venenosa'] ? 'Sim' : 'Não' ?></td>
          <td data-label="Localização"><?= htmlspecialchars($row['localizacao']) ?></td>
          <td data-label="Descrição"><?= htmlspecialchars($row['descricao']) ?></td>
          <td data-label="Ações" class="botoes-acao">
            <a href="editar.php?id=<?= $row['id'] ?>" class="btn-editar">Editar</a>
            <form action="excluir.php" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir?');">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <button type="submit" class="btn-excluir">Excluir</button>
            </form>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
  <?php else: ?>
    <p class="no-result">Nenhum resultado encontrado para "<strong><?= htmlspecialchars($busca) ?></strong>".</p>
  <?php endif; ?>
</main>

</body>
</html>
