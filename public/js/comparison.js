// scripts.js

let draggedImageSrc = null;
let clone = null;

function setMode(mode) {
    const viewer = document.getElementById('image-viewer');

    // Clear existing mode classes
    viewer.className = '';

    // Add the new mode class
    viewer.classList.add(mode);

    // Update images based on the mode
    if (mode === 'single') {
        viewer.innerHTML = `<img src="/images/clientes/oculos4.png" id="viewer-image" ondrop="drop(event)" ondragover="allowDrop(event)" ontouchstart="touchStart(event)" ontouchmove="touchMove(event)" ontouchend="touchEnd(event)">`;
    } else if (mode === 'double') {
        viewer.innerHTML = `
            <img src="/images/clientes/oculos4.png" id="viewer-image" ondrop="drop(event)" ondragover="allowDrop(event)" ontouchstart="touchStart(event)" ontouchmove="touchMove(event)" ontouchend="touchEnd(event)">
            <img src="/images/clientes/oculos4.png" id="viewer-image" ondrop="drop(event)" ondragover="allowDrop(event)" ontouchstart="touchStart(event)" ontouchmove="touchMove(event)" ontouchend="touchEnd(event)">
        `;
    } else if (mode === 'quad') {
        viewer.innerHTML = `
            <img src="/images/clientes/oculos4.png" id="viewer-image" ondrop="drop(event)" ondragover="allowDrop(event)" ontouchstart="touchStart(event)" ontouchmove="touchMove(event)" ontouchend="touchEnd(event)">
            <img src="/images/clientes/oculos4.png" id="viewer-image" ondrop="drop(event)" ondragover="allowDrop(event)" ontouchstart="touchStart(event)" ontouchmove="touchMove(event)" ontouchend="touchEnd(event)">
            <img src="/images/clientes/oculos4.png" id="viewer-image" ondrop="drop(event)" ondragover="allowDrop(event)" ontouchstart="touchStart(event)" ontouchmove="touchMove(event)" ontouchend="touchEnd(event)">
            <img src="/images/clientes/oculos4.png" id="viewer-image" ondrop="drop(event)" ondragover="allowDrop(event)" ontouchstart="touchStart(event)" ontouchmove="touchMove(event)" ontouchend="touchEnd(event)">
        `;
    }
}

function allowDrop(event) {
    event.preventDefault();
}

function drag(event) {
    draggedImageSrc = event.target.src;
    event.dataTransfer.setData("text", event.target.src);
    clone = event.target.cloneNode(true);
    clone.classList.add('dragging');
    document.body.appendChild(clone);
}

function drop(event) {
    event.preventDefault();
    const data = event.dataTransfer ? event.dataTransfer.getData("text") : draggedImageSrc;
    if (data) {
        event.target.src = data;
    }
    if (clone) {
        document.body.removeChild(clone);
        clone = null;
    }
}

function touchStart(event) {
    const touch = event.touches[0];
    draggedImageSrc = event.target.src;
    clone = event.target.cloneNode(true);
    clone.classList.add('dragging');
    clone.style.left = `${touch.clientX}px`;
    clone.style.top = `${touch.clientY}px`;
    document.body.appendChild(clone);
    event.target.initialX = touch.clientX;
    event.target.initialY = touch.clientY;
}

function touchMove(event) {
    event.preventDefault();
    const touch = event.touches[0];
    const dx = touch.clientX - event.target.initialX;
    const dy = touch.clientY - event.target.initialY;
    if (clone) {
        clone.style.left = `${touch.clientX}px`;
        clone.style.top = `${touch.clientY}px`;
    }
}

function touchEnd(event) {
    event.preventDefault();
    const touch = event.changedTouches[0];
    const dropTarget = document.elementFromPoint(touch.clientX, touch.clientY);
    if (dropTarget && dropTarget.tagName === "IMG" && dropTarget !== event.target) {
        dropTarget.src = draggedImageSrc;
    }
    if (clone) {
        document.body.removeChild(clone);
        clone = null;
    }
    draggedImageSrc = null;
}

function populateCarrossel() {
    const carrosselContainer = document.querySelector('.carrossel');
    
    // Limpa o carrossel antes de adicionar novas imagens
    carrosselContainer.innerHTML = '';
    // Percorre o array de URLs de imagens e cria os elementos de imagem
    selectedImages.forEach(src => {
        const itemContainer = document.createElement('div');
        itemContainer.className = 'carrossel-item-container';

        const img = document.createElement('img');
        img.src = src;
        img.className = 'carrossel-item';
        img.draggable = true;
        img.ondragstart = drag;
        img.ontouchstart = touchStart;
        img.ontouchmove = touchMove;
        img.ontouchend = touchEnd;

        itemContainer.appendChild(img);
        carrosselContainer.appendChild(itemContainer);
    });
}

