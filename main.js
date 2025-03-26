document.addEventListener('DOMContentLoaded', () => {
    const addToCartButtons = document.querySelectorAll('.btn-adicionar-carrinho');
    const carrinhoContador = document.querySelector('.carrinho-contador');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const produtoId = event.target.dataset.produtoId;
            
            // Simula adição ao carrinho usando localStorage
            let carrinho = JSON.parse(localStorage.getItem('carrinho') || '{}');
            
            if (carrinho[produtoId]) {
                carrinho[produtoId] += 1;
            } else {
                carrinho[produtoId] = 1;
            }

            localStorage.setItem('carrinho', JSON.stringify(carrinho));

            // Atualiza contador
            const totalItens = Object.values(carrinho).reduce((a, b) => a + b, 0);
            carrinhoContador.textContent = totalItens;

            // Mostra notificação
            mostrarNotificacao('Produto adicionado ao carrinho!');
        });
    });

    function mostrarNotificacao(mensagem) {
        const notificacao = document.createElement('div');
        notificacao.classList.add('notificacao');
        notificacao.textContent = mensagem;
        document.body.appendChild(notificacao);

        setTimeout(() => {
            notificacao.remove();
        }, 3000);
    }

    // Atualiza contador ao carregar a página
    function atualizarContadorCarrinho() {
        const carrinho = JSON.parse(localStorage.getItem('carrinho') || '{}');
        const totalItens = Object.values(carrinho).reduce((a, b) => a + b, 0);
        
        if (carrinhoContador) {
            carrinhoContador.textContent = totalItens;
        }
    }

    atualizarContadorCarrinho();
});