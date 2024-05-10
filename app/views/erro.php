<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div id="aviso" class="alert alert-danger" style="text-align: center;">
    </div>
</body>

</html>

<script>
    if ('<?php echo isset($_GET["erro"]) ? $_GET["erro"] : "" ?>' === "nao_logado") {
        document.getElementById("aviso").innerText = "Você não está logado!.";
        var aviso = document.getElementById("aviso");
        aviso.style.display = "block";
        setTimeout(function() {
            window.location.href = 'http://localhost/ConnectingIFES%202.0/app/index.php';
        }, 4000);
    }
</script>