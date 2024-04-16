<?php
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/app/controllers/grupo/GrupoController.php');
include("../header.php");

$grupoController = new GrupoController($conn);

// Verifica se o ID do grupo foi passado na URL
if (isset($_GET['idGrupo'])) {
    $idGrupo = $_GET['idGrupo'];

    // Obtém os detalhes do grupo com base no ID
    $grupo = $grupoController->obterGrupo($idGrupo);

    if ($grupo) {
        $nome = $grupo['nome'];
    } else {
        header("Location: erro.php");
        exit();
    }
} else {
    header("Location: erro.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualização de Grupo</title>
</head>

<body>
    <h2 class="text-center mb-4">Atualização de Grupo</h2>

    <div id="aviso" class="alert alert-danger" style="display:none;">
    </div>

    <form action="../../../../app/controllers/grupo/ProcessarAtualizacaoGrupo.php" method="POST" id="atualizacaoForm" class="container">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Grupo:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>" required>
        </div>

        <input type="hidden" id="idGrupo" name="idGrupo" value="<?php echo $idGrupo; ?>">

        <button type="submit" class="btn btn-success">Atualizar</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>