<?php
include("header.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>

<body onload="toggleCampos()">

    <h2 class="text-center mb-4">Cadastro de Usuário</h2>

    <div id="aviso" class="alert alert-danger" style="display:none;">
    </div>

    <form action="../../../../app/controllers/usuario/ProcessarCadastroUsuario.php" method="POST" id="cadastroForm" enctype="multipart/form-data" class="container">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="mb-3">
            <label for="sobrenome" class="form-label">Sobrenome:</label>
            <input type="text" class="form-control" id="sobrenome" name="sobrenome" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>

        <div class="mb-3">
            <label for="fotoPerfil" class="form-label">Foto de Perfil:</label>
            <input type="file" class="form-control" id="fotoPerfil" name="fotoPerfil">
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo:</label>
            <select class="form-select" id="tipo" name="tipo" required onchange="toggleCampos()">
                <option value="administrador">Administrador</option>
                <option value="aluno">Aluno</option>
                <option value="professor">Professor</option>
            </select>
        </div>

        <div id="matriculaGroup" class="mb-3" style="display:none;">
            <label for="matricula" class="form-label">Matrícula:</label>
            <input type="text" class="form-control" id="matricula" name="matricula">
            <label for="curso" class="form-label">Curso:</label>
            <input type="text" class="form-control" id="curso" name="curso">
            <label for="periodo" class="form-label">Período:</label>
            <input type="text" class="form-control" id="periodo" name="periodo">
        </div>

        <div id="siapeGroup" class="mb-3" style="display:none;">
            <label for="siape" class="form-label">SIAPE:</label>
            <input type="text" class="form-control" id="siape" name="siape">
            <label for="departamento" class="form-label">Departamento:</label>
            <input type="text" class="form-control" id="departamento" name="departamento">
        </div>

        <div id="loginGroup" class="mb-3" style="display:none;">
            <label for="login" class="form-label">Login:</label>
            <input type="text" class="form-control" id="login" name="login">
        </div>

        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>

    <script>
        function toggleCampos() {
            var tipoSelecionado = document.getElementById("tipo").value;
            var matriculaGroup = document.getElementById("matriculaGroup");
            var siapeGroup = document.getElementById("siapeGroup");
            var loginGroup = document.getElementById("loginGroup");
            var matriculaInput = document.getElementById("matricula");
            var cursoInput = document.getElementById("curso");
            var periodoInput = document.getElementById("periodo");
            var siapeInput = document.getElementById("siape");
            var departamentoInput = document.getElementById("departamento");
            var loginInput = document.getElementById("login");

            // Ocultar todos os grupos de campos por padrão
            matriculaGroup.style.display = "none";
            siapeGroup.style.display = "none";
            loginGroup.style.display = "none";

            // Remover o atributo required de todos os campos
            matriculaInput.removeAttribute("required");
            cursoInput.removeAttribute("required");
            periodoInput.removeAttribute("required");
            siapeInput.removeAttribute("required");
            departamentoInput.removeAttribute("required");
            loginInput.removeAttribute("required");

            // Exibir o grupo de campos correspondente com base no tipo selecionado e adicionar o atributo required se necessário
            if (tipoSelecionado === "aluno") {
                matriculaGroup.style.display = "block";
                cursoInput.style.display = "block";
                periodoInput.style.display = "block";
                matriculaInput.setAttribute("required", "required");
                cursoInput.setAttribute("required", "required");
                periodoInput.setAttribute("required", "required");
            } else if (tipoSelecionado === "professor") {
                siapeGroup.style.display = "block";
                departamentoInput.style.display = "block";
                siapeInput.setAttribute("required", "required");
                departamentoInput.setAttribute("required", "required");
            } else if (tipoSelecionado === "administrador") {
                loginGroup.style.display = "block";
                loginInput.setAttribute("required", "required");
            }
        }


        if ('<?php echo isset($_GET["erro"]) ? $_GET["erro"] : "" ?>' === "email_existente") {
            document.getElementById("aviso").innerText = "E-mail já Cadastrado!.";
            var aviso = document.getElementById("aviso");
            aviso.style.display = "block";
        }
        if ('<?php echo isset($_GET["erro"]) ? $_GET["erro"] : "" ?>' === "siape_existente") {
            document.getElementById("aviso").innerText = "Siape já Cadastrado!.";
            var aviso = document.getElementById("aviso");
            aviso.style.display = "block";
        }
        if ('<?php echo isset($_GET["erro"]) ? $_GET["erro"] : "" ?>' === "matricula_existente") {
            document.getElementById("aviso").innerText = "Matricula já Cadastrada!.";
            var aviso = document.getElementById("aviso");
            aviso.style.display = "block";
        }
        if ('<?php echo isset($_GET["erro"]) ? $_GET["erro"] : "" ?>' === "login_existente") {
            document.getElementById("aviso").innerText = "Login já Cadastrada!.";
            var aviso = document.getElementById("aviso");
            aviso.style.display = "block";
        }
    </script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</html>