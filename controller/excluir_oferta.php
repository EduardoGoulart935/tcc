<?php
require_once('../model/conexao.php');

// Verifica se o ID foi passado pela URL amigável
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pega o ID da URL amigável
    $url = $_SERVER['REQUEST_URI'];
    $parts = explode('/', $url);
    $id_oferta = end($parts); // Obtém o último valor da URL como ID

    // Valida o ID da oferta
    if (!empty($id_oferta) && is_numeric($id_oferta)) {
        // Query para excluir a oferta do banco de dados
        $sql = "DELETE FROM ofertas WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id_oferta);

        if ($stmt->execute()) {
            // Retorna uma resposta de sucesso em formato JSON
            echo json_encode(['success' => true, 'message' => 'Oferta excluída com sucesso.']);
        } else {
            // Retorna uma resposta de erro
            echo json_encode(['success' => false, 'message' => 'Erro ao excluir oferta.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID inválido.']);
    }
} else {
    // Método não permitido
    http_response_code(405); // Método não permitido
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
}
?>
