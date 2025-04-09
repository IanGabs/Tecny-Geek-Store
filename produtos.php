<?php
$produtos = [
    [
        'id' => 1,
        'nome' => 'Pelúcia Smiling Critters',
        'preco' => 79.90,
        'imagem' => 'assets/images/smiling-critters.jpg',
        'descricao' => 'Pelúcia oficial dos adoráveis Smiling Critters'
    ],
    [
        'id' => 2,
        'nome' => 'Pelúcia Huggy Wuggy',
        'preco' => 89.90,
        'imagem' => 'assets/images/huggy-wuggy.jpg',
        'descricao' => 'Pelúcia do famoso personagem Huggy Wuggy'
    ],
    [
        'id' => 3,
        'nome' => 'Pelúcia Kissy Missy',
        'preco' => 79.90,
        'imagem' => 'assets/images/kissy-missy.jpg',
        'descricao' => 'Pelúcia da adorável Kissy Missy'
    ],
    [
        'id' => 4,
        'nome' => 'Pelúcia Poppy Playtime',
        'preco' => 99.90,
        'imagem' => 'assets/images/poppy-playtime.jpg',
        'descricao' => 'Pelúcia do universo Poppy Playtime'
    ],
    [
        'id' => 5,
        'nome' => 'Pelúcia Catnap',
        'preco' => 69.90,
        'imagem' => 'assets/images/catnap.jpg',
        'descricao' => 'Pelúcia do adorável Catnap'
    ],
    [
        'id' => 6,
        'nome' => 'Pelúcia Dogday',
        'preco' => 74.90,
        'imagem' => 'assets/images/dogday.jpg',
        'descricao' => 'Pelúcia do divertido Dogday'
    ]
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Tecny Geek Store</title>
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
                    <span class="carrinho-contador">0</span>
                </a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="produtos-catalogo">
            <h1>Nossos Produtos</h1>
            <div class="produtos-grid">
                <?php foreach($produtos as $produto): ?>
                    <div class="produto-card">
                        <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>">
                        <h3><?php echo $produto['nome']; ?></h3>
                        <p>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                        <p><?php echo $produto['descricao']; ?></p>
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
                <img src="assets/images/logo.png" alt="Tecny Geek Store">
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