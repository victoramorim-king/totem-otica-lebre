const totemButtons = document.getElementsByClassName("button");
const createAndClear = document.querySelectorAll(".create-and-clear-buttons");
const changeAndDisable = document.querySelectorAll(
  ".change-and-disable-buttons"
);

Array.from(totemButtons).forEach((button) => {
  button.addEventListener("click", () => {
    const buttonText = button.textContent;
    const image = button.querySelector("img").src;

    createAndClear.forEach((comp) => {
      comp.style.display = "none";
    });
    changeAndDisable.forEach((comp) => {
      comp.style.display = "flex";
    });

    const selectedButton = changeAndDisable[0];
    selectedButton.querySelector("img").src = image;
    selectedButton.querySelector("#tituloAlterar").textContent = buttonText;
  });
});

$(document).ready(function () {

  //carregar lentes!
  $.ajax({
    url: '../assets/includes/buscaLente.php',
    type: 'POST',
    dataType: 'json',
    success: function (data) {
      if (data) {
        var html = "";
        $.each(data, function (i, v) {

          html += " <a class='button posicao' data-codigoLinha='" + i + "'>";
          html += "   <div class='button-grid'>";
          html += "     <div class='image-container-smaller'>";
          html += "        <img style='width:60px; height:60px;' src='" + v.imagem + "'/>";
          html += "	    </div>";
          html += "	    <div class='text-container'>";
          html += "		    <p class='text-button'>" + v.titulo + "</p>";
          html += "	    </div>";
          html += "	  </div>";
          html += " </a>";

        });

        $('.listaLentes').html(html);

        $('.posicao').on('click', function () {

          $.ajax({
            url: '../assets/includes/xhr.adicionaLente.php',
            type: 'POST',
            dataType: 'json',
            data: {
              situacao: 'busca',
              codigoLinha: $(this).data('codigolinha')
            },
            success: function (resp) {

              $('.create-and-clear-buttons').hide();

              $('.change-and-disable-buttons').show();

              $.each(resp, function (i1, v2) {
                $('.change-and-disable-buttons img').attr('src', v2.imagem);
                $('#tituloAlterar').val(v2.titulo);
                $('#descricaoEscondido').val(v2.descricao);
                $("#alterar").attr("data-codigo", v2.codigo);
                $("#desativar").attr("data-codigo", v2.codigo);
              });


              // alterar lentes !!
              $('#alterar').on('click',function(){
                var codigoLente = $(this).data('codigo');
                var titulo = $('#tituloAlterar').val();
                var descricao = $('#descricaoEscondido').val();
                var mostrarnomenu = $('.mostraNoMenu').val();

                $.ajax({
                  url: '../assets/includes/xhr.adicionaLente.php',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                    situacao: 'alterar',
                    codigoLente: codigoLente,
                    titulo: titulo,
                    descricao: descricao,
                    mostrarNoMenu: mostrarnomenu
                  },
                  success: function (re) {

                    console.log(re);

                    const Toast = Swal.mixin({
                      toast: true,
                      position: "top-end",
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                      }
                    });

                    if (re == 'foi') {
                      location.reload();
                    } else if (re == 'foi-nao') {
                      Toast.fire({
                        icon: "warning",
                        title: "Não foi possível cadastrar , entre em contato com o suporte!"
                      });
                    } else {
                      Toast.fire({
                        icon: "error",
                        title: "Erro 500, entre em contato com o suporte!"
                      });
                    }
                  },
                  error: function () {
                    console.log('Yamero');
                  }
                });
              });
              // alterar lente fim!

              // desativar lentes !!
              $('#desativar').on('click',function(){
                var codigoLente = $(this).data('codigo');

                $.ajax({
                  url: '../assets/includes/xhr.adicionaLente.php',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                    situacao: 'desativar',
                    codigoLente: codigoLente
                  },
                  success: function (rr) {
                    const Toast = Swal.mixin({
                      toast: true,
                      position: "top-end",
                      showConfirmButton: false,
                      timer: 3000,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                      }
                    });

                    if (rr == 'foi') {
                      location.reload();
                    } else if (rr == 'foi-nao') {
                      Toast.fire({
                        icon: "warning",
                        title: "Não foi possível desativar , entre em contato com o suporte!"
                      });
                    } else {
                      Toast.fire({
                        icon: "error",
                        title: "Erro 500, entre em contato com o suporte!"
                      });
                    }
                  },
                  error: function () {
                    console.log('Yamero');
                  }
                });
              });
              // desativar lentes fim !!
            },
            error: function () {
              console.log('Yamero');
            }
          });

        });
        
      } else {
        const Toast = Swal.mixin({
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
          }
        });

        Toast.fire({
          icon: "error",
          title: "Erro 500, entre em contato com o suporte!"
        });
      }
    },
    error: function (error) {
      console.error('Erro na requisição AJAX:', error);
    }
  });
  //carregar lentes fim!

  // adiciona lente
  $('#adicionarLente').click(function () {
    var titulo = $('#titulo').val();
    var descricao = $('#descricao').val();
    var mostrarNoMenu = $('#mostrarNoMenuCAD').val();
    var reader = new FileReader();

    reader.onload = function (event) {
      var imagemBase64 = event.target.result;

      var dados = {
        situacao: 'adiciona',
        texto: titulo,
        descricao: descricao,
        mostrarNoMenu: mostrarNoMenu,
        imagem: imagemBase64
      };

      $.ajax({
        url: '../assets/includes/xhr.adicionaLente.php',
        type: 'POST',
        data: dados,
        success: function (response) {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.onmouseenter = Swal.stopTimer;
              toast.onmouseleave = Swal.resumeTimer;
            }
          });

          if (response == 'existe') {
            Toast.fire({
              icon: "warning",
              title: "Já existe uma lente cadastrado com esse nome, verifique se não está desativado!"
            });
          } else if (response == 'foi') {
            location.reload();
          } else if (response == 'foi-nao') {
            Toast.fire({
              icon: "error",
              title: "Não foi possível cadastrar esse menu, entre em contato com o suporte."
            });
          } else {
            Toast.fire({
              icon: "error",
              title: "Erro 500, entre em contato com o suporte!"
            });
          }
        },
        error: function () {
          console.log('Yamero');
        }
      });
    };
    var imagem = $('#image-input')[0].files[0];
    reader.readAsDataURL(imagem);
  });
  // adiciona lente fim!

$('.voltar').on('click', function(){
  location.reload();
});

});
