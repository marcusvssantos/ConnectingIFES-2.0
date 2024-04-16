<?php
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/app/controllers/grupo/GrupoController.php');
include("../header.php");

if (isset($_POST['deleteGroup'])) {
    if (isset($_POST['idGrupo']) && !empty($_POST['idGrupo'])) {

        $idGrupo = $_POST['idGrupo'];

        $grupoController = new GrupoController($conn);

        $grupoController->deletarGrupo($idGrupo);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Grupos</title>
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
    </style>
</head>

<body>

    <br><br><a href="GrupoCreate.php"><button>Cadastrar novo Grupo</button></a><br><br>

    <h1>Lista de Grupos</h1>

    <table>
        <tr>
            <th>Nome do Grupo</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
        <?php
        $grupos = $grupoController->obterGrupos();
        foreach ($grupos as $grupo) {
            echo "<tr>";
            echo "<td>{$grupo['nome']}</td>";
            echo "<td>
                    <form method='GET' action='GrupoUpdate.php'>
                        <input type='hidden' name='idGrupo' value='{$grupo['idGrupo']}'>
                        <button type='submit' name=''>Editar</button>
                    </form>
                </td>";
            echo "<td>
                    <form method='POST' action=''>
                        <input type='hidden' name='idGrupo' value='{$grupo['idGrupo']}'>
                        <button type='submit' name='deleteGroup'>Deletar</button>
                    </form>
                   </td>";
            echo "</tr>";
        }
        ?>
    </table>

</body>

</html>