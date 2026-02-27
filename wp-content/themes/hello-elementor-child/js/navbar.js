/**
 * navbar.js - Mega menu con data centralizado, panel derecho renderizado por JS, a11y, cierre Esc/click fuera
 * En WordPress: definir window.projectPageBase y opcional window.projectLinkSuffix (ej. '' para URLs sin .html)
 */
(function () {
  "use strict";

  var projectBase = function () {
    return window.projectPageBase != null ? window.projectPageBase : "project/";
  };
  var projectSuffix = function () {
    return typeof window.projectLinkSuffix !== "undefined" ? window.projectLinkSuffix : ".html";
  };
  var projectsMenu = {
    education: {
      label: "Randall Recreation Center Project",
      items: [
        { label: "Boone ES Emergency Repairs", slug: "boone-es-emergency-repairs" }
      ]
    },
    "gov-buildings": {
      label: "Government-Owned Buildings",
      items: [
        { label: "The Wall at O Street SE", slug: "the-wall-at-o-street-se" }
      ]
    },
    municipal: {
      label: "Municipal & Healthcare",
      items: [
        { label: "MPD 4th District HQ", slug: "mpd-4th-district-hq" }
      ]
    },
    "gov-housing": {
      label: "Government Housing",
      items: [
        { label: "Forest Ridge and The Vistas Apartments Renovations", slug: "forest-ridge-and-the-vistas" }
      ]
    },
    recreational: {
      label: "Recreational Facilities",
      items: [
        { label: "Sherwood Recreation Center Exterior Improvements", slug: "sherwood-recreation-center" },
        { label: "Randall Recreation Center Project", slug: "randall-recreation-center" }
      ]
    }
  };

  window.projectsMenu = projectsMenu;
  var firstCategoryId = "education";

  function renderMegaPanel(panelId) {
    var data = projectsMenu[panelId];
    if (!data || !data.items) return "";
    var base = projectBase();
    var suffix = projectSuffix();
    var html = "";
    for (var i = 0; i < data.items.length; i++) {
      var item = data.items[i];
      var href = item.slug ? base + item.slug + suffix : base;
      html += '<a href="' + escapeHtml(href) + '">' + escapeHtml(item.label) + "</a>";
    }
    return html;
  }

  function escapeHtml(text) {
    var div = document.createElement("div");
    div.textContent = text;
    return div.innerHTML;
  }

  window.Navbar = {
    init: function () {
      var header = document.getElementById("site-header");
      if (!header) return;

      var toggleBtn = document.getElementById("nav-toggle");
      var itemsWithDropdown = header.querySelectorAll(".nav__item[aria-haspopup='true']");
      var megaPanelInner = header.querySelector(".nav__mega-panel-inner");
      var megaCategories = header.querySelectorAll(".nav__mega-category");
      var mediaQuery = window.matchMedia("(max-width: 900px)");

      function isMobile() {
        return mediaQuery.matches;
      }

      function closeAllDropdowns() {
        for (var i = 0; i < itemsWithDropdown.length; i++) {
          itemsWithDropdown[i].setAttribute("aria-expanded", "false");
          var panel = itemsWithDropdown[i].querySelector(".nav__dropdown");
          if (panel) panel.setAttribute("hidden", "");
        }
        header.classList.remove("is-open");
        if (toggleBtn) toggleBtn.setAttribute("aria-expanded", "false");
      }

      function openDropdown(item) {
        closeAllDropdowns();
        item.setAttribute("aria-expanded", "true");
        var panel = item.querySelector(".nav__dropdown");
        if (panel) panel.removeAttribute("hidden");
        if (isMobile()) header.classList.add("is-open");
        if (toggleBtn && isMobile()) toggleBtn.setAttribute("aria-expanded", "true");
      }

      function toggleDropdown(item) {
        var expanded = item.getAttribute("aria-expanded") === "true";
        if (expanded) {
          item.setAttribute("aria-expanded", "false");
          var panel = item.querySelector(".nav__dropdown");
          if (panel) panel.setAttribute("hidden", "");
          if (isMobile()) header.classList.remove("is-open");
          if (toggleBtn && isMobile()) toggleBtn.setAttribute("aria-expanded", "false");
        } else {
          openDropdown(item);
        }
      }

      function setMegaPanel(panelId) {
        if (!megaPanelInner) return;
        megaPanelInner.innerHTML = renderMegaPanel(panelId);
        for (var i = 0; i < megaCategories.length; i++) {
          var cat = megaCategories[i];
          cat.classList.toggle("is-active", cat.getAttribute("data-nav-panel") === panelId);
        }
      }

      setMegaPanel(firstCategoryId);

      for (var i = 0; i < itemsWithDropdown.length; i++) {
        (function (item) {
          var panel = item.querySelector(".nav__dropdown");
          item.addEventListener("mouseenter", function () {
            if (!isMobile()) {
              item.setAttribute("aria-expanded", "true");
              if (panel) panel.removeAttribute("hidden");
            }
          });
          item.addEventListener("mouseleave", function () {
            if (!isMobile()) {
              item.setAttribute("aria-expanded", "false");
              if (panel) panel.setAttribute("hidden", "");
            }
          });
        })(itemsWithDropdown[i]);
      }

      for (var j = 0; j < itemsWithDropdown.length; j++) {
        var link = itemsWithDropdown[j].querySelector(".nav__link");
        if (!link) continue;
        link.addEventListener("click", function (e) {
          if (!isMobile()) return;
          e.preventDefault();
          var parent = this.closest(".nav__item");
          toggleDropdown(parent);
        });
      }

      for (var k = 0; k < megaCategories.length; k++) {
        (function (cat) {
          var panelId = cat.getAttribute("data-nav-panel");
          if (!panelId) return;
          cat.addEventListener("mouseenter", function () {
            if (!isMobile()) setMegaPanel(panelId);
          });
          cat.addEventListener("focus", function () {
            setMegaPanel(panelId);
          });
          cat.addEventListener("click", function (e) {
            e.preventDefault();
            setMegaPanel(panelId);
            var firstLink = header.querySelector(".nav__mega-panel-inner a");
            if (firstLink && isMobile()) firstLink.focus();
          });
        })(megaCategories[k]);
      }

      if (toggleBtn) {
        toggleBtn.addEventListener("click", function () {
          var open = header.classList.toggle("is-open");
          toggleBtn.setAttribute("aria-expanded", open ? "true" : "false");
          if (!open) closeAllDropdowns();
        });
      }

      document.addEventListener("click", function (e) {
        if (!header.contains(e.target)) closeAllDropdowns();
      });

      document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") closeAllDropdowns();
      });
    }
  };
})();
