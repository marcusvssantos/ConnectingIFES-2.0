<?php
require_once '../../../config/conexao.php';
require_once 'PublicacaoController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPublicacao = $_POST['idPublicacao'];

    $publicacaoController = new PublicacaoController($conn);

    $publicacaoController->deletarPublicacao($idPublicacao); 
      
    echo "<script>setTimeout(function() {
                window.location.href = 'http://localhost/ConnectingIFES%202.0/app/views/professor/meu_perfil.php';
            }, 1);</script>";
        
}
?>
