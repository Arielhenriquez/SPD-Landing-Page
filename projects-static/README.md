# Página Projects – SPD Contracting

Código portable para la pestaña **Projects**: HTML + CSS + JS separados, sin Tailwind ni librerías. Incluye el carrusel reutilizable (Vanilla JS) en `vendor/`.

## Estructura

```
projects/
├── projects.html      # Página completa (contenido para WP)
├── projects.css       # Estilos scopiados a .projects-page
├── projects.js        # JS de página (opcional; carrusel auto-inicia)
├── vendor/
│   ├── carousel.js    # Carrusel Vanilla JS
│   └── carousel.css   # Estilos del carrusel (.c-carousel__*)
└── README.md          # Este archivo
```

## Cómo probar en local

1. **Abrir el HTML directamente**  
   Abre `projects.html` en el navegador (doble clic o `file:///...`). Los carruseles se inicializan solos al cargar la página gracias a `[data-carousel]` y el auto-init en `carousel.js`.

2. **Con Live Server (recomendado)**  
   Si usas VS Code / Cursor con extensión “Live Server”: clic derecho en `projects.html` → “Open with Live Server”. Así se evitan restricciones de CORS si más adelante usas recursos locales.

3. **Comprobar carruseles**  
   - **Our Services**: flechas prev/next y, si hay más slides que los visibles, arrastre con mouse o touch.  
   - **Related Projects**: mismo comportamiento y dots de paginación.  
   - No hace falta llamar nada extra: `Carousel.init()` se ejecuta en `DOMContentLoaded` para todos los `[data-carousel]`.

## Integración en WordPress (sin tocar el theme)

### Opción 1: Pegar HTML en una página (más simple)

1. Crea una **Página** en WP (p. ej. “Projects”).
2. Añade un bloque **Custom HTML** y pega dentro todo el contenido de `<main class="projects-page">...</main>` del `projects.html` (solo el interior del `<main>`, sin `<main>` si tu theme ya envuelve el contenido en su propio contenedor; si no, incluye también `<main class="projects-page">` y el cierre `</main>`).
3. Publica.

### Cargar CSS y JS sin editar el theme

**Opción A – Plugin (recomendado)**  
Con **WPCode**, **Simple Custom CSS and JS** o similar:

- Añade un fragmento de **CSS**: pega el contenido de `projects.css` y de `vendor/carousel.css`.  
  Opcional: scope por página con un selector tipo `.page-id-XXX .projects-page` (sustituye `XXX` por el ID de la página Projects).
- Añade un fragmento de **JS**: pega primero `vendor/carousel.js`, luego `projects.js`.  
  Configura el JS para que se cargue en **footer** y solo en la página Projects si el plugin lo permite.

**Opción B – Additional CSS**  
- En **Apariencia → Personalizar → CSS adicional** pega `projects.css` + `vendor/carousel.css`.  
- Para no afectar al resto del sitio, scope así:  
  `.page-id-XXX .projects-page { ... }` (y el resto de reglas dentro de `.projects-page`).  
- El JS tendrás que cargarlo con un plugin (p. ej. WPCode) porque “Additional CSS” no ejecuta JS.

### Inicialización del carrusel en WordPress

- Si el HTML de la página se carga en la primera carga del DOM (bloque Custom HTML estático), **no hace falta hacer nada**: `carousel.js` ya ejecuta `autoInit` en `DOMContentLoaded` y enlaza todos los `[data-carousel]`.
- Si en el futuro el contenido se inyecta por AJAX o después del DOM, después de insertar el HTML llama en la consola o en tu script:  
  `if (window.Carousel && typeof window.Carousel.init === "function") { Carousel.init(); }`  
  `projects.js` ya incluye una comprobación similar para re-inicializar si hace falta.

### Resumen

- **No tocar** `functions.php` ni child theme por ahora.  
- Todo el estilo va bajo el wrapper **`.projects-page`** para no pisar estilos globales.  
- Mantener las clases del carrusel **`.c-carousel__*`** tal cual en el HTML que pegues.

## Data-attributes del carrusel

En cada contenedor con `data-carousel` puedes usar:

| Atributo | Descripción | Ejemplo |
|----------|-------------|---------|
| `data-carousel` | Activa el carrusel (auto-init) | presente |
| `data-carousel-breakpoints` | JSON: número de slides por ancho | `'{"0":1,"600":2,"900":3}'` |
| `data-carousel-dots` | Mostrar dots | `"true"` / `"false"` |
| `data-carousel-loop` | Loop infinito | `"true"` / `"false"` |
| `data-carousel-autoplay` | Autoplay | `"false"` por defecto |

Las flechas son horizontales (prev = triángulo izquierda, next = triángulo derecha) y están en `carousel.css` (pseudo-elementos `::before`).
