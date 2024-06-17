let selecting = false;
var selectedImages = [];


function openFullscreen(img) {
    const fullscreenOverlay = document.getElementById('fullscreen-overlay');
    const fullscreenImage = document.getElementById('fullscreen-image');
    fullscreenOverlay.style.display = 'flex';
    fullscreenImage.src = img.src;
    fullscreenImage.style.width = '100vw'
}

function toggleSelectionMode() {
    selecting = !selecting;
    const gridContainer = document.getElementById('clientes-grid-3');
    if (selecting) {
        document.querySelector('#counter').style.display = 'flex'
        document.querySelector('#select-btn').style.display = 'none'
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
    const maxSelected = 10;
    let countImgSelected = document.querySelectorAll('.selected').length;
    if (selecting) {
        if (!img.classList.contains('selected')) {
            if (countImgSelected < maxSelected) {
                img.classList.add('selected');
                img.classList.remove('unselected');
                countImgSelected++;
            }
        } else {
            img.classList.remove('selected');
            img.classList.add('unselected');
            countImgSelected--;
        }

        const counterElement = document.querySelector('#counter');
        if (countImgSelected >= maxSelected) {
            counterElement.innerHTML = '<u>Selecionados</u>: <span style="color: red;"> MAX</span>';
        } else {
            counterElement.innerHTML = '<u>Selecionados</u>: ' + countImgSelected;
        }
    }

}


function compareSelected() {
    let countImgSelected = document.querySelectorAll('.selected').length;
    if (countImgSelected > 0) {


        selecting = false;
        const gridContainer = document.getElementById('clientes-grid-3');
        gridContainer.classList.remove('select-mode');

        const images = document.querySelectorAll('#clientes-grid-3 img');
        selectedImages = [];
        images.forEach(img => {
            if (img.classList.contains('selected')) {
                selectedImages.push(img.src);
            }
        });
        openComparison()

        const compareBtnContainer = document.getElementById('compare-btn-container');
        compareBtnContainer.style.display = 'none';
    }
}


function cancelComparison() {
    selecting = false;
    document.querySelector('#select-btn').style.display = 'flex'
    document.querySelector('#counter').style.display = 'none'
    document.querySelector('#counter').innerHTML = 'Selecionados: 0';


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

