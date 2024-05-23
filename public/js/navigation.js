var currentPage = ""

function navigateTo(page) {
    currentPage = page;
    const content = document.getElementById('content');

    // Fetch the content from the server
    fetch(`/${page}-content`)
        .then(response => response.text())
        .then(html => {
            content.innerHTML = html;
        })
        .catch(error => console.error('Error loading page:', error));
}

function toogleFadeInOut(page) {
    const content = document.getElementById(page + '-page');

    if (content.classList.contains('fade-in')) {
        content.classList.remove('fade-in');
        content.classList.add('fade-out');
    } else {
        content.classList.remove('fade-out');
        content.classList.add('fade-in');
    }
}

function hideFooter() {
    document.querySelector("#footer").style.bottom = '-156px';
}

function showFooter(page) {
    switch (page) {
        case 'galeria':
            document.querySelector("#footer-btn-1").innerHTML = "Voltar ao menu";
            document.getElementById('footer-btn-1').onclick = function () {
                hideFooter();
                navigateTo('menu');
            };

            document.querySelector("#footer-label").innerHTML = "Galeria";
            document.querySelector("#footer-btn-2").innerHTML = "Abrir Câmera";

            break;
        case 'videos':
            document.querySelector("#footer-btn-1").innerHTML = "Voltar ao menu";
            document.getElementById('footer-btn-1').onclick = function () {
                hideFooter();
                navigateTo('menu');
            };

            document.querySelector("#footer-label").innerHTML = "Vídeos";
            document.querySelector("#footer-btn-2").style.display = "none";
            break;
        case 'comparacao':
            document.querySelector("#footer-btn-1").innerHTML = "Voltar ao menu";
            document.getElementById('footer-btn-1').onclick = function () {
                hideFooter();
                navigateTo('menu');
            };

            document.querySelector("#footer-label").innerHTML = "Galeria";
            document.querySelector("#footer-btn-2").innerHTML = "Abrir Câmera";

            break;

        default:
            break;
    }
    document.querySelector("#footer").style.bottom = '0';
}

function openGaleria() {
    toogleFadeInOut(currentPage)
    navigateTo('galeria')
    showFooter('galeria')
}

function openVideos() {
    toogleFadeInOut(currentPage)
    navigateTo('videos')
    showFooter('videos')

}

function openCamera() {
    cabecalhoPequeno()
    toogleFadeInOut(currentPage)
    navigateTo('camera')
    hideFooter()





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

}

// Load the home page by default
window.onload = function () {
    navigateTo('menu');
    currentPage = 'menu';
};