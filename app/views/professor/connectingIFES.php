<?php
include("header.php");
$publicacoes = $publicacaoController->obterPublicacoesProfessorGrupo($usuario['idProfessor']);
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
                if ($siape === $publicacao['siape']) {
                    echo "<h5><a href='meu_perfil.php' style='text-decoration: none; color: #32A041;'>" . $publicacao['nome'] . " " . $publicacao['sobrenome'] . "</a></h5>";
                } else {
                    echo "<h5><a href='perfil_professor.php?id=" . $publicacao['idProfessor'] . "' style='text-decoration: none; color: #32A041;'>" . $publicacao['nome'] . " " . $publicacao['sobrenome'] . "</a></h5>";
                }
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
    </div>

    <script src=" https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>