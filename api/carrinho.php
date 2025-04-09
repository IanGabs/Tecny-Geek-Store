<?php
require_once '../config/database.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['produto_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'ID do produto não especificado']);
        exit;
    }
    
    $produto_id = $data['produto_id'];
    $usuario_id = obter_usuario_id();
    
    $stmt = $conn->prepare("SELECT * FROM carrinho WHERE usuario_id = ? AND produto_id = ?");
    $stmt->bind_param("ii", $usuario_id, $produto_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $stmt = $conn->prepare("UPDATE carrinho SET quantidade = quantidade + 1 WHERE usuario_id = ? AND produto_id = ?");
        $stmt->bind_param("ii", $usuario_id, $produto_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO carrinho (usuario_id, produto_id, quantidade) VALUES (?, ?, 1)");
        $stmt->bind_param("ii", $usuario_id, $produto_id);
    }
    
    if ($stmt->execute()) {
        $total_itens = obter_total_itens_carrinho();
        echo json_encode(['status' => 'success', 'message' => 'Produto adicionado ao carrinho', 'total_itens' => $total_itens]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao adicionar ao carrinho']);
    }
}

else if ($method === 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['produto_id']) || !isset($data['acao'])) {
        echo json_encode(['status' => 'error', 'message' => 'Dados incompletos']);
        exit;
    }
    
    $produto_id = $data['produto_id'];
    $acao = $data['acao'];
    $usuario_id = obter_usuario_id();
    
    if ($acao === 'aumentar') {
        $stmt = $conn->prepare("UPDATE carrinho SET quantidade = quantidade + 1 WHERE usuario_id = ? AND produto_id = ?");
        $stmt->bind_param("ii", $usuario_id, $produto_id);
    } 
    else if ($acao === 'diminuir') {
        $stmt = $conn->prepare("SELECT quantidade FROM carrinho WHERE usuario_id = ? AND produto_id = ?");
        $stmt->bind_param("ii", $usuario_id, $produto_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row['quantidade'] > 1) {
            $stmt = $conn->prepare("UPDATE carrinho SET quantidade = quantidade - 1 WHERE usuario_id = ? AND produto_id = ?");
            $stmt->bind_param("ii", $usuario_id, $produto_id);
        } else {
            $stmt = $conn->prepare("DELETE FROM carrinho WHERE usuario_id = ? AND produto_id = ?");
            $stmt->bind_param("ii", $usuario_id, $produto_id);
        }
    }
    
    if ($stmt->execute()) {
        $total_itens = obter_total_itens_carrinho();
        $carrinho = obter_itens_carrinho();
        echo json_encode([
            'status' => 'success', 
            'message' => 'Carrinho atualizado', 
            'total_itens' => $total_itens,
            'carrinho' => $carrinho
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar carrinho']);
    }
}

else if ($method === 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!isset($data['produto_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'ID do produto não especificado']);
        exit;
    }
    
    $produto_id = $data['produto_id'];
    $usuario_id = obter_usuario_id();
    
    $stmt = $conn->prepare("DELETE FROM carrinho WHERE usuario_id = ? AND produto_id = ?");
    $stmt->bind_param("ii", $usuario_id, $produto_id);
    
    if ($stmt->execute()) {
        $total_itens = obter_total_itens_carrinho();
        $carrinho = obter_itens_carrinho();
        echo json_encode([
            'status' => 'success', 
            'message' => 'Item removido do carrinho', 
            'total_itens' => $total_itens,
            'carrinho' => $carrinho
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao remover item do carrinho']);
    }
}

else if ($method === 'GET') {
    $carrinho = obter_itens_carrinho();
    $total_itens = obter_total_itens_carrinho();
    
    echo json_encode([
        'status' => 'success', 
        'total_itens' => $total_itens,
        'carrinho' => $carrinho
    ]);
}