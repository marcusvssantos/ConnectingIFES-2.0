<?php
require_once '../../../config/conexao.php';
require_once 'UsuarioController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_POST['idUsuario'];
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $fotoPerfil = $_POST['fotoPerfil'];
    $tipo = $_POST['tipo'];
    $matricula = isset($_POST['matricula']) ? $_POST['matricula'] : "";
    $siape = isset($_POST['siape']) ? $_POST['siape'] : "";

    $usuarioController = new UsuarioController($conn);

    $usuarioEditado = $usuarioController->obterUsuario($idUsuario);
    $emailUsuarioEditado = $usuarioEditado['email'];
    $siapeUsuarioEditado = $usuarioEditado['siape'];
    $matriculaUsuarioEditado = $usuarioEditado['matricula'];
    
    // Verifica se o e-mail já está cadastrado
    $emailExistente = $usuarioController->verificarEmailExistente($email);
    
    // Verifica se o siape já está cadastrado
    $siapeExistente = $siape !== null && $siape !== "" ? $usuarioController->verificarSiapeExistente($siape) : false;

    // Verifica se a matricula já está cadastrada
    $matriculaExistente = $matricula !== null  && $matricula !== "" ? $usuarioController->verificarMatriculaExistente($matricula) : false;


     
    if ($emailUsuarioEditado != $emailExistente && $emailExistente && $matriculaExistente && $matriculaUsuarioEditado != $matriculaExistente) {
        header("Location: ../../views/usuario/UsuarioCreate.php?erro=email_existente_e_matricula_existente");
        exit;
    }elseif ($emailUsuarioEditado != $emailExistente && $emailExistente && $siapeExistente && $siapeUsuarioEditado != $siapeExistente) {
        header("Location: ../../views/usuario/UsuarioCreate.php?erro=email_existente_e_siape_existente");
        exit;
    }elseif ($emailUsuarioEditado != $emailExistente && $emailExistente) {
        header("Location: ../../views/usuario/UsuarioCreate.php?erro=email_existente");
        exit;
    } elseif ($siapeExistente && $siapeUsuarioEditado != $siapeExistente) {
        header("Location: ../../views/usuario/UsuarioCreate.php?erro=siape_existente");
        exit;
    } elseif ($matriculaExistente && $matriculaUsuarioEditado != $matricula) {
        header("Location: ../../views/usuario/UsuarioCreate.php?erro=matricula_existente");
        exit;
    }else {
        // Caso o e-mail não esteja cadastrado, cadastra o usuário
        $idUsuario = $usuarioController->atualizarUsuario($idUsuario, $nome, $sobrenome, $email, $fotoPerfil, $tipo, $matricula, $siape);
            echo "Usuário editado com sucesso!";
            echo "<script>setTimeout(function() {
                window.location.href = '../../views/usuario/UsuarioREAD.php';
            }, 2000);</script>";
    }
}
