<?php
class UsuarioModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function criarUsuario($nome, $sobrenome, $email, $senha, $fotoPerfil, $tipo, $matricula = null, $siape = null) {
        $sql = "INSERT INTO usuarios (nome, sobrenome, email, senha, fotoPerfil, tipo, matricula, siape) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nome, $sobrenome, $email, $senha, $fotoPerfil, $tipo, $matricula, $siape]);
        return $this->conn->lastInsertId();
    }

    public function obterUsuario($idUsuario) {
        $sql = "SELECT * FROM usuarios WHERE idUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idUsuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarUsuario($idUsuario, $nome, $sobrenome, $email, $senha, $fotoPerfil, $tipo, $matricula = null, $siape = null) {
        $sql = "UPDATE usuarios SET nome = ?, sobrenome = ?, email = ?, senha = ?, fotoPerfil = ?, tipo = ?, matricula = ?, siape = ? WHERE idUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nome, $sobrenome, $email, $senha, $fotoPerfil, $tipo, $matricula, $siape, $idUsuario]);
    }

    public function deletarUsuario($idUsuario) {
        $sql = "DELETE FROM usuarios WHERE idUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idUsuario]);
    }
}
?>
