<?php
// Configurações de conexão com o banco de dados
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "ConnectingIFES_2_0"; 

// Cria a conexão
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Define o modo de erro do PDO como exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Define o charset como UTF-8
    $conn->exec("SET NAMES utf8");
} catch(PDOException $e) {
    // Em caso de erro na conexão, exibe uma mensagem de erro
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
    // Encerra o script
    die();
}
?>
