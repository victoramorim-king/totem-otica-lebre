$(document).ready(function () {

  $.ajax({
    url: '../assets/includes/xhr.buscaDesativados.php',
    type: 'POST',
    dataType: 'json',
    success: function (data) {
      var htmlLentes = "";
      var htmlMenus = "";
      var htmlVideos = "";

      $.each(data, function (i, arr) {
        $.each(arr, function (tabela, valores) {
          $.each(valores, function (codigo, v3) {
            if (tabela == 'lentes') {
              htmlLentes += "<div class='button-container' style='padding: 5px;'>";
              htmlLentes += " <a class='button'>";
              htmlLentes += "   <div class='button-grid'>";
              htmlLentes += "     <div class='image-container'>";
              htmlLentes += "       <img style='width:60px; height:60px;' src='" + v3.imagem + "' />";
              htmlLentes += "     </div>";
              htmlLentes += "     <div class='text-container'>";
              htmlLentes += "       <p class='text-button'>" + v3.titulo + "</p>";
              htmlLentes += "     </div>";
              htmlLentes += "   </div>";
              htmlLentes += " </a>";
              htmlLentes += " <button class='active-btn ativarL' data-codigo='" + v3.codigo + "'>Ativar</button>";
              htmlLentes += "</div>";

            }

            if (tabela == 'menus') {
              htmlMenus += " <div class='button-container' style='padding: 5px;'>";
              htmlMenus += "     <a class='button'>";
              htmlMenus += "         <div class='button-grid'>";
              htmlMenus += "           <div class='image-container'>";
              htmlMenus += "             <img style='width:60px; height:60px;' src='" + v3.imagem + "' />";
              htmlMenus += "           </div>";
              htmlMenus += "           <div class='text-container'>";
              htmlMenus += "             <p class='text-button'>" + v3.titulo + "</p>";
              htmlMenus += "           </div>";
              htmlMenus += "         </div>";
              htmlMenus += "       </a>";
              htmlMenus += "       <button class='active-btn ativaM' data-codigo='" + v3.codigo + "'>Ativar</button>";
              htmlMenus += " </div>";
            }

            if (tabela == 'videos') {
              htmlVideos += "<div class='button-container' style='padding: 5px;'>";
              htmlVideos += "    <video class='galery-videos' muted src='" + v3.caminhoVideo + "' ></video>";
              htmlVideos += "    <button class='active-btn ativarV' data-codigo='" + v3.codigo + "'>Ativar</button>";
              htmlVideos += "</div>";
            }
          });
        });
      });

      $('.lentesDesativadas').html(htmlLentes);
      $('.menusDesativados').html(htmlMenus);
      $('.videosDesativados').html(htmlVideos);

      $('.ativarL').on('click',function(){
        
        $.ajax({
          url: '../assets/includes/xhr.ativarDesativados.php',
          type: 'POST',
          dataType: 'json',
          data: {
            situacao: 'ativaLente',
            codigo: $(this).data('codigo')
          },
          success: function (data) {
            if (data == 'foi'){
              location.reload();
            }
          },
          error: function (error) {
            console.error('Erro na requisição AJAX:', error);
          }
        });
      });


      $('.ativaM').on('click',function(){
        $.ajax({
          url: '../assets/includes/xhr.ativarDesativados.php',
          type: 'POST',
          dataType: 'json',
          data: {
            situacao: 'ativaMenu',
            codigo: $(this).data('codigo')
          },
          success: function (data) {
            if (data == 'foi'){
              location.reload();
            }
          },
          error: function (error) {
            console.error('Erro na requisição AJAX:', error);
          }
        });
      });

      $('.ativarV').on('click',function(){
        $.ajax({
          url: '../assets/includes/xhr.ativarDesativados.php',
          type: 'POST',
          dataType: 'json',
          data: {
            situacao: 'ativaVideo',
            codigo: $(this).data('codigo')
          },
          success: function (data) {
            if (data == 'foi'){
              location.reload();
            }
          },
          error: function (error) {
            console.error('Erro na requisição AJAX:', error);
          }
        });
      });

    },
    error: function (error) {
      console.error('Erro na requisição AJAX:', error);
    }
  });

});