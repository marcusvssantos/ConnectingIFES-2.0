<?php
require 'C:\wamp64\www\ConnectingIFES 2.0\app\controllers\usuario\UsuarioController.php';

use PHPUnit\Framework\TestCase;

class UsuarioTest extends TestCase
{
    protected $usuarioController;
    public $userId;

    protected function setUp(): void
    {
        $conn = new PDO('mysql:host=localhost;dbname=ConnectingIFES_2_0', 'root', '');
        $this->usuarioController = new UsuarioController($conn);
    }

    public function testCriarUsuario()
    {
        $nome = 'Teste';
        $sobrenome = 'Usuário';
        $email = 'teste@usuario.com';
        $senha = 'senha123';
        $fotoPerfil = 'foto.jpg';
        $tipo = 'aluno';
        $matricula = '123456';
        $siape = '';
        $curso = 'Engenharia';
        $departamento = '';
        $login = '';

        // Criar usuário
        $result = $this->usuarioController->criarUsuario($nome, $sobrenome, $email, $senha, $fotoPerfil, $tipo, $matricula, $siape, $curso, $departamento, $login);

        // Verificar se o resultado não é nulo
        $this->assertNotNull($result);

    }

    

    public function testObterAlunos()
    {
        // Obter alunos
        $alunos = $this->usuarioController->obterAlunos();

        // Verificar se o resultado não é nulo
        $this->assertNotNull($alunos);

        // Verificar se há pelo menos um aluno retornado
        $this->assertGreaterThan(0, count($alunos));
    }

     
    public function testDeletarUsuario()
    {

        $matricula = '123456';
        $senha = 'senha123';

        // Obter usuário por email e senha
        $usuario = $this->usuarioController->obterAlunoPorMatriculaSenha($matricula, $senha);

        // Verificar se o resultado não é nulo
        $this->assertNotNull($usuario);

        // Verificar se o email retornado corresponde ao email fornecido
        $this->assertEquals($matricula, $usuario['matricula']);
        $this->userId = $usuario['idUsuario'];

        // Deletar usuário
        $this->usuarioController->deletarUsuario($this->userId);
    
        // Tentar obter o usuário que foi deletado
        $usuario = $this->usuarioController->obterUsuario($this->userId);
    
        // Verificar se o usuário não existe mais
        $this->assertFalse($usuario);

    }
    
}
