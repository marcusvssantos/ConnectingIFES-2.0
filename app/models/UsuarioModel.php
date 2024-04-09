<?php
class UsuarioModel
{
    private $conn;


    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function criarUsuario($nome, $sobrenome, $email, $senha, $fotoPerfil, $tipo, $matricula = null, $siape = null, $curso = null, $periodo = null, $departamento = null, $login = null)
    {
        $sql = "INSERT INTO Usuario (nome, sobrenome, email, fotoPerfil, tipo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nome, $sobrenome, $email, $fotoPerfil, $tipo]);
        $usuario_id = $this->conn->lastInsertId();

        switch ($tipo) {
            case 'aluno':
                $sql = "INSERT INTO Aluno (matricula, senha, curso, periodo, usuario_id) VALUES (?, ?, ?, ?, ?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$matricula, $senha, $curso, $periodo, $usuario_id]);
                break;
            case 'professor':
                $sql = "INSERT INTO Professor (siape, senha, departamento, usuario_id) VALUES (?, ?, ?, ?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$siape, $senha, $departamento, $usuario_id]);
                break;
            case 'administrador':
                $sql = "INSERT INTO Administrador (login, senha, usuario_id) VALUES (?, ?, ?)";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$login, $senha, $usuario_id]);
                break;
        }

        return $usuario_id;
    }

    public function obterUsuario($idUsuario)
    {
        $sql = "SELECT * FROM Usuario WHERE idUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idUsuario]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            switch ($usuario['tipo']) {
                case 'aluno':
                    $sql = "SELECT * FROM Aluno WHERE usuario_id = ?";
                    break;
                case 'professor':
                    $sql = "SELECT * FROM Professor WHERE usuario_id = ?";
                    break;
                case 'administrador':
                    $sql = "SELECT * FROM Administrador WHERE usuario_id = ?";
                    break;
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$idUsuario]);
            $perfil = $stmt->fetch(PDO::FETCH_ASSOC);
            $usuario = array_merge($usuario, $perfil);
        }

        return $usuario;
    }

    public function obterAlunos() {
        $sql = "SELECT u.*, a.* FROM Usuario u
                LEFT JOIN Aluno a ON u.idUsuario = a.usuario_id
                WHERE u.tipo = 'aluno'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function obterProfessores() {
        $sql = "SELECT u.*, p.* FROM Usuario u
                LEFT JOIN Professor p ON u.idUsuario = p.usuario_id
                WHERE u.tipo = 'professor'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function obterAdministradores() {
        $sql = "SELECT u.*, ad.* FROM Usuario u
                LEFT JOIN Administrador ad ON u.idUsuario = ad.usuario_id
                WHERE u.tipo = 'administrador'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function atualizarUsuario($idUsuario, $nome, $sobrenome, $email, $fotoPerfil, $tipo, $matricula = null, $siape = null, $curso = null, $periodo = null,  $departamento = null, $login = null)
    {
        $sql = "UPDATE Usuario SET nome = ?, sobrenome = ?, email = ?, fotoPerfil = ?, tipo = ? WHERE idUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nome, $sobrenome, $email, $fotoPerfil, $tipo, $idUsuario]);

        switch ($tipo) {
            case 'aluno':
                $sql = "UPDATE Aluno SET matricula = ?, curso = ?, periodo = ? WHERE usuario_id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$matricula, $curso, $periodo, $idUsuario]);
                break;
            case 'professor':
                $sql = "UPDATE Professor SET siape = ?, departamento = ? WHERE usuario_id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$siape, $departamento, $idUsuario]);
                break;
            case 'administrador':
                $sql = "UPDATE Administrador SET login = ? WHERE usuario_id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$login, $idUsuario]);
                break;
        }
    }

    public function deletarUsuario($idUsuario)
    {
        $sql = "DELETE FROM Usuario WHERE idUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idUsuario]);
    }

    public function verificarEmailExistente($email)
    {
        $sql = "SELECT COUNT(*) FROM Usuario WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function verificarSiapeExistente($siape)
    {
        $sql = "SELECT COUNT(*) FROM Professor WHERE siape = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$siape]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function verificarMatriculaExistente($matricula)
    {
        $sql = "SELECT COUNT(*) FROM Aluno WHERE matricula = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$matricula]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function verificarLoginExistente($login)
    {
        $sql = "SELECT COUNT(*) FROM Administrador WHERE login = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$login]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function obterUsuarioPorEmailSenha($email, $senha)
    {
        $sql = "SELECT * FROM Usuario WHERE email = ? AND senha = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email, $senha]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }
}
