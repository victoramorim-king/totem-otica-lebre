<!-- Botão para comparar -->
<button id="compare-btn" onclick="toggleSelectionMode()">Comparar</button>

<!-- Grade de imagens -->
<div id="clientes-gride-container" class="fade-in">
  <div id='clientes-grid-3' class="grid-3">
    <img src="/images/clientes/oculos4.png" onclick="handleImageClick(this)">
    <img src="/images/clientes/oculos4.png" onclick="handleImageClick(this)">
    <img src="/images/clientes/oculos4.png" onclick="handleImageClick(this)">
    <img src="/images/clientes/oculos4.png" onclick="handleImageClick(this)">
  </div>
</div>

<!-- Overlay de tela cheia -->
<div id="fullscreen-overlay">
  <img id="fullscreen-image">
</div>

<!-- Botões de comparação -->
<div id="compare-btn-container">
  <button onclick="compareSelected()">Comparar</button>
  <button onclick="cancelComparison()">Cancelar</button>
</div>