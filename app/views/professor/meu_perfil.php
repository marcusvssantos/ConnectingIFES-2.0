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
                echo "<button type='button' data-toggle='modal' data-target='#postModal' class='btn btn-success btn-sm mb-2 editBtn' style='width: 30px; height: 30px; '><i class='bi bi-pencil' style='width: 50%; height: 50%; font-size: 50%; align-self: center;'></i></button>&nbsp";
                echo "<button type='submit' name='delete_publicacao' class='btn btn-danger btn-sm mb-2' style='width: 30px; height: 30px;'><i class='bi bi-trash' style='width: 50%; height: 50%; font-size: 50%; align-self: center;'></i></button>"; // Botão de apagar
                echo "</form>";
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
    <div class="modal fade" id="cadastroModal" tabindex="-1" role="dialog" aria-labelledby="cadastroModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadastroModalLabel">Publicação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../../app/controllers/publicacao/ProcessarCadastroPublicacao.php" enctype="multipart/form-data" method="POST">
                        <div class="form-group">
                            <label for="tituloPost">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Digite o título da postagem">
                        </div>
                        <div class="form-group">
                            <label for="conteudoPost">Conteúdo</label>
                            <textarea class="form-control" id="conteudo" name="conteudo" rows="4" placeholder="Digite o conteúdo da postagem"></textarea>
                        </div>

                        <?php echo '<input type="hidden" id="professor_id" name="professor_id" value="' . $usuario['idProfessor'] . '">'; ?>
                        <div class="form-group">
                            <label for="imagemPost" class="col-form-label">Imagem</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imagem" name="imagem">
                                <label class="custom-file-label" for="imagemPost">Escolher arquivo</label>
                            </div>
                        </div>
                        <label>Selecione os grupos em que deseja Publicar:</label><br>
                        <?php
                        foreach ($gruposProfessor as $grupo) {
                            echo '<div class="form-check">';
                            echo '<input class="form-check-input" type="checkbox" id="grupo_' . $grupo['idGrupo'] . '" name="grupos[]" value="' . $grupo['idGrupo'] . '">';
                            echo '<label class="form-check-label" for="grupo_' . $grupo['idGrupo'] . '">' . $grupo['nome'] . '</label>';
                            echo '</div>';
                        }
                        ?>
                        <button type="submit" name='post_publicacao' class="btn btn-primary">Publicar</button>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src=" https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>