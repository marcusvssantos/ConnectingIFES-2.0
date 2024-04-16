<?php
include("../header.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Grupo</title>
</head>

<body>

    <h2 class="text-center mb-4">Cadastro de Grupo</h2>

    <div id="aviso" class="alert alert-danger" style="display:none;">
    </div>

    <form action="../../../../app/controllers/grupo/ProcessarCadastroGrupo.php" method="POST" id="cadastroForm" class="container">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Grupo:</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>

    <script>
        if ('<?php echo isset($_GET["erro"]) ? $_GET["erro"] : "" ?>' === "nome_existente") {
            document.getElementById("aviso").innerText = "Nome do Grupo já Cadastrado!.";
            var aviso = document.getElementById("aviso");
            aviso.style.display = "block";
        }
    </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</html>