<?php
$mensagemStatus = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = strip_tags(trim($_POST["nome"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $assunto = strip_tags(trim($_POST["assunto"]));
    $mensagem = strip_tags(trim($_POST["mensagem"]));

    if (empty($nome) || empty($email) || empty($assunto) || empty($mensagem)) {
        $mensagemStatus = "❌ Por favor, preencha todos os campos.";
    } else {
        $para = "fateambiental@gmail.com";
        $assunto_email = "Contato do site: $assunto";

        $conteudo = "Você recebeu uma nova mensagem do site FatecAmbiental:\n\n";
        $conteudo .= "Nome: $nome\n";
        $conteudo .= "Email: $email\n";
        $conteudo .= "Assunto: $assunto\n";
        $conteudo .= "Mensagem:\n$mensagem\n";

        $headers = "From: $nome <$email>";

        if (mail($para, $assunto_email, $conteudo, $headers)) {
            $mensagemStatus = "✅ Mensagem enviada com sucesso!";
        } else {
            $mensagemStatus = "❌ Erro ao enviar mensagem. Tente novamente mais tarde.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Contato | FatecAGRO</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #e9ecef;
    }

    .menu-btn {
      position: fixed;
      top: 20px;
      right: 20px;
      font-size: 28px;
      background-color: transparent;
      border: none;
      cursor: pointer;
      z-index: 1101;
    }

    .sidebar {
      height: 100%;
      width: 0;
      position: fixed;
      top: 0;
      right: 0;
      background-color: #007f5f;
      overflow-x: hidden;
      transition: 0.3s;
      padding-top: 60px;
      z-index: 1100;
    }

    .sidebar a {
      padding: 15px 25px;
      text-decoration: none;
      font-size: 18px;
      color: white;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: 0.2s;
    }

    .sidebar a:hover {
      background-color: #026348;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      left: 20px;
      font-size: 36px;
      color: white;
    }

    header {
      background-color: white;
      padding: 20px 60px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .logo {
      font-size: 24px;
      color: #007f5f;
      font-weight: bold;
    }

    .search-form {
      display: flex;
      align-items: center;
    }

    .search-form input {
      padding: 8px 12px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 4px 0 0 4px;
      outline: none;
    }

    .search-icon {
      padding: 8px 12px;
      background-color: #007f5f;
      color: white;
      border-radius: 0 4px 4px 0;
      cursor: pointer;
    }

    .contato-container {
      max-width: 800px;
      margin: 80px auto;
      padding: 30px;
      background-color: #f4f4f4;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .contato-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #007f5f;
    }

    .contato-container form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .contato-container input,
    .contato-container textarea {
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
      width: 100%;
    }

    .contato-container textarea {
      resize: vertical;
      min-height: 120px;
    }

    .contato-container button {
      background-color: #007f5f;
      color: white;
      border: none;
      padding: 12px;
      font-size: 16px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .contato-container button:hover {
      background-color: #026348;
    }

    .mensagem-status {
      margin-bottom: 15px;
      font-weight: bold;
      text-align: center;
      padding: 10px;
      border-radius: 5px;
      background-color: #e0f8ee;
      color: #007f5f;
      border: 1px solid #b2e6d5;
    }

    .footer {
      background-color: #007f5f;
      color: white;
      padding: 20px;
      text-align: center;
    }

    .footer-title {
      font-weight: bold;
      margin-bottom: 10px;
    }

    .logo-slider span {
      margin: 0 10px;
      display: inline-block;
    }

    .footer-nav {
      margin: 15px 0;
    }

    .footer-nav a {
      color: white;
      margin: 0 10px;
      text-decoration: none;
    }

    .footer-copy {
      font-size: 14px;
      margin-top: 10px;
    }

    @media (max-width: 600px) {
      .contato-container {
        margin: 20px;
        padding: 20px;
      }

      header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }
    }
  </style>
</head>
<body>

<header>
<a href="index.php" class="logo">🌿 FatecAmbiental</a>


</header>

<main>
  <div class="contato-container">
    <h2>Fale Conosco</h2>

    <?php if (!empty($mensagemStatus)) : ?>
      <div class="mensagem-status"><?= $mensagemStatus ?></div>
    <?php endif; ?>

    <form action="" method="POST">
      <input type="text" name="nome" placeholder="Seu nome" required>
      <input type="email" name="email" placeholder="Seu e-mail" required>
      <input type="text" name="assunto" placeholder="Assunto" required>
      <textarea name="mensagem" placeholder="Digite sua mensagem" required></textarea>
      <button type="submit">Enviar</button>
    </form>
  </div>
</main>

<footer class="footer">
  <p class="footer-title">Parceiros:</p>
  <div class="logo-slider">
    <span>Nextflows</span>
    <span>Fancywear</span>
    <span>DataBites</span>
    <span>ExDone</span>
    <span>Arktico</span>
    <span>PayScale</span>
  </div>

  <div class="footer-nav">
    <a href="#">Our Focus</a>
    <a href="#">Project</a>
    <a href="#">News & Events</a>
    <a href="#">About Us</a>
  </div>

  <p class="footer-copy">© <?= date('Y') ?> FatecAGRO. Todos os direitos reservados.</p>
</footer>

<script>
  function abrirSidebar() {
    document.getElementById("sidebar").style.width = "250px";
  }

  function fecharSidebar() {
    document.getElementById("sidebar").style.width = "0";
  }
</script>

</body>
</html>
