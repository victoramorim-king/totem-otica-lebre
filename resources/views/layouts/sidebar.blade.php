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
            <img src="{{ asset('/images/admin/home.png') }}" class="img-fluid" title="home">
            <p>Menu</p>
        </a>
        <a class="menu-button" href="lentes">
            <img src="{{ asset('/images/admin/lentes-de-contato.png') }}" class="img-fluid" title="Lentes de contato">
            <p>Lentes</p>
        </a>
        <a class="menu-button" href="videos">
            <img src="{{ asset('/images/admin/play.png') }}" class="img-fluid" title="Vídeos">
            <p>Videos</p>
        </a>
        <a class="menu-button" href="galeria">
            <img src="{{ asset('/images/admin/galeria.png') }}" class="img-fluid" title="Galeria">
            <p>Galeria</p>
        </a>
        <a class="menu-button" href="/desativados">
            <img src="{{ asset('/images/admin/pasta.png') }}" class="img-fluid" title="Desativados">
            <p>Desativados</p>
        </a>
    </div>
    <div class="account-container">
        <p>Conta</p>
        <a class="menu-button">
            <img src="{{ asset('/images/admin/configuracao.png') }}" class="img-fluid" title="Configuração">
            <p>Configurações</p>
        </a>
        <a class="menu-button" id="logout-button" href="{{ route('logout') }}" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
            <img src="{{ asset('/images/admin/desligar.png') }}" class="img-fluid" title="Desligar">
            <p>Desligar</p>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            
        </a>
    </div>
</aside>
