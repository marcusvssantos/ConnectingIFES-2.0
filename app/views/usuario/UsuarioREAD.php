<?php
require_once '../../../app/controllers/usuario/UsuarioController.php';
include("header.php");

if (isset($_POST['deleteUser'])) {
    if (isset($_POST['idUsuario']) && !empty($_POST['idUsuario'])) {

        $idUsuario = $_POST['idUsuario'];

        $usuarioController = new UsuarioController($conn);

        $usuarioController->deletarUsuario($idUsuario);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
</head>

<body>
    <h2>Lista de Usuários</h2>

    <h3>Administradores</h3>
    <table border="1">
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Foto de Perfil</th>
            <th>Editar</th>
        </tr>
        <?php
        $adminUsuarios = $usuarioController->obterUsuariosPorTipo('admin');
        foreach ($adminUsuarios as $usuario) {
            echo "<tr>";
            echo "<td>{$usuario['nome']} {$usuario['sobrenome']}</td>";
            echo "<td>{$usuario['email']}</td>";
            echo "<td>{$usuario['fotoPerfil']}</td>";
            echo "<td><a href='UsuarioUpdate.php?id={$usuario['idUsuario']}'>Editar</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h3>Alunos</h3>
    <table border="1">
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Foto de Perfil</th>
            <th>Matricula</th>
            <th>Editar</th>

        </tr>
        <?php
        $alunosUsuarios = $usuarioController->obterUsuariosPorTipo('aluno');
        foreach ($alunosUsuarios as $usuario) {
            echo "<tr>";
            echo "<td>{$usuario['nome']} {$usuario['sobrenome']}</td>";
            echo "<td>{$usuario['email']}</td>";
            echo "<td>{$usuario['fotoPerfil']}</td>";
            echo "<td>{$usuario['matricula']}</td>";
            echo "<td><a href='UsuarioUpdate.php?id={$usuario['idUsuario']}'>Editar</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <h3>Professores</h3>
    <table border="1">
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Foto de Perfil</th>
            <th>Siape</th>
            <th>Editar</th>
            <th>Excluir</th>

        </tr>
        <?php
        $professoresUsuarios = $usuarioController->obterUsuariosPorTipo('professor');
        foreach ($professoresUsuarios as $usuario) {
            echo "<tr>";
            echo "<td>{$usuario['nome']} {$usuario['sobrenome']}</td>";
            echo "<td>{$usuario['email']}</td>";
            echo "<td>{$usuario['fotoPerfil']}</td>";
            echo "<td>{$usuario['siape']}</td>";
            echo "<td><a href='UsuarioUpdate.php?id={$usuario['idUsuario']}'>Editar</a></td>";
            echo "<td>
                    <form method='POST' action=''>
                        <input type='hidden' name='idUsuario' value='{$usuario['idUsuario']}'>
                        <button type='submit' name='deleteUser'>Deletar</button>
                    </form>
                   </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>