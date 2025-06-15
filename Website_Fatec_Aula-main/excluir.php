<?php
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);

    $sql = "DELETE FROM arvore WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        header("Location: consultar.php?msg=excluido");
        exit;
    } else {
        echo "Erro ao excluir.";
    }
}
?>
