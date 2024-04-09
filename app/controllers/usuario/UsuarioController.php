<?php
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/config/conexao.php');
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/app/models/UsuarioModel.php');


$usuarioController = new UsuarioController($conn);

class UsuarioController {
    private $usuarioModel;

    public function __construct($conn) {
        $this->usuarioModel = new UsuarioModel($conn);
    }

    public function criarUsuario($nome, $sobrenome, $email, $senha, $fotoPerfil, $tipo, $matricula = null, $siape = null, $curso = null, $departamento = null, $login = null) {
        return $this->usuarioModel->criarUsuario($nome, $sobrenome, $email, $senha, $fotoPerfil, $tipo, $matricula, $siape, $curso, $departamento, $login);
    }

    public function obterUsuario($idUsuario) {
        return $this->usuarioModel->obterUsuario($idUsuario);
    }
    
    public function atualizarUsuario($idUsuario, $nome, $sobrenome, $email, $fotoPerfil, $tipo, $matricula = null, $siape = null, $curso = null, $periodo, $departamento = null, $login = null) {
        $this->usuarioModel->atualizarUsuario($idUsuario, $nome, $sobrenome, $email, $fotoPerfil, $tipo, $matricula, $siape, $curso, $periodo , $departamento, $login);
    }

    public function deletarUsuario($idUsuario) {
        $this->usuarioModel->deletarUsuario($idUsuario);
    }

    public function verificarEmailExistente($email) {
        return $this->usuarioModel->verificarEmailExistente($email);
    }

    public function verificarSiapeExistente($siape) {
        return $this->usuarioModel->verificarSiapeExistente($siape);
    }
    
    public function verificarMatriculaExistente($matricula) {
        return $this->usuarioModel->verificarMatriculaExistente($matricula);
    }

    public function verificarLoginExistente($login){
        return $this->usuarioModel->verificarLoginExistente($login);
    }

    public function obterUsuarioPorEmailSenha($email, $senha) {
        return $this->usuarioModel->obterUsuarioPorEmailSenha($email, $senha);
    }

    public function obterAlunos() {
        return $this->usuarioModel->obterAlunos();
    }

    public function obterProfessores() {
        return $this->usuarioModel->obterProfessores();
    }

    public function obterAdministradores() {
        return $this->usuarioModel->obterAdministradores();
    }
}
?>
