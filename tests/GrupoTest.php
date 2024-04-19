<?php
require 'C:\wamp64\www\ConnectingIFES 2.0\app\controllers\grupo\GrupoController.php';

use PHPUnit\Framework\TestCase;

class GrupoTest extends TestCase
{
    protected $grupoController;
    public $grupoId;

    protected function setUp(): void
    {
        $conn = new PDO('mysql:host=localhost;dbname=ConnectingIFES_2_0', 'root', '');
        $this->grupoController = new GrupoController($conn);
    }

    public function testGrupo()
    {
        $nome = 'Teste';
        $result = $this->grupoController->criarGrupo($nome);
        $this->assertNotNull($result);


        $grupo = $this->grupoController->obterGrupoNome($nome);
        $this->assertEquals($nome, $grupo['nome']);
        $this->grupoId = $grupo['idGrupo'];

        $this->grupoController->deletarGrupo($this->grupoId);
        $grupoID = $this->grupoController->obterGrupo($this->grupoId);
        $this->assertFalse($grupoID);

    }
    
}
