<?php

$db_name = "moviestar";
$db_host = "localhost";
$db_user = "root";
$db_pass = "";

try {
    $conn = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_host, $db_user, $db_pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (PDOException $e) {
    echo "ERRO AO CONECTAR COM O BANCO DE DADOS: " . $e->getMessage() . "<br>" . $conn->errorInfo();
}
