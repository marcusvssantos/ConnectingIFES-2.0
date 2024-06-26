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

    public function obterAlunos()
    {
        $sql = "SELECT u.*, a.* FROM Usuario u
                LEFT JOIN Aluno a ON u.idUsuario = a.usuario_id
                WHERE u.tipo = 'aluno'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterProfessores()
    {
        $sql = "SELECT u.*, p.* FROM Usuario u
                LEFT JOIN Professor p ON u.idUsuario = p.usuario_id
                WHERE u.tipo = 'professor'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterAdministradores()
    {
        $sql = "SELECT u.*, ad.* FROM Usuario u
                LEFT JOIN Administrador ad ON u.idUsuario = ad.usuario_id
                WHERE u.tipo = 'administrador'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function atualizarUsuario($idUsuario, $nome, $sobrenome, $email, $fotoPerfil, $tipo, $matricula = null, $siape = null, $curso = null, $periodo = null,  $departamento = null, $login = null, $senha = null)
    {
        $sql = "UPDATE Usuario SET nome = ?, sobrenome = ?, email = ?, fotoPerfil = ?, tipo = ? WHERE idUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nome, $sobrenome, $email, $fotoPerfil, $tipo, $idUsuario]);

        switch ($tipo) {
            case 'aluno':
                $sql = "UPDATE Aluno SET matricula = ?, curso = ?, periodo = ? , senha = ? WHERE usuario_id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$matricula, $curso, $periodo, $senha, $idUsuario]);
                break;
            case 'professor':
                $sql = "UPDATE Professor SET siape = ?, departamento = ? , senha = ? WHERE usuario_id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$siape, $departamento, $senha, $idUsuario]);
                break;
            case 'administrador':
                $sql = "UPDATE Administrador SET login = ? ,senha = ? WHERE usuario_id = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$login, $senha, $idUsuario]);
                break;
        }
    }

    public function deletarUsuario($idUsuario)
    {
        // Primeiro, obtemos o tipo de usuário
        $sql = "SELECT tipo FROM Usuario WHERE idUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idUsuario]);
        $tipo = $stmt->fetchColumn();

        // Em seguida, deletamos as entradas relacionadas em outras tabelas de acordo com o tipo
        switch ($tipo) {
            case 'aluno':
                $this->deletarAluno($idUsuario);
                break;
            case 'professor':
                $this->deletarProfessor($idUsuario);
                break;
            case 'administrador':
                $this->deletarAdministrador($idUsuario);
                break;
            default:
                break;
        }

        // Finalmente, deletamos o usuário da tabela principal
        $sql = "DELETE FROM Usuario WHERE idUsuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idUsuario]);
    }

    private function deletarAluno($idUsuario)
    {
        $sql = "DELETE FROM Aluno WHERE usuario_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idUsuario]);
    }

    private function deletarProfessor($idUsuario)
    {
        $sql = "DELETE FROM Professor WHERE usuario_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idUsuario]);
    }

    private function deletarAdministrador($idUsuario)
    {
        $sql = "DELETE FROM Administrador WHERE usuario_id = ?";
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

    public function obterAlunoPorMatriculaSenha($matricula, $senha)
    {
        $sql = "SELECT u.*, a.*, a.periodo FROM Usuario u 
            INNER JOIN Aluno a ON u.idUsuario = a.usuario_id 
            WHERE a.matricula= ? AND a.senha = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$matricula, $senha]);
        $aluno = $stmt->fetch(PDO::FETCH_ASSOC);
        return $aluno;
    }

    public function obterProfessorPorSiapeSenha($siape, $senha)
    {
        $sql = "SELECT u.*, p.* FROM Usuario u 
            INNER JOIN Professor p ON u.idUsuario = p.usuario_id 
            WHERE p.siape = ? AND p.senha = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$siape, $senha]);
        $professor = $stmt->fetch(PDO::FETCH_ASSOC);
        return $professor;
    }

    public function obterAdministradorPorLoginSenha($login, $senha)
    {
        $sql = "SELECT u.*, a.* FROM Usuario u 
            INNER JOIN Administrador a ON u.idUsuario = a.usuario_id 
            WHERE a.login = ? AND a.senha = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$login, $senha]);
        $administrador = $stmt->fetch(PDO::FETCH_ASSOC);
        return $administrador;
    }
}
