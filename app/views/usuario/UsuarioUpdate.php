<?php
require_once '../../../app/controllers/usuario/UsuarioController.php';

$usuarioController = new UsuarioController($conn);

// Verifica se o ID do usuário foi passado na URL
if (isset($_GET['id'])) {
    $idUsuario = $_GET['id'];

    // Obtém os detalhes do usuário com base no ID
    $usuario = $usuarioController->obterUsuario($idUsuario);

    if ($usuario) {
        $nome = $usuario['nome'];
        $sobrenome = $usuario['sobrenome'];
        $email = $usuario['email'];
        $foto = $usuario['fotoPerfil'];
        $siape = $usuario['siape'];
        $tipo = $usuario['tipo'];
        $matricula = $usuario['matricula'];
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualização de Usuário</title>
</head>

<body>
    <h2>Atualização de Usuário</h2>

    <div id="aviso" style="display:none;color:red;">
    </div>

    <form action="../../../app/controllers/usuario/ProcessarAtualizacaoUsuario.php" method="POST" id="atualizacaoForm">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required><br>

        <label for="sobrenome">Sobrenome:</label><br>
        <input type="text" id="sobrenome" name="sobrenome" value="<?php echo $sobrenome; ?>" required><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br>

        <label for="fotoPerfil">Foto de Perfil:</label><br>
        <input type="text" id="fotoPerfil" value="<?php echo $foto; ?>"  name="fotoPerfil"><br>

        <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $idUsuario; ?>">
        <input type="hidden" id="tipo" name="tipo" value="<?php echo $tipo; ?>">


        <?php if ($siape !== null && $siape !== '') : ?>
            <label for="siape">SIAPE:</label><br>
            <input type="text" id="siape" name="siape" value="<?php echo $siape; ?>" required><br>
        <?php endif; ?>

        <?php if ($matricula !== null && $matricula !== '') : ?>
            <label for="matricula">Matrícula:</label><br>
            <input type="text" id="matricula" name="matricula" value="<?php echo $matricula; ?>" required><br>
        <?php endif; ?>

        <input type="submit" value="Atualizar">
    </form>

    <script>
        


    </script>
</body>

</html>
