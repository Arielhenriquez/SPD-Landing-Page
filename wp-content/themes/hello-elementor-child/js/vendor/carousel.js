/**
 * Carousel - Vanilla JS, sin dependencias.
 * Múltiples instancias, inicialización por data-carousel o new Carousel(el, options).
 */

(function () {
  "use strict";

  const REDUCED_MOTION = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  const DEFAULT_OPTIONS = {
    autoplay: false,
    interval: 5000,
    pauseOnHover: true,
    loop: true,
    showDots: true,
    breakpoints: {
      0: 1,
      768: 2,
      1024: 3,
    },
  };

  /**
   * Obtiene slidesPerView según el ancho actual y los breakpoints.
   * breakpoints: { minWidth: slidesPerView }
   */
  function getSlidesPerView(breakpoints) {
    const w = window.innerWidth;
    let slides = 1;
    let maxBreak = 0;
    for (const bp in breakpoints) {
      const n = parseInt(bp, 10);
      if (!isNaN(n) && w >= n && n >= maxBreak) {
        maxBreak = n;
        slides = breakpoints[bp];
      }
    }
    return slides;
  }

  /**
   * Helpers para drag/swipe (mouse y touch)
   */
  const Drag = {
    onStart(ev, carousel) {
      ev.preventDefault();
      carousel._dragStartX = "touches" in ev ? ev.touches[0].clientX : ev.clientX;
      carousel._dragStartTranslate = carousel._currentTranslate;
      carousel._isDragging = true;
      carousel.root.classList.add("is-dragging");
      carousel.pause();
    },
    onMove(ev, carousel) {
      if (!carousel._isDragging) return;
      const x = "touches" in ev ? ev.touches[0].clientX : ev.clientX;
      const delta = x - carousel._dragStartX;
      const minT = carousel._minTranslate();
      const maxT = carousel._maxTranslate();
      let t = carousel._dragStartTranslate + delta;
      if (!carousel.options.loop) t = Math.max(minT, Math.min(maxT, t));
      carousel._applyTranslate(t);
    },
    onEnd(ev, carousel) {
      if (!carousel._isDragging) return;
      carousel.root.classList.remove("is-dragging");
      carousel._isDragging = false;
      const x = "changedTouches" in ev ? ev.changedTouches[0].clientX : ev.clientX;
      const delta = x - carousel._dragStartX;
      const threshold = 50;
      if (delta > threshold) carousel.prev();
      else if (delta < -threshold) carousel.next();
      else carousel._applyIndex(carousel._currentIndex);
      carousel._resumeFromOptions();
    },
  };

  /**
   * Clase Carousel - una instancia por elemento.
   */
  class Carousel {
    constructor(element, options = {}) {
      if (!element || !element.nodeName) throw new Error("Carousel: element required");
      this.root = element;
      this.options = { ...DEFAULT_OPTIONS, ...options };
      if (REDUCED_MOTION) this.options.autoplay = false;

      this._viewport = element.querySelector(".c-carousel__viewport");
      this._track = element.querySelector(".c-carousel__track");
      this._slides = Array.from(element.querySelectorAll(".c-carousel__slide"));
      this._btnPrev = element.querySelector(".c-carousel__btn--prev");
      this._btnNext = element.querySelector(".c-carousel__btn--next");
      this._dotsContainer = element.querySelector(".c-carousel__dots");

      this._currentIndex = 0;
      this._slidesPerView = 1;
      this._slideWidth = 0;
      this._currentTranslate = 0;
      this._timer = null;
      this._isDragging = false;

      if (!this._viewport || !this._track || !this._slides.length) return;

      this._init();
    }

    _init() {
      this.root.setAttribute("aria-roledescription", "carousel");
      if (!this.root.getAttribute("aria-label")) this.root.setAttribute("aria-label", "Image carousel");
      this.root.setAttribute("tabindex", "0");

      this._slidesPerView = getSlidesPerView(this.options.breakpoints);
      this._updateSlideWidth();
      this._currentIndex = 0;
      this._currentTranslate = 0;
      this._applyIndex(0);

      this._bindEvents();
      this._renderDots();
      this._updateUI();

      if (this.options.autoplay) this.play();
    }

    _updateSlideWidth() {
      const w = this._viewport ? this._viewport.offsetWidth : this.root.offsetWidth;
      this._slidesPerView = getSlidesPerView(this.options.breakpoints);
      this._slideWidth = w / this._slidesPerView;
      this._slides.forEach((s) => (s.style.width = this._slideWidth + "px"));
    }

    _minTranslate() {
      const totalWidth = this._slides.length * this._slideWidth;
      const viewWidth = this._slidesPerView * this._slideWidth;
      return -(totalWidth - viewWidth);
    }

    _maxTranslate() {
      return 0;
    }

    _maxIndex() {
      return Math.max(0, this._slides.length - this._slidesPerView);
    }

    _clampIndex(index) {
      return Math.max(0, Math.min(this._maxIndex(), index));
    }

    _normalizeIndex(index) {
      if (!this.options.loop) return this._clampIndex(index);
      const size = this._maxIndex() + 1;
      if (size <= 0) return 0;
      return ((index % size) + size) % size;
    }

    _applyTranslate(px) {
      this._currentTranslate = px;
      this._track.style.transform = "translate3d(" + px + "px, 0, 0)";
    }

    _indexToTranslate(index) {
      const i = this.options.loop ? this._normalizeIndex(index) : this._clampIndex(index);
      return -i * this._slideWidth;
    }

    _applyIndex(index) {
      this._currentIndex = this._normalizeIndex(index);
      const t = this._indexToTranslate(this._currentIndex);
      this._currentTranslate = t;
      this._track.style.transform = "translate3d(" + t + "px, 0, 0)";
      this._updateUI();
    }

    _updateUI() {
      const atStart = !this.options.loop && this._currentIndex <= 0;
      const atEnd = !this.options.loop && this._currentIndex >= this._maxIndex();
      if (this._btnPrev) {
        this._btnPrev.disabled = atStart;
        this._btnPrev.setAttribute("aria-disabled", atStart ? "true" : "false");
      }
      if (this._btnNext) {
        this._btnNext.disabled = atEnd;
        this._btnNext.setAttribute("aria-disabled", atEnd ? "true" : "false");
      }
      const dots = this.root.querySelectorAll(".c-carousel__dot");
      dots.forEach((d, i) => d.classList.toggle("is-active", i === this._currentIndex));
    }

    _renderDots() {
      if (!this._dotsContainer || !this.options.showDots) {
        if (this._dotsContainer) this._dotsContainer.innerHTML = "";
        return;
      }
      const count = Math.max(1, this._maxIndex() + 1);
      this._dotsContainer.innerHTML = "";
      this._dotsContainer.setAttribute("aria-label", "Pagination");
      for (let i = 0; i < count; i++) {
        const btn = document.createElement("button");
        btn.type = "button";
        btn.className = "c-carousel__dot";
        btn.setAttribute("aria-label", "Go to slide " + (i + 1));
        btn.addEventListener("click", () => this.go(i));
        this._dotsContainer.appendChild(btn);
      }
    }

    _bindEvents() {
      const r = this.root;
      if (this._btnPrev) this._btnPrev.addEventListener("click", () => this.prev());
      if (this._btnNext) this._btnNext.addEventListener("click", () => this.next());

      r.addEventListener("keydown", (e) => {
        if (e.target.closest(".c-carousel") !== r) return;
        if (e.key === "ArrowLeft") {
          e.preventDefault();
          this.prev();
        } else if (e.key === "ArrowRight") {
          e.preventDefault();
          this.next();
        }
      });

      let moveHandler, endHandler;
      const start = (e) => Drag.onStart(e, this);
      moveHandler = (e) => Drag.onMove(e, this);
      endHandler = (e) => {
        Drag.onEnd(e, this);
        document.removeEventListener("mousemove", moveHandler);
        document.removeEventListener("mouseup", endHandler);
        document.removeEventListener("touchmove", moveHandler, { passive: true });
        document.removeEventListener("touchend", endHandler);
      };

      this._viewport.addEventListener("mousedown", (e) => {
        if (e.button !== 0) return;
        start(e);
        document.addEventListener("mousemove", moveHandler);
        document.addEventListener("mouseup", endHandler);
      });
      this._viewport.addEventListener("touchstart", (e) => {
        start(e);
        document.addEventListener("touchmove", moveHandler, { passive: true });
        document.addEventListener("touchend", endHandler);
      }, { passive: true });

      if (this.options.pauseOnHover) {
        r.addEventListener("mouseenter", () => this.pause());
        r.addEventListener("mouseleave", () => this._resumeFromOptions());
      }

      this._onResize = () => {
        this._updateSlideWidth();
        this._applyIndex(this._currentIndex);
        this._renderDots();
        this._updateUI();
      };
      window.addEventListener("resize", this._onResize);
    }

    _resumeFromOptions() {
      if (this.options.autoplay && !this._isDragging) this.play();
    }

    go(index) {
      this._applyIndex(index);
      if (this.options.autoplay) {
        this.pause();
        this.play();
      }
    }

    next() {
      this._applyIndex(this._currentIndex + 1);
      if (this.options.autoplay) {
        this.pause();
        this.play();
      }
    }

    prev() {
      this._applyIndex(this._currentIndex - 1);
      if (this.options.autoplay) {
        this.pause();
        this.play();
      }
    }

    play() {
      this.pause();
      this._timer = setInterval(() => this.next(), this.options.interval);
    }

    pause() {
      if (this._timer) {
        clearInterval(this._timer);
        this._timer = null;
      }
    }

    destroy() {
      this.pause();
      if (this._dotsContainer) this._dotsContainer.innerHTML = "";
      this._track.style.transform = "";
      this._slides.forEach((s) => (s.style.width = ""));
      if (this._onResize) window.removeEventListener("resize", this._onResize);
    }
  }

  /**
   * Inicialización automática por [data-carousel]
   * Opciones por data-carousel-* (autoplay, interval, pause-on-hover, loop, show-dots)
   * Breakpoints por data-carousel-breakpoints (JSON): {"0":1,"768":2,"1024":3}
   */
  function autoInit() {
    document.querySelectorAll("[data-carousel]").forEach((el) => {
      if (el._carouselInstance) return;
      const opts = {};
      const autoplay = el.getAttribute("data-carousel-autoplay");
      if (autoplay !== null) opts.autoplay = autoplay !== "false" && autoplay !== "0";
      const interval = el.getAttribute("data-carousel-interval");
      if (interval !== null) opts.interval = parseInt(interval, 10) || DEFAULT_OPTIONS.interval;
      const pauseOnHover = el.getAttribute("data-carousel-pause-on-hover");
      if (pauseOnHover !== null) opts.pauseOnHover = pauseOnHover !== "false" && pauseOnHover !== "0";
      const loop = el.getAttribute("data-carousel-loop");
      if (loop !== null) opts.loop = loop !== "false" && loop !== "0";
      const showDots = el.getAttribute("data-carousel-dots");
      if (showDots !== null) opts.showDots = showDots !== "false" && showDots !== "0";
      const bp = el.getAttribute("data-carousel-breakpoints");
      if (bp) try { opts.breakpoints = JSON.parse(bp); } catch (_) {}
      const carousel = new Carousel(el, opts);
      el._carouselInstance = carousel;
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", autoInit);
  } else {
    autoInit();
  }

  window.Carousel = Carousel;
  /** Vuelve a escanear el DOM en busca de [data-carousel] (útil si añades carruseles por JS después). */
  window.Carousel.init = autoInit;
})();
