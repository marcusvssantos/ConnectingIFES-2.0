<?php
require_once '../../../config/conexao.php';
require_once 'UsuarioController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $idUsuario = $_POST['idUsuario']; // Certifique-se de que o ID do usuário está sendo enviado corretamente
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $tipo = $_POST['tipo'];
    $matricula = isset($_POST['matricula']) ? $_POST['matricula'] : null;
    $curso = isset($_POST['curso']) ? $_POST['curso'] : null;
    $periodo = isset($_POST['periodo']) ? $_POST['periodo'] : null;
    $siape = isset($_POST['siape']) ? $_POST['siape'] : null;
    $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : null;
    $login = isset($_POST['login']) ? $_POST['login'] : null;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

    // Verificar se uma nova foto de perfil foi enviada
    // Inicialize $fotoPerfil com o valor da foto de perfil existente
    $usuarioEditado = $usuarioController->obterUsuario($idUsuario);

    $fotoPerfil = $usuarioEditado['fotoPerfil'];

    // Verifique se uma nova foto de perfil foi enviada
    if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {
        $diretorioDestino = $_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/public/uploads/fotoPerfil/';
        $nomeArquivo = $_FILES['fotoPerfil']['name'];
        $extensao = pathinfo($nomeArquivo, PATHINFO_EXTENSION); // Obtém a extensão do arquivo original
        $novoNome = "foto_perfil_" . time() . "." . $extensao; // Define o novo nome com o timestamp e a extensão original

        // Correção: inclui o novo nome do arquivo no caminho de destino
        $caminhoCompleto = $diretorioDestino . $novoNome;

        if (move_uploaded_file($_FILES['fotoPerfil']['tmp_name'], $caminhoCompleto)) {
            $fotoPerfil = $novoNome; // Atualiza $fotoPerfil com o novo nome do arquivo
        } else {
            echo "Erro ao mover o arquivo de foto de perfil para o diretório de destino.";
        }
    }

    $usuarioController = new UsuarioController($conn);

    // Verifica se o usuário foi encontrado
    if ($usuarioEditado) {
        $emailUsuarioEditado = $usuarioEditado['email'];

        // Verifica se o tipo de usuário é aluno antes de acessar a matrícula
        if ($usuarioEditado['tipo'] === 'aluno') {
            $matriculaUsuarioEditado = $usuarioEditado['matricula'];
        }

        // Verifica se o tipo de usuário é professor antes de acessar o siape
        if ($usuarioEditado['tipo'] === 'professor') {
            $siapeUsuarioEditado = $usuarioEditado['siape'];
        }

        if ($usuarioEditado['tipo'] === 'administrador') {
            $loginUsuarioEditado = $usuarioEditado['login'];
        }
    }


    // Verifica se o e-mail já está cadastrado
    $emailExistente = $usuarioController->verificarEmailExistente($email);

    // Verifica se o siape já está cadastrado
    $siapeExistente = $siape !== null && $siape !== "" ? $usuarioController->verificarSiapeExistente($siape) : false;

    // Verifica se a matricula já está cadastrada
    $matriculaExistente = $matricula !== null  && $matricula !== "" ? $usuarioController->verificarMatriculaExistente($matricula) : false;

    $loginExistente = $login !== null  && $login !== "" ? $usuarioController->verificarLoginExistente($login) : false;




    if ($emailExistente &&  $emailUsuarioEditado != $email) {
        header("Location: ../../views/administrador/usuario/UsuarioCreate.php?erro=email_existente");
        exit;
    } elseif ($siapeExistente && $siapeUsuarioEditado != $siape) {
        header("Location: ../../views/administrador/usuario/UsuarioCreate.php?erro=siape_existente");
        exit;
    } elseif ($matriculaExistente && $matriculaUsuarioEditado != $matricula) {
        header("Location: ../../views/administrador/usuario/UsuarioCreate.php?erro=matricula_existente");
        exit;
    } elseif ($loginExistente && $loginUsuarioEditado != $login) {
        header("Location: ../../views/administrador/usuario/UsuarioCreate.php?erro=login_existente");
        exit;
    } else {
        // Caso o e-mail não esteja cadastrado, cadastra o usuário
        $usuarioController->atualizarUsuario($idUsuario, $nome, $sobrenome, $email, $fotoPerfil, $tipo, $matricula, $siape, $curso, $periodo, $departamento, $login, $senha);
        echo "Usuário editado com sucesso!";
        echo "<script>setTimeout(function() {
            window.history.back();
        }, 2000);</script>";
    }
}
