<?php
require_once '../../../config/conexao.php';
require_once 'GrupoController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];

    $grupoController = new GrupoController($conn);

    // Verifica se o nome do grupo já está cadastrado
    $nomeExistente = $grupoController->verificarNomeGrupoExistente($nome);

    if ($nomeExistente) {
        header("Location: ../../views/administrador/grupo/GrupoCreate.php?erro=nome_existente");
        exit;
    }

    // Caso o nome do grupo não esteja cadastrado, cadastra o grupo
    $idGrupo = $grupoController->criarGrupo($nome);

    if ($idGrupo) {
        echo "Grupo cadastrado com sucesso!";
        echo "<script>setTimeout(function() {
            window.location.href = '../../views/administrador/grupo/GrupoREAD.php';
        }, 2000);</script>";
    } else {
        echo "Erro ao cadastrar grupo.";
    }
}
?>