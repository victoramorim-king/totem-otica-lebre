var currentPage = ""

function navigateTo(page, images) {
    currentPage = page;
    const content = document.getElementById('content');

    // Fetch the content from the server
    fetch(`/${page}-content`)
        .then(response => response.text())
        .then(html => {
            content.innerHTML = html;
            if (page == 'comparison') {
                changeImage();
                populateCarrossel();
            }
        })
        .catch(error => console.error('Error loading page:', error));
}

function toogleFadeInOut(page) {
    const content = document.getElementById('content').firstChild;
    if (content) {
        if (content.classList) {
            if (content.classList.contains('fade-in')) {
                content.classList.remove('fade-in');
                content.classList.add('fade-out');
            } else {
                content.classList.remove('fade-out');
                content.classList.add('fade-in');
            }
        }
    }
}

function hideFooter() {
    document.querySelector("#footer").style.bottom = '-156px';
}



function showFooter(page) {
    switch (page) {
        case 'galeria':
            currentPage = page
            //document.querySelector("#footer-btn-1").innerHTML = "Voltar ao menu";
            document.getElementById('footer-btn-1').onclick = function () {
                openMenu()
            };
            document.querySelector("#footer-btn-2").style.display = "flex";
            document.getElementById('footer-btn-2').onclick = function () {
                openCamera()
            };

            document.querySelector("#footer-btn-span").style.display = "none";
            document.querySelector("#footer-btn-3").style.display = "none";
            document.querySelector("#footer-btn-4").style.display = "none";
            document.querySelector("#footer-btn-5").style.display = "none";
            document.querySelector("#footer-btn-6").style.display = "none";
            document.querySelector("#footer-btn-7").style.display = "none";

            document.querySelector("#footer-label").innerHTML = "<u>Galeria</u>";
            // document.querySelector("#footer-btn-2").innerHTML = "Abrir Câmera";

            break;
        case 'videos':
            currentPage = page
            // document.querySelector("#footer-btn-1").innerHTML = "Voltar ao menu";
            document.getElementById('footer-btn-1').onclick = function () {
                openMenu();
            };

            document.querySelector("#footer-label").innerHTML = "Vídeos";
            document.querySelector("#footer-btn-2").style.display = "none";
            document.querySelector("#footer-btn-span").style.display = "flex";
            document.querySelector("#footer-btn-3").style.display = "none";
            document.querySelector("#footer-btn-4").style.display = "none";
            document.querySelector("#footer-btn-5").style.display = "none";
            document.querySelector("#footer-btn-6").style.display = "none";
            document.querySelector("#footer-btn-7").style.display = "none";


            break;
        case 'comparison':
            currentPage = page
            document.querySelector("#footer-btn-1").style.display = "none";
            document.querySelector("#footer-label").innerHTML = "Comparação";
            document.querySelector("#footer-label").style.display = "none";

            document.querySelector("#footer-btn-2").style.display = "none";
            document.querySelector("#footer-btn-span").style.display = "none";
            document.querySelector("#footer-btn-3").style.display = "flex";
            document.getElementById('footer-btn-3').onclick = function () {
                openGaleria()
            };
            document.querySelector("#footer-btn-4").style.display = "flex";
            document.getElementById('footer-btn-4').onclick = function () {
                setMode('single')
            };
            document.querySelector("#footer-btn-5").style.display = "flex";
            document.getElementById('footer-btn-5').onclick = function () {
                setMode('double')
            };
            document.querySelector("#footer-btn-6").style.display = "flex";
            document.getElementById('footer-btn-6').onclick = function () {
                setMode('quad')
            };
            document.querySelector("#footer-btn-7").style.display = "flex";
            document.getElementById('footer-btn-7').onclick = function () {
                openMenu()
            };
            break;
        case 'camera':
            currentPage = page
            document.querySelector("#footer-btn-1").innerHTML = "Voltar ao menu";
            document.getElementById('footer-btn-1').onclick = function () {
                hideFooter();
                cabecalhoGrande()
            };

            document.querySelector("#footer-label").innerHTML = "Galeria";
            document.querySelector("#footer-btn-2").innerHTML = "Abrir Câmera";

            break;

        default:
            break;
    }
    document.querySelector("#footer").style.bottom = '0';
}

function openMenu() {
    cabecalhoGrande()
    navigateTo('menu')
    popularGrid('lentes')
    toogleFadeInOut(currentPage)
    hideFooter()

}

function openGaleria() {
    toogleFadeInOut(currentPage)
    cabecalhoGrande()
    navigateTo('galeria')
    showFooter('galeria')
    popularGrid('clientes')
}

function openComparison(images) {
    toogleFadeInOut(currentPage)
    cabecalhoPequeno()
    navigateTo('comparison')
    showFooter('comparison')

}

function changeImage() {
    const carrosselItems = document.querySelectorAll('.carrossel-item');

    // Seleciona a imagem de visualização
    const viewerImage = document.getElementById('viewer-image');

    // Adiciona evento de clique a cada item do carrossel
    carrosselItems.forEach(item => {

        item.addEventListener('click', () => {
            viewerImage.src = item.src; // Atualiza a imagem de visualização com a fonte da imagem clicada
        });
    });
}

function openVideos() {
    //toogleFadeInOut(currentPage)
    cabecalhoGrande()
    navigateTo('videos')
    showFooter('videos')
    popularGridVideos()


}

function openCamera() {
    document.querySelector('.video-container').style.display = 'block'

    // Função para listar dispositivos de mídia
    async function getCameras() {
        const devices = await navigator.mediaDevices.enumerateDevices();
        return devices.filter(device => device.kind === 'videoinput');
    }

    // Função para iniciar a câmera
    async function startCamera(cameraId) {
        const constraints = {
            video: {
                deviceId: cameraId,
                width: { ideal: 3840 },
                height: { ideal: 2160 }
            }
        };

        try {
            const stream = await navigator.mediaDevices.getUserMedia(constraints);
            const video = document.getElementById('video');
            video.srcObject = stream;
        } catch (err) {
            console.error('Erro ao acessar a câmera: ' + err);
        }
    }

    // Listar câmeras e iniciar a câmera correta
    getCameras().then(cameras => {
        if (cameras.length > 0) {
            startCamera(cameras[0].deviceId); // Iniciar a primeira câmera encontrada
        } else {
            console.error('Nenhuma câmera encontrada');
        }
    });

    cabecalhoPequeno()
    toogleFadeInOut(currentPage)
    hideFooter()
}

function closeCamera() {
    openGaleria();
    document.querySelector(".video-container").style.display = "none";
    toogleFadeInOut(currentPage)



}

// Load the home page by default




function popularGrid(tipo) {
    fetch(`/api/images/${tipo}`)
        .then(response => response.json())
        .then(images => {
            const gridContainer = document.getElementById(`${tipo}-grid-3`); // Seleciona a div onde as imagens serão adicionadas

            images.forEach(image => {
                const img = document.createElement('img');
                img.src = image.path;
                gridContainer.appendChild(img); // Adiciona a imagem à div

            });

            // Fechar a visualização em tela cheia ao clicar no overlay
            const fullscreenOverlay = document.getElementById('fullscreen-overlay');
            fullscreenOverlay.addEventListener('click', function () {
                this.style.display = 'none';
            });
        })
        .catch(error => console.error('Erro ao carregar página:', error));
}

function popularGridVideos() {
    fetch('/api/videos')
        .then(response => response.json())
        .then(videos => {
            const gridContainer = document.getElementById('videos-grid-3'); // Seleciona a div onde os vídeos serão adicionados
            gridContainer.innerHTML = ''; // Limpa o conteúdo anterior

            videos.forEach(video => {
                if (video.active) { // Verifica se o vídeo está ativo
                    const videoElement = document.createElement('video');
                    videoElement.src = video.path;
                    videoElement.controls = true;
                    videoElement.width = 320; // Define a largura do vídeo (ajuste conforme necessário)
                    videoElement.height = 240; // Define a altura do vídeo (ajuste conforme necessário)
                    gridContainer.appendChild(videoElement); // Adiciona o vídeo à div
                }
            });
        })
        .catch(error => console.error('Erro ao carregar vídeos:', error));
}



// Chamar a função para popular o grid quando a página carregar
//window.addEventListener('load', popularGrid);


function cabecalhoPequeno() {
    document.getElementById('capa').style.position = 'fixed';
    document.getElementById('capa').style.zIndex = '2';
    document.getElementById('capa').style.height = '14vh';
    document.getElementById('capa').style.width = '200%';
    document.getElementById('capa').style.borderRadius = '0 0 100% 100%';
    document.getElementById('logo').style.width = '10vh';
    document.getElementById('logo').style.marginTop = '50px';
}

function cabecalhoGrande() {
    document.getElementById('capa').style.height = '34vh';
    document.getElementById('capa').style.borderRadius = '0 0 50% 50%';
    document.getElementById('capa').style.position = '';
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
    openMenu();
    currentPage = 'menu';
}, 500); // 5000