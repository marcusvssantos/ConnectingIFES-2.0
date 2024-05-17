<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/app/controllers/publicacao/PublicacaoController.php');
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/app/controllers/usuario/UsuarioController.php');
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/app/controllers/grupo/GrupoController.php');

$usuarioController = new UsuarioController($conn);
$publicacaoController = new PublicacaoController($conn);
$grupoController = new GrupoController($conn);


$matricula =  $_SESSION['matricula'];
$senha =  $_SESSION['senha'];

$usuario = $usuarioController->obterAlunoPorMatriculaSenha($matricula, $senha);
$gruposAluno = $grupoController->obterGruposDoAluno($matricula);
$grupos = $grupoController->obterGrupos();


if ((!isset($_SESSION['matricula']) == true)) {
  header("Location: http://localhost/ConnectingIFES%202.0/app/views/erro.php?erro=nao_logado");
}


if (isset($_POST['sair'])) {
  header("Location: http://localhost/ConnectingIFES%202.0/app/index.php");
  unset($_SESSION['matricula']);
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
  <link rel="stylesheet" type="text/css" href="estilo_aluno.css" media="screen" />
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
      <?php 
      echo "<a class='editBtnProf' href='#contact' data-toggle='modal' data-target='#edicaoAlunoModal' title='Editar Perfil'>"
      ?>
          <i class="bi bi-gear"></i>
          <span class="nav-text">
            Editar Perfil
          </span>
        </a>
      </li>

      
      <li>
        <a href="chat.php" title="Chat">
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


<!-- Modal Aluno-->
<div class="modal fade" id="edicaoAlunoModal" tabindex="-1" role="dialog" aria-labelledby="edicaoAlunoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="edicaoAlunoModalLabel">Editar Meu Perfil</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="../../../app/controllers/usuario/ProcessarAtualizacaoUsuario.php" enctype="multipart/form-data" method="POST">
            <div class="form-group">
              <label for="nomePost">Nome</label>
              <input type="text" class="form-control" id="nome" name="nome" value="<?php echo "{$usuario['nome']} ";?>" placeholder="Digite seu nome" required> 
            </div>
            <div class="form-group">
              <label for="sobrenomePost">Sobrenome</label>
              <input class="form-control" id="sobrenome" value="<?php echo "{$usuario['sobrenome']} ";?>" name="sobrenome"  placeholder="Digite o seu Sobrenome" required></input>
            </div>
            <div class="form-group">
              <label for="emailPost">email</label>
              <input type="email" class="form-control" id="email" value="<?php echo "{$usuario['email']} ";?>" name="email" placeholder="Digite o seu Email" required></input>
            </div>
            <div class="form-group">
              <label for="senhaPost">Senha</label>
              <input type="password" class="form-control" id="senha" name="senha"  placeholder="Digite sua nova Senha" required></input>
            </div>
            <?php echo '<input type="hidden" id="idUsuario" name="idUsuario" value="'. $usuario['idUsuario']. '">';?>
            <?php echo '<input type="hidden" id="tipo" name="tipo" value="'. $usuario['tipo']. '">';?>
            <?php echo '<input type="hidden" id="curso" name="curso" value="'. $usuario['curso']. '">';?>
            <?php echo '<input type="hidden" id="periodo" name="periodo" value="'. $usuario['periodo']. '">';?>
            <?php echo '<input type="hidden" id="matricula" name="matricula" value="'. $usuario['matricula']. '">';?>

            <div class="form-group">
              <label for="fotoPerfilPost" class="col-form-label">Foto de Perfil</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="fotoPerfil" name="fotoPerfil">
                <label class="custom-file-label" for="fotoPerfilPost">Escolher arquivo</label>
              </div>
            </div>
           
            
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