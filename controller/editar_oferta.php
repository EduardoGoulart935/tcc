<?php
session_start();
require_once("../model/conexao.php");

if (!isset($_SESSION['id_perfil'])) {
    die("Usuário não está logado. Faça o login novamente.");
}

$id_perfil = $_SESSION['id_perfil'];

$dados = json_decode(file_get_contents("php://input"), true);

if ($dados) {
    $nome = $dados['nome'];
    $status = $dados['status'];
    $descricao = $dados['descricao'];
    $categoria = $dados['categoria'];
    $contato = $dados['contato'];

    $sql_perfil = "UPDATE ofertas SET nome = :nome, status = :status, descricao = :descricao, categoria = :categoria, contato = :contato WHERE id_perfil = :id_perfil";
    $editar = $pdo->prepare($sql_perfil);
    $editar->bindParam(':nome', $nome);
    $editar->bindParam(':status', $status);
    $editar->bindParam(':descricao', $descricao);
    $editar->bindParam(':categoria', $categoria);
    $editar->bindParam(':contato', $contato);
    $editar->bindParam(':id_perfil', $id_perfil);
    $editar->execute();

    if ($editar->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos.']);
}

