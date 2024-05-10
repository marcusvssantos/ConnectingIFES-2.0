<?php
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/config/conexao.php');
require 'C:\wamp64\www\ConnectingIFES 2.0\app\models\PublicacaoModel.php';

$publicacaoController = new PublicacaoController($conn);

class PublicacaoController
{
    private $publicacaoModel;

    public function __construct($conn)
    {
        $this->publicacaoModel = new PublicacaoModel($conn);
    }


    public function criarPublicacaoGrupo($grupo_id, $publicacao_id)
    {
        $this->publicacaoModel->criarPublicacaoGrupo($grupo_id, $publicacao_id);
    }

    public function obterPublicacoes($professor_id)
    {
        return $this->publicacaoModel->obterPublicacoes($professor_id);
    }

    public function obterPublicacaoPorId($publicacao_id)
    {
        return $this->publicacaoModel->obterPublicacaoPorId($publicacao_id);
    }

    public function atualizarPublicacao($publicacao_id, $titulo, $conteudo, $imagemPublicacao, $dataPublicacao)
    {
        $this->publicacaoModel->atualizarPublicacao($publicacao_id, $titulo, $conteudo, $imagemPublicacao, $dataPublicacao);
    }

    public function deletarPublicacao($publicacao_id)
    {
        $this->publicacaoModel->deletarPublicacao($publicacao_id);
    }

    public function obterPublicacoesPorGrupo($grupo_id)
    {
        return $this->publicacaoModel->obterPublicacoesPorGrupo($grupo_id);
    }

    public function obterPublicacoesPorProfessor($professor_id)
    {
        return $this->publicacaoModel->obterPublicacoesPorProfessor($professor_id);
    }

    public function obterPublicacoesAlunoGrupo($aluno_id)
    {
        return $this->publicacaoModel->obterPublicacoesAlunoGrupo($aluno_id);
    }

    public function obterPublicacoesProfessorGrupo($professor_id)
    {
        return $this->publicacaoModel->obterPublicacoesProfessorGrupo($professor_id);
    }

    
    
    public function criarPublicacao($titulo, $conteudo, $imagemPublicacao, $dataPublicacao, $professor_id, $grupos)
    {
        $publicacao_id = $this->publicacaoModel->criarPublicacao($titulo, $conteudo, $imagemPublicacao, $dataPublicacao, $professor_id);

        foreach ($grupos as $grupo_id) {
            $this->publicacaoModel->criarPublicacaoGrupo($grupo_id, $publicacao_id);
        }

        return $publicacao_id;
    }
}
