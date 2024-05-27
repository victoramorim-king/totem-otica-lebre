<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Selector</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        #clientes-grid-3 img {
            cursor: pointer;
            border: 2px solid transparent;
            transition: opacity 0.3s ease-in-out, border 0.3s ease-in-out, max-width 0.3s ease-in-out;
        }

        #clientes-grid-3 img.selected {
            border: 2px solid green;
        }

        #clientes-grid-3 img.unselected {
            opacity: 0.5;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        #fullscreen-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            text-align: center;
            padding-top: 20px;
        }

        #fullscreen-image {
            max-width: 80%;
            max-height: 80%;
            margin: 0 auto;
        }

        #compare-btn-container {
            display: none;
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1001;
        }

        #compare-btn-container button {
            margin: 0 10px;
        }

        .select-mode #clientes-grid-3 img {
            opacity: 0.5;
            transition: transform 0.3s ease;
            transform: scale(0.8);
        }


        .select-mode #clientes-grid-3 img.selected {
            opacity: 1;
            /* Definindo a opacidade completa para imagens selecionadas */
            transform: scale(1);

            /* Restaurando o tamanho original da imagem */
        }

        .select-mode #clientes-grid-3 img.unselected {
            transform: scale(0.8);
            opacity: 0.5;
        }

        #clientes-grid-3 img {
            transition: transform 0.3s ease;
        }

        #clientes-grid-3 img.selected {
            opacity: 1;
            /* Definindo a opacidade completa para imagens selecionadas */
            transform: scale(1);

            /* Restaurando o tamanho original da imagem */
        }

        #clientes-grid-3 img.unselected {
            transform: scale(0.8);
            opacity: 0.5;
        }
    </style>
</head>

<body>
    <h1>Selecionar Imagens</h1>

    <!-- Botão para comparar -->
    <button id="compare-btn" onclick="toggleSelectionMode()">Comparar</button>

    <!-- Grade de imagens -->
    <div id="clientes-gride-container" class="fade-in">
        <div id='clientes-grid-3' class="grid-3">
            <img src="/images/clientes/oculos4.png" onclick="handleImageClick(this)">
            <img src="/images/clientes/oculos4.png" onclick="handleImageClick(this)">
            <img src="/images/clientes/oculos4.png" onclick="handleImageClick(this)">
            <img src="/images/clientes/oculos4.png" onclick="handleImageClick(this)">
        </div>
    </div>

    <!-- Overlay de tela cheia -->
    <div id="fullscreen-overlay">
        <img id="fullscreen-image">
    </div>

    <!-- Botões de comparação -->
    <div id="compare-btn-container">
        <button onclick="compareSelected()">Comparar</button>
        <button onclick="cancelComparison()">Cancelar</button>
    </div>

    <script>
        let selecting = false;

        function openFullscreen(img) {
            const fullscreenOverlay = document.getElementById('fullscreen-overlay');
            const fullscreenImage = document.getElementById('fullscreen-image');

            fullscreenImage.src = img.src;
            fullscreenOverlay.style.display = 'block';
        }

        function toggleSelectionMode() {
            selecting = !selecting;
            const gridContainer = document.getElementById('clientes-grid-3');
            if (selecting) {
                gridContainer.classList.add('select-mode');
                const images = document.querySelectorAll('#clientes-grid-3 img');
                images.forEach(img => {
                    img.addEventListener('click', toggleSelection);
                    img.classList.add('unselected');
                });
                const compareBtnContainer = document.getElementById('compare-btn-container');
                compareBtnContainer.style.display = 'block';
            } else {
                gridContainer.classList.remove('select-mode');
                const images = document.querySelectorAll('#clientes-grid-3 img');
                images.forEach(img => {
                    img.removeEventListener('click', toggleSelection);
                    img.classList.remove('selected');
                    img.classList.remove('unselected');
                });
                const compareBtnContainer = document.getElementById('compare-btn-container');
                compareBtnContainer.style.display = 'none';
            }
        }

        function handleImageClick(img) {
            if (!selecting) {
                openFullscreen(img);
            }
        }

        function toggleSelection(event) {
            const img = event.target;
            if (img.classList.contains('selected')) {
                img.classList.remove('selected');
                img.classList.add('unselected'); // Adicionando a classe 'unselected' ao contêiner da imagem
            } else {
                img.classList.add('selected');
                img.classList.remove('unselected'); // Removendo a classe 'unselected' do contêiner da imagem
            }
        }

        function compareSelected() {
            selecting = false;
            const selectedImages = []; // Array para armazenar os src das imagens selecionadas
            const gridContainer = document.getElementById('clientes-grid-3');
            gridContainer.classList.remove('select-mode');

            const images = document.querySelectorAll('#clientes-grid-3 img');
            images.forEach(img => {
                if (img.classList.contains('selected')) {
                    selectedImages.push(img.src); // Adiciona o src da imagem selecionada ao array
                    img.classList.remove('unselected');
                }
            });

            console.log(selectedImages); // Mostra o array com os src das imagens selecionadas no console

            const compareBtnContainer = document.getElementById('compare-btn-container');
            compareBtnContainer.style.display = 'none';
        }


        function cancelComparison() {
            selecting = false;
            const gridContainer = document.getElementById('clientes-grid-3');
            gridContainer.classList.remove('select-mode');
            const images = document.querySelectorAll('#clientes-grid-3 img');
            images.forEach(img => {
                img.classList.remove('selected');
                img.classList.remove('unselected');
            });

            const compareBtnContainer = document.getElementById('compare-btn-container');
            compareBtnContainer.style.display = 'none';
        }

        // Fechar a visualização em tela cheia ao clicar no overlay
        const fullscreenOverlay = document.getElementById('fullscreen-overlay');
        fullscreenOverlay.addEventListener('click', function () {
            this.style.display = 'none';
        });
    </script>
</body>

</html>