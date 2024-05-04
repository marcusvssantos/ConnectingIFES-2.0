<?php
session_start();

if ((!isset($_SESSION['siape']) == true)) {
  header('location: ../index.php');
}


if (isset($_POST['sair'])) {
  unset($_SESSION['siape']);
  unset($_SESSION['idUsuario']);
}


?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" sizes="32x32" href="../../img/Logo ConnectingIFES.png">
  <link rel="stylesheet" type="text/css" href="estilo_professor.css" media="screen" />
  <!-- CSS do Bootstrap -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

  <!-- JS do Bootstrap (necessário para os componentes interativos) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>





  <nav class="sidebar">
    <ul>
      <li>
        <a>
          <img class="nav-icon" src="acai.png">
          <span class="nav-text">
            &nbsp&nbsp Carlos João
          </span>
        </a>
      </li>
      <li>
        <a href="index_professor.php">
          <i class="bi bi-house-door"></i>
          <span class="nav-text">
            Publicações
          </span>
        </a>
      </li>

      <li>
        <a href="editar_professor.php">
          <i class="bi bi-gear"></i>
          <span class="nav-text">
            Editar Perfil
          </span>
        </a>
      </li>

      <li>
        <a href="meu_perfil.php">
          <i class="bi bi-people"></i>
          <span class="nav-text">
            Minhas Publicações
          </span>
        </a>
      </li>
      <li>
        <a href="#contact" data-toggle="modal" data-target="#cadastroModal" title="Adicionar Nova Publicação">
          <i class="bi bi-file-earmark-plus"></i>
          <span class="nav-text">
            Nova Publicações
          </span>
        </a>
      </li>
      <li>
        <a href="#contact" data-toggle="modal" data-target="#postModal" title="Adicionar Nova Publicação">
          <i class="bi bi-chat-dots"></i>
          <span class="nav-text">
            Mensagens
          </span>
        </a>
      </li>



    </ul>
    <ul class="logout">
      <li>
        <a>
          <form class="nav navbar-nav navbar-right" method="POST">
            <button type="submit" class="btn btn-secondary" name="sair" id="btn-sair">
              <i class="bi bi-power bi-2x"></i>
              <span class="nav-text">
                Sair
              </span>
            </button>
          </form>

      </li>
    </ul>

  </nav>

  <!-- Modal -->
  <div class="modal fade" id="cadastroModal" tabindex="-1" role="dialog" aria-labelledby="cadastroModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cadastroModalLabel">Publicação</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="tituloPost">Título</label>
              <input type="text" class="form-control" id="tituloPost" name="tituloPost" placeholder="Digite o título da postagem">
            </div>
            <div class="form-group">
              <label for="conteudoPost">Conteúdo</label>
              <textarea class="form-control" id="conteudoPost" name="conteudoPost" rows="4" placeholder="Digite o conteúdo da postagem"></textarea>
            </div>
            <div class="form-group">
              <label for="imagemPost" class="col-form-label">Imagem</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="imagemPost" name="imagemPost">
                <label class="custom-file-label" for="imagemPost">Escolher arquivo</label>
              </div>
            </div>
            <div class="form-group">
              <label for="multiSelect">Selecione as opções:</label>
              <select class="form-control" id="multiSelect">
                <option value="opcao1">Opção 1</option>
                <option value="opcao2">Opção 2</option>
                <option value="opcao3">Opção 3</option>
                <option value="opcao4">Opção 4</option>
              </select>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>




  <!-- Incluindo Bootstrap JS (opcional) -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
<script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>