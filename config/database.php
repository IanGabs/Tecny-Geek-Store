<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'tecnygeek';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function obter_usuario_id() {
    global $conn;
    
    if (!isset($_SESSION['session_id'])) {
        $_SESSION['session_id'] = session_id();
    }
    
    $session_id = $_SESSION['session_id'];
    
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE session_id = ?");
    $stmt->bind_param("s", $session_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['id'];
    } else {
        $stmt = $conn->prepare("INSERT INTO usuarios (session_id) VALUES (?)");
        $stmt->bind_param("s", $session_id);
        $stmt->execute();
        return $conn->insert_id;
    }
}

function obter_total_itens_carrinho() {
    global $conn;
    
    $usuario_id = obter_usuario_id();
    
    $stmt = $conn->prepare("SELECT SUM(quantidade) as total FROM carrinho WHERE usuario_id = ?");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    return $row['total'] ? $row['total'] : 0;
}

function obter_itens_carrinho() {
    global $conn;
    
    $usuario_id = obter_usuario_id();
    
    $stmt = $conn->prepare("
        SELECT c.*, p.nome, p.preco, p.imagem
        FROM carrinho c
        JOIN produtos p ON c.produto_id = p.id
        WHERE c.usuario_id = ?
    ");
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $itens = [];
    $total = 0;
    
    while ($row = $result->fetch_assoc()) {
        $subtotal = $row['preco'] * $row['quantidade'];
        $total += $subtotal;
        
        $itens[] = [
            'id' => $row['id'],
            'produto_id' => $row['produto_id'],
            'quantidade' => $row['quantidade'],
            'nome' => $row['nome'],
            'preco' => $row['preco'],
            'imagem' => $row['imagem'],
            'subtotal' => $subtotal
        ];
    }
    
    return [
        'itens' => $itens,
        'total' => $total
    ];
}