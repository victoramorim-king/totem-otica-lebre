<div id="header-galeria">
  <div id="counter-container">
    <div id="counter"></div>

  </div>
  <div id="galeria-btn-container">
    <button id="select-btn" class="default-btn" style="margin-top:0;"
      onclick="toggleSelectionMode()">Selecionar</button>
    <div id="compare-btn-container">
      <button onclick="compareSelected()" class="default-btn">Comparar</button>
      <button onclick="cancelComparison()" class="neutral-btn">Cancelar</button>
    </div>
  </div>


</div>
<!-- Botão para comparar -->

<!-- Grade de imagens -->
<div id="clientes-gride-container" class="fade-in">
  <div id='clientes-grid-3' class="grid-3">
  </div>
</div>

<!-- Overlay de tela cheia -->
<div id="fullscreen-overlay">
  <div id="" class="modal-close-button-galery">
    <img src="{{asset('/images/icons/close.png')}}">
  </div>
  <img id="fullscreen-image">

</div>

<!-- Botões de comparação -->