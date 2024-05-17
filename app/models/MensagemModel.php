<?php

class MensagemModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function criarMensagem($conversa_id, $remetente_id, $conteudo)
    {
        $sql = "INSERT INTO Mensagem (conversa_id, remetente_id, conteudo, dataEnvio) VALUES (?, ?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$conversa_id, $remetente_id, $conteudo]);
        return $this->conn->lastInsertId();
    }

    public function obterMensagensPorConversa($conversa_id)
    {
        $sql = "SELECT * FROM Mensagem WHERE conversa_id = ? ORDER BY dataEnvio ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$conversa_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obterMensagemPorId($mensagem_id)
    {
        $sql = "SELECT * FROM Mensagem WHERE idMensagem = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$mensagem_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deletarMensagem($mensagem_id)
    {
        $sql = "DELETE FROM Mensagem WHERE idMensagem = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$mensagem_id]);
    }
}
?>
