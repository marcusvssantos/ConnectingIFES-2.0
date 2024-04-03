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
    <style>
        /* Estilo para as tabelas */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Estilo para os botões */
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Estilo para o link */
        a {
            text-decoration: none;
            color: #4CAF50;
        }

        a:hover {
            text-decoration: underline;
        }

        details {
            font:
                25px "Open Sans",
                Calibri,
                sans-serif;
            width: 620px;
        }

        details>summary {
            padding: 2px 6px;
            width: 40em;
            border: none;
            box-shadow: 3px 3px 4px black;
            cursor: pointer;
            list-style: none;
        }

    </style>
</head>

<body>
    <h2>Lista de Usuários</h2>

    <a href="UsuarioCreate.php"><button>Cadastrar novo Usuário</button></a>

    <details>
        <summary>Administradores</summary>
        <table>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Foto de Perfil</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
            <?php
            $adminUsuarios = $usuarioController->obterUsuariosPorTipo('admin');
            foreach ($adminUsuarios as $usuario) {
                echo "<tr>";
                echo "<td>{$usuario['nome']} {$usuario['sobrenome']}</td>";
                echo "<td>{$usuario['email']}</td>";
                echo "<td>{$usuario['fotoPerfil']}</td>";
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
    </details>


    <details>
        <summary>Alunos</summary>
        <table>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Foto de Perfil</th>
                <th>Matricula</th>
                <th>Editar</th>
                <th>Excluir</th>


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
    </details>


    <details>
        <summary>Professores</summary>
        <table>
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
    </details>
</body>

</html>