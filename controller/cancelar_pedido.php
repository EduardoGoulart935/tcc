<?php
require_once('../model/conexao.php');
session_start();

// Verifica se o perfil do usuário está setado
if (!isset($_SESSION['id_perfil'])) {
    header('HTTP/1.1 403 Forbidden');
    echo json_encode(['success' => false, 'error' => 'Usuário não autenticado']);
    exit();
}

// Obtém o ID do pedido do JSON recebido
$data = json_decode(file_get_contents('php://input'), true);
$idPedido = $data['id_pedido'] ?? null;

// Valida o ID do pedido
if (!$idPedido) {
    echo json_encode(['success' => false, 'error' => 'ID do pedido não especificado']);
    exit();
}

// Verifica se o pedido pertence ao usuário
$sql = "DELETE FROM pedidos WHERE id = :idPedido AND id_perfil_pedido = :idPerfil";
$query = $pdo->prepare($sql);
$query->bindParam(':idPedido', $idPedido, PDO::PARAM_INT);
$query->bindParam(':idPerfil', $_SESSION['id_perfil'], PDO::PARAM_INT);

if ($query->execute() && $query->rowCount() > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Falha ao cancelar o pedido ou pedido não encontrado']);
}
?>
