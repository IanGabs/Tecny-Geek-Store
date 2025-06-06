<?php
require_once 'config/database.php';

$carrinho_dados = obter_itens_carrinho();
$itens_carrinho = $carrinho_dados['itens'];
$total = $carrinho_dados['total'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho - Tecny Geek Store</title>
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
        <section class="carrinho">
            <h1>Seu Carrinho</h1>
            
            <?php if (empty($itens_carrinho)): ?>
                <div class="carrinho-vazio">
                    <p>Seu carrinho está vazio.</p>
                    <a href="produtos.php" class="btn-primary">Continuar Comprando</a>
                </div>
            <?php else: ?>
                <div class="itens-carrinho">
                    <?php foreach ($itens_carrinho as $item): ?>
                        <div class="item-carrinho">
                            <img src="<?php echo $item['imagem']; ?>" alt="<?php echo $item['nome']; ?>">
                            <div class="item-detalhes">
                                <h3><?php echo $item['nome']; ?></h3>
                                <p>Preço: R$ <?php echo number_format($item['preco'], 2, ',', '.'); ?></p>
                                <div class="quantidade">
                                    <button class="btn-diminuir" data-produto-id="<?php echo $item['produto_id']; ?>">-</button>
                                    <span><?php echo $item['quantidade']; ?></span>
                                    <button class="btn-aumentar" data-produto-id="<?php echo $item['produto_id']; ?>">+</button>
                                </div>
                                <p>Subtotal: R$ <?php echo number_format($item['subtotal'], 2, ',', '.'); ?></p>
                                <button class="btn-remover" data-produto-id="<?php echo $item['produto_id']; ?>">Remover</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="resumo-carrinho">
                    <h2>Resumo do Pedido</h2>
                    <p>Total: R$ <?php echo number_format($total, 2, ',', '.'); ?></p>
                    <a href="finalizar-compra.php" class="btn-primary">Finalizar Compra</a>
                </div>
            <?php endif; ?>
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

    <script src="assets/js/carrinho.js"></script>
</body>
</html>