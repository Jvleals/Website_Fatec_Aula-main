<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Status da Árvore</title>
  <link rel="stylesheet" href="telainf.css">
</head>
<body>

  <header>
    <div class="logo">🌿 FatecAmbiental</div>

    <form class="search-form" action="pesquisar.php" method="GET">
      <input type="text" name="q" placeholder="Buscar árvore..." required />
      <span class="search-icon" onclick="this.closest('form').submit();">🔍</span>
    </form>

    <!-- Botão hamburger -->
    <button class="menu-button" aria-label="Abrir menu" aria-expanded="false" aria-controls="sideMenu" onclick="toggleMenu(this)">
      <span class="bar"></span>
      <span class="bar"></span>
      <span class="bar"></span>
    </button>

    <!-- Sidebar menu -->
    <nav id="sideMenu" aria-hidden="true">
      <button class="close-btn" aria-label="Fechar menu" onclick="closeMenu()">✖</button>
      <a href="#">Opção 1</a>
      <a href="#">Opção 2</a>
      <a href="#">Opção 3</a>
    </nav>
  </header>

  <section class="background-image">
    <div class="overlay">
      <!-- Formulário -->
      <form class="info" action="salvar.php" method="POST" enctype="multipart/form-data">
  <!-- Dados -->
  <label><strong>Nome Científico:</strong>
    <input type="text" name="nome_cientifico" required>
  </label>

  <label><strong>Nome Popular:</strong>
    <input type="text" name="nome_popular">
  </label>

  <label><strong>Localização (Rua e Bairro):</strong>
    <input type="text" name="localizacao" placeholder="Ex: Rua das Flores, Bairro Jardim" required>
  </label>

  <label><strong>Espaço Árvore:</strong>
    <input type="text" name="espaco_arvore">
  </label>

  <label><strong>Classificação:</strong>
    <input type="text" name="classificacao">
  </label>

  <label><strong>Número de indivíduos:</strong>
    <input type="number" name="numero_individuos" min="0">
  </label>

  <label><strong>Estado fitossanitário:</strong>
    <input type="text" name="estado_fitossanitario">
  </label>

  <label><strong>Estado do tronco:</strong>
    <input type="text" name="estado_tronco">
  </label>

  <label><strong>Estado das raízes:</strong>
    <input type="text" name="estado_raizes">
  </label>

  <label><strong>Danos ao pavimento:</strong>
    <select name="danos_pavimento">
      <option value="">Selecione</option>
      <option value="sem_dano">Sem dano</option>
      <option value="rachaduras">Rachaduras</option>
      <option value="desnivel">Desnível</option>
    </select>
  </label>

  <label><strong>Fiação:</strong>
    <select name="fiacao">
      <option value="">Selecione</option>
      <option value="livre">Livre</option>
      <option value="interferencia_leve">Interferência leve</option>
      <option value="interferencia_grave">Interferência grave</option>
    </select>
  </label>

  <label><strong>Sinalização:</strong>
    <select name="sinalizacao">
      <option value="">Selecione</option>
      <option value="sem_interferencia">Sem interferência</option>
      <option value="obstruindo_placa">Obstruindo placa</option>
      <option value="afastada">Afastada</option>
    </select>
  </label>

  <label><strong>DAP (cm):</strong>
    <input type="number" name="dap" step="0.01" min="0">
  </label>

  <label><strong>Bioma:</strong>
    <select name="bioma">
      <option value="">Selecione</option>
      <option value="mata_atlantica">Mata Atlântica</option>
      <option value="cerrado">Cerrado</option>
      <option value="pampa">Pampa</option>
      <option value="caatinga">Caatinga</option>
      <option value="amazonia">Amazônia</option>
    </select>
  </label>

  <label><strong>Nativa?</strong>
    <select name="nativa">
      <option value="">Selecione</option>
      <option value="sim">Sim</option>
      <option value="nao">Não</option>
    </select>
  </label>

  <label><strong>Imagem da árvore:</strong>
    <input type="file" name="imagem" accept="image/*">
  </label>

  <label><strong>Medicinal?</strong>
    <select name="medicinal" required>
      <option value="">Selecione</option>
      <option value="1">Sim</option>
      <option value="0">Não</option>
    </select>
  </label>

  <label><strong>Venenosa?</strong>
    <select name="venenosa" required>
      <option value="">Selecione</option>
      <option value="1">Sim</option>
      <option value="0">Não</option>
    </select>
  </label>

  <label><strong>Descrição:</strong>
    <textarea name="descricao" rows="4" placeholder="Descreva observações relevantes"></textarea>
  </label>

  <button type="submit">Salvar</button>
</form>
    </div>
  </section>

  <script>
    const menuButton = document.querySelector('.menu-button');
    const sideMenu = document.getElementById('sideMenu');

    function toggleMenu(button) {
      const expanded = button.getAttribute('aria-expanded') === 'true' || false;
      button.setAttribute('aria-expanded', !expanded);
      sideMenu.classList.toggle('open');
      sideMenu.setAttribute('aria-hidden', expanded);
      button.classList.toggle('open');
    }

    function closeMenu() {
      sideMenu.classList.remove('open');
      menuButton.classList.remove('open');
      menuButton.setAttribute('aria-expanded', false);
      sideMenu.setAttribute('aria-hidden', true);
    }
  </script>
</body>
</html>
