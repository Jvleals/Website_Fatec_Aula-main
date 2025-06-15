<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Recebendo dados do formulário
    $nome_cientifico = $_POST['nome_cientifico'];
    $nome_popular = $_POST['nome_popular'];
    $localizacao = $_POST['localizacao'];
    $espaco_arvore = $_POST['espaco_arvore'];
    $classificacao = $_POST['classificacao'];
    $numero_individuos = isset($_POST['numero_individuos']) && $_POST['numero_individuos'] !== '' ? intval($_POST['numero_individuos']) : null;
    $estado_fitossanitario = $_POST['estado_fitossanitario'];
    $estado_tronco = $_POST['estado_tronco'];
    $estado_raizes = $_POST['estado_raizes'];
    $danos_pavimento = $_POST['danos_pavimento'];
    $fiacao = $_POST['fiacao'];
    $sinalizacao = $_POST['sinalizacao'];
    $dap = isset($_POST['dap']) && $_POST['dap'] !== '' ? floatval($_POST['dap']) : null;
    $bioma = $_POST['bioma'];
    $nativa = $_POST['nativa'];
    $medicinal = isset($_POST['medicinal']) ? 1 : 0;
    $venenosa = isset($_POST['venenosa']) ? 1 : 0;
    $descricao = $_POST['descricao'];

    // ========================
    // Manipulação da imagem
    // ========================
    $imagem = $_FILES['imagem'];
    $nome_arquivo = '';

    if (isset($imagem) && $imagem['error'] === UPLOAD_ERR_OK) {
        $extensao = strtolower(pathinfo($imagem['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($extensao, $permitidas)) {
            // Gera nome único para o arquivo
            $nome_arquivo = uniqid() . '.' . $extensao;

            // Define pasta de destino
            $pasta = 'imagens/';

            // Cria pasta se não existir
            if (!is_dir($pasta)) {
                mkdir($pasta, 0755, true);
            }

            $destino = $pasta . $nome_arquivo;

            if (!move_uploaded_file($imagem['tmp_name'], $destino)) {
                echo "Erro ao mover a imagem.";
                exit;
            }
        } else {
            echo "Formato de imagem não permitido. (Apenas jpg, jpeg, png ou gif)";
            exit;
        }
    }

    // ========================
    // Inserindo no banco
    // ========================

    $sql = "INSERT INTO arvore (
        nome_cientifico, nome_popular, localizacao, espaco_arvore, classificacao,
        numero_individuos, estado_fitossanitario, estado_tronco, estado_raizes,
        danos_pavimento, fiacao, sinalizacao, dap, bioma, nativa, medicinal,
        venenosa, descricao, imagem
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Erro na preparação da query: " . $conn->error);
    }

    // Tipos: s = string, i = inteiro, d = double
    $stmt->bind_param(
        "ssssisssssssdsiisss",
        $nome_cientifico, 
        $nome_popular,    
        $localizacao,     
        $espaco_arvore,   
        $classificacao,   
        $numero_individuos,
        $estado_fitossanitario, 
        $estado_tronco,   
        $estado_raizes,   
        $danos_pavimento, 
        $fiacao,          
        $sinalizacao,     
        $dap,             
        $bioma,           
        $nativa,          
        $medicinal,       
        $venenosa,        
        $descricao,       
        $nome_arquivo     
    );
    
    if ($stmt->execute()) {
        // Cadastro realizado com sucesso
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
