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

    public function obterUsuariosPorTipo($tipo) {
        $sql = "SELECT * FROM usuarios WHERE tipo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$tipo]);
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $usuarios;
    }
    

    public function atualizarUsuario($idUsuario, $nome, $sobrenome, $email, $fotoPerfil, $tipo, $matricula, $siape) {
        $sql = "UPDATE usuarios SET nome = ?, sobrenome = ?, email = ?, fotoPerfil = ?, tipo = ?, matricula = ?, siape = ? WHERE idUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nome, $sobrenome, $email, $fotoPerfil, $tipo, $matricula, $siape, $idUsuario]);
    }

    public function deletarUsuario($idUsuario) {
        $sql = "DELETE FROM usuarios WHERE idUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idUsuario]);
    }

    public function verificarEmailExistente($email) {
        $sql = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function verificarSiapeExistente($siape) {
        $sql = "SELECT COUNT(*) FROM usuarios WHERE siape = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$siape]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function verificarMatriculaExistente($matricula) {
        $sql = "SELECT COUNT(*) FROM usuarios WHERE matricula = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$matricula]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
    
    
}
?>
