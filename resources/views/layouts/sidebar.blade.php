<aside class="sidebar">
    <div class="profile-container">
        <div class="profile-icon">R</div>
        <div>
            <p class="name">Rodrigo</p>
            <p class="role">CEO</p>
        </div>
    </div>
    <p class="subtitle">Principal</p>
    <div class="buttons-container">
        <a class="menu-button menu-button-active">
            <img src="../images/home.png" />
            <p>Menu</p>
        </a>
        <a class="menu-button" href="./lentes.php">
            <img src="../images/lentes-de-contato.png" />
            <p>Lentes</p>
        </a>
        <a class="menu-button" href="./videos.php">
            <img src="../images/play.png" />
            <p>Videos</p>
        </a>
        <a class="menu-button" href="./galeria.php">
            <img src="../images/galeria.png" />
            <p>Galeria</p>
        </a>
        <a class="menu-button" href="./desativados.php">
            <img src="../images/pasta.png" />
            <p>Desativados</p>
        </a>
    </div>
    <div class="account-container">
        <p>Conta</p>
        <a class="menu-button" href="./configuracoes.php">
            <img src="../images/configuracao.png" />
            <p>Configurações</p>
        </a>
        <a class="menu-button" id="logout-button">
            <img src="../images/desligar.png" />
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </a>
    </div>
</aside>