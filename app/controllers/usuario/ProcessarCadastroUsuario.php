<?php
require_once '../../../config/conexao.php';
require_once 'UsuarioController.php';

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $fotoPerfil = $_POST['fotoPerfil'];
    $tipo = $_POST['tipo'];
    $matricula = isset($_POST['matricula']) ? $_POST['matricula'] : null;
    $siape = isset($_POST['siape']) ? $_POST['siape'] : null;

    // Instancia o controlador de usuário
    $usuarioController = new UsuarioController($conn);

    // Chama o método para criar usuário
    $idUsuario = $usuarioController->criarUsuario($nome, $sobrenome, $email, $senha, $fotoPerfil, $tipo, $matricula, $siape);

    // Verifica se o usuário foi criado com sucesso
    if ($idUsuario) {
        echo "Usuário cadastrado com sucesso! ID: $idUsuario";
    } else {
        echo "Erro ao cadastrar usuário.";
    }
}
?>

