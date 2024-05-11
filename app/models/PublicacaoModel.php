<?php

class PublicacaoModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function criarPublicacao($titulo, $conteudo, $imagemPublicacao, $dataPublicacao, $professor_id)
    {
        $sql = "INSERT INTO Publicacao (titulo, conteudo, imagemPublicacao, dataPublicacao, professor_id) VALUES (?,?,?,?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$titulo, $conteudo, $imagemPublicacao, $dataPublicacao, $professor_id]);
        $publicacao_id = $this->conn->lastInsertId();

        return $publicacao_id;
    }



    public function criarPublicacaoGrupo($grupo_id, $publicacao_id)
    {
        $sql = "INSERT INTO PublicacaoGrupo (grupo_id, publicacao_id) VALUES (?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$grupo_id, $publicacao_id]);
    }

    public function obterPublicacoes($professor_id)
    {
        $sql = "SELECT p.*, g.grupo_nome FROM Publicacao p
                LEFT JOIN PublicacaoGrupo pg ON p.idPublicacao = pg.publicacao_id
                LEFT JOIN Grupo g ON pg.grupo_id = g.idGrupo
                WHERE p.professor_id =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$professor_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterPublicacaoPorId($publicacao_id)
    {
        $sql = "SELECT * FROM Publicacao WHERE idPublicacao =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$publicacao_id]);
        $publicacao = $stmt->fetch(PDO::FETCH_ASSOC);

        return $publicacao;
    }

    public function atualizarPublicacao($publicacao_id, $titulo, $conteudo, $imagemPublicacao, $dataPublicacao)
    {
        $sql = "UPDATE Publicacao SET titulo =?, conteudo =?, imagemPublicacao =?, dataPublicacao =? WHERE idPublicacao =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$titulo, $conteudo, $imagemPublicacao, $dataPublicacao, $publicacao_id]);
    }

    public function deletarPublicacao($publicacao_id)
    {
        $sql = "DELETE FROM Publicacao WHERE idPublicacao =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$publicacao_id]);

        $sql = "DELETE FROM PublicacaoGrupo WHERE publicacao_id =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$publicacao_id]);
    }

    public function obterPublicacoesPorGrupo($grupo_id)
    {
        $sql = "SELECT p.*, g.grupo_nome FROM Publicacao p
            LEFT JOIN PublicacaoGrupo pg ON p.idPublicacao = pg.publicacao_id
            LEFT JOIN Grupo g ON pg.grupo_id = g.idGrupo
            WHERE pg.grupo_id =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$grupo_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterPublicacoesPorProfessor($professor_id)
    {
        $sql = "SELECT DISTINCT p.*, u.*,pr.* FROM Publicacao p
                JOIN Professor pr ON p.professor_id = pr.idProfessor
                JOIN Usuario u ON pr.usuario_id = u.idUsuario
                LEFT JOIN PublicacaoGrupo pg ON p.idPublicacao = pg.publicacao_id
                WHERE p.professor_id = ?
                ORDER BY p.dataPublicacao DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$professor_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterPublicacoesAlunoGrupo($aluno_id)
    {
        $sql = "SELECT p.*, g.grupo_nome
            FROM Publicacao p
            JOIN PublicacaoGrupo pg ON p.idPublicacao = pg.publicacao_id
            JOIN Grupo g ON pg.grupo_id = g.idGrupo
            JOIN GrupoAluno ga ON g.idGrupo = ga.grupo_id
            WHERE ga.aluno_id =?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$aluno_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterPublicacoesProfessorGrupo($professor_id)
    {
        $sql = "SELECT DISTINCT p.*, u.*, pr.*
            FROM Publicacao p
            JOIN Professor pr ON p.professor_id = pr.idProfessor
            JOIN Usuario u ON pr.usuario_id = u.idUsuario
            JOIN PublicacaoGrupo pg ON p.idPublicacao = pg.publicacao_id
            JOIN Grupo g ON pg.grupo_id = g.idGrupo
            JOIN GrupoProfessor gp ON g.idGrupo = gp.grupo_id
            WHERE gp.professor_id =?
            ORDER BY p.dataPublicacao DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$professor_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
