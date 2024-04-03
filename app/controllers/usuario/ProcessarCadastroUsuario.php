<?php
require_once '../../../config/conexao.php';
require_once 'UsuarioController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $fotoPerfil = $_POST['fotoPerfil'];
    $tipo = $_POST['tipo'];
    $matricula = $_POST['matricula'];
    $siape = $_POST['siape'];

    $usuarioController = new UsuarioController($conn);

    // Verifica se o e-mail já está cadastrado
    $emailExistente = $usuarioController->verificarEmailExistente($email);
    
    // Verifica se o siape já está cadastrado
    $siapeExistente = $siape !== null && $siape !== "" ? $usuarioController->verificarSiapeExistente($siape) : false;

    // Verifica se a matricula já está cadastrada
    $matriculaExistente = $matricula !== null  && $matricula !== "" ? $usuarioController->verificarMatriculaExistente($matricula) : false;


     
    if ($emailExistente && $matriculaExistente) {
        header("Location: ../../views/usuario/UsuarioCreate.php?erro=email_existente_e_matricula_existente");
        exit;
    }elseif ($emailExistente && $siapeExistente) {
        header("Location: ../../views/usuario/UsuarioCreate.php?erro=email_existente_e_siape_existente");
        exit;
    }elseif ($emailExistente) {
        header("Location: ../../views/usuario/UsuarioCreate.php?erro=email_existente");
        exit;
    } elseif ($siapeExistente) {
        header("Location: ../../views/usuario/UsuarioCreate.php?erro=siape_existente");
        exit;
    } elseif ($matriculaExistente) {
        header("Location: ../../views/usuario/UsuarioCreate.php?erro=matricula_existente");
        exit;
    }else {
        // Caso o e-mail não esteja cadastrado, cadastra o usuário
        $idUsuario = $usuarioController->criarUsuario($nome, $sobrenome, $email, $senha, $fotoPerfil, $tipo, $matricula, $siape);

        if ($idUsuario) {
            echo "Usuário cadastrado com sucesso!";
            echo "<script>setTimeout(function() {
                window.location.href = '../../views/usuario/UsuarioREAD.php';
            }, 2000);</script>";
        } else {
            echo "Erro ao cadastrar usuário.";
        }
    }
}
