<?php
require_once '../../../config/conexao.php';
require_once 'UsuarioController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $usuarioController = new UsuarioController($conn);

    // Verifica se o e-mail já está cadastrado
    $emailExistente = $usuarioController->verificarEmailExistente($email);

    // Verifica se o siape já está cadastrado
    $siapeExistente = $siape !== null && $siape !== "" ? $usuarioController->verificarSiapeExistente($siape) : false;

    // Verifica se a matricula já está cadastrada
    $matriculaExistente = $matricula !== null && $matricula !== "" ? $usuarioController->verificarMatriculaExistente($matricula) : false;

    // Verifica se a matricula já está cadastrada
    $loginExistente = $login !== null && $login !== "" ? $usuarioController->verificarLoginExistente($login) : false;

    // Define uma variável para armazenar o caminho da foto de perfil
    $fotoPerfil = null;

    // Verifica se um arquivo de fotoPerfil foi enviado
    if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {
        // Diretório para salvar as fotos de perfil
        $diretorioDestino = "../../../public/uploads/fotoPerfil/";

        // Obtém informações sobre o arquivo de fotoPerfil
        $nomeArquivo = $_FILES['fotoPerfil']['name'];
        $caminhoTemporario = $_FILES['fotoPerfil']['tmp_name'];
        $extensao = pathinfo($nomeArquivo, PATHINFO_EXTENSION); // Obtém a extensão do arquivo original
        $novoNome = "foto_perfil_" . time() . "." . $extensao; // Define o novo nome com o timestamp e a extensão original

        // Move o arquivo para o diretório de destino
        $caminhoCompleto = $diretorioDestino . $novoNome;
        if (move_uploaded_file($caminhoTemporario, $caminhoCompleto)) {
            // Caso o arquivo tenha sido movido com sucesso, define o caminho da fotoPerfil
            $fotoPerfil = $caminhoCompleto;
        } else {
            echo "Erro ao mover o arquivo de foto de perfil para o diretório de destino.";
            exit; // Encerra o script em caso de erro
        }
    }

    // Verifica se o e-mail já está cadastrado
    if ($emailExistente) {
        header("Location: ../../views/usuario/UsuarioCreate.php?erro=email_existente");
        exit;
    } elseif ($siapeExistente) {
        header("Location: ../../views/usuario/UsuarioCreate.php?erro=siape_existente");
        exit;
    } elseif ($matriculaExistente) {
        header("Location: ../../views/usuario/UsuarioCreate.php?erro=matricula_existente");
        exit;
    } elseif ($loginExistente) {
        header("Location: ../../views/usuario/UsuarioCreate.php?erro=login_existente");
        exit;
    }

    // Caso o e-mail não esteja cadastrado, cadastra o usuário
    $idUsuario = $usuarioController->criarUsuario($nome, $sobrenome, $email, $senha, $fotoPerfil, $tipo, $matricula, $siape, $curso, $periodo, $departamento, $login);

    if ($idUsuario) {
        echo "Usuário cadastrado com sucesso!";
        echo "<script>setTimeout(function() {
            window.location.href = '../../views/usuario/UsuarioREAD.php';
        }, 2000);</script>";
    } else {
        echo "Erro ao cadastrar usuário.";
    }
}
?>
