<?php
require_once '../../../config/conexao.php';
require_once '../../models/UsuarioModel.php';

$usuarioController = new UsuarioController($conn);

class UsuarioController {
    private $usuarioModel;

    public function __construct($conn) {
        $this->usuarioModel = new UsuarioModel($conn);
    }

    public function criarUsuario($nome, $sobrenome, $email, $senha, $fotoPerfil, $tipo, $matricula, $siape) {
        return $this->usuarioModel->criarUsuario($nome, $sobrenome, $email, $senha, $fotoPerfil, $tipo, $matricula, $siape);
    }

    public function obterUsuario($idUsuario) {
        return $this->usuarioModel->obterUsuario($idUsuario);
    }
    
    public function obterUsuariosPorTipo($tipo) {
        return $this->usuarioModel->obterUsuariosPorTipo($tipo);
    }

    public function atualizarUsuario($idUsuario, $nome, $sobrenome, $email, $fotoPerfil, $tipo, $matricula, $siape) {
        $this->usuarioModel->atualizarUsuario($idUsuario, $nome, $sobrenome, $email, $fotoPerfil, $tipo, $matricula, $siape);
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
    public function obterUsuarioPorEmailSenha($email, $senha) {
        return $this->usuarioModel->obterUsuarioPorEmailSenha($email, $senha);
    }
}
?>
