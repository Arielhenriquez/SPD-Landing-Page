# Cómo ejecutar este proyecto WordPress (SPD Contracting, Inc.)

Este proyecto es un **respaldo creado con Duplicator**. Los archivos ya están extraídos; falta configurar la base de datos y la URL del sitio.

---

## Con Docker (recomendado)

Necesitas tener [Docker](https://www.docker.com/get-started) y [Docker Compose](https://docs.docker.com/compose/install/) instalados.

### 1. Opcional: configurar variables

Copia el archivo de ejemplo y edita si quieres cambiar contraseñas o puerto:

```bash
copy .env.example .env
```

Por defecto el sitio quedará en **http://localhost:8080**.

### 2. Levantar los contenedores

En la carpeta del proyecto (donde está `docker-compose.yml`):

```bash
docker compose up -d
```

Espera unos segundos a que MariaDB esté listo.

### 3. Abrir el instalador de Duplicator (¡importante!)

**No abras** `main.installer.php` directamente; primero debes abrir el instalador de entrada para que se cree el archivo de seguridad (CSRF).

En el navegador entra a:

**http://localhost:8080/20260208_spdcontractinginc_27c8ba10e49c5b772531_20260208203750_installer-backup.php**

(Si cambiaste el puerto en `.env`, usa ese número en lugar de 8080.)

Esa página creará el archivo necesario y te llevará al asistente. Si ves un error "CSRF FILE NOT FOUND", es porque se abrió `dup-installer/main.installer.php` sin pasar antes por la URL de arriba.

### 4. Completar el asistente de Duplicator

- **Paso 1 – Base de datos:** usa estos datos (son los del contenedor):
  - **Host:** `db` (nombre del servicio, no uses `localhost`)
  - **Base de datos:** `wordpress`
  - **Usuario:** `wordpress`
  - **Contraseña:** `wordpress` (o la que pusiste en `.env`)
- **Paso 2:** Si dice que los archivos ya están extraídos, continúa.
- **Paso 3 – URL del sitio:** pon **`http://localhost:8080`** (o tu puerto).
- **Paso 4:** Finaliza. Luego borra la carpeta `dup-installer` por seguridad.

### 5. Entrar al sitio

- Sitio: **http://localhost:8080**
- Panel: **http://localhost:8080/wp-login.php**

---

## Cómo modificar el sitio (páginas y CSS)

### Entrar al panel de WordPress

1. Abre **http://localhost:8080/wp-login.php**
2. Inicia sesión con uno de los usuarios del sitio (si no recuerdas la contraseña, usa “¿Perdiste tu contraseña?” o resétala desde la base de datos).

### Agregar o editar páginas

El sitio usa **Elementor** como constructor de páginas.

- **Crear una página nueva:** En el panel → **Páginas** → **Añadir** (o “Add New”). Pon título, luego haz clic en **Editar con Elementor** para diseñar con arrastrar y soltar.
- **Editar una página existente:** **Páginas** → haz clic en la que quieras → **Editar con Elementor**.
- Desde ahí puedes añadir secciones, columnas, textos, imágenes, botones, etc., y cambiar estilos por bloque.

Para que la página se vea en el menú: **Apariencia** → **Menús** → elige el menú (por ejemplo “Principal”) → marca la nueva página en “Páginas” → **Añadir al menú** → **Guardar menú**.

### Modificar el CSS (estilos globales)

Tienes varias opciones, de la más sencilla a la más avanzada:

1. **CSS adicional del tema (rápido)**  
   **Apariencia** → **Personalizar** → **CSS adicional**. Ahí puedes pegar reglas CSS que afectan a todo el sitio. Ejemplo:
   ```css
   .elementor-heading-title { color: #1a1a2e; }
   .elementor-button { border-radius: 8px; }
   ```

2. **Plugin “Simple Custom CSS and JS”** (ya instalado)  
   En el panel: **Custom CSS & JS** → **Add Custom CSS** (o “Add Custom Code”). Crea un archivo de tipo “CSS” y escribe tus reglas. Puedes elegir que se cargue en “Front-end” (solo en el sitio, no en el admin). Así mantienes todo el CSS personalizado en un solo lugar.

3. **Estilos por página/sección en Elementor**  
   Al editar una página con Elementor: selecciona una sección o widget → pestaña **Avanzado** → **CSS personalizado**. Sirve para cambios que solo aplican a esa página o a ese bloque.

4. **Tema hijo (para no perder cambios al actualizar)**  
   Si quieres modificar archivos del tema (PHP/CSS) sin que se pierdan al actualizar: crea un **tema hijo** de “Hello Elementor”, activa el tema hijo y pon ahí tu `style.css` y archivos extra. Es la opción más técnica pero la más segura a largo plazo.

### Homepage con HTML/CSS en el proyecto (sin Elementor)

Para que la portada no dependa del widget de Elementor y se edite todo en archivos:

1. **Plantilla creada:** "Homepage (HTML/CSS en proyecto)".
2. **En el panel:** Edita la página que es tu portada (o la que quieras usar) → en la columna derecha, **Atributos de página** → **Plantilla** → elige **"Homepage (HTML/CSS en proyecto)"** → Actualizar.
3. **Archivos a editar en el proyecto:**
   - **HTML:** `wp-content/themes/hello-elementor-child/template-parts/homepage-content.php`
   - **CSS:** `wp-content/themes/hello-elementor-child/css/homepage.css`
   - **JS (opcional):** `wp-content/themes/hello-elementor-child/js/homepage.js`

**Por qué se veía a mitad de pantalla con Elementor:** Si pegas un documento HTML completo (con `<!DOCTYPE>`, `<head>`, `<body>`) dentro del widget "Código HTML" de Elementor, ese contenido queda dentro de una columna del constructor. El `body` de tu CSS no es el de la página real, y el ancho queda limitado al del widget. Por eso la plantilla anterior genera la página entera desde PHP y carga tu HTML/CSS desde archivos, sin usar el widget.

### CSS por página en archivos (tema hijo)

Para editar el CSS de cada página en archivos del proyecto (no desde el panel):

1. **Activa el tema hijo:** Panel → **Apariencia** → **Temas** → **Hello Elementor Child** → Activar.
2. **CSS global:** edita en tu proyecto `wp-content/themes/hello-elementor-child/css/custom.css`.
3. **CSS solo en una página:** crea un archivo con el **slug** de la página en `wp-content/themes/hello-elementor-child/css/pages/`, por ejemplo `contact-us.css` para la página cuyo slug es `contact-us`. El slug lo ves en Páginas → editar la página (en la URL o en "Enlace permanente").

Los cambios en esos archivos se aplican al recargar el sitio.

### Resumen rápido

| Quiero…              | Dónde hacerlo |
|----------------------|---------------|
| Crear una página     | Páginas → Añadir → Editar con Elementor |
| Editar una página    | Páginas → [página] → Editar con Elementor |
| Cambiar menú         | Apariencia → Menús |
| CSS para todo el sitio | Apariencia → Personalizar → CSS adicional, o Custom CSS & JS |
| CSS solo en una página | Elementor → sección/widget → Avanzado → CSS personalizado |

### Comandos útiles

```bash
# Ver logs
docker compose logs -f

# Parar todo
docker compose down

# Parar y borrar también la base de datos (empezar de cero)
docker compose down -v
```

---

## Requisitos (sin Docker)

- **PHP** 7.4 o superior (recomendado 8.x)
- **MySQL** o **MariaDB**
- Un servidor web (Apache, Nginx) o servidor PHP integrado

---

## Opción 1: Usar el instalador de Duplicator (recomendado)

1. **Instala un entorno local** con PHP y MySQL, por ejemplo:
   - [XAMPP](https://www.apachefriends.org/) (Windows)
   - [Laragon](https://laragon.org/) (Windows)
   - [Local by Flywheel](https://localwp.com/) (Windows/Mac)
   - [Docker](https://www.docker.com/) con imagen WordPress

2. **Copia toda la carpeta** del proyecto dentro de la carpeta del servidor (por ejemplo `htdocs` en XAMPP o la carpeta de sitios en Laragon).

3. **Crea una base de datos vacía** en MySQL (phpMyAdmin o línea de comandos):
   ```sql
   CREATE DATABASE spd_wp_local CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   CREATE USER 'spd_user'@'localhost' IDENTIFIED BY 'tu_password';
   GRANT ALL ON spd_wp_local.* TO 'spd_user'@'localhost';
   FLUSH PRIVILEGES;
   ```

4. **Abre en el navegador** el instalador de Duplicator:
   - Si usas XAMPP/Laragon con la carpeta en `htdocs/archive`:
     ```
     http://localhost/archive/dup-installer/main.installer.php
     ```
   - O el archivo de respaldo del instalador en la raíz:
     ```
     http://localhost/archive/20260208_spdcontractinginc_27c8ba10e49c5b772531_20260208203750_installer-backup.php
     ```

5. Sigue los pasos del asistente:
   - **Paso 1:** Acepta los términos y configura la base de datos (nombre, usuario, contraseña, host `localhost`).
   - **Paso 2:** El instalador puede indicar que los archivos ya están extraídos (modo “manual extract”); continúa.
   - **Paso 3:** Define la **nueva URL** del sitio (ej. `http://localhost/archive`).
   - **Paso 4:** Finaliza y elimina la carpeta `dup-installer` por seguridad.

---

## Opción 2: Configuración manual (sin Duplicator)

Si prefieres no usar el instalador:

### 1. Crear la base de datos

Crea una base de datos y un usuario en MySQL (como en el paso 3 de la Opción 1).

### 2. Crear `wp-config.php`

En la **raíz** del proyecto hay un archivo **`wp-config.local.php`** de ejemplo. Cópialo y renómbralo a **`wp-config.php`** (o crea `wp-config.php` con el mismo contenido) y edita:

- `DB_NAME` → nombre de la base de datos
- `DB_USER` → usuario de MySQL
- `DB_PASSWORD` → contraseña del usuario
- `DB_HOST` → normalmente `localhost`

### 3. Importar la base de datos

Importa el archivo SQL del backup en tu base de datos:

- **phpMyAdmin:** Selecciona la base de datos → pestaña “Importar” → elegir archivo  
  `dup-installer/dup-database__27c8ba1-08203750.sql`
- **Línea de comandos:**
  ```bash
  mysql -u spd_user -p spd_wp_local < "dup-installer/dup-database__27c8ba1-08203750.sql"
  ```

### 4. Cambiar la URL del sitio

El sitio original usaba `https://qmbqbrt0dq.wpdns.site`. Debes actualizar la base de datos a tu nueva URL (ej. `http://localhost/archive`).

**Con WP-CLI** (si lo tienes instalado):
```bash
wp search-replace "https://qmbqbrt0dq.wpdns.site" "http://localhost/archive" --all-tables --path=.
```

**Con SQL** en phpMyAdmin o consola MySQL:
```sql
USE spd_wp_local;

UPDATE wp_options SET option_value = 'http://localhost/archive' WHERE option_name = 'siteurl';
UPDATE wp_options SET option_value = 'http://localhost/archive' WHERE option_name = 'home';
```

(Ajusta `archive` si tu carpeta tiene otro nombre.)

### 5. Iniciar el servidor

**Servidor PHP integrado** (desde la raíz del proyecto):
```bash
php -S localhost:8080
```
Luego abre: **http://localhost:8080**

**XAMPP/Laragon:** Asegúrate de que Apache y MySQL estén iniciados y entra a la URL que corresponda a la carpeta del proyecto (ej. `http://localhost/20260208_spdcontractinginc_27c8ba10e49c5b772531_20260208203750_archive`).

---

## Acceso al escritorio de WordPress

- **URL de login:** `http://tu-url-local/wp-login.php`  
- **Usuarios del backup:**  
  - `fgutierrez@spdcon-inc.com`  
  - `arielhenriquez17@hotmail.com`  
  - `info@hauscommercialcleaning.com`  

Las contraseñas son las que tenían en el sitio original; si no las recuerdas, tendrás que restablecerlas desde la base de datos o usando “¿Perdiste tu contraseña?” si el correo funciona en local.

---

## Resumen rápido (Opción 2)

1. Instalar XAMPP/Laragon (o similar).  
2. Copiar el proyecto en `htdocs` (o carpeta de sitios).  
3. Crear base de datos y usuario en MySQL.  
4. Copiar `wp-config.local.php` → `wp-config.php` y poner nombre BD, usuario y contraseña.  
5. Importar `dup-installer/dup-database__27c8ba1-08203750.sql`.  
6. Ejecutar los `UPDATE` de `siteurl` y `home` con tu URL local.  
7. Abrir la URL en el navegador (ej. `http://localhost/.../wp-login.php`).
