const selectAllBtn = document.querySelector(".select-all-btn");
const deleteSelectedBtn = document.querySelector(".delete-btn");

selectAllBtn.addEventListener("click", function () {
  const checkboxes = document.querySelectorAll(".checkbox");
  checkboxes.forEach((checkbox) => {
    checkbox.checked = true;
  });
});

deleteSelectedBtn.addEventListener("click", function () {
  const checkboxes = document.querySelectorAll(".checkbox:checked");
  checkboxes.forEach((checkbox) => {
    const imageContainer = checkbox.parentNode;
    // Aqui vc vai ter que adicionar o endpoint de delete
    imageContainer.remove();
  });
});


$(document).ready(function () {
  $.ajax({
    url: '../assets/includes/buscaGaleria.php',
    type: 'POST',
    dataType: 'json',
    success: function (data) {
      if (data) {
        var html = "";
        $.each(data, function (i, v) {
          html += " <div class='img-container'> ";
          html += " 	<img src='"+v.link+"' alt='Imagem "+i+"'> ";
          html += " 	<input type='checkbox' class='checkbox excluir"+v.codigo+"'> ";
          html += " 	<button class='delete-btn-img apagar"+v.codigo+"'>X</button> ";
          html += " </div> ";
        });
        $('.gallery').html(html);
      } else {
        console.log('Nenhum item de menu encontrado');
      }
    },
    error: function (error) {
      console.error('Erro na requisição AJAX:', error);
    }
  });
});