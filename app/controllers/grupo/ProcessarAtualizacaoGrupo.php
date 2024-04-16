<?php

require_once '../../../config/conexao.php';
require_once 'GrupoController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $idGrupo = $_POST['idGrupo']; // Certifique-se de que o ID do grupo está sendo enviado corretamente
    $nome = $_POST['nome'];

    $grupoController = new GrupoController($conn);

    // Verifica se o grupo foi encontrado
    $grupoEditado = $grupoController->obterGrupo($idGrupo);


    // Verifica se o nome do grupo já está cadastrado
    $nomeGrupoExistente = $grupoController->verificarNomeGrupoExistente($nome);

    if ($nomeGrupoExistente) {
        header("Location: ../../views/administrador/grupo/GrupoUpdate.php?erro=nome_existente");
        exit;
    } else {
        // Caso o nome do grupo não esteja cadastrado, atualiza o grupo
        $grupoController->atualizarGrupo($idGrupo, $nome);
        echo "Grupo editado com sucesso!";
        echo "<script>setTimeout(function() {
                    window.location.href = '../../views/administrador/grupo/GrupoREAD.php';
                }, 2000);</script>";
    }
}
