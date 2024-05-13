<?php
require_once '../../../config/conexao.php';
require_once 'GrupoController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idGrupo = $_POST['idGrupo'];
    $alunosSelecionados = isset($_POST['alunos']) ? $_POST['alunos'] : [];
    $professoresSelecionados = isset($_POST['professores']) ? $_POST['professores'] : [];

    $grupoController = new GrupoController($conn);
    

    // Atualizar alunos do grupo
    $grupoController->atualizarMembrosGrupo($idGrupo, $alunosSelecionados, 'aluno');

    // Atualizar professores do grupo
    $grupoController->atualizarMembrosGrupo($idGrupo, $professoresSelecionados, 'professor');

    header("Location: ../../views/administrador/grupo/GrupoGerenciarMembros.php?idGrupo=$idGrupo");
    exit();
}
