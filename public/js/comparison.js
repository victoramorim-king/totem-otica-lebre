// scripts.js


let draggedImageSrc = null;
let clone = null;
let single = [];
let double = []
let quad = [];
let carroselSelectedImage = null;
let carrosselSelectionMode = false;



function setMode(mode) {
    const viewer = document.getElementById('image-viewer');
    
    selectedImages.forEach(image => {
        if (single.length < 1) {
            single.push(image)
        }

        if (double.length < 2) {
            double.push(image)
        }

        if (quad.length < 4) {
            quad.push(image)
        }

    });
    // Clear existing mode classes
    viewer.className = '';

    // Add the new mode class
    viewer.classList.add(mode);

    // Update images based on the mode
    if (mode === 'single') {
        viewer.innerHTML = `<img src="${single[0]}" id="viewer-image" onclick="swapCarroselImg(this, 'single')">`;
    } else if (mode === 'double') {
        if (double.length == 1) {
            viewer.innerHTML = `
            <img src="${double[0]}" id="viewer-image" onclick="swapCarroselImg(this, 'double')" data-position="0">
            <img src="${double[0]}" id="viewer-image" onclick="swapCarroselImg(this, 'double')" data-position="1">
        `;
        } else {
            viewer.innerHTML = `
            <img src="${double[0]}" id="viewer-image" onclick="swapCarroselImg(this, 'double')" data-position="0">
            <img src="${double[1]}" id="viewer-image" onclick="swapCarroselImg(this, 'double')" data-position="1">
        `;
        }

    } else if (mode === 'quad') {
        viewer.innerHTML = ''
        tmp = 0;
        for (let index = 0; index < 4; index++) {

            viewer.innerHTML += `
            <img src="${quad[tmp]}" id="viewer-image" onclick="swapCarroselImg(this, 'quad')" data-position="${index}">
           `

            if (tmp == quad.length - 1) {
                tmp = 0
            }
            tmp++
        }


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
    single = [];
    double = [];
    quad = [];
    selectedImages.forEach(image => {
        if (single.length < 1) {
            single.push(image)
        }

        if (double.length < 2) {
            double.push(image)
        }

        if (quad.length < 4) {
            quad.push(image)
        }

    });
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
        img.onclick = () => {
            selectImageFromCarrosel(img);
        }

        itemContainer.appendChild(img);
        carrosselContainer.appendChild(itemContainer);
    });
}

function selectImageFromCarrosel(image) {
    // Deselect the previously selected image, if any
    if (carroselSelectedImage) {
        carroselSelectedImage.classList.remove('selected');
    }

    // Select the new image
    image.classList.add('selected');
    carroselSelectedImage = image;
    toggleCarrosselSelectionMode(true)
}

function toggleCarrosselSelectionMode(option) {
    const images = document.querySelectorAll('#image-viewer img');
    carrosselSelectionMode = option;

    images.forEach(img => {
        if (carrosselSelectionMode) {
            img.classList.add('selection-mode');
        } else {
            img.classList.remove('selection-mode');
        }
    });
}

function swapCarroselImg(event, mode) {
    if (carroselSelectedImage) {
        // Swap the src attributes
        event.src = carroselSelectedImage.src;
        if(mode == 'single'){
            single[0] = carroselSelectedImage.src;
        }
        if(mode == 'double'){
            index = event.dataset.position;
            double[index] = carroselSelectedImage.src;
        }

        if(mode == 'quad'){
            index = event.dataset.position;
            quad[index] = carroselSelectedImage.src;
        }


        // Deselect the bottom image after swapping
        carroselSelectedImage.classList.remove('selected');
        carroselSelectedImage = null;
        toggleCarrosselSelectionMode(false);

    }
}
