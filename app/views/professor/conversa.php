<?php
include("header.php");
require 'C:\wamp64\www\ConnectingIFES 2.0\app\controllers\chat\ConversaController.php';

$conversaController = new ConversaController($conn);
$mensagemController = new ConversaController($conn);

$idConversa = $_GET['idConversa'];
$conversa = $conversaController->obterConversaPorId($idConversa);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['obter_mensagens'])) {
        $mensagens = $mensagemController->obterMensagensPorConversa($idConversa);
        foreach ($mensagens as $mensagem) {
            echo "<div class='mensagem'>";
            echo "<span><strong>" . ($mensagem['remetente_id'] == $_SESSION['idUsuario'] ? 'Você' : 'Outro') . ":</strong> {$mensagem['conteudo']}</span>";
            echo "</div>";
        }
        exit;
    } elseif (isset($_POST['enviar_mensagem'])) {
        $conteudo = $_POST['conteudo'];
        $remetente_id = $_SESSION['idUsuario'];
        $mensagemController->criarMensagem($idConversa, $remetente_id, $conteudo);
        echo json_encode(['success' => true]);
        exit;
    }
}
?>

<div class="container">
    <h1>Conversa</h1>
    <div class="mensagens" id="mensagens">
        <!-- Mensagens serão carregadas aqui via AJAX -->
    </div>
    <form id="form-mensagem">
        <textarea name="conteudo" id="conteudo" required></textarea>
        <button type="submit">Enviar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function carregarMensagens() {
    $.ajax({
        url: 'conversa.php?idConversa=<?php echo $idConversa; ?>',
        type: 'POST',
        data: { obter_mensagens: true },
        success: function(response) {
            $('#mensagens').html(response);
        }
    });
}

$(document).ready(function() {
    // Carregar mensagens a cada 2 segundos
    setInterval(carregarMensagens, 2000);

    // Enviar nova mensagem via AJAX
    $('#form-mensagem').submit(function(event) {
        event.preventDefault();
        var conteudo = $('#conteudo').val();
        $.ajax({
            url: 'conversa.php?idConversa=<?php echo $idConversa; ?>',
            type: 'POST',
            data: {
                enviar_mensagem: true,
                conteudo: conteudo
            },
            success: function(response) {
                $('#conteudo').val('');  // Limpar o campo de texto
                carregarMensagens();    // Atualizar as mensagens
            }
        });
    });
});
</script>
