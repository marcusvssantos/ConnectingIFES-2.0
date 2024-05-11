<?php
require_once '../../../config/conexao.php';
require_once 'PublicacaoController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPublicacao = $_POST['editIdPublicacao'];
    $titulo = $_POST['editTitulo'];
    $conteudo = $_POST['editConteudo'];
    $dataPublicacao = date('Y-m-d H:i:s');

    $publicacaoController = new PublicacaoController($conn);

    $pAtual = $publicacaoController->obterPublicacaoPorId($idPublicacao);

    $imagem = $pAtual['imagemPublicacao'];

    if (isset($_FILES['imagemPublicacao']) && $_FILES['imagemPublicacao']['error'] === UPLOAD_ERR_OK) {
        $diretorioDestino = $_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/public/uploads/imagemPublicacao/';
        $nomeArquivo = $_FILES['imagemPublicacao']['name'];
        $extensao = pathinfo($nomeArquivo, PATHINFO_EXTENSION); // Obtém a extensão do arquivo original
        $novoNome = "imagemPublicacao_" . time() . "." . $extensao; // Define o novo nome com o timestamp e a extensão original

        // Correção: inclui o novo nome do arquivo no caminho de destino
        $caminhoCompleto = $diretorioDestino . $novoNome;
        $caminhoImagemAntiga = $diretorioDestino . $imagem;
        if (move_uploaded_file($_FILES['imagemPublicacao']['tmp_name'], $caminhoCompleto)) {
            unlink($caminhoImagemAntiga);
            $imagem = $novoNome;
        } else {
            echo "Erro ao mover o arquivo de imagem para o diretório de destino.";
        }
    }



    $publicacaoController->atualizarPublicacao($idPublicacao, $titulo, $conteudo, $imagem, $dataPublicacao);
    echo "Publicação editada com sucesso!";
    echo "<script>setTimeout(function() {
                window.location.href = 'http://localhost/ConnectingIFES%202.0/app/views/professor/meu_perfil.php';
            }, 2000);</script>";
}
