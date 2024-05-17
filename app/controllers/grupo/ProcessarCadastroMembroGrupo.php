<?php
require_once '../../../config/conexao.php';
require_once 'GrupoController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['idProfessor'])){
        $idProfessor = $_POST['idProfessor'];
        $idGrupo = $_POST['idGrupo'];

        $grupoController = new GrupoController($conn);

        $professorGrupo = $grupoController->adicionarProfessorAoGrupo($idGrupo, $idProfessor);
    }

    if(isset($_POST['idAluno'])){
        $idAluno = $_POST['idAluno'];
        $idGrupo = $_POST['idGrupo'];

        $grupoController = new GrupoController($conn);

        $professorGrupo = $grupoController->adicionarAlunoAoGrupo($idGrupo, $idAluno);
    }
   
}
