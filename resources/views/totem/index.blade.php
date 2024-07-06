<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ótica Lebre</title>
    <link rel="stylesheet" href="{{ asset('/css/totem.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/camera.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/comparison.css') }}">
    <style>
        .video-thumbnail {
            cursor: pointer;
            width: 100%;
            border-radius: 15px;
            height: 100%;
            box-shadow: -4px 10px 25px 7px rgba(45, 45, 45, 0.1);     
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe00;
            /* margin: 60% 0 0 0; */
            width: 100vw;
        }

        .modal-close-button {
            display: flex;
            position: absolute;
            border: #ccc solid 4px;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            width: var(--largura-altura-icone-navegacao);
            height: var(--largura-altura-icone-navegacao);
            background-color: var(--fundo-escuro-transparente);
            border-radius: var(--curvatura-bordas-icone-navegacao);
            left: 50%;
            transform: translate(-50%, -200px);
            transition: 0.1s ease;


        }

        .modal-close-button-galery {
            display: flex;
            position: absolute;
            border: #ccc solid 4px;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            width: var(--largura-altura-icone-navegacao);
            height: var(--largura-altura-icone-navegacao);
            background-color: var(--fundo-escuro-transparente);
            border-radius: var(--curvatura-bordas-icone-navegacao);
            left: 50%;
            transform: translate(-50%, 88vh);
            transition: 0.1s ease;


        }

        .modal-close-button-galery:hover {
            transform: translate(-50%, 88vh) scale(0.9);
            ;
        }

        .modal-close-button:hover {
            transform: scale(0.9);
            transform: translate(-50%, -200px);
        }

        .modal-close-button>img {
            width: 55px;
        }

        html, body{
            overflow-y: auto;
        }
    </style>

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
                <div id="camera-go-back-button" class="camera-button" onclick="closeCamera()">
                    <img src="{{asset('/images/icons/go-back.png')}}">
                </div>
                <div id="camera-snap-button" class="camera-button" onclick="startTimer()">
                    <span id='timerLabel' class="timerLabel">10</span>
                    <img src="{{asset('/images/icons/camera.png')}}">
                </div>
                <div id="camera-timer-button" class="camera-button disabled" onclick="changeTimer()">
                    <img src="{{asset('/images/icons/cronometro.png')}}">
                </div>
            </div>

            <div id="image-preview-container" style="display:none;">
                <img id="image-preview" alt="Captured Image">
                <div id="preview-buttons-container">
                    <div id="save-button" class="camera-button" onclick="saveImage()">
                        <img src="{{asset('/images/icons/save.png')}}">
                    </div>
                    <div id="discard-button" class="camera-button" onclick="discardImage()">
                        <img src="{{asset('/images/icons/trash.png')}}">
                    </div>
                </div>
            </div>
        </div>



        <!-- Modal Structure -->
        <div id="videoModal" class="modal">
            <div class="modal-content">
                <video id="modalVideo" controls width="100%"></video>
            </div>
            <div id="closeModalBtn" class="modal-close-button">
                <img src="{{asset('/images/icons/close.png')}}">
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
                <img src="{{asset('/images/icons/gallery.png')}}">

            </div>

            <div id="footer-btn-4" class="footer-button">
                <img src="{{asset('/images/icons/square.png')}}">
            </div>
            <div id="footer-btn-5" class="footer-button" onclick="setMode('double')">
                <img src="{{asset('/images/icons/square-2.png')}}" style="width:6.2vw;">

            </div>
            <div id="footer-btn-6" class="footer-button" onclick="setMode('quad')">
                <img src="{{asset('/images/icons/square-4.png')}}">
            </div>
            <div id="footer-btn-7" class="footer-button">
                <img src="{{asset('/images/icons/home.png')}}">
            </div>


        </div>

    </div>



    <script src="{{asset('/js/navigation.js')}}"></script>
    <script src="{{asset('/js/camera.js')}}"></script>
    <script src="{{asset('/js/comparison.js')}}"></script>
    <script src="{{asset('/js/galeria.js')}}"></script>


    <script>

    </script>
</body>

</html>