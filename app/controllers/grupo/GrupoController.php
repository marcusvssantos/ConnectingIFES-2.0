<?php
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/config/conexao.php');
include($_SERVER['DOCUMENT_ROOT'] . '/ConnectingIFES 2.0/app/models/GrupoModel.php');


$grupoController = new GrupoController($conn);

class GrupoController
{
    private $grupoModel;

    public function __construct($conn)
    {
        $this->grupoModel = new GrupoModel($conn);
    }

    public function criarGrupo($nome)
    {
        return $this->grupoModel->criarGrupo($nome);
    }

    public function obterGrupo($idGrupo)
    {
        return $this->grupoModel->obterGrupo($idGrupo);
    }

    public function obterGrupos()
    {
        return $this->grupoModel->obterGrupos();
    }

    public function atualizarGrupo($idGrupo, $nome)
    {
        $this->grupoModel->atualizarGrupo($idGrupo, $nome);
    }

    public function deletarGrupo($idGrupo)
    {
        $this->grupoModel->deletarGrupo($idGrupo);
    }

    public function adicionarAlunoAoGrupo($idGrupo, $idAluno)
    {
        $this->grupoModel->adicionarAlunoAoGrupo($idGrupo, $idAluno);
    }

    public function removerAlunoDoGrupo($idGrupo, $idAluno)
    {
        $this->grupoModel->removerAlunoDoGrupo($idGrupo, $idAluno);
    }

    public function adicionarProfessorAoGrupo($idGrupo, $idProfessor)
    {
        $this->grupoModel->adicionarProfessorAoGrupo($idGrupo, $idProfessor);
    }

    public function removerProfessorDoGrupo($idGrupo, $idProfessor)
    {
        $this->grupoModel->removerProfessorDoGrupo($idGrupo, $idProfessor);
    }

    public function obterAlunosDoGrupo($idGrupo)
    {
        return $this->grupoModel->obterAlunosDoGrupo($idGrupo);
    }

    public function obterProfessoresDoGrupo($idGrupo)
    {
        return $this->grupoModel->obterProfessoresDoGrupo($idGrupo);
    }

    public function verificarNomeGrupoExistente($nome)
    {
        return $this->grupoModel->verificarNomeGrupoExistente($nome);
    }


    public function obterAlunos()
    {
        return $this->grupoModel->obterAlunos();
    }

    public function obterProfessores()
    {
        return $this->grupoModel->obterProfessores();
    }

    public function alunoEstaNoGrupo($idGrupo, $idAluno)
    {
        return $this->grupoModel->alunoEstaNoGrupo($idGrupo, $idAluno);
    }

    public function professorEstaNoGrupo($idGrupo, $idProfessor)
    {
        return $this->grupoModel->professorEstaNoGrupo($idGrupo, $idProfessor);
    }

    public function obterMembrosGrupo($idGrupo)
    {
        return $this->grupoModel->obterMembrosGrupo($idGrupo);
    }

    public function atualizarMembrosGrupo($idGrupo, $membrosSelecionados, $tipoMembro)
    {
        // Supondo que $membrosSelecionados seja um array de IDs de alunos ou professores
        // e $tipoMembro seja 'aluno' ou 'professor'

        // Primeiro, obtenha todos os membros atuais do grupo
        $membrosAtuais = $this->grupoModel->obterMembrosGrupo($idGrupo, $tipoMembro);

        // Em seguida, compare os membros atuais com os selecionados para determinar quais adicionar ou remover
        foreach ($membrosAtuais as $membroAtual) {
            // Verifica se o membro atual está na lista de selecionados
            $posicao = array_search($membroAtual['id'], $membrosSelecionados);
            if ($posicao === false) {
                // Se o membro atual não estiver na lista de selecionados, remova-o do grupo
                $this->grupoModel->removerMembroDoGrupo($idGrupo, $membroAtual['id'], $tipoMembro);
            }
        }

        foreach ($membrosSelecionados as $membroSelecionado) {
            if (!$this->grupoModel->membroEstaNoGrupo($idGrupo, $membroSelecionado, $tipoMembro)) {
                // Se o membro selecionado não estiver no grupo, adicione-o
                $this->grupoModel->adicionarMembroAoGrupo($idGrupo, $membroSelecionado, $tipoMembro);
            }
        }
    }
}
