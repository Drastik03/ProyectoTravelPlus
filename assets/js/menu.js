document.addEventListener("DOMContentLoaded", function () {
  const menuButton = document.querySelector(".btn-button-menu");
  const sidebar = document.querySelector(".sidebar");
  const overlay = document.querySelector(".overlay");
  const closeButton = document.querySelector(".sidebar-close");
  function openMenu() {
    sidebar.classList.add("active");
    overlay.classList.add("active");
    document.body.style.overflow = "hidden";
  }
  function closeMenu() {
    sidebar.classList.remove("active");
    overlay.classList.remove("active");
    document.body.style.overflow = "";
  }
  menuButton.addEventListener("click", openMenu);
  closeButton.addEventListener("click", closeMenu);
  overlay.addEventListener("click", closeMenu);
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape" && sidebar.classList.contains("active")) {
      closeMenu();
    }
  });
  sidebar.addEventListener("click", function (e) {
    e.stopPropagation();
  });
  const sidebarLinks = sidebar.querySelectorAll("a");
  sidebarLinks.forEach((link) => {
    link.addEventListener("click", closeMenu);
  });
});
