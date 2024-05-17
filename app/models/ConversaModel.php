<?php

class ConversaModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function criarConversa($usuario1_id, $usuario2_id)
    {
        $sql = "INSERT INTO Conversa (usuario1_id, usuario2_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$usuario1_id, $usuario2_id]);
        $conversaId = $this->conn->lastInsertId();
        return $conversaId;
    }


    public function obterConversasPorUsuario($usuario_id)
    {
        $sql = "SELECT * FROM Conversa WHERE usuario1_id = ? OR usuario2_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$usuario_id, $usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterConversaPorId($conversa_id)
    {
        $sql = "SELECT * FROM Conversa WHERE idConversa = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$conversa_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deletarConversa($conversa_id)
    {
        $sql = "DELETE FROM Conversa WHERE idConversa = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$conversa_id]);
    }
}
