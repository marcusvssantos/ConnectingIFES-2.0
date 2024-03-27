<?php
require_once '../../../config/conexao.php';
require_once '../../models/UsuarioModel.php';

$usuarioController = new UsuarioController($conn);

class UsuarioController {
    private $usuarioModel;

    public function __construct($conn) {
        $this->usuarioModel = new UsuarioModel($conn);
    }

    public function criarUsuario($nome, $sobrenome, $email, $senha, $fotoPerfil, $tipo, $matricula = null, $siape = null) {
        return $this->usuarioModel->criarUsuario($nome, $sobrenome, $email, $senha, $fotoPerfil, $tipo, $matricula, $siape);
    }

    public function obterUsuario($idUsuario) {
        return $this->usuarioModel->obterUsuario($idUsuario);
    }

    public function atualizarUsuario($idUsuario, $nome, $sobrenome, $email, $senha, $fotoPerfil, $tipo, $matricula = null, $siape = null) {
        $this->usuarioModel->atualizarUsuario($idUsuario, $nome, $sobrenome, $email, $senha, $fotoPerfil, $tipo, $matricula, $siape);
    }

    public function deletarUsuario($idUsuario) {
        $this->usuarioModel->deletarUsuario($idUsuario);
    }
}
?>
