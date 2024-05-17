<?php
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/config/conexao.php');
require 'C:\wamp64\www\ConnectingIFES 2.0\app\models\ConversaModel.php';
require 'C:\wamp64\www\ConnectingIFES 2.0\app\models\MensagemModel.php';

$conversaController = new ConversaController($conn);

class ConversaController
{
    private $conversaModel;
    private $mensagemModel;

    public function __construct($conn)
    {
        $this->conversaModel = new ConversaModel($conn);
        $this->mensagemModel = new MensagemModel($conn);
    }

    // Métodos para conversas
    public function criarConversa($usuario1_id, $usuario2_id)
    {
        return $this->conversaModel->criarConversa($usuario1_id, $usuario2_id);
    }


    public function obterConversasPorUsuario($usuario_id)
    {
        return $this->conversaModel->obterConversasPorUsuario($usuario_id);
    }

    public function obterConversaPorId($conversa_id)
    {
        return $this->conversaModel->obterConversaPorId($conversa_id);
    }

    public function deletarConversa($conversa_id)
    {
        $this->conversaModel->deletarConversa($conversa_id);
    }

    // Métodos para mensagens
    public function criarMensagem($conversa_id, $remetente_id, $conteudo)
    {
        return $this->mensagemModel->criarMensagem($conversa_id, $remetente_id, $conteudo);
    }

    public function obterMensagensPorConversa($conversa_id)
    {
        return $this->mensagemModel->obterMensagensPorConversa($conversa_id);
    }

    public function obterMensagemPorId($mensagem_id)
    {
        return $this->mensagemModel->obterMensagemPorId($mensagem_id);
    }

    public function deletarMensagem($mensagem_id)
    {
        $this->mensagemModel->deletarMensagem($mensagem_id);
    }
}
