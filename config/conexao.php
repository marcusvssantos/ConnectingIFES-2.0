<?php
// Configurações de conexão com o banco de dados
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "ConnectingIFES_2_0"; 

// Cria a conexão
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec("SET NAMES utf8");
} catch(PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
    die();
}
?>
