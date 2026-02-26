/**
 * Projects page - JS específico.
 * El carrusel se inicializa solo por [data-carousel] en carousel.js (DOMContentLoaded).
 * Si en WordPress cargas el HTML por AJAX o después del DOM, llama: window.Carousel && Carousel.init();
 */

(function () {
  "use strict";

  const page = document.querySelector(".projects-page");
  if (!page) return;

  // Re-inicializar carruseles si el contenido se inyectó después (p. ej. en WP con bloques dinámicos)
  if (document.readyState === "complete" && page.querySelectorAll("[data-carousel]").length) {
    if (window.Carousel && typeof window.Carousel.init === "function") {
      window.Carousel.init();
    }
  }
})();
