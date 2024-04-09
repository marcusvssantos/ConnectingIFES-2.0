<?php
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/app/controllers/usuario/UsuarioController.php');

$usuarioController = new UsuarioController($conn);

// Verifica se o ID do usuário foi passado na URL
if (isset($_GET['idUsuario'])) {
    $idUsuario = $_GET['idUsuario'];

    // Obtém os detalhes do usuário com base no ID
    $usuario = $usuarioController->obterUsuario($idUsuario);

    if ($usuario) {
        $nome = $usuario['nome'];
        $sobrenome = $usuario['sobrenome'];
        $email = $usuario['email'];
        $foto = $usuario['fotoPerfil'];
        $tipo = $usuario['tipo'];
        $matricula = isset($usuario['matricula']) ? $usuario['matricula'] : '';
        $siape = isset($usuario['siape']) ? $usuario['siape'] : '';
        $curso = isset($usuario['curso']) ? $usuario['curso'] : '';
        $periodo = isset($usuario['periodo']) ? $usuario['periodo'] : '';
        $departamento = isset($usuario['departamento']) ? $usuario['departamento'] : '';
        $login = isset($usuario['login']) ? $usuario['login'] : '';
    } else {
        header("Location: erro.php");
        exit();
    }
} else {
    header("Location: erro.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualização de Usuário</title>
</head>

<body>
    <h2 class="text-center mb-4">Atualização de Usuário</h2>

    <div id="aviso" class="alert alert-danger" style="display:none;">
    </div>

    <form action="../../../../app/controllers/usuario/ProcessarAtualizacaoUsuario.php" method="POST" id="atualizacaoForm" enctype="multipart/form-data" class="container">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>" required>
        </div>

        <div class="mb-3">
            <label for="sobrenome" class="form-label">Sobrenome:</label>
            <input type="text" class="form-control" id="sobrenome" name="sobrenome" value="<?php echo $sobrenome; ?>" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>

        <div class="mb-3">
            <label for="fotoPerfil" class="form-label">Foto de Perfil:</label>
            <input type="file" class="form-control" id="fotoPerfil" name="fotoPerfil">
        </div>

        <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $idUsuario; ?>">
        <input type="hidden" id="tipo" name="tipo" value="<?php echo $tipo; ?>">

        <?php if ($tipo === 'aluno') : ?>
            <div class="mb-3">
                <label for="matricula" class="form-label">Matrícula:</label>
                <input type="text" class="form-control" id="matricula" name="matricula" value="<?php echo $matricula; ?>" required>
            </div>
            <div class="mb-3">
                <label for="curso" class="form-label">Curso:</label>
                <input type="text" class="form-control" id="curso" name="curso" value="<?php echo $curso; ?>" required>
            </div>
            <div class="mb-3">
                <label for="periodo" class="form-label">Período:</label>
                <input type="text" class="form-control" id="periodo" name="periodo" value="<?php echo $periodo; ?>" required>
            </div>
        <?php elseif ($tipo === 'professor') : ?>
            <div class="mb-3">
                <label for="siape" class="form-label">SIAPE:</label>
                <input type="text" class="form-control" id="siape" name="siape" value="<?php echo $siape; ?>" required>
            </div>
            <div class="mb-3">
                <label for="departamento" class="form-label">Departamento:</label>
                <input type="text" class="form-control" id="departamento" name="departamento" value="<?php echo $departamento; ?>" required>
            </div>
        <?php elseif ($tipo === 'administrador') : ?>
            <div class="mb-3">
                <label for="login" class="form-label">Login:</label>
                <input type="text" class="form-control" id="login" name="login" value="<?php echo $login; ?>" required>
            </div>
        <?php endif; ?>

        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>