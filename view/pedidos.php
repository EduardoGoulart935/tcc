<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seus Pedidos - Ampera</title>
    <link rel="stylesheet" href="/Ampera/view/CSS/suas_ofertas.css">
</head>
<body>

    <div class="container">
        <h1>Seus Pedidos</h1>
        <div id="pedidos-container"></div>
    </div>

    <script>
        function criarCardPedido(pedido) {
            const card = document.createElement('div');
            card.classList.add('pedido-card');

            card.innerHTML = `
                <div class="info">
                    <h2>Data do Pedido: ${pedido.hora_data}</h2>
                    <p>Produto: ${pedido.nome}</p>
                    <p>Descrição: ${pedido.descricao}</p>
                    <button onclick="cancelarPedido(${pedido.id})">Cancelar Pedido</button>
                </div>
            `;
            document.getElementById('pedidos-container').appendChild(card);
        }

        function carregarPedidos() {
            fetch('/Ampera/controller/cards_pedidos.php')
                .then(response => response.json())
                .then(pedidos => {
                    pedidos.forEach(pedido => criarCardPedido(pedido));
                })
                .catch(error => console.error('Erro ao carregar pedidos:', error));
        }

        function cancelarPedido(idPedido) {
            fetch('/Ampera/controller/cancelar_pedido.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id_pedido: idPedido })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Pedido cancelado com sucesso!');
                    location.reload();
                } else {
                    alert('Erro ao cancelar o pedido.');
                }
            })
            .catch(error => console.error('Erro ao cancelar o pedido:', error));
        }

        carregarPedidos();
    </script>
</body>
</html>
