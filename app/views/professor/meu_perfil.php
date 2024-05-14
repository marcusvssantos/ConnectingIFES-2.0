<?php
include("header.php");
$publicacoes = $publicacaoController->obterPublicacoesPorProfessor($usuario['idProfessor']);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="img\Logo ConnectingIFES.png">
</head>


<body>

    <div class="main-content">
        <div class="container mt-5">
            <h2 class="mb-4" style="color: #32A041;">Publicações</h2>

            <?php

            foreach ($publicacoes as $publicacao) {
                echo "<div class='card publicacao-card'>";
                echo "<div class='publicacao-card-header'>";
                $fotoPerfil = '../../../public/uploads/fotoPerfil/' . $publicacao['fotoPerfil'];
                echo "<img class='nav-icon' src=' " . $fotoPerfil . "'> ";
                echo "<h5>" . $publicacao['nome'] . " " . $publicacao['sobrenome'] . "</h5>";
                echo "<span class='text-muted ml-auto'>" . "Postagem feita dia: " . date("d/m/Y", strtotime($publicacao['dataPublicacao'])) . "</span>";
                echo "<span class='text-muted ml-auto'>" . "&nbsp às " . date("H:i", strtotime($publicacao['dataPublicacao'])) .  "</span>&nbsp&nbsp";
                echo "<form method='POST' action=''>";
                echo "<input type='hidden' name='idPublicacao' value='" . $publicacao['idPublicacao'] . "'>";
                echo "<button type='button' data-toggle='modal' data-target='#editModal'  
                    data-idpublicacao='" . $publicacao['idPublicacao'] . "' 
                    data-titulo='" . $publicacao['titulo'] . "' 
                    data-conteudo='" . $publicacao['conteudo'] . "' 
                    class='btn btn-success btn-sm mb-2 editBtn' style='width: 30px; height: 30px;'>
                        <i class='bi bi-pencil' style='width: 50%; height: 50%; font-size: 50%; align-self: center;'></i>
                    </button>&nbsp";
                echo "</form>";
            ?>

                <form class="delete-publicacao-form" method="POST" action="../../../app/controllers/publicacao/ProcessarRemoverPublicacao.php">
                    <input type="hidden" name="idPublicacao" value="<?php echo $publicacao['idPublicacao']; ?>">
                    <button type="submit" class="btn btn-danger btn-sm mb-2 deleteBtn" style="width: 30px; height: 30px;">
                        <i class="bi bi-trash" style="width: 50%; height: 50%; font-size: 50%; align-self: center;"></i>
                    </button>
                </form>
            <?php
                echo "</div>";
                echo "<div class='publicacao-card-content'>";
                echo "<h3 style='text-align:center;'> " . $publicacao['titulo'] . "</h3>";
                if (!empty($publicacao['imagemPublicacao'])) {
                    $imagemPublicacao = '../../../public/uploads/imagemPublicacao/' . $publicacao['imagemPublicacao'];
                    echo "<img src='" . $imagemPublicacao . "' >";
                }
                echo "</div>";
                echo "<div class='card-body publicacao-card-description'>";
                echo "<p>" . $publicacao['conteudo'] . "</p>";
                echo "</div>";
                echo "</div>";
            }


            ?>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Publicação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editPostForm" enctype="multipart/form-data" method="POST">
                        <div class="form-group">
                            <label for="tituloPost">Título</label>
                            <input type="text" class="form-control" id="editTitulo" name="editTitulo" placeholder="Digite o título da postagem">
                        </div>
                        <div class="form-group">
                            <label for="conteudoPost">Conteúdo</label>
                            <textarea class="form-control" id="editConteudo" name="editConteudo" rows="4" placeholder="Digite o conteúdo da postagem"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="imagemPost" class="col-form-label">Imagem</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imagemPublicacao" name="imagemPublicacao">
                                <label class="custom-file-label" for="imagemPost">Escolher arquivo</label>
                            </div>
                        </div>
                        <input type="hidden" name="editIdPublicacao" id="editIdPublicacao">
                        <button type="submit" name="post_publicacao" class="btn btn-primary">Publicar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editPostForm').on('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: '../../../app/controllers/publicacao/ProcessarAtualizacaoPublicacao.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Processar a resposta e atualizar a interface do usuário
                        window.location.href = 'meu_perfil.php';
                        alert('Publicação atualizada com sucesso!');
                        $('#editModal').modal('hide');
                        // Aqui você pode atualizar a publicação na página sem recarregar
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Erro na requisição AJAX: ' + textStatus, errorThrown);
                    }
                });
            });

            // Para popular o modal com os dados da publicação quando ele for aberto
            $('#editModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var idPublicacao = button.data('id'); // Extraia a informação de `data-id` do botão que abriu o modal

                // Aqui você faria uma requisição AJAX para obter os dados da publicação e preencher os campos do formulário
                $.ajax({
                    url: '../../../app/controllers/publicacao/ObterDadosPublicacao.php',
                    type: 'GET',
                    data: {
                        idPublicacao: idPublicacao
                    },
                    success: function(data) {
                        $('#editTitulo').val(data.titulo);
                        $('#editConteudo').val(data.conteudo);
                        $('#editIdPublicacao').val(data.idPublicacao);
                        // Se tiver uma imagem, você pode exibir um preview dela ou alguma indicação
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Erro ao obter os dados da publicação: ' + textStatus, errorThrown);
                    }
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var editButtons = document.querySelectorAll('.editBtn');
            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var idPublicacao = this.getAttribute('data-idpublicacao');
                    var titulo = this.getAttribute('data-titulo');
                    var conteudo = this.getAttribute('data-conteudo');

                    document.getElementById('editIdPublicacao').value = idPublicacao;
                    document.getElementById('editTitulo').value = titulo;
                    document.getElementById('editConteudo').value = conteudo;
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>