<?php
include("header.php");
$publicacoes = $publicacaoController->obterPublicacoesAlunoGrupo($usuario['idAluno']);
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

    <div class="container vh-100 d-flex flex-column">
        <div class="row">
            <div class="col-10">
                <h2 class="mb-4 col-12" style="color: #32A041;">Publicações</h2>

                <?php

                foreach ($publicacoes as $publicacao) {
                    echo "<div class='card publicacao-card'>";
                    echo "<div class='publicacao-card-header'>";
                    $fotoPerfil = '../../../public/uploads/fotoPerfil/' . $publicacao['fotoPerfil'];
                    echo "<img class='nav-icon' src=' " . $fotoPerfil . "'> ";
                    echo "<h5><a href='perfil_professor.php?id=" . $publicacao['idProfessor'] . "' style='text-decoration: none; color: #32A041;'>" . $publicacao['nome'] . " " . $publicacao['sobrenome'] . "</a></h5>";
                    echo "<span class='text-muted ml-auto'>" . "Postagem feita dia: " . date("d/m/Y", strtotime($publicacao['dataPublicacao'])) . "</span>";
                    echo "<span class='text-muted ml-auto'>" . "&nbsp às " . date("H:i", strtotime($publicacao['dataPublicacao'])) .  "</span>";

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

            <div class="direita col-2">
                <div class="direita col-12">
                    <div class="card seguir-card row">
                        <div>
                            <h2 class="mb-4">Sugestões para você</h2>
                        </div>
                        <div class="user-card">
                            <?php
                            foreach ($grupos as $grupo) {
                                $professorNoGrupo = false;

                                foreach ($gruposAluno as $gp) {
                                    if ($gp['idGrupo'] == $grupo['idGrupo']) {
                                        $professorNoGrupo = true;
                                        break;
                                    }
                                }
                                if (!$professorNoGrupo) {
                                    echo "<div id='grupo-{$grupo['idGrupo']}'>
                                        <form class='form-grupo'>
                                            <br>
                                            <input type='hidden' name='idAluno' value='{$usuario['idAluno']}'>
                                            <input type='hidden' name='idGrupo' value='{$grupo['idGrupo']}'>
                                            <div>{$grupo['nome']} - <button type='button' class='btn btn-primary' data-action='adicionar'>Seguir</button></div>
                                        </form>
                                    </div>";
                                } else {
                                    echo "<div id='grupo-{$grupo['idGrupo']}'>
                                        <form class='form-grupo'>
                                            <br>
                                            <input type='hidden' name='idAluno' value='{$usuario['idAluno']}'>
                                            <input type='hidden' name='idGrupo' value='{$grupo['idGrupo']}'>
                                            <div>{$grupo['nome']} - <button type='button' class='btn btn-danger' data-action='remover'>Deixar de Seguir</button></div>
                                        </form>
                                    </div>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="direita col-12">
                 <br>
                 <div class="card seguir-card" >
                        <h3>Principais Notícias IFES</h3>
                        <br>
                        <?php
                        $xml = simplexml_load_file("https://www.ifes.edu.br/noticias?format=feed&type=rss");

                        if ($xml === false) {
                            echo "Erro ao carregar o arquivo XML";
                        } else {
                            foreach ($xml->channel->item as $item) {
                                $titulo = (string) $item->title;
                                $link = (string) $item->link;
                                $descricao = (string) $item->description;
                                $data = date("d/m/Y", strtotime((string) $item->pubDate));
                                
                                echo '<div class="card mb-3">';
                                echo '<div class="card-body">';
                                echo "<h5 class='card-title'>$titulo</h5>";
                                echo "<p class='card-text'>$descricao</p>";
                                echo "<a href='$link' class='card-link' target='_blank'>Leia mais</a>";
                                echo '</div>';
                                echo '<div class="card-footer">';
                                echo "<small class='text-muted'>Data: $data</small>";
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                </div>


            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.user-card').on('click', '.btn', function() {
                var action = $(this).data('action');
                var form = $(this).closest('.form-grupo');
                var idAluno = form.find('input[name="idAluno"]').val();
                var idGrupo = form.find('input[name="idGrupo"]').val();

                $.ajax({
                    url: action === 'adicionar' ? '../../../app/controllers/grupo/ProcessarCadastroMembroGrupo.php' : '../../../app/controllers/grupo/ProcessarRemoverMembroGrupo.php',
                    type: 'POST',
                    data: {
                        idAluno: idAluno,
                        idGrupo: idGrupo
                    },
                    success: function(response) {
                        // Atualize o conteúdo da div conforme necessário após a resposta
                        if (action === 'adicionar') {
                            form.find('.btn').removeClass('btn-primary').addClass('btn-danger').data('action', 'remover').text('Deixar de Seguir');
                        } else {
                            form.find('.btn').removeClass('btn-danger').addClass('btn-primary').data('action', 'adicionar').text('Seguir');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Erro na requisição AJAX: ' + textStatus, errorThrown);
                    }
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>