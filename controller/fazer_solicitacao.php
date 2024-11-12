<?php
session_start();
require_once("../model/conexao.php");

// Habilita exibição de erros (remover em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Recebe os dados JSON enviados via fetch
$data = json_decode(file_get_contents('php://input'), true);
$id_perfil_solicitante = $_SESSION['id_perfil']; // ID do usuário logado (quem faz a solicitação)
$id_oferta = $data['id_oferta'];

if (isset($id_oferta) && isset($id_perfil_solicitante)) {
    try {
        // Verificar o criador da oferta
        $sql = "SELECT id_perfil FROM ofertas WHERE id = :id_oferta";
        $query = $pdo->prepare($sql);
        $query->bindParam(':id_oferta', $id_oferta);
        $query->execute();
        $oferta = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($oferta) {
            $id_perfil_recebedor = $oferta['id_perfil'];

            // Verifica se o usuário solicitante não está solicitando sua própria oferta
            if ($id_perfil_recebedor == $id_perfil_solicitante) {
                echo json_encode(['success' => false, 'message' => 'Você não pode solicitar sua própria oferta.']);
                exit;
            }

            // Insere o pedido na tabela pedidos
            $sql = "INSERT INTO pedidos (id_ofertas, id_perfil_pedido, hora_data) VALUES (:id_oferta, :id_perfil_solicitante, NOW())";
            $query = $pdo->prepare($sql);
            $query->bindParam(':id_oferta', $id_oferta);
            $query->bindParam(':id_perfil_solicitante', $id_perfil_solicitante);
            $query->execute();

            // Insere a notificação na tabela notificacoes
            $sql = "INSERT INTO notificacoes (id_perfil_recebedor, id_perfil_solicitante, id_oferta) VALUES (:id_perfil_recebedor, :id_perfil_solicitante, :id_oferta)";
            $query = $pdo->prepare($sql);
            $query->bindParam(':id_perfil_recebedor', $id_perfil_recebedor);
            $query->bindParam(':id_perfil_solicitante', $id_perfil_solicitante);
            $query->bindParam(':id_oferta', $id_oferta);
            $query->execute();

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Oferta não encontrada']);
        }
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos']);
}
