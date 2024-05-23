<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ótica Lebre</title>
    <link rel="stylesheet" href="{{ asset('/css/totem.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/camera.css') }}">
</head>

<body>
    <div id="app">
        <div id="capa">
            <div class="content">
                <img src="{{ asset('/images/logo.png') }}" id="logo" />
            </div>
        </div>
        <div id="content">
        </div>
       
        <div id="footer">
            <button id="footer-btn-1">Voltar</button>
            <p id="footer-label">Galeria</p>
            <button id="footer-btn-2">Abrir Camera</button>
        </div>

    </div>



    <script src="{{asset('/js/navigation.js')}}"></script>
    <script src="{{asset('/js/camera.js')}}"></script>

    <script>
        const gridContainer = document.getElementById('lentes-grid-3');

        // Função para criar e adicionar os elementos de imagem ao grid
        function popularGrid() {
            lentes.forEach(lente => {
                const iconContainer = document.createElement('div');
                iconContainer.classList.add('icon-container');

                const img = document.createElement('img');
                img.src = lente.src;

                iconContainer.appendChild(img);
                gridContainer.appendChild(iconContainer);
            });
        }

        // Chamar a função para popular o grid quando a página carregar
        window.addEventListener('load', popularGrid);


        function cabecalhoPequeno() {
            document.getElementById('capa').style.height = '14vh';
            document.getElementById('capa').style.width = '200%';
            document.getElementById('capa').style.borderRadius = '0 0 100% 100%';
            document.getElementById('logo').style.width = '10vh';
            document.getElementById('logo').style.marginTop = '50px';
        }

        function cabecalhoGrande() {
            document.getElementById('capa').style.height = '34vh';
            document.getElementById('capa').style.borderRadius = '0 0 50% 50%';
            document.getElementById('logo').style.width = '23vh';
            document.getElementById('logo').style.marginTop = '200px';
        }

        function cabecalhoCapa() {
            document.getElementById('capa').style.height = '200%';
            document.getElementById('capa').style.borderRadius = '0 0 0 0';
            document.getElementById('logo').style.width = '30vh';
            document.getElementById('logo').style.marginTop = '-200px';
        }

        setTimeout(function () {
            document.getElementById('logo').classList.add('show');
        }, 200); // 2000

        setTimeout(function () {
            cabecalhoGrande();
        }, 500); // 5000
    </script>
</body>

</html>