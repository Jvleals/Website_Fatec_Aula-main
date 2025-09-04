<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$url = "http://" . $_SERVER['HTTP_HOST'] . "/exibicao.php?id=" . $id;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>QR Code da Árvore</title>
  <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      padding: 20px;
    }
    #qrcode {
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 20px auto;
      width: 100%;
    }
    input {
      width: 90%;
      padding: 5px;
      margin-top: 10px;
      text-align: center;
    }
    button {
      padding: 8px 16px;
      margin-top: 15px;
      background: #2d6a4f;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background: #1b4332;
    }
  </style>
</head>
<body>
  <h2>QR Code da Árvore</h2>
  <div id="qrcode"></div>
  <input type="text" value="<?= htmlspecialchars($url) ?>" readonly id="link">
  <br>
  <button onclick="copiarLink()">Copiar Link</button>

  <script>
    const url = "<?= $url ?>";
    new QRCode(document.getElementById("qrcode"), {
      text: url,
      width: 250,
      height: 250
    });

    function copiarLink() {
      const link = document.getElementById("link");
      link.select();
      document.execCommand("copy");
      alert("Link copiado: " + link.value);
    }
  </script>
</body>
</html>
