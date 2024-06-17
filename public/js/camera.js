let timerDuration = 0; // Default timer duration in seconds
let timerInterval;
let capturedBlob = null;


function takePicture() {
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');

    const videoWidth = video.videoWidth;
    const videoHeight = video.videoHeight;
    
    // Define the dimensions of the portrait image (9:16)
    const portraitWidth = videoHeight * (9 / 16);
    const portraitHeight = videoHeight;

    // Calculate the offset to center the portrait crop
    const offsetX = (videoWidth - portraitWidth) / 2;

    // Adjust canvas size to portrait dimensions
    canvas.width = portraitWidth;
    canvas.height = portraitHeight;

    // Draw the central part of the video onto the canvas
    context.drawImage(video, offsetX, 0, portraitWidth, portraitHeight, 0, 0, portraitWidth, portraitHeight);

    // Convert the canvas image to a Blob and display it
    canvas.toBlob((blob) => {
        capturedBlob = blob;
        const url = URL.createObjectURL(blob);
        const imagePreview = document.getElementById('image-preview');
        imagePreview.src = url;

        // Show the image preview and buttons
        document.getElementById('image-preview-container').style.display = 'block';
    }, 'image/png');
}

function saveImage() {
    if (!capturedBlob) return;

    const formData = new FormData();
    formData.append('image', capturedBlob, 'photo.png');
    formData.append('category', 'clientes');
    formData.append('active', 'true');

    fetch('/api/images', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(result => {
        console.log(result.message);
        // Hide the image preview and buttons after saving
        document.getElementById('image-preview-container').style.display = 'none';
    })
    .catch(error => {
        console.error('Error uploading image', error);
    });
}

function discardImage() {
    // Hide the image preview and buttons
    document.getElementById('image-preview-container').style.display = 'none';
    // Release the URL object
    URL.revokeObjectURL(document.getElementById('image-preview').src);
    capturedBlob = null;
}

function startTimer() {
    let timeRemaining = timerDuration;
        const timerDisplay = document.getElementById('timerLabel');
        const goBackBtn = document.getElementById('camera-go-back-button');
        const snapkBtn = document.getElementById('camera-snap-button');
        const timerBtn = document.getElementById('camera-timer-button');

        goBackBtn.style.display = 'none';
        timerBtn.style.display = 'none';
        snapkBtn.onclick = null; // Remove temporariamente a função de tirar foto
        timerDisplay.classList.add('active');


        timerDisplay.textContent = timeRemaining;

        timerInterval = setInterval(() => {
            timeRemaining--;
            timerDisplay.textContent = timeRemaining;

            if (timeRemaining <= 0) {
                clearInterval(timerInterval);
                timerDisplay.textContent = timerDuration;
                takePicture();
                goBackBtn.style.display = 'flex';
                timerBtn.style.display = 'flex';
                snapkBtn.onclick = startTimer; // Remove temporariamente a função de tirar foto
                timerDisplay.classList.remove('active');


            }
        }, 1000);
}

// Função para alterar a duração do temporizador
function changeTimer() {
    if (timerDuration === 0) {
        timerDuration = 5;
        document.querySelector('#timerLabel').style.display = 'flex';
        document.querySelector('#camera-timer-button').classList.remove('disabled');
        

    } else if (timerDuration === 5) {
        timerDuration = 10;
        document.querySelector('#camera-timer-button').classList.remove('disabled');
        document.querySelector('#timerLabel').style.display = 'flex';

    } else {
        timerDuration = 0;
        document.querySelector('#camera-timer-button').classList.add('disabled');
        document.querySelector('#timerLabel').style.display = 'none';


    }
    document.querySelector('#timerLabel').innerHTML = timerDuration;

    console.log(`Timer set to ${timerDuration} seconds`);
}
