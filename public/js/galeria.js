let selecting = false;
var selectedImages = [];


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
    const gridContainer = document.getElementById('clientes-grid-3');
    gridContainer.classList.remove('select-mode');

    const images = document.querySelectorAll('#clientes-grid-3 img');

    images.forEach(img => {
        if (img.classList.contains('selected')) {
            selectedImages.push(img.src);
        }
    });
    openComparison()

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

