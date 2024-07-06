<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixed Sidebar Example</title>
    <link rel="stylesheet" href="{{asset('/css/admin/index.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/cropperjs/dist/cropper.css">
    <style>
        :root {
            --sidebar-width: 25vw;
            --sidebar-header-height: 16vh;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .sidebar {
            height: 100vh;
            width: var(--sidebar-width);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1001;
            background-color: #f8f8f8;
            transition: 0.1s ease-in-out;
        }

        .sidebar a {
            padding: 20px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #2d2d2d;
            display: block;
            margin-left: 15px;
        }

        .sidebar a:hover {
            background-color: #e0e0e0;
            border-radius: 15px 0 0 15px;
            color: black;
        }

        .sidebar-header {
            height: var(--sidebar-header-height);
            background: linear-gradient(to top, #00A554, #05DA72);
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }



        #logo {
            width: 3.96vw;
        }

        .sidebar-footer {
            padding-top: 10px;
            height: 8.08%;
            background-color: #d9d9d9;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .sidebar-footer a {
            padding: 20px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #2d2d2d;
            display: block;
            margin-left: 15px;
        }


        .sidebar-footer a:hover {
            background-color: #f8f8f8;
            border-radius: 15px 0 0 15px;
            color: black;
        }

        .main {
            margin-left: var(--sidebar-width);
            width: calc(100vw - var(--sidebar-width));
            height: calc(100vh - var(--sidebar-header-height));
        }

        .main-content {
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .main-header {
            height: var(--sidebar-header-height);
            background-color: white;
            margin-bottom: 10px;
            box-shadow: 0px 10px 25px 15px #2d2d2d2d;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-around;
            position: fixed;
            right: 0;
            z-index: 1000;

            width: calc(100vw - var(--sidebar-width));
        }

        #compare-btn-container {
            justify-content: space-between;
            gap: 20px;
        }

        #grid-container {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: var(--sidebar-header-height);
            padding: 25px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            width: 80%;
        }




        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .media-container {
            position: relative;
            display: inline-block;
        }

        .status-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 24px;
            height: 24px;
            padding: 10px;
            background: linear-gradient(to top, #707070, #acacac);
            border-radius: 50%;
            cursor: pointer;
        }

        .status-icon.active {
            background: linear-gradient(to top, #00A554, #05DA72);
            ;
        }

        .media-container img,
        .media-container video {
            display: block;
            max-width: 100%;
            border-radius: 15px;

        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            border-radius: 15px;

        }

        .close,
        .closeCrop {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .closeCrop:hover,
        .closeCrop:focus,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        #openModal {
            background: linear-gradient(to top, #00A554, #05DA72);
            width: 6vw;
            height: 6vw;
            border-radius: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            bottom: 30px;
            right: 40px;
            position: fixed;
            transition: ease 0.3s;
            z-index: 1000;

        }

        #openModal:hover {
            transform: scale(0.9);
        }

        #openModal img {
            width: 4.43vw;
        }

        #imageToCrop {
            width: 100%;
            max-height: 70vh;
            object-fit: contain;
        }

        .modal-content-crop {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            margin: auto;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            border-radius: 15px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Estilos para a modal de carregamento */
        .loading-modal {
            display: none;
            /* Inicialmente escondida */
            position: fixed;
            z-index: 999999;
            /* Garante que fique acima de todo o conteúdo */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Fundo escuro semitransparente */
            overflow: auto;
        }

        .loading-modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 200px;
            text-align: center;
            position: relative;
        }

        /* Estilos para o ícone de carregamento */
        .loader {
            border: 4px solid #f3f3f3;
            /* Luz */
            border-top: 4px solid #3498db;
            /* Azul */
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            /* Animação de rotação */
            margin: 0 auto 10px;
            /* Centralizado */
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <img id="logo" src="{{asset('/images/logo.png')}}">
        </div>
        <a href="#" onclick="popularGrid('lentes')">Lentes</a>
        <a href="#" onclick="popularGridVideos()">Vídeos</a>
        <a href="#" onclick="popularGrid('clientes')">Galeria</a>
        <div class="sidebar-footer">
            <a href="#">Sair</a>
        </div>
    </div>

    <div class="main">
        <div class="main-header">
            <span></span>
            <p id="page-title">Lentes</p>
            <button id="select-btn" onclick="toggleSelectionMode()" class="default-btn">Selecionar</button>

            <div id="compare-btn-container">
                <button id="openModalDanger" class="danger-btn">Deletar</button>
                <button onclick="cancelComparison()" class="neutral-btn">Cancelar</button>
            </div>
            <!-- <label for="filtro-grid">Filtro</label>
            <select name="filtros" id="filtro-grid">
                <option value="todos" selected>todos</option>
                <option value="ativos">ativos</option>
                <option value="inativos">inativos</option>
            </select> -->
        </div>


        <div id="openModal">
            <img src="{{asset('/images/icons/upload.png')}}" alt="">
        </div>
        <!-- Modal de carregamento -->
        <div id="loadingModal" class="loading-modal">
            <div class="loading-modal-content">
                <div class="loader"></div>
                <p>Enviando arquivo...</p>
            </div>
        </div>


        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2 id="titulo-modal-imagem">Upload de imagem</h2>
                <p>Escolha qual imagem a imagem que deseja fazer upload.</p>
                <img id='uploadPreviewCanva' src="" alt="">
                <form id="uploadForm" enctype="multipart/form-data" method="POST">
                    <input type="file" class="neutral-btn" name="image" id="image" accept="image/*" required>
                    <input type="text" name="category" id="category" placeholder="Category" required hidden>
                    <input type="checkbox" name="active" id="active" checked hidden>
                    <button type="submit" class="default-btn">Upload</button>
                </form>
            </div>
        </div>

        <div id="modalVideo" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2 id="titulo-modal-Video">Upload de Vídeo</h2>
                <p>Escolha qual video deseja fazer upload.</p>
                <form id="uploadFormVideo" enctype="multipart/form-data" method="POST">
                    <input type="file" class="neutral-btn" name="video" id="video" accept="video/*" required>
                    <input type="checkbox" name="active" id="active" checked hidden>
                    <button type="submit" class="default-btn">Upload</button>
                </form>
            </div>
        </div>

        <div id="dangerModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2 id="titulo-modal-danger">Atenção!</h2>
                <p>Você tem certeza que quer deletar as imagens selecionadas permanentemente?</p>
                <div>
                    <button onclick="compareSelected()" class='danger-btn'>Deletar</button>
                    <button onclick="fecharDangerModal()" class="neutral-btn">Cancelar</button>
                </div>
            </div>
        </div>

        <div id="cropperModal" class="modal">
            <div class="modal-content-crop">
                <span class="closeCrop">&times;</span>
                <h2>Recortar Imagem</h2>
                <div>
                    <img id="imageToCrop">
                </div>
                <button id="cropButton">Recortar</button>
            </div>
        </div>

        <div class="main-content">

            <div id="grid-container" class="fade-in">
                <div id="grid-3" class="grid-3"></div>
            </div>
        </div>
    </div>

    <script>
        currentPage = 'lentes';
        var modal = document.getElementById('modal');
        var modalVideo = document.getElementById('modalVideo');
        var modalDanger = document.getElementById('dangerModal');
        var btn = document.getElementById('openModal');
        var btn2 = document.getElementById('openModalDanger');

        var span = document.getElementsByClassName('close')[0];
        var span2 = document.getElementsByClassName('close')[1];
        var span3 = document.getElementsByClassName('close')[2];




        span.onclick = function () {
            modal.style.display = 'none';
            modalVideo.style.display = 'none';
            document.getElementById('image').value = '';
            document.getElementById('uploadPreviewCanva').src = '';
        }

        span2.onclick = function () {
            modal.style.display = 'none';
            modalVideo.style.display = 'none';

        }

        span3.onclick = function () {
            modal.style.display = 'none';
            modalVideo.style.display = 'none';
            modalDanger.style.display = 'none';

        }

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = 'none';
                document.getElementById('image').value = '';
                document.getElementById('uploadPreviewCanva').src = '';
            }

            if (event.target == modalVideo) {
                modalVideo.style.display = 'none';
            }

            if (event.target == modalDanger) {
                modalDanger.style.display = 'none';
            }
        }

        function fecharDangerModal() {
            modalDanger.style.display = 'none';
        }

        function navigateTo(page) {
            fetch(`/admin/${page}-content`)
                .then(response => response.text())
                .then(html => {
                    document.querySelector('.main-content').innerHTML = html;
                })
                .catch(error => console.error('Error loading page:', error));
        }

        function popularGrid(tipo) {
            if (tipo == 'lentes') {
                document.querySelector('#page-title').innerHTML = "Lentes"
            } else {
                document.querySelector('#page-title').innerHTML = "Galeria"
            }
            cancelComparison();

            btn.onclick = function () {
                modal.style.display = 'block';
                document.querySelector('#category').value = currentPage
                document.querySelector('#titulo-modal-imagem').innerHTML = `Upload de imagem de ${currentPage}`
            }

            btn2.onclick = function () {
                modalDanger.style.display = 'block';

            }

            currentPage = tipo;
            fetch(`/api/images/${tipo}`)
                .then(response => response.json())
                .then(images => {
                    const gridContainer = document.getElementById('grid-3');
                    gridContainer.innerHTML = '';
                    images.forEach(image => {
                        const mediaContainer = document.createElement('div');
                        mediaContainer.className = 'media-container';

                        const imageIcon = document.createElement('img');


                        imageIcon.src = '{{asset('/images/icons/closed-eye.png')}}';

                        const img = document.createElement('img');
                        img.src = '/storage/' + image.path;
                        img.dataset.active = image.active;
                        img.dataset.imageId = image.id;


                        const statusIcon = document.createElement('div');

                        statusIcon.className = 'status-icon';
                        if (image.active) {
                            statusIcon.classList.add('active');
                            imageIcon.src = '{{asset('/images/icons/opened-eye.png')}}';
                        }
                        statusIcon.onclick = () => toggleStatus(statusIcon, image.id);

                        statusIcon.appendChild(imageIcon)
                        mediaContainer.appendChild(img);
                        mediaContainer.appendChild(statusIcon);
                        gridContainer.appendChild(mediaContainer);
                    });
                })
                .catch(error => console.error('Erro ao carregar imagens:', error));
        }

        function popularGridVideos() {
            currentPage = 'vídeos';
            document.querySelector('#page-title').innerHTML = 'Vídeos'
            cancelComparison();
            btn.onclick = function () {
                modalVideo.style.display = 'block';
                document.querySelector('#category').value = currentPage
                document.querySelector('#titulo-modal-imagem').innerHTML = `Upload de imagem de ${currentPage}`
            }
            fetch('/api/videos')
                .then(response => response.json())
                .then(videos => {
                    const gridContainer = document.getElementById('grid-3');
                    gridContainer.innerHTML = '';
                    videos.forEach(video => {
                        const mediaContainer = document.createElement('div');
                        mediaContainer.className = 'media-container';

                        const videoElement = document.createElement('video');
                        videoElement.src = '/storage/' + video.path;
                        videoElement.controls = true;
                        videoElement.width = 350;
                        videoElement.height = 262.5;
                        videoElement.dataset.videoId = video.id;


                        const statusIcon = document.createElement('div');
                        const imageIcon = document.createElement('img');

                        imageIcon.src = '{{asset('/images/icons/closed-eye.png')}}';

                        statusIcon.className = 'status-icon';
                        if (video.active) {
                            statusIcon.classList.add('active');
                            imageIcon.src = '{{asset('/images/icons/opened-eye.png')}}';
                        }
                        statusIcon.onclick = () => toggleStatusVideo(statusIcon, video.id);

                        statusIcon.appendChild(imageIcon)
                        mediaContainer.appendChild(videoElement);
                        mediaContainer.appendChild(statusIcon);
                        gridContainer.appendChild(mediaContainer);
                    });
                })
                .catch(error => console.error('Erro ao carregar vídeos:', error));
        }

        function toggleStatus(icon, imageId) {
            icon.classList.toggle('active');
            let newStatus = icon.classList.contains('active');
            icon.firstChild.src = newStatus ? '{{asset('/images/icons/opened-eye.png')}}' : '{{asset('/images/icons/closed-eye.png')}}';

            // Prepare the data to be sent in the fetch request
            let data = {
                active: newStatus
            };

            // Make the fetch call to update the image status
            fetch(`/api/images/${imageId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    getActiveMediaSources(); // Call this function to refresh media sources
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }

        function toggleStatusVideo(icon, videoId) {
            icon.classList.toggle('active');
            let newStatus = icon.classList.contains('active');
            icon.firstChild.src = newStatus ? '{{asset('/images/icons/opened-eye.png')}}' : '{{asset('/images/icons/closed-eye.png')}}';

            // Prepare the data to be sent in the fetch request
            let data = {
                active: newStatus
            };

            // Make the fetch call to update the image status
            fetch(`/api/videos/${videoId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    getActiveMediaSources(); // Call this function to refresh media sources
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }


        function getActiveMediaSources() {
            const activeIcons = document.querySelectorAll('.status-icon.active');
            const activeSources = [];

            activeIcons.forEach(icon => {
                const mediaContainer = icon.parentElement;
                const mediaElement = mediaContainer.querySelector('img, video');

                if (mediaElement) {
                    activeSources.push(mediaElement.src);
                }
            });

            console.log(activeSources);
            return activeSources;
        }

        document.addEventListener('DOMContentLoaded', () => {
            popularGrid('lentes');
        });

        // Função para exibir a modal de carregamento
        function showLoadingModal() {
            document.getElementById('loadingModal').style.display = 'block';
        }

        // Função para esconder a modal de carregamento
        function hideLoadingModal() {
            document.getElementById('loadingModal').style.display = 'none';
        }

        // Event listener para o formulário de imagens
        document.getElementById('uploadForm').addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);

            showLoadingModal(); // Mostrar modal de carregamento

            fetch('/api/images', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    hideLoadingModal(); // Esconder modal de carregamento após o upload

                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.statusText}`);
                    }
                    return response.text(); // Altere para response.text() se lidar com respostas não JSON
                })
                .then(data => {
                    try {
                        const jsonData = JSON.parse(data); // Tentar analisar JSON
                        console.log('Upload bem-sucedido:', jsonData);
                        alert('Imagem adicionada com sucesso.');
                        modal.style.display = 'none'; // Esconder modal após o upload
                        popularGrid(currentPage); // Atualizar grid, se necessário
                        document.getElementById('image').value = '';
                        document.getElementById('uploadPreviewCanva').src = '';
                    } catch (error) {
                        console.error('Erro ao analisar JSON:', error);
                        console.log('Dados da resposta:', data); // Registrar dados brutos da resposta
                        alert('Falha ao adicionar imagem.');
                        modal.style.display = 'none'; // Esconder modal em caso de falha
                    }
                })
                .catch(error => {
                    console.error('Erro ao enviar imagem:', error);
                    alert('Erro ao enviar imagem. Verifique sua conexão e tente novamente.');
                    hideLoadingModal(); // Esconder modal de carregamento em caso de erro
                });
        });



        document.getElementById('uploadFormVideo').addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);

            showLoadingModal(); // Mostrar modal de carregamento de vídeos

            fetch('/api/videos', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    hideLoadingModal(); // Esconder modal de carregamento de vídeos após o upload

                    if (!response.ok) {
                        throw new Error(`Network response was not ok: ${response.statusText}`);
                    }
                    return response.text(); // Altere para response.text() se lidar com respostas não JSON
                })
                .then(data => {
                    try {
                        const jsonData = JSON.parse(data); // Tentar analisar JSON
                        console.log('Upload de vídeo bem-sucedido:', jsonData);
                        alert('Vídeo adicionado com sucesso!');
                        modalVideo.style.display = 'none'; // Esconder modal de vídeo após o upload
                        popularGridVideos(); // Atualizar grid de vídeos, se necessário
                    } catch (error) {
                        console.error('Erro ao analisar JSON:', error);
                        console.log('Dados da resposta:', data); // Registrar dados brutos da resposta
                        alert('Falha ao tentar adicionar um vídeo.');
                        modalVideo.style.display = 'none'; // Esconder modal de vídeo em caso de falha
                    }
                })
                .catch(error => {
                    console.error('Erro ao enviar vídeo:', error);
                    alert('Erro ao enviar vídeo. Verifique sua conexão e tente novamente.');
                    hideLoadingModal(); // Esconder modal de carregamento de vídeos em caso de erro
                });
        });


        function deleteVideo(videoId) {


            fetch(`/api/videos/${videoId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao deletar o vídeo');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data.message);
                    // Aqui você pode atualizar a interface do usuário para remover o vídeo deletado da lista
                })
                .catch(error => {
                    console.error('Erro:', error);
                });
        }

        function deleteImage(imageId) {
            fetch(`/api/images/${imageId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erro ao deletar o vídeo');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data.message);
                    // Aqui você pode atualizar a interface do usuário para remover o vídeo deletado da lista
                })
                .catch(error => {
                    console.error('Erro:', error);
                });
        }
    </script>
    <script src="{{asset('/js/admin/galeria.js')}}"></script>
    <script src="https://unpkg.com/cropperjs"></script>
    <script>
        let cropper;
        const cropperModal = document.getElementById('cropperModal');
        const imageToCrop = document.getElementById('imageToCrop');
        const cropButton = document.getElementById('cropButton');
        const imageInput = document.getElementById('image');
        const closeModal = document.querySelector('.closeCrop');

        // Abrir o modal de recorte ao selecionar uma imagem
        imageInput.addEventListener('change', (event) => {
            const files = event.target.files;
            if (files && files.length > 0) {
                const reader = new FileReader();
                reader.onload = () => {
                    imageToCrop.src = reader.result;
                    cropperModal.style.display = 'block';

                    // Inicializar o Cropper.js
                    cropper = new Cropper(imageToCrop, {
                        aspectRatio: 240 / 160,
                        viewMode: 1,
                        autoCropArea: 1,
                    });
                };
                reader.readAsDataURL(files[0]);
            }
        });

        // Fechar o modal
        closeModal.onclick = function () {
            cropperModal.style.display = 'none';
            cropper.destroy();
            modal.style.display = 'none';
            document.getElementById('image').value = '';
            document.getElementById('uploadPreviewCanva').src = '';
        };

        // Recortar a imagem e fazer upload
        cropButton.addEventListener('click', () => {
            const canvas = cropper.getCroppedCanvas({
                width: 240,
                height: 160,
            });

            canvas.toBlob((blob) => {
                const url = URL.createObjectURL(blob);

                // Atualiza a imagem no elemento img com id 'uploadPreviewCanva'
                const previewImage = document.getElementById('uploadPreviewCanva');
                previewImage.src = url;

                // Cria um arquivo de imagem e coloca no input de id 'image'
                const fileInput = document.getElementById('image');
                const dataTransfer = new DataTransfer();
                const file = new File([blob], 'imagemRecortada.jpg', { type: 'image/jpeg' });

                dataTransfer.items.add(file);
                fileInput.files = dataTransfer.files;

                cropperModal.style.display = 'none';
                cropper.destroy();
                alert('Imagem recortada com sucesso!');
            });
        });

        // Fechar o modal ao clicar fora dele
        window.onclick = function (event) {
            if (event.target === cropperModal) {
                cropperModal.style.display = 'none';
                cropper.destroy();
                modal.style.display = 'none';
                document.getElementById('image').value = '';
                document.getElementById('uploadPreviewCanva').src = '';

            }

        };
    </script>
</body>

</html>