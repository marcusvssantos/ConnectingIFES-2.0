<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>

<body>
    <h2>Cadastro de Usuário</h2>
    <form action="../../../app/controllers/usuario/ProcessarCadastroUsuario.php" method="POST" id="cadastroForm">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br>

        <label for="sobrenome">Sobrenome:</label><br>
        <input type="text" id="sobrenome" name="sobrenome" required><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required><br>

        <label for="senha">Senha:</label><br>
        <input type="password" id="senha" name="senha" required><br>

        <label for="fotoPerfil">Foto de Perfil:</label><br>
        <input type="text" id="fotoPerfil" name="fotoPerfil"><br>

        <label for="tipo">Tipo:</label><br>
        <select id="tipo" name="tipo" required onchange="toggleCampos()">
            <option value="admin">Administrador</option>
            <option value="aluno">Aluno</option>
            <option value="professor">Professor</option>
        </select><br>

        <div id="matriculaGroup" style="display:none;">
            <label for="matricula">Matrícula (opcional):</label><br>
            <input type="text" id="matricula" name="matricula"><br>
        </div>

        <div id="siapeGroup" style="display:none;">
            <label for="siape">SIAPE (opcional):</label><br>
            <input type="text" id="siape" name="siape"><br>
        </div>

        <input type="submit" value="Cadastrar">
    </form>

    <script>
        function toggleCampos() {
            var tipoSelecionado = document.getElementById("tipo").value;
            var matriculaGroup = document.getElementById("matriculaGroup");
            var siapeGroup = document.getElementById("siapeGroup");
            var matriculaInput = document.getElementById("matricula");
            var siapeInput = document.getElementById("siape");

            // Ocultar ambos os campos por padrão
            matriculaGroup.style.display = "none";
            siapeGroup.style.display = "none";

            // Remover o atributo required de ambos os campos
            matriculaInput.removeAttribute("required");
            siapeInput.removeAttribute("required");

            // Exibir o campo correspondente com base no tipo selecionado e adicionar o atributo required se necessário
            if (tipoSelecionado === "aluno") {
                matriculaGroup.style.display = "block";
                matriculaInput.setAttribute("required", "required");
            } else if (tipoSelecionado === "professor") {
                siapeGroup.style.display = "block";
                siapeInput.setAttribute("required", "required");
            }
        }
    </script>
</body>

</html>
