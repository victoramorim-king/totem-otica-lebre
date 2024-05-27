<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fixed Sidebar Example</title>
    <style>
        :root {
            --sidebar-width: 25vw;
            --sidebar-header-height: 16vh;

        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .sidebar {
            height: 100vh;
            /* Full-height */
            width: var(--sidebar-width);
            /* Width of the sidebar */
            position: fixed;
            /* Fixed Sidebar (stay in place on scroll) */
            top: 0;
            /* Stay at the top */
            left: 0;
            background-color: #f8f8f8;
            box-shadow: 0px 0px 10px 5px #2d2d2d1d;
            /* Black */
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #2d2d2d;
            display: block;
            margin-left: 15px;
            padding: 20px;
        }

        .sidebar a:hover {
            color: #f1f1f1;
            background-color: white;
            border-radius: 15px 0 0 15px;
            margin-left: 15px;
            padding: 20px;
            color: black;
        }

        .sidebar-header {
            height: var(--sidebar-header-height);
            background-color: green;
            margin-bottom: 10px;
        }

        .sidebar-footer {
            padding-top: 10px;
            height: 8.08%;
            background-color: grey;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .main {
            margin-left: var(--sidebar-width);
            /* Same as the width of the sidebar */
            padding: 0;
            width: calc(100vw - var(--sidebar-width));
            height: calc(100vh - var(--sidebar-header-height));
        }

        .main-content {
            position: relative;
            padding: 16px;
            width: 100%%;
            height: calc(100vh - (var(--sidebar-header-height) * 2));
        }

        .main-header {
            height: var(--sidebar-header-height);
            background-color: transparent;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-header">

        </div>
        <a href="#" onclick="navigateTo('lentes')">Lentes</a>
        <a href="#"  onclick="navigateTo('videos')">Vídeos</a>
        <a href="#"  onclick="navigateTo('galeria')">Galeria</a>
        <div class="sidebar-footer">
            <a href="#">Sair</a>
        </div>

    </div>

    <div class="main">
        <div class="sidebar-header">
            lentes
        </div>
        <div class="main-content">

        </div>


    </div>
    <script>
        function navigateTo(page) {
            const content = document.querySelector('.main-content');

            // Fetch the content from the server
            fetch(`/admin/${page}-content`)
                .then(response => response.text())
                .then(html => {
                    content.innerHTML = html;
                   
                })
                .catch(error => console.error('Error loading page:', error));
        }
    </script>
</body>

</html>