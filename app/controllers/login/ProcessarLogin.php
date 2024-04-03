<?php
session_start();

require_once '../../../config/conexao.php';
require_once '../usuario/UsuarioController.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os campos foram preenchidos
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Verifica se as credenciais estão corretas
        $usuarioController = new UsuarioController($conn);
        $usuario = $usuarioController->obterUsuarioPorEmailSenha($email, $senha);

        if ($usuario) {
            // Inicia a sessão e armazena o ID do usuário
            $_SESSION['idUsuario'] = $usuario['idUsuario'];
            // Redireciona para a página após o login bem-sucedido
            header("Location: ../../views/usuario/UsuarioREAD.php");
            exit();
        } else {
            $_SESSION['erro'] = "Credenciais inválidas. Por favor, tente novamente.";
            header("Location: ../../index.php");
            exit();
        }
    } else {
        $_SESSION['erro'] = "Por favor, preencha todos os campos.";
        header("Location: ../../index.php");
        exit();
    }
}
?>
