<div class="video-container">
            <video id="video" autoplay></video>
        </div>
<div id="galeria-page" class="container fade-in">
  <!-- TELA DE EDIÇÃO DE BOTÕES -->

  <div class="divider-screen">
    <div class="content">
      <!-- CRIAR E LIMPAR BOTÃO -->
      <a class="editable-btn create-and-clear-buttons">
        <div class="button-grid">
          <div class="image-container-smaller">
            <button class="add-image-button">
              <div class="button-content">
                <p>+</p>
                <p>Ícone</p>
              </div>
            </button>
            <input type="file" id="image-input" style="display: none;">
          </div>
          <div class="text-container">
            <input class="text-button input-title" id="titulo" type="text" placeholder="Título" />
          </div>
        </div>
      </a>
      <textarea placeholder="Descrição" class="description-input create-and-clear-buttons" id="descricao"></textarea>
      <div class="create-and-clear-buttons action-btn-container"
        style="justify-content: center; align-items: center; gap: 8px;">
        <label for="mostraNoMenu">Mostrar No Menu:</label><br>
        <select class="create-button green-button mostraNoMenu" id="mostrarNoMenuCAD"
          style="padding: 7px; border-radius: 3px; width: 119px;">
          <option value="N">Não</option>
          <option value="S">Sim</option>
        </select>
      </div>
      <div class="create-and-clear-buttons action-btn-container">
        <button class="clear-button create-button">Limpar</button>
        <button class="add-button create-button" id="adicionarLente">Adicionar</button>
      </div>

      <!-- ALTERAR E DESATIVAR BOTÃO -->
      <a class="button change-and-disable-buttons" style="display: none;">
        <div class="button-grid">
          <div class="image-container-smaller">
            <img src="" />
          </div>
          <div class="text-container">
            <input class="text-button input-title" id="tituloAlterar" type="text" placeholder="Título" />
          </div>
        </div>
      </a>
      <textarea placeholder="Descrição" class="description-input change-and-disable-buttons"
        id="descricaoEscondido"></textarea>
      <div class="change-and-disable-buttons action-btn-container"
        style="display: none; justify-content: center; align-items: center; gap: 8px;">
        <label for="mostraNoMenu">Mostrar No Menu:</label><br>
        <select class="create-button green-button mostraNoMenu" style="padding: 7px; border-radius: 3px; width: 119px;">
          <option value="N">Não</option>
          <option value="S">Sim</option>
        </select>

      </div>
      <div class="change-and-disable-buttons action-btn-container" style="display: none;">
        <button class="create-button green-button" id="alterar">Alterar</button>
        <button class="create-button green-button" id="desativar">Desativar</button>
      </div>
      <div class="change-and-disable-buttons action-btn-container" style="display: none;">
        <button class="create-button green-button voltar">Voltar</button>
      </div>
    </div>
    <!-- TELA DO TOTEM -->
    <section class="container">
      <div class="title-container">
        <p class="title">Lentes</p>
      </div>
      <div class="grid-container listaLentes"> </div>
    </section>
  </div>