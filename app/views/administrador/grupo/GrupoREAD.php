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
        body {
            padding-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <br><br><a href="GrupoCreate.php"><button class="btn btn-success"><i class="fas fa-plus"></i>Cadastrar novo Grupo</button></a><br><br>

                <div class="card mb-3">
                    <div class="card-header">
                        <h3>Lista de Grupos</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
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
                        <button type='submit' class='btn btn-primary btn-sm btn-icone' name=''><i class='fas fa-edit'></i>Editar</button>
                    </form>
                </td>";
                                echo "<td>
                    <form method='POST' action=''>
                        <input type='hidden' name='idGrupo' value='{$grupo['idGrupo']}'>
                        <button type='submit' class='btn btn-danger btn-sm btn-icone name='deleteGroup'><i class='fas fa-trash-alt'></i> Deletar</button>
                    </form>
                   </td>";
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>