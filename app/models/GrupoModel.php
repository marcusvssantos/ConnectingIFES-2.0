<?php
class GrupoModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function criarGrupo($nome)
    {
        $sql = "INSERT INTO Grupo (nome) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nome]);
        return $this->conn->lastInsertId();
    }

    public function obterGrupo($idGrupo)
    {
        $sql = "SELECT * FROM Grupo WHERE idGrupo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idGrupo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obterGrupoNome($nome)
    {
        $sql = "SELECT * FROM Grupo WHERE nome = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nome]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obterGrupos()
    {
        $sql = "SELECT * FROM Grupo";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function atualizarGrupo($idGrupo, $nome)
    {
        $sql = "UPDATE Grupo SET nome = ? WHERE idGrupo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nome, $idGrupo]);
    }

    public function deletarGrupo($idGrupo)
    {
        $sql = "DELETE FROM Grupo WHERE idGrupo = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idGrupo]);
    }

    public function adicionarAlunoAoGrupo($idGrupo, $idAluno)
    {
        $sql = "INSERT INTO GrupoAluno (grupo_id, aluno_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idGrupo, $idAluno]);
    }

    public function removerAlunoDoGrupo($idGrupo, $idAluno)
    {
        $sql = "DELETE FROM GrupoAluno WHERE grupo_id = ? AND aluno_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idGrupo, $idAluno]);
    }

    public function adicionarProfessorAoGrupo($idGrupo, $idProfessor)
    {
        $sql = "INSERT INTO GrupoProfessor (grupo_id, professor_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idGrupo, $idProfessor]);
    }

    public function removerProfessorDoGrupo($idGrupo, $idProfessor)
    {
        $sql = "DELETE FROM GrupoProfessor WHERE grupo_id = ? AND professor_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idGrupo, $idProfessor]);
    }

    public function obterAlunosDoGrupo($idGrupo)
    {
        $sql = "SELECT a.* FROM Aluno a
                JOIN GrupoAluno ga ON a.idAluno = ga.aluno_id
                WHERE ga.grupo_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idGrupo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterProfessoresDoGrupo($idGrupo)
    {
        $sql = "SELECT p.* FROM Professor p
                JOIN GrupoProfessor gp ON p.idProfessor = gp.professor_id
                WHERE gp.grupo_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idGrupo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterGruposDoProfesor($siape)
    {
        $sql = "SELECT g.* FROM Grupo g
                JOIN GrupoProfessor gp ON g.idGrupo = gp.grupo_id
                JOIN Professor p ON gp.professor_id = p.idProfessor
                WHERE p.siape = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$siape]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verificarNomeGrupoExistente($nome)
    {
        $sql = "SELECT COUNT(*) FROM Grupo WHERE nome = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nome]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    // Método para buscar todos os alunos
    public function obterAlunos()
    {
        $sql = "SELECT * FROM Aluno";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar todos os professores
    public function obterProfessores()
    {
        $sql = "SELECT * FROM Professor";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para verificar se um aluno já está cadastrado no grupo
    public function alunoEstaNoGrupo($idGrupo, $idAluno)
    {
        $sql = "SELECT COUNT(*) FROM GrupoAluno WHERE grupo_id = ? AND aluno_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idGrupo, $idAluno]);
        return $stmt->fetchColumn() > 0;
    }

    // Método para verificar se um professor já está cadastrado no grupo
    public function professorEstaNoGrupo($idGrupo, $idProfessor)
    {
        $sql = "SELECT COUNT(*) FROM GrupoProfessor WHERE grupo_id = ? AND professor_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idGrupo, $idProfessor]);
        return $stmt->fetchColumn() > 0;
    }

    public function obterMembrosGrupo($idGrupo)
    {
        // Buscar alunos do grupo
        $sqlAlunos = "SELECT a.* FROM Aluno a
                     JOIN GrupoAluno ga ON a.idAluno = ga.aluno_id
                     WHERE ga.grupo_id = ?";
        $stmtAlunos = $this->conn->prepare($sqlAlunos);
        $stmtAlunos->execute([$idGrupo]);
        $alunos = $stmtAlunos->fetchAll(PDO::FETCH_ASSOC);

        // Buscar professores do grupo
        $sqlProfessores = "SELECT p.* FROM Professor p
                           JOIN GrupoProfessor gp ON p.idProfessor = gp.professor_id
                           WHERE gp.grupo_id = ?";
        $stmtProfessores = $this->conn->prepare($sqlProfessores);
        $stmtProfessores->execute([$idGrupo]);
        $professores = $stmtProfessores->fetchAll(PDO::FETCH_ASSOC);

        // Combinar alunos e professores em um único array
        $membrosGrupo = array_merge($alunos, $professores);

        return $membrosGrupo;
    }

    public function removerMembroDoGrupo($idGrupo, $idMembro, $tipoMembro)
    {
        $sql = $tipoMembro === 'aluno' ? "DELETE FROM GrupoAluno WHERE grupo_id = ? AND aluno_id = ?" : "DELETE FROM GrupoProfessor WHERE grupo_id = ? AND professor_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idGrupo, $idMembro]);
    }

    public function adicionarMembroAoGrupo($idGrupo, $idMembro, $tipoMembro)
    {
        $sql = $tipoMembro === 'aluno' ? "INSERT INTO GrupoAluno (grupo_id, aluno_id) VALUES (?, ?)" : "INSERT INTO GrupoProfessor (grupo_id, professor_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idGrupo, $idMembro]);
    }

    public function membroEstaNoGrupo($idGrupo, $idMembro, $tipoMembro)
    {
        $sql = $tipoMembro === 'aluno' ? "SELECT COUNT(*) FROM GrupoAluno WHERE grupo_id = ? AND aluno_id = ?" : "SELECT COUNT(*) FROM GrupoProfessor WHERE grupo_id = ? AND professor_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idGrupo, $idMembro]);
        return $stmt->fetchColumn() > 0;
    }
}
