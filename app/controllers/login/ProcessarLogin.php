<?php
session_start();

require_once '../../../config/conexao.php';
require_once '../usuario/UsuarioController.php';

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['senha'])) {
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $siape = isset($_POST['siape']) ? $_POST['siape'] : null;
        $matricula = isset($_POST['matricula']) ? $_POST['matricula'] : null;
        $login = isset($_POST['login']) ? $_POST['login'] : null;
        $senha = isset($_POST['senha']) ? $_POST['senha'] : null;
        $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;

        $usuarioController = new UsuarioController($conn);
        switch ($tipo) {
            case 'professor':
                $usuario = $usuarioController->obterProfessorPorSiapeSenha($siape, $senha);
                break;
            case 'aluno':
                // Código para o caso de ser aluno
                break;
            case 'administrador':
                // Código para o caso de ser administrador
                break;
            default:
                // Código para o caso de nenhum dos valores acima
                break;
        }




        if ($usuario) {
            // Inicia a sessão e armazena o ID do usuário
            $_SESSION['idUsuario'] = $usuario['idUsuario'];
            switch ($tipo) {
                case 'professor':
                    $_SESSION['siape'] = $siape;
                    header("Location: http://localhost/ConnectingIFES%202.0/app/views/professor/publicacoes.php");
                    exit();
                    break;
                case 'aluno':
                    // Código para o caso de ser aluno
                    break;
                case 'administrador':
                    // Código para o caso de ser administrador
                    break;
                default:
                    exit();
                    break;
            }
            exit();
        } else {
            $_SESSION['erro'] = "Credenciais inválidas. Por favor, tente novamente.";
            switch ($tipo) {
                case 'professor':
                    header("Location: http://localhost/ConnectingIFES%202.0/app/views/professor/index.php");
                    exit();
                    break;
                case 'aluno':
                    // Código para o caso de ser aluno
                    break;
                case 'administrador':
                    // Código para o caso de ser administrador
                    break;
                default:
                    exit();
                    break;
            }
        }
    } 
}
