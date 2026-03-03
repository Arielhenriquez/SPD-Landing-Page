/**
 * Project detail page - Related Projects carousel.
 * Fuente primaria: window.projectsData (todos los proyectos, expuesto por functions.php).
 * Fallback: window.projectsMenu + window.projectsImages + window.projectsExcerpts (navbar).
 */
(function () {
  "use strict";

  var PLACEHOLDER = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='400' height='250' viewBox='0 0 400 250'%3E%3Crect fill='%23e2e8f0' width='400' height='250'/%3E%3Ctext fill='%2394a3b8' x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' font-family='sans-serif' font-size='14'%3EProject%3C/text%3E%3C/svg%3E";

  function getCurrentSlug() {
    var mount = document.getElementById("related-projects-mount");
    if (mount && mount.getAttribute("data-current-slug")) {
      return mount.getAttribute("data-current-slug");
    }
    var path = window.location.pathname || "";
    var m = path.match(/\/(?:project|projects)\/([^/]+)/);
    if (m && m[1]) {
      var slug = m[1];
      if (slug.slice(-8) === "-project") {
        return slug.slice(0, -8);
      }
      return slug;
    }
    return null;
  }

  function escapeHtml(text) {
    if (!text) return "";
    var div = document.createElement("div");
    div.textContent = text;
    return div.innerHTML;
  }

  function buildProjects() {
    /* --- Fuente primaria: projectsData (todos los proyectos) --- */
    if (window.projectsData && typeof window.projectsData === "object") {
      return Object.values(window.projectsData).map(function (p) {
        return {
          slug:    p.slug    || "",
          label:   p.title   || p.label || "",
          excerpt: p.excerpt || "",
          image:   p.image   || "",
          url:     p.url     || "",
        };
      });
    }

    /* --- Fallback: projectsMenu + projectsImages + projectsExcerpts --- */
    var menu = window.projectsMenu;
    if (!menu || typeof menu !== "object") return [];

    var images   = window.projectsImages   || {};
    var excerpts = window.projectsExcerpts || {};
    var base     = window.projectPageBase  != null ? window.projectPageBase : "/projects/";
    if (base && base.slice(-1) !== "/") base += "/";
    var suffix = typeof window.projectLinkSuffix !== "undefined" ? window.projectLinkSuffix : "";

    return Object.values(menu).flatMap(function (cat) {
      return (cat && cat.items) ? cat.items : [];
    }).map(function (p) {
      var slug = p.slug || "";
      var href = base + slug + suffix;
      if (suffix === "" && href.slice(-1) !== "/") href += "/";
      return {
        slug:    slug,
        label:   p.label || p.title || "",
        excerpt: excerpts[slug] || "",
        image:   images[slug]   || "",
        url:     href,
      };
    });
  }

  function buildHtml(projects) {
    var html = "";
    for (var i = 0; i < projects.length; i++) {
      var p       = projects[i];
      var label   = p.label;
      var excerpt = p.excerpt.trim();
      if (excerpt.length > 130) excerpt = excerpt.substring(0, 127) + "...";
      var img  = p.image.trim() || PLACEHOLDER;
      var href = p.url || "#";

      html += "<div class=\"c-carousel__slide\">";
      html += "<article class=\"related-card\">";
      html += "<a href=\"" + escapeHtml(href) + "\" class=\"thumb\">";
      html += "<img src=\"" + escapeHtml(img) + "\" alt=\"" + escapeHtml(label) + "\" loading=\"lazy\">";
      html += "</a>";
      html += "<div class=\"body\">";
      html += "<h3><a href=\"" + escapeHtml(href) + "\">" + escapeHtml(label) + "</a></h3>";
      if (excerpt) html += "<p>" + escapeHtml(excerpt) + "</p>";
      html += "<a href=\"" + escapeHtml(href) + "\" class=\"link\">Read more \u2192</a>";
      html += "</div>";
      html += "</article>";
      html += "</div>";
    }
    return html;
  }

  function reinitCarousel(carouselEl, track) {
    if (!window.Carousel || typeof window.Carousel.init !== "function") return;

    /* Destruir instancia previa para que autoInit no la saltee */
    if (carouselEl && carouselEl._carouselInstance) {
      if (typeof carouselEl._carouselInstance.destroy === "function") {
        carouselEl._carouselInstance.destroy();
      }
      delete carouselEl._carouselInstance;
    }

    /* Resetear transform residual del track */
    if (track) {
      track.style.transform = "";
    }

    requestAnimationFrame(function () {
      window.Carousel.init();
    });
  }

  function init() {
    var mount = document.getElementById("related-projects-mount");
    if (!mount) return;

    var all = buildProjects();
    if (all.length === 0) return;

    var currentSlug = getCurrentSlug();
    /* Normalizar: quitar sufijo "-project" para comparar con slugs del data */
    var normalizedCurrent = currentSlug && currentSlug.slice(-8) === "-project"
      ? currentSlug.slice(0, -8)
      : currentSlug;
    var filtered = normalizedCurrent
      ? all.filter(function (p) {
          var s = p.slug && p.slug.slice(-8) === "-project" ? p.slug.slice(0, -8) : p.slug;
          return s !== normalizedCurrent;
        })
      : all;
    if (filtered.length === 0) return;

    var html  = buildHtml(filtered);
    var track = document.getElementById("project-related-track")
      || mount.querySelector(".c-carousel__track");

    if (!track) return;

    var carouselEl = mount.querySelector(".c-carousel");
    track.innerHTML = html;
    reinitCarousel(carouselEl, track);
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
