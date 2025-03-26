document.addEventListener('DOMContentLoaded', () => {
    const carrinhoContainer = document.querySelector('.itens-carrinho');
    
    // Carrega carrinho do localStorage
    function carregarCarrinho() {
        const carrinho = JSON.parse(localStorage.getItem('carrinho') || '{}');
        return carrinho;
    }

    // Salva carrinho no localStorage
    function salvarCarrinho(carrinho) {
        localStorage.setItem('carrinho', JSON.stringify(carrinho));
    }

    // Atualiza contador do carrinho
    function atualizarContador() {
        const carrinho = carregarCarrinho();
        const totalItens = Object.values(carrinho).reduce((a, b) => a + b, 0);
        const carrinhoContador = document.querySelector('.carrinho-contador');
        
        if (carrinhoContador) {
            carrinhoContador.textContent = totalItens;
        }

        // Recarrega página se carrinho estiver vazio
        if (totalItens === 0) {
            location.reload();
        }
    }

    // Event listeners para botões de quantidade e remoção
    if (carrinhoContainer) {
        carrinhoContainer.addEventListener('click', (event) => {
            const carrinho = carregarCarrinho();
            const produtoId = event.target.dataset.produtoId;

            if (event.target.classList.contains('btn-aumentar')) {
                carrinho[produtoId] += 1;
                salvarCarrinho(carrinho);
                location.reload();
            }

            if (event.target.classList.contains('btn-diminuir')) {
                if (carrinho[produtoId] > 1) {
                    carrinho[produtoId] -= 1;
                } else {
                    delete carrinho[produtoId];
                }
                salvarCarrinho(carrinho);
                location.reload();
            }

            if (event.target.classList.contains('btn-remover')) {
                delete carrinho[produtoId];
                salvarCarrinho(carrinho);
                location.reload();
            }

            atualizarContador();
        });
    }

    // Inicializa contador
    atualizarContador();
});