/**
 * Homepage: scroll horizontal del bloque Featured Projects (.projects-cards) con flechas.
 * Navbar.init() y Carousel.init() se llaman desde el tema tras cargar (si hace falta).
 */
(function () {
  "use strict";
  document.addEventListener("DOMContentLoaded", function () {
    var prev = document.querySelector(".carousel-prev");
    var next = document.querySelector(".carousel-next");
    var cards = document.querySelector(".projects-cards");
    if (prev && next && cards) {
      prev.addEventListener("click", function () {
        cards.scrollBy({ left: -320, behavior: "smooth" });
      });
      next.addEventListener("click", function () {
        cards.scrollBy({ left: 320, behavior: "smooth" });
      });
    }
    if (window.Navbar && typeof window.Navbar.init === "function") {
      window.Navbar.init();
    }
    if (window.Carousel && typeof window.Carousel.init === "function") {
      window.Carousel.init();
    }
  });
})();
