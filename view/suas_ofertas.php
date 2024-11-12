<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suas Ofertas - Ampera</title>
    <link rel="stylesheet" href="/Ampera/view/CSS/suas_ofertas.css">
    <style>
        /* Estilos básicos para a modal */
        .modal {
            display: none; 
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); 
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Suas Ofertas</h1>
        <div id="ofertas-container"></div>
    </div>

    <!-- Modal para editar ofertas -->
    <div id="editarModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="fecharModal()">&times;</span>
            <h2>Editar Oferta</h2>
            <form id="formEditarOferta">
                <input type="hidden" id="id_oferta">
                <label for="nome">Nome da Oferta:</label>
                <input type="text" id="nome_oferta" required><br><br>

                Status:
                    <select name="status" id="status" required>
                        <option value="A">Ativo</option>
                        <option value="I">Inativo</option>
                    </select>
                <br>
                <label for="descricao">Descrição:</label>
                <input type="text" id="descricao_oferta" required><br><br>

                <label for="categoria">Categoria:</label>
                <input type="text" id="categoria_oferta" required><br><br>

                <label for="contato">Contato:</label>
                <input type="text" id="contato_oferta" required><br><br>

                <button type="button" onclick="salvarEdicao()">Salvar</button>
            </form>
        </div>
    </div>

    <script>
        function criarCardOferta(oferta) {
            const card = document.createElement('div');
            card.classList.add('oferta-card');

            card.innerHTML = `
                <div class="image">
                    <img src="/Ampera/imagens/${oferta.nome_foto}" alt="${oferta.nome}">
                </div>
                <div class="info">
                    <h2>${oferta.nome}</h2>
                    <h2>${oferta.status}</h2>
                    <p>${oferta.descricao}</p>
                    <p>ID: ${oferta.id}</p>
                    <p><strong>Categoria:</strong> ${oferta.categoria}</p>
                    <p><strong>Contato:</strong> ${oferta.contato}</p>
                    <p><strong>Email:</strong> ${oferta.email}</p>
                    <div class="buttons">
                        <button class="edit-button" onclick="abrirModal(${oferta.id}, '${oferta.nome}', 
                        '${oferta.status}', '${oferta.descricao}', '${oferta.categoria}', '${oferta.contato}')">Editar</button>
                        <button class="delete-button" onclick="excluirOferta(${oferta.id})">Excluir</button>
                    </div>
                </div>
            `;
            document.getElementById('ofertas-container').appendChild(card);
        }

        function abrirModal(id, nome, status, descricao, categoria, contato) {
            document.getElementById('id_oferta').value = id;
            document.getElementById('nome_oferta').value = nome;
            document.getElementById('status').value = status;
            document.getElementById('descricao_oferta').value = descricao;
            document.getElementById('categoria_oferta').value = categoria;
            document.getElementById('contato_oferta').value = contato;

            // Exibe a modal
            document.getElementById('editarModal').style.display = 'block';
        }

        function fecharModal() {
            document.getElementById('editarModal').style.display = 'none';
        }

        function salvarEdicao() {
            const id = document.getElementById('id_oferta').value;
            const nome = document.getElementById('nome_oferta').value;
            const status = document.getElementById('status').value;
            const descricao = document.getElementById('descricao_oferta').value;
            const categoria = document.getElementById('categoria_oferta').value;
            const contato = document.getElementById('contato_oferta').value;

            const dadosAtualizados = {
                id_oferta: id,
                nome: nome,
                status: status,
                descricao: descricao,
                categoria: categoria,
                contato: contato
            };

            fetch('/Ampera/controller/editar_oferta.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(dadosAtualizados)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Oferta editada com sucesso!');
                    location.reload(); // Atualiza a página
                } else {
                    alert('Erro ao editar oferta.');
                }
            })
            .catch(error => console.error('Erro ao editar oferta:', error));
        }

        // Carregar ofertas do backend
        fetch('/Ampera/controller/cards_suasOfertas.php')
            .then(response => response.json())
            .then(ofertas => {
                ofertas.forEach(oferta => criarCardOferta(oferta));
            })
            .catch(error => console.error('Erro ao carregar ofertas:', error));

        // Fechar a modal ao clicar fora dela
        window.onclick = function(event) {
            if (event.target == document.getElementById('editarModal')) {
                fecharModal();
            }
        }
    </script>

</body>

</html>
