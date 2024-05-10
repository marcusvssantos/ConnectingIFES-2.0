<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/app/controllers/publicacao/PublicacaoController.php');
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/app/controllers/usuario/UsuarioController.php');
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/app/controllers/grupo/GrupoController.php');

$usuarioController = new UsuarioController($conn);
$publicacaoController = new PublicacaoController($conn);
$grupoController = new GrupoController($conn);


$siape =  $_SESSION['siape'];
$senha =  $_SESSION['senha'];

$usuario = $usuarioController->obterProfessorPorSiapeSenha($siape, $senha);
$gruposProfessor = $grupoController->obterGruposDoProfesor($siape);


if ((!isset($_SESSION['siape']) == true)) {
  header("Location: http://localhost/ConnectingIFES%202.0/app/views/erro.php?erro=nao_logado");
}


if (isset($_POST['sair'])) {
  header("Location: http://localhost/ConnectingIFES%202.0/app/index.php");
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
          <?php
          $fotoPerfil = '../../../public/uploads/fotoPerfil/' . $usuario['fotoPerfil'];
          echo "<img class='nav-icon' src=' " . $fotoPerfil . "'> ";
          ?>
          <span class="nav-text">
            &nbsp&nbsp <?php echo "{$usuario['nome']} {$usuario['sobrenome']}"; ?>
          </span>
        </a>
      </li>
      <li>
        <a href="connectingIFES.php">
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
          <form action="../../../app/controllers/publicacao/ProcessarCadastroPublicacao.php" enctype="multipart/form-data" method="POST">
            <div class="form-group">
              <label for="tituloPost">Título</label>
              <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Digite o título da postagem">
            </div>
            <div class="form-group">
              <label for="conteudoPost">Conteúdo</label>
              <textarea class="form-control" id="conteudo" name="conteudo" rows="4" placeholder="Digite o conteúdo da postagem"></textarea>
            </div>

            <?php echo '<input type="hidden" id="professor_id" name="professor_id" value="'. $usuario['idProfessor']. '">';?>
            <div class="form-group">
              <label for="imagemPost" class="col-form-label">Imagem</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="imagem" name="imagem">
                <label class="custom-file-label" for="imagemPost">Escolher arquivo</label>
              </div>
            </div>
            <label>Selecione os grupos em que deseja Publicar:</label><br>
            <?php
            foreach ($gruposProfessor as $grupo) {
              echo '<div class="form-check">';
              echo '<input class="form-check-input" type="checkbox" id="grupo_' . $grupo['idGrupo'] . '" name="grupos[]" value="' . $grupo['idGrupo'] . '">';
              echo '<label class="form-check-label" for="grupo_' . $grupo['idGrupo'] . '">' . $grupo['nome'] . '</label>';
              echo '</div>';
            }
            ?>
            <button type="submit" name='post_publicacao' class="btn btn-primary">Publicar</button>

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