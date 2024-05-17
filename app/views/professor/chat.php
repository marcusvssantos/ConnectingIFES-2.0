<?php
include("header.php");
$usuarioAtual = $usuario['idUsuario'];
$todosAlunos = $usuarioController->obterAlunos();
$todosProfessores = $usuarioController->obterProfessores();

function displayUsers($users, $type, $usuarioAtualId)
{
    echo "<h2>$type</h2>";
    echo "<ul>";
    foreach ($users as $user) {
        if ($user['idUsuario'] != $usuarioAtualId) { // Verifica se não é o usuário atual
            echo "<li>";
            echo "<span>{$user['nome']} {$user['sobrenome']}</span> ";
            echo "<button class='start-chat' data-id='{$user['idUsuario']}'>Iniciar Conversa</button>";
            echo "</li>";
        }
    }
    echo "</ul>";
}

?>

<div class="container">
    <h1>Iniciar Conversa</h1>
    <?php
    if (!empty($todosAlunos) || !empty($todosProfessores)) {
        displayUsers($todosAlunos, "Alunos", $usuarioAtual);
        displayUsers($todosProfessores, "Professores", $usuarioAtual);
    } else {
        echo "<p>Nenhum usuário disponível para iniciar uma conversa.</p>";
    }
    ?>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.start-chat').click(function() {
            var usuarioSelecionado = $(this).data('id');
            $.ajax({
                url: '../../../app/controllers/chat/ProcessarConversa.php',
                type: 'POST',
                dataType: 'json', // Definindo o tipo de dados esperado
                data: {
                    usuarioAtual: <?php echo $usuarioAtual; ?>,
                    usuarioSelecionado: usuarioSelecionado
                },
                success: function(response) {
                    console.log(response); // Verificar o conteúdo da resposta
                    if (response.success) {
                        window.location.href = 'conversa.php?idConversa=' + response.idConversa;
                    } else {
                        alert("Erro ao iniciar a conversa.");
                    }
                },
                error: function() {
                    alert('Erro ao iniciar a conversa. Por favor, tente novamente.');
                }
            });

        });
    });
</script>