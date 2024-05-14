<?php
require_once '../../../config/conexao.php';
require_once '../../../app/controllers/publicacao/PublicacaoController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $conteudo = $_POST['conteudo'];
    $imagemPublicacao = null;
    $dataPublicacao = date('Y-m-d H:i:s'); // Pode ser ajustado conforme necessário
    $professor_id = $_POST['professor_id']; // Supondo que você tenha uma sessão iniciada com o ID do professor
    $grupos = isset($_POST['grupos'])? $_POST['grupos'] : [];

    $publicacaoController = new PublicacaoController($conn);

    // Verifica se a imagem foi enviada
    if (isset($_FILES['imagem'])) {
        $diretorioDestino = $_SERVER['DOCUMENT_ROOT']. '/ConnectingIFES 2.0/public/uploads/imagemPublicacao/';
        $nomeArquivo = $_FILES['imagem']['name'];
        $extensao = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
        $novoNome = "publicacao_". time(). ".". $extensao;

        $caminhoCompleto = $diretorioDestino. $novoNome;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoCompleto)) {
            $imagemPublicacao = $novoNome;
        }
    }

    // Cria a publicação
    $publicacao_id = $publicacaoController->criarPublicacao($titulo, $conteudo, $imagemPublicacao, $dataPublicacao, $professor_id, $grupos);

    if ($publicacao_id) {
        echo "Publicação criada com sucesso!";
        echo "<script>setTimeout(function() {
            window.location.href = '../../views/professor/connectingIFES.php';
        }, 2000);</script>";
    } else {
        echo "Erro ao criar publicação.";
    }
}
?>
