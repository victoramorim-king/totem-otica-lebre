let selecting = false;
var selectedImages = [];


function openFullscreen(img) {
    const fullscreenOverlay = document.getElementById('fullscreen-overlay');
    const fullscreenImage = document.getElementById('fullscreen-image');
    fullscreenOverlay.style.display = 'flex';
    fullscreenImage.src = img.src;
    fullscreenImage.style.width = '100vw'
    document.body.style.overflow = 'hidden';
    document.html.style.overflow = 'hidden';



}

function toggleSelectionMode() {
    selecting = !selecting;
    if (selecting) {
        enableSelectionMode()

    } else {
        cancelSelectionMode()
    }
}

function cancelSelectionMode() {
    const gridContainer = document.getElementById('grid-3');

    gridContainer.classList.remove('select-mode');
    const images = document.querySelectorAll('#grid-3 img');
    images.forEach(img => {
        img.removeEventListener('click', toggleSelection);
        img.classList.remove('selected');
        img.classList.remove('unselected');
    });
    const compareBtnContainer = document.getElementById('compare-btn-container');
    compareBtnContainer.style.display = 'none';
    document.querySelectorAll('.status-icon').forEach((icon) => { icon.style.display = 'flex' })

}

function enableSelectionMode() {
    const gridContainer = document.getElementById('grid-3');

    document.querySelector('#select-btn').style.display = 'none'
    gridContainer.classList.add('select-mode');
    const images = document.querySelectorAll('#grid-3 img');
    images.forEach(img => {
        img.addEventListener('click', toggleSelection);
        img.classList.add('unselected');
    });

    const videos = document.querySelectorAll('#grid-3 video');
    videos.forEach(video => {
        video.addEventListener('click', toggleSelection);
        video.classList.add('unselected');
    });
    const compareBtnContainer = document.getElementById('compare-btn-container');
    compareBtnContainer.style.display = 'flex';
    document.querySelectorAll('.status-icon').forEach((icon) => { icon.style.display = 'none' })
}

function handleImageClick(img) {
    if (!selecting) {
        openFullscreen(img);
    }
}

function toggleSelection(event) {

    const img = event.target;
    if (selecting) {
        if (!img.classList.contains('selected')) {
            img.classList.add('selected');
            img.classList.remove('unselected');
        } else {
            img.classList.remove('selected');
            img.classList.add('unselected');

        }



        // const counterElement = document.querySelector('#counter');
        // if (countImgSelected >= maxSelected) {
        //     counterElement.innerHTML = '<u>Selecionados</u>: <span style="color: red;"> MAX</span>';
        // } else {
        //     counterElement.innerHTML = '<u>Selecionados</u>: ' + countImgSelected;
        // }
    }

}


function compareSelected() {
    selecting = false;
    const gridContainer = document.getElementById('grid-3');
    gridContainer.classList.remove('select-mode');

    const images = document.querySelectorAll('#grid-3 img');

    images.forEach(img => {
        if (img.classList.contains('selected')) {
            deleteImage(img.dataset.imageId)
        }
    });

    const videos = document.querySelectorAll('#grid-3 video');

    videos.forEach(video => {
        if (video.classList.contains('selected')) {
            deleteVideo(video.dataset.videoId)
        }
    });

    const compareBtnContainer = document.getElementById('compare-btn-container');
    compareBtnContainer.style.display = 'none';

    if(currentPage == 'videos'){
        popularGridVideos();
    }else{
        popularGrid(currentPage);
    }
    fecharDangerModal();
}


function cancelComparison() {
    selecting = false;
    document.querySelector('#select-btn').style.display = 'flex'
    // document.querySelector('#counter').style.display = 'none'
    // document.querySelector('#counter').innerHTML = 'Selecionados: 0';


    const gridContainer = document.getElementById('grid-3');
    gridContainer.classList.remove('select-mode');
    const images = document.querySelectorAll('#grid-3 img');
    images.forEach(img => {
        img.classList.remove('selected');
        img.classList.remove('unselected');
    });

    const videos = document.querySelectorAll('#grid-3 video');
    videos.forEach(video => {
        video.classList.remove('selected');
        video.classList.remove('unselected');
    });

    const compareBtnContainer = document.getElementById('compare-btn-container');
    compareBtnContainer.style.display = 'none';
    document.querySelectorAll('.status-icon').forEach((icon) => { icon.style.display = 'flex' })

}

