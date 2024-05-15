const mobileMenu = document.getElementById("mobile-menu-icon");
const sidebar = document.getElementsByClassName("sidebar")[0];

function toggleSidebar() {
  const sidebarVisible = sidebar.classList.contains("sidebar-show");
  if (sidebarVisible) {
    sidebar.classList.remove("sidebar-show");
  } else {
    sidebar.classList.add("sidebar-show");
  }
}

mobileMenu.addEventListener("click", toggleSidebar);

document.addEventListener('DOMContentLoaded', function() {
  const menuLinks = document.querySelectorAll('.menu-button');

  menuLinks.forEach(link => {
      link.addEventListener('click', function(event) {
          event.preventDefault(); // Prevenir comportamento padrão do link

          const url = this.getAttribute('href'); // Obter URL do link clicado

          // Carregar conteúdo da view correspondente
          fetch(url)
              .then(response => response.text())
              .then(html => {
                  document.getElementById('main-content').innerHTML = html;
              })
              .catch(error => console.error('Erro ao carregar conteúdo:', error));
      });
  });
});