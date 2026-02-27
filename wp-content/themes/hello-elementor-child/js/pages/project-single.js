/**
 * Project detail page - Related Projects carousel.
 * Uses projectsMenu (navbar), filters out current project, renders full cards.
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

  function init() {
    var mount = document.getElementById("related-projects-mount");
    if (!mount) return;

    var menu = window.projectsMenu;
    if (!menu || typeof menu !== "object") return;

    var allProjects = Object.values(menu).flatMap(function (cat) {
      return (cat && cat.items) ? cat.items : [];
    });
    if (allProjects.length === 0) return;

    var currentSlug = getCurrentSlug();
    var filtered = currentSlug
      ? allProjects.filter(function (item) { return item.slug !== currentSlug; })
      : allProjects;

    var base = (window.projectPageBase != null ? window.projectPageBase : "/projects/");
    if (base && base.slice(-1) !== "/") base += "/";
    var suffix = typeof window.projectLinkSuffix !== "undefined" ? window.projectLinkSuffix : "";
    var images   = window.projectsImages   || {};
    var excerpts = window.projectsExcerpts || {};
    var urls     = window.projectsUrls     || {};

    var html = "";
    for (var i = 0; i < filtered.length; i++) {
      var p      = filtered[i];
      var slug   = p.slug || "";
      var label  = p.label || p.title || "";
      var excerpt = (excerpts[slug] || "").trim();
      if (excerpt.length > 120) excerpt = excerpt.substring(0, 117) + "...";
      var img  = (images[slug] || "").trim() || PLACEHOLDER;
      var href = urls[slug] || (base + slug + suffix);

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

    var track = document.getElementById("project-related-track")
      || mount.querySelector(".c-carousel__track");

    if (track) {
      track.innerHTML = html;
      if (window.Carousel) {
        if (typeof window.Carousel.initAll === "function") {
          window.Carousel.initAll();
        } else if (typeof window.Carousel.init === "function") {
          window.Carousel.init();
        }
      }
    }
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
