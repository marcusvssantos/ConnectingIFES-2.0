<?php
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/app/controllers/usuario/UsuarioController.php');
include("../header.php");

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
        body {
            padding-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <br><br><a href="UsuarioCreate.php"><button class="btn btn-success"><i class="fas fa-plus"></i> Adicionar Usuário</button></a><br><br>

                <h1>Lista de Usuários</h1>


                <div class="card mb-6">
                    <div class="card-header">
                        <h3>Alunos</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
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
                                    echo "<td><img src='http://localhost/ConnectingIFES%202.0/public/img/UsuarioIndefinido.png' alt='Foto de Perfil' class='foto-perfil'></td>";
                                }
                                echo "<td>{$usuario['email']}</td>";
                                echo "<td>{$usuario['matricula']}</td>";
                                echo "<td>{$usuario['curso']}</td>";
                                echo "<td>{$usuario['periodo']}</td>";
                            ?>
                                <td>
                                    <a href="UsuarioUpdate.php?idUsuario=<?= $usuario['idUsuario'] ?>">
                                        <button class="btn btn-primary btn-sm btn-icone">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                    </a>

                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm btn-icone" onclick="confirmarExclusao(<?= $usuario['idUsuario'] ?>)">
                                        <i class="fas fa-trash-alt"></i> Remover
                                    </button>
                                </td>

                            <?php
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>



                <div class="card mb-6">
                    <div class="card-header">
                        <h3>Professores</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">

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
                                    echo "<td><img src='http://localhost/ConnectingIFES%202.0/public/img/UsuarioIndefinido.png' alt='Foto de Perfil' class='foto-perfil'></td>";
                                }
                                echo "<td>{$usuario['email']}</td>";
                                echo "<td>{$usuario['siape']}</td>";
                                echo "<td>{$usuario['departamento']}</td>";
                            ?>
                                <td>
                                    <a href="UsuarioUpdate.php?idUsuario=<?= $usuario['idUsuario'] ?>">
                                        <button class="btn btn-primary btn-sm btn-icone">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                    </a>

                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm btn-icone" onclick="confirmarExclusao(<?= $usuario['idUsuario'] ?>)">
                                        <i class="fas fa-trash-alt"></i> Remover
                                    </button>
                                </td>

                            <?php
                                echo "</tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>


                <div class="card mb-6">
                    <div class="card-header">
                        <h3>Administradores</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
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
                                    echo "<td><img src='http://localhost/ConnectingIFES%202.0/public/img/UsuarioIndefinido.png' alt='Foto de Perfil' class='foto-perfil'></td>";
                                }
                                echo "<td>{$usuario['email']}</td>";
                                echo "<td>{$usuario['login']}</td>";
                            ?>
                                <td>
                                    <a href="UsuarioUpdate.php?idUsuario=<?= $usuario['idUsuario'] ?>">
                                        <button class="btn btn-primary btn-sm btn-icone">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                    </a>

                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm btn-icone" onclick="confirmarExclusao(<?= $usuario['idUsuario'] ?>)">
                                        <i class="fas fa-trash-alt"></i> Remover
                                    </button>
                                </td>

                            <?php
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</html>