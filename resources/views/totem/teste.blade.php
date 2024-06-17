<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body>
    <h1>Upload Image</h1>
    <input type="file" id="imageInput">
    <button onclick="uploadImage()">Upload</button>

    <script>
        function uploadImage() {
            const input = document.getElementById('imageInput');
            const file = input.files[0];
            if (!file) {
                console.error('No file selected.');
                return;
            }

            const formData = new FormData();
            formData.append('image', file);

            fetch('/api/images', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Upload successful:', data);
            })
            .catch(error => console.error('Error uploading image:', error));
        }
    </script>
</body>
</html>
