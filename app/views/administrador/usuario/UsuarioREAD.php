<?php
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/app/controllers/usuario/UsuarioController.php');
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

        /* Estilo para as imagens de perfil */
        .foto-perfil {
            width: 50px;
            /* Ajuste conforme necessário */
            height: 50px;
            /* Ajuste conforme necessário */
            object-fit: cover;
            /* Mantém a proporção da imagem, cortando partes que não cabem */
            border-radius: 50%;
            /* Torna a imagem circular, se desejado */
        }
    </style>
</head>

<body>


    <br><br><a href="UsuarioCreate.php"><button>Cadastrar novo Usuário</button></a><br><br>

    <h1>Lista de Usuários</h1>

    <h3>Alunos</h3>
    <table>
        <tr>
            <th>Nome</th>
            <th>Foto de Perfil</th>
            <th>E-mail</th>
            <th>Matrícula</th>
            <th>Curso</th>
            <th>Período</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
        <?php
        $alunos = $usuarioController->obterAlunos();
        foreach ($alunos as $usuario) {
            echo "<tr>";
            echo "<td>{$usuario['nome']} {$usuario['sobrenome']}</td>";
            $fotoPerfil = '../../../../public/uploads/fotoPerfil/' . $usuario['fotoPerfil'];

            if ($usuario['fotoPerfil'] != null) {
                echo "<td><img src='" . $fotoPerfil . "' alt='Foto de Perfil' class='foto-perfil'></td>";
            } else {
                echo "<td style='background-color: blue; width: 50px; height: 50px; border-radius: 50%;'></td>";
            }
            echo "<td>{$usuario['email']}</td>";
            echo "<td>{$usuario['matricula']}</td>";
            echo "<td>{$usuario['curso']}</td>";
            echo "<td>{$usuario['periodo']}</td>";
            echo "<td>
                    <form method='GET' action='UsuarioUpdate.php'>
                        <input type='hidden' name='idUsuario' value='{$usuario['idUsuario']}'>
                        <button type='submit' name=''>Editar</button>
                    </form>
                </td>";
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


    <h3>Professores</h3>
    <table>
        <tr>
            <th>Nome</th>
            <th>Foto de Perfil</th>
            <th>E-mail</th>
            <th>SIAPE</th>
            <th>Departamento</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
        <?php
        $professores = $usuarioController->obterProfessores();
        foreach ($professores as $usuario) {
            echo "<tr>";
            echo "<td>{$usuario['nome']} {$usuario['sobrenome']}</td>";
            $fotoPerfil = '../../../../public/uploads/fotoPerfil/' . $usuario['fotoPerfil'];

            if ($usuario['fotoPerfil'] != null) {
                echo "<td><img src='" . $fotoPerfil . "' alt='Foto de Perfil' class='foto-perfil'></td>";
            } else {
                echo "<td style='background-color: white; width: 100px; height: 100px; border-radius: 50%;'></td>";
            }
            echo "<td>{$usuario['email']}</td>";
            echo "<td>{$usuario['siape']}</td>";
            echo "<td>{$usuario['departamento']}</td>";
            echo "<td>
                    <form method='GET' action='UsuarioUpdate.php'>
                        <input type='hidden' name='idUsuario' value='{$usuario['idUsuario']}'>
                        <button type='submit' name=''>Editar</button>
                    </form>
                </td>";
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

    <h3>Administradores</h3>
    <table>
        <tr>
            <th>Nome</th>
            <th>Foto de Perfil</th>
            <th>E-mail</th>
            <th>Login</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
        <?php
        $administradores = $usuarioController->obterAdministradores();
        foreach ($administradores as $usuario) {
            echo "<tr>";
            echo "<td>{$usuario['nome']} {$usuario['sobrenome']}</td>";
            $fotoPerfil = '../../../../public/uploads/fotoPerfil/' . $usuario['fotoPerfil'];

            if ($usuario['fotoPerfil'] != null) {
                echo "<td><img src='" . $fotoPerfil . "' alt='Foto de Perfil' class='foto-perfil'></td>";
            } else {
                echo "<td style='background-color: white; width: 100px; height: 100px; border-radius: 50%;'></td>";
            }
            echo "<td>{$usuario['email']}</td>";
            echo "<td>{$usuario['login']}</td>";
            echo "<td>
                    <form method='GET' action='UsuarioUpdate.php'>
                        <input type='hidden' name='idUsuario' value='{$usuario['idUsuario']}'>
                        <button type='submit' name=''>Editar</button>
                    </form>
                </td>";
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