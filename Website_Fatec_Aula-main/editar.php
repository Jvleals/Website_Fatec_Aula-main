<?php
include('conexao.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Buscar os dados da árvore
$sql = "SELECT * FROM arvore WHERE id = $id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $dados = $result->fetch_assoc();
} else {
    echo "Registro não encontrado.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_popular = isset($_POST['nome_popular']) ? $conn->real_escape_string($_POST['nome_popular']) : '';
    $nome_cientifico = isset($_POST['nome_cientifico']) ? $conn->real_escape_string($_POST['nome_cientifico']) : '';
    $bioma = isset($_POST['bioma']) ? $conn->real_escape_string($_POST['bioma']) : '';
    $classificacao = isset($_POST['classificacao']) ? $conn->real_escape_string($_POST['classificacao']) : '';
    $espaco_arvore = isset($_POST['espaco_arvore']) ? $conn->real_escape_string($_POST['espaco_arvore']) : '';

    $numero_individuos = (isset($_POST['numero_individuos']) && $_POST['numero_individuos'] !== '') 
        ? intval($_POST['numero_individuos']) 
        : 'NULL';

    $estado_fitossanitario = isset($_POST['estado_fitossanitario']) ? $conn->real_escape_string($_POST['estado_fitossanitario']) : '';
    $estado_tronco = isset($_POST['estado_tronco']) ? $conn->real_escape_string($_POST['estado_tronco']) : '';
    $estado_raizes = isset($_POST['estado_raizes']) ? $conn->real_escape_string($_POST['estado_raizes']) : '';
    $danos_pavimento = isset($_POST['danos_pavimento']) ? $conn->real_escape_string($_POST['danos_pavimento']) : '';
    $fiacao = isset($_POST['fiacao']) ? $conn->real_escape_string($_POST['fiacao']) : '';
    $sinalizacao = isset($_POST['sinalizacao']) ? $conn->real_escape_string($_POST['sinalizacao']) : '';

    $dap = (isset($_POST['dap']) && $_POST['dap'] !== '') 
        ? $conn->real_escape_string($_POST['dap']) 
        : 'NULL';

    $nativa = isset($_POST['nativa']) ? $conn->real_escape_string($_POST['nativa']) : '';
    $descricao = isset($_POST['descricao']) ? $conn->real_escape_string($_POST['descricao']) : '';

    $medicinal = isset($_POST['medicinal']) ? 1 : 0;
    $venenosa = isset($_POST['venenosa']) ? 1 : 0;

    $imagem = $dados['imagem']; // Mantém a imagem atual por padrão

    // Upload de imagem
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $pasta = 'imagens/';
        $nomeTemporario = $_FILES['imagem']['tmp_name'];
        $nomeArquivoOriginal = basename($_FILES['imagem']['name']);
        $extensao = strtolower(pathinfo($nomeArquivoOriginal, PATHINFO_EXTENSION));
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($extensao, $extensoesPermitidas)) {
            $novoNomeArquivo = uniqid('img_', true) . '.' . $extensao;
            $caminhoCompleto = $pasta . $novoNomeArquivo;

            if (move_uploaded_file($nomeTemporario, $caminhoCompleto)) {
                $imagem = $novoNomeArquivo;
            } else {
                echo "<p style='color:red;'>Erro ao salvar a imagem enviada.</p>";
            }
        } else {
            echo "<p style='color:red;'>Tipo de arquivo não permitido. Use jpg, jpeg, png ou gif.</p>";
        }
    }

    // Preparar valores para a query
    $numero_individuos_sql = $numero_individuos === 'NULL' ? "NULL" : $numero_individuos;
    $dap_sql = $dap === 'NULL' ? "NULL" : "'$dap'";

    $sqlUpdate = "UPDATE arvore SET 
        nome_popular = '$nome_popular',
        nome_cientifico = '$nome_cientifico',
        bioma = '$bioma',
        classificacao = '$classificacao',
        espaco_arvore = '$espaco_arvore',
        numero_individuos = $numero_individuos_sql,
        estado_fitossanitario = '$estado_fitossanitario',
        estado_tronco = '$estado_tronco',
        estado_raizes = '$estado_raizes',
        danos_pavimento = '$danos_pavimento',
        fiacao = '$fiacao',
        sinalizacao = '$sinalizacao',
        dap = $dap_sql,
        nativa = '$nativa',
        descricao = '$descricao',
        medicinal = $medicinal,
        venenosa = $venenosa,
        imagem = '$imagem'
        WHERE id = $id";

    if ($conn->query($sqlUpdate) === TRUE) {
        header("Location: consultar.php");
        exit();
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Editar Árvore</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    /* Seu CSS aqui (igual ao original) */
    form {
      max-width: 800px;
      margin: 20px auto;
      background: #f7f7f7;
      padding: 20px;
      border-radius: 10px;
    }
    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }
    input, textarea {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }
    input[type="checkbox"] {
      width: auto;
      margin-right: 8px;
      vertical-align: middle;
    }
    button {
      margin-top: 15px;
      padding: 10px 20px;
      background: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background: #0056b3;
    }
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
      background-color: #e0f2e9;
      border-bottom: 2px solid #007bff;
      margin-bottom: 30px;
    }
    .logo {
      font-size: 24px;
      font-weight: bold;
      color: #007bff;
      text-decoration: none;
    }
    .btn-outline {
      padding: 8px 16px;
      background: transparent;
      border: 2px solid #007bff;
      color: #007bff;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease, color 0.3s ease;
      font-weight: 600;
    }
    .btn-outline:hover {
      background-color: #007bff;
      color: white;
    }
    img {
      border-radius: 5px;
      margin-top: 8px;
      max-width: 150px;
      height: auto;
      display: block;
    }
  </style>
</head>
<body>
  <header>
    <a href="index.php" class="logo">🌿 FatecAGRO</a>
    <button class="btn-outline" onclick="history.back()">Voltar</button>
  </header>

  <h1 style="text-align:center;">Editar Dados da Árvore</h1>

  <form method="POST" enctype="multipart/form-data">
    <label>Nome Popular</label>
    <input type="text" name="nome_popular" value="<?= htmlspecialchars($dados['nome_popular']) ?>" />

    <label>Nome Científico</label>
    <input type="text" name="nome_cientifico" value="<?= htmlspecialchars($dados['nome_cientifico']) ?>" />

    <label>Bioma</label>
    <input type="text" name="bioma" value="<?= htmlspecialchars($dados['bioma']) ?>" />

    <label>Classificação</label>
    <input type="text" name="classificacao" value="<?= htmlspecialchars($dados['classificacao']) ?>" />

    <label>Espaço da Árvore</label>
    <input type="text" name="espaco_arvore" value="<?= htmlspecialchars($dados['espaco_arvore']) ?>" />

    <label>Número de Indivíduos</label>
    <input type="number" name="numero_individuos" value="<?= htmlspecialchars($dados['numero_individuos']) ?>" />

    <label>Estado Fitossanitário</label>
    <input type="text" name="estado_fitossanitario" value="<?= htmlspecialchars($dados['estado_fitossanitario']) ?>" />

    <label>Estado do Tronco</label>
    <input type="text" name="estado_tronco" value="<?= htmlspecialchars($dados['estado_tronco']) ?>" />

    <label>Estado das Raízes</label>
    <input type="text" name="estado_raizes" value="<?= htmlspecialchars($dados['estado_raizes']) ?>" />

    <label>Danos no Pavimento</label>
    <input type="text" name="danos_pavimento" value="<?= htmlspecialchars($dados['danos_pavimento']) ?>" />

    <label>Fiação</label>
    <input type="text" name="fiacao" value="<?= htmlspecialchars($dados['fiacao']) ?>" />

    <label>Sinalização</label>
    <input type="text" name="sinalizacao" value="<?= htmlspecialchars($dados['sinalizacao']) ?>" />

    <label>DAP</label>
    <input type="text" name="dap" value="<?= htmlspecialchars($dados['dap']) ?>" />

    <label>Nativa</label>
    <input type="text" name="nativa" value="<?= htmlspecialchars($dados['nativa']) ?>" />

    <label>Descrição</label>
    <textarea name="descricao"><?= htmlspecialchars($dados['descricao']) ?></textarea>

    <label>
      <input type="checkbox" name="medicinal" <?= $dados['medicinal'] ? 'checked' : '' ?> />
      Medicinal
    </label>

    <label>
      <input type="checkbox" name="venenosa" <?= $dados['venenosa'] ? 'checked' : '' ?> />
      Venenosa
    </label>

    <label>Imagem Atual</label>
    <?php if (!empty($dados['imagem'])): ?>
      <img src="uploads/<?= htmlspecialchars($dados['imagem']) ?>" alt="Imagem da árvore" />
    <?php else: ?>
      <p>Sem imagem cadastrada.</p>
    <?php endif; ?>

    <label>Alterar Imagem</label>
    <input type="file" name="imagem" accept="image/*" />

    <button type="submit">Salvar Alterações</button>
  </form>
</body>
</html>
