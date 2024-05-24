<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ótica Lebre</title>
    <link rel="stylesheet" href="{{ asset('/css/totem.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/camera.css') }}">
</head>

<body>
    <div id="app">
        <div id="capa">
            <div class="content">
                <img src="{{ asset('/images/logo.png') }}" id="logo" />
            </div>
        </div>

        <div id="content">
        </div>
        <div class="video-container fade-in">
            <div class="camera">
                <video id="video" autoplay></video>
            </div>
            <canvas id="canvas" style="display:none;"></canvas>
            <div class="camera-buttons-container fade-in">
                <div class="camera-button" onclick="closeCamera()">
                    <img src="{{asset('/images/icons/go-back.png')}}">
                </div>
                <div class="camera-button">
                    <img src="{{asset('/images/icons/camera.png')}}">
                </div>
                <div class="camera-button">
                    <img src="{{asset('/images/icons/cronometro.png')}}">
                </div>
            </div>

        </div>


        <div id="footer">
            <div id="footer-btn-1" class="footer-button">
                <img src="{{asset('/images/icons/go-back.png')}}">
            </div>

            <p id="footer-label"><u>Galeria</u></p>
            <div id="footer-btn-2" class="footer-button">
                <img src="{{asset('/images/icons/camera.png')}}">
            </div>
            <span id="footer-btn-span"></span>
            <div id="footer-btn-3" class="footer-button">
                <img src="{{asset('/images/icons/go-back.png')}}">
            </div>
            <div id="footer-btn-4" class="footer-button">
                <img src="{{asset('/images/icons/go-back.png')}}">
            </div>
            <div id="footer-btn-5" class="footer-button">
                <img src="{{asset('/images/icons/go-back.png')}}">
            </div>
            <div id="footer-btn-6" class="footer-button">
                <img src="{{asset('/images/icons/go-back.png')}}">
            </div>
            <div id="footer-btn-7" class="footer-button">
                <img src="{{asset('/images/icons/go-back.png')}}">
            </div>


        </div>

    </div>



    <script src="{{asset('/js/navigation.js')}}"></script>
    <script src="{{asset('/js/camera.js')}}"></script>

    <script>

    </script>
</body>

</html>