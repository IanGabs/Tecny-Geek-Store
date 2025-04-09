<?php
require_once 'config/database.php';

$produtos = [
    [
        'id' => 1,
        'nome' => 'Pelúcia Phoenica - Epithet Erased',
        'preco' => 79.90,
        'imagem' => './imgs/Phoenica.png',
        'descricao' => 'Pelúcia oficial de Epithet Erades'
    ],
    [
        'id' => 2,
        'nome' => 'Hollow Knight Mini Figures',
        'preco' => 59.90,
        'imagem' => './imgs/Hollow_Knight_figures-removebg-preview.png',
        'descricao' => 'Pequenos figurinos de Hollow Knight'
    ],
    [
        'id' => 3,
        'nome' => 'ENA Pop-Up',
        'preco' => 109.90,
        'imagem' => './imgs/Ena-removebg-preview.png',
        'descricao' => 'Camiseta de ENA'
    ],
    [
        'id' => 4,
        'nome' => 'Chaveiro Kinger',
        'preco' => 99.90,
        'imagem' => './imgs/Kinger-removebg-preview.png',
        'descricao' => 'Chaveiro de Kinger de The Amazing Digital Circus'
    ]
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início - Tecny Geek Store</title>
    <link rel="icon" href="./imgs/Tecny__1_-removebg-preview.png" type="image/png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="./imgs/Tecny-removebg-preview.png" alt="Tecny Geek Store">
        </div>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <li><a href="produtos.php">Produtos</a></li>
                <li><a href="carrinho.php">
                    <i class="fas fa-shopping-cart"></i> Carrinho 
                    <span class="carrinho-contador"><?php echo obter_total_itens_carrinho(); ?></span>
                </a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="banner">
            <h1>Bem-vindo à Tecny Geek Store</h1>
            <p>Encontre os produtos dos seus personagens favoritos!</p>
            <a href="produtos.php" class="btn-primary">Ver Produtos</a>
        </section>

        <section class="destaques">
            <h2>Produtos em Destaque</h2>
            <div class="produtos-grid">
                <?php foreach($produtos as $produto): ?>
                    <div class="produto-card">
                        <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>">
                        <h3><?php echo $produto['nome']; ?></h3>
                        <p>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                        <button class="btn-adicionar-carrinho" data-produto-id="<?php echo $produto['id']; ?>">
                            Adicionar ao Carrinho
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="./imgs/Tecny-removebg-preview.png" alt="Tecny Geek Store">
            </div>
            <div class="footer-links">
                <h4>Links Rápidos</h4>
                <ul>
                    <li><a href="sobre.php">Sobre Nós</a></li>
                    <li><a href="contato.php">Contato</a></li>
                    <li><a href="politica-privacidade.php">Política de Privacidade</a></li>
                </ul>
            </div>
            <div class="footer-social">
                <h4>Siga-nos</h4>
                <div class="social-icons">
                    <a href="#" class="fab fa-facebook"></a>
                    <a href="#" class="fab fa-instagram"></a>
                    <a href="#" class="fab fa-twitter"></a>
                </div>
            </div>
        </div>
        <div class="copyright">
            © 2025 Tecny Geek Store. Todos os direitos reservados.
        </div>
    </footer>

    <script src="assets/js/main.js"></script>
</body>
</html>