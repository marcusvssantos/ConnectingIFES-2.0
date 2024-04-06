<?php
require_once '../../../config/conexao.php';
require_once 'UsuarioController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $idUsuario = $_POST['idUsuario']; // Certifique-se de que o ID do usuário está sendo enviado corretamente
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo'];
    $matricula = isset($_POST['matricula']) ? $_POST['matricula'] : null;
    $curso = isset($_POST['curso']) ? $_POST['curso'] : null;
    $periodo = isset($_POST['periodo']) ? $_POST['periodo'] : null;
    $siape = isset($_POST['siape']) ? $_POST['siape'] : null;
    $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : null;
    $login = isset($_POST['login']) ? $_POST['login'] : null;

    // Verificar se uma nova foto de perfil foi enviada
    $fotoPerfilAtualizada = null;
    if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {
        $diretorioDestino = "../../../public/uploads/fotoPerfil/";
        $nomeArquivo = $_FILES['fotoPerfil']['name'];
        $caminhoTemporario = $_FILES['fotoPerfil']['tmp_name'];
        $extensao = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
        $novoNome = "foto_perfil_" . time() . "." . $extensao;
        $caminhoCompleto = $diretorioDestino . $novoNome;
        if (move_uploaded_file($caminhoTemporario, $caminhoCompleto)) {
            $fotoPerfilAtualizada = $caminhoCompleto;
        } else {
            echo "Erro ao mover o arquivo de foto de perfil para o diretório de destino.";
            exit;
        }
    }

    $usuarioController = new UsuarioController($conn);


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
        $usuarioController->atualizarUsuario($idUsuario, $nome, $sobrenome, $email, $fotoPerfilAtualizada, $tipo, $matricula, $siape, $curso, $periodo, $departamento, $login);
        echo "Usuário editado com sucesso!";
            echo "<script>setTimeout(function() {
                window.location.href = '../../views/usuario/UsuarioREAD.php';
            }, 2000);</script>";
    }
}
?>