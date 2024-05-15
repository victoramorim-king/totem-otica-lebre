$(document).ready(function () {
  $("#logout-button").click(function () {
    $.ajax({
      url: "../validacao/sair.php",
      type: "POST",
      success: function (data) {
        window.location.href = "../index.php";
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  });
});