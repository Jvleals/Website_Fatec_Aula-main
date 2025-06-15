<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pasta onde as imagens serão salvas
    $targetDir = "imagens/";

    // Verifica se o arquivo foi enviado
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['imagem']['tmp_name'];
        $fileName = basename($_FILES['imagem']['name']);
        $fileSize = $_FILES['imagem']['size'];
        $fileType = $_FILES['imagem']['type'];

        // Extensão do arquivo
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExtension, $allowedExtensions)) {
            // Gera um nome único para evitar sobrescrita
            $newFileName = uniqid('img_', true) . '.' . $fileExtension;

            // Caminho completo do arquivo na pasta imagens
            $destPath = $targetDir . $newFileName;

            // Move o arquivo para a pasta imagens
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                // Agora, insira o registro no banco (exemplo básico)
                $nome_popular = $conn->real_escape_string($_POST['nome_popular']);
                $nome_cientifico = $conn->real_escape_string($_POST['nome_cientifico']);
                // ... adicione os outros campos necessários
                $imagem = $conn->real_escape_string($newFileName);

                $sql = "INSERT INTO arvore (nome_popular, nome_cientifico, imagem) VALUES ('$nome_popular', '$nome_cientifico', '$imagem')";

                if ($conn->query($sql)) {
                    echo "Upload e cadastro realizados com sucesso!";
                } else {
                    echo "Erro ao salvar no banco: " . $conn->error;
                }
            } else {
                echo "Erro ao mover o arquivo.";
            }
        } else {
            echo "Tipo de arquivo não permitido. Use jpg, jpeg, png ou gif.";
        }
    } else {
        echo "Erro no upload do arquivo.";
    }
}
?>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <label>Nome Popular:</label>
    <input type="text" name="nome_popular" required /><br />
    <label>Nome Científico:</label>
    <input type="text" name="nome_cientifico" required /><br />
    <label>Imagem:</label>
    <input type="file" name="imagem" accept="image/*" required /><br />
    <button type="submit">Enviar</button>
</form>
