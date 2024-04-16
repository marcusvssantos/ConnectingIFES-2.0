<?php
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/app/controllers/grupo/GrupoController.php');
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/app/controllers/usuario/UsuarioController.php');

include("../header.php");

$grupoController = new GrupoController($conn);
$usuarioController = new UsuarioController($conn);

if (isset($_GET['idGrupo'])) {
    $idGrupo = $_GET['idGrupo'];
    $grupo = $grupoController->obterGrupo($idGrupo);
    $alunos = $usuarioController->obterAlunos();
    $professores = $usuarioController->obterProfessores();
    $membrosGrupo = $grupoController->obterMembrosGrupo($idGrupo); // Supondo que você tenha um método para isso
} else {
    header("Location: GrupoREAD.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Membros do Grupo</title>
</head>
<body>
    <h1>Gerenciar Membros do Grupo: <?= $grupo['nome'] ?></h1>

    <form action="../../../../app/controllers/grupo/ProcessarGerenciarMembros.php" method="post">
        <input type="hidden" name="idGrupo" value="<?= $idGrupo ?>">

        <h2>Alunos</h2>
        <?php foreach ($alunos as $aluno): ?>
            <div>
                <input type="checkbox" name="alunos[]" value="<?= $aluno['idAluno'] ?>" <?= in_array($aluno['idAluno'], $membrosGrupo) ? 'checked' : '' ?>>
                <label><?= $aluno['nome'] ?></label>
            </div>
        <?php endforeach; ?>

        <h2>Professores</h2>
        <?php foreach ($professores as $professor): ?>
            <div>
                <input type="checkbox" name="professores[]" value="<?= $professor['idProfessor'] ?>" <?= in_array($professor['idProfessor'], $membrosGrupo) ? 'checked' : '' ?>>
                <label><?= $professor['nome'] ?></label>
            </div>
        <?php endforeach; ?>

        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
