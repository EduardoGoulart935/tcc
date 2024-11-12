<?php
require_once('../model/conexao.php');
session_start();

// Verifica se o usuário está autenticado e logado
if (empty($_SESSION['autenticado']) || empty($_SESSION['logado']) || empty($_SESSION['id_perfil'])) {
    http_response_code(403);
    echo json_encode(["error" => "Usuário não autenticado"]);
    exit();
}

// Seleciona as ofertas com status 'A' e filtra por id_perfil
$sql = "SELECT id, nome, descricao, categoria, contato, email, status, nome_foto, id_perfil 
        FROM ofertas 
        WHERE status = 'A' AND id_perfil = :id_perfil";
$query = $pdo->prepare($sql);
$query->bindParam(':id_perfil', $_SESSION['id_perfil'], PDO::PARAM_INT);
$query->execute();
$ofertas = $query->fetchAll(PDO::FETCH_ASSOC);

// Define o cabeçalho JSON e exibe o resultado
header('Content-Type: application/json');
echo json_encode($ofertas);
