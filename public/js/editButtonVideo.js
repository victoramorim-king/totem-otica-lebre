const totemButtons = document.getElementsByClassName("galery-videos");
const createAndClear = document.querySelectorAll(".create-and-clear-buttons");
const changeAndDisable = document.querySelectorAll(
  ".change-and-disable-buttons"
);

Array.from(totemButtons).forEach((button) => {
  button.addEventListener("click", () => {
    const video = button.src;
    console.log(video);
    createAndClear.forEach((comp) => {
      comp.style.display = "none";
    });
    changeAndDisable.forEach((comp) => {
      comp.style.display = "flex";
    });

    const selectedButton = changeAndDisable[0];
    selectedButton.src = video;
  });
});

$(document).ready(function() {

  $.ajax({
    url: '../assets/includes/buscaVideo.php',
    type: 'POST',
    dataType: 'json',
    success: function (data) {
      if (data) {
        var html = "";
        $.each(data, function (i, v) {
          html += "<video class='galery-videos posicao' data-codigo='"+v.codigo+"' muted src='"+v.caminhoVideo+"' ></video>";
        });

        $('.listarVideos').html(html);

        $('.posicao').on('click', function () {

          $.ajax({
            url: '../assets/includes/xhr.adicionaVideo.php',
            type: 'POST',
            dataType: 'json',
            data: {
              situacao: 'busca',
              codigoLinha: $(this).data('codigo')
            },
            success: function (resp) {

              $('.create-and-clear-buttons').hide();

              $('.change-and-disable-buttons').show();

              $.each(resp, function (i1, v2) {
                $('.mudarLink').attr('src', v2.caminhoVideo);
                $("#desativar").attr("data-codigo", v2.codigo);
              });

              $('#desativar').on('click',function(){
                var codigoVideo = $(this).data('codigo');

                $.ajax({
                  url: '../assets/includes/xhr.adicionaVideo.php',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                    situacao: 'desativar',
                    codigoVideo: codigoVideo
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



  $('#adicionarVideo').on('click',function(e) {
      e.preventDefault();

      var formData = new FormData();
      formData.append('videoFile', $('#image-input')[0].files[0]);

      $.ajax({
          url: '../assets/includes/xhr.salvaVideo.php',
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
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
          error: function(xhr, status, error) {
              alert('Erro ao enviar vídeo: ' + error);
          }
      });
  });

  $('.voltar').on('click', function(){
    location.reload();
  });
});