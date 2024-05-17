<?php
require_once '../../../config/conexao.php';
require_once 'ConversaController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuarioAtual = $_POST['usuarioAtual'];
    $usuarioSelecionado = $_POST['usuarioSelecionado'];

    $conversaController = new ConversaController($conn);

    // Verifica se já existe uma conversa entre os dois usuários
    $conversas = $conversaController->obterConversasPorUsuario($usuarioAtual);
    $conversaExistente = null;

    foreach ($conversas as $conversa) {
        if (($conversa['usuario1_id'] == $usuarioAtual && $conversa['usuario2_id'] == $usuarioSelecionado) || 
            ($conversa['usuario1_id'] == $usuarioSelecionado && $conversa['usuario2_id'] == $usuarioAtual)) {
            $conversaExistente = $conversa;
            break;
        }
    }

    if ($conversaExistente) {
        echo json_encode([
            'success' => true,
            'idConversa' => $conversaExistente['idConversa']
        ]);
    } else {
        // Cria uma nova conversa
        $idConversa = $conversaController->criarConversa($usuarioAtual, $usuarioSelecionado);
        echo json_encode([
            'success' => true,
            'idConversa' => $idConversa
        ]);
    }
}
?>
