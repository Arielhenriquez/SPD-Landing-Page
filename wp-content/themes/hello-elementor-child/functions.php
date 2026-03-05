<?php
/**
 * Hello Elementor Child - Navbar, footer y carrusel genérico (repo SPD-test/waldo).
 * Plantillas: Homepage, Projects. Assets compartidos para ambas.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Clase en body para que los estilos SPD (navbar/footer) ganen sobre Elementor y tema padre.
 */
function hello_elementor_child_body_class_spd( $classes ) {
	$classes[] = 'spd-theme';
	return $classes;
}
add_filter( 'body_class', 'hello_elementor_child_body_class_spd', 5 );

/**
 * Register "Approach Single" in the Template dropdown for EVERY post type that has a
 * template selector — this matches the mechanism Elementor itself uses (see
 * Elementor\Modules\PageTemplates\Module::add_wp_templates_support).
 *
 * Two support flags cover both cases:
 *   'page-attributes' — the WP-native Template dropdown (classic editor / Quick Edit)
 *   'elementor'       — Elementor's injected Template dropdown (covers CPTs registered by
 *                       Elementor Pro or ACF that add 'elementor' support)
 *
 * Runs on init at priority 20 so all CPTs are already registered.
 * Priority 5 on each theme_{type}_templates filter ensures our entry appears before
 * Elementor (priority 10) overwrites the array.
 *
 * Why the key is 'page-templates/template-approach-single.php':
 *   WordPress stores exactly this string in the _wp_page_template post-meta when the user
 *   picks the template from the dropdown.  It must match the relative path from the theme root.
 */
function hello_elementor_child_add_approach_template_support() {
	$native_types   = (array) get_post_types_by_support( 'page-attributes' );
	$elementor_types = (array) get_post_types_by_support( 'elementor' );
	$all_types = array_unique( array_merge( $native_types, $elementor_types ) );

	foreach ( $all_types as $post_type ) {
		add_filter(
			"theme_{$post_type}_templates",
			'hello_elementor_child_register_approach_template',
			5  /* before Elementor's priority 10 */
		);
	}
}
add_action( 'init', 'hello_elementor_child_add_approach_template_support', 20 );

function hello_elementor_child_register_approach_template( $templates ) {
	$templates['page-templates/template-approach-single.php'] = __( 'Approach Single', 'hello-elementor-child' );
	return $templates;
}

/**
 * DEBUG — approach page diagnostics.
 *
 * Fires on the 'wp' action (after main query) and on 'template_include' (last, priority 99).
 * Output goes to wp-content/debug.log when both WP_DEBUG=true and WP_DEBUG_LOG=true.
 *
 * What to look for in the log:
 *   get_post_type      → the actual CPT slug for these posts (e.g. "approach_expertise")
 *   _wp_page_template  → what the Template dropdown saved; should be
 *                        "page-templates/template-approach-single.php" after you pick it
 *   template_include   → the final PHP file WordPress will load; must end in
 *                        "page-templates/template-approach-single.php"
 *
 * REMOVE OR COMMENT THIS BLOCK once the above values are confirmed correct.
 */
function hello_elementor_child_debug_approach_post_type() {
	if ( is_admin() ) {
		return;
	}
	$uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
	if ( ! preg_match( '#/(?:expertise|approach-expertise)/#', $uri ) ) {
		return;
	}
	$qo        = get_queried_object();
	$qo_id     = get_queried_object_id();
	$post_type = get_post_type( $qo_id );
	$post_slug = $qo_id ? get_post_field( 'post_name', $qo_id ) : '';
	$tpl_meta  = $qo_id ? (string) get_page_template_slug( $qo_id ) : '(no id)';

	error_log( '[SPD Approach Debug] ---- wp action ----' );
	error_log( '[SPD Approach Debug] URI=' . $uri );
	error_log( '[SPD Approach Debug] queried_object_id=' . $qo_id );
	error_log( '[SPD Approach Debug] get_post_type=' . var_export( $post_type, true ) );
	error_log( '[SPD Approach Debug] post_name=' . $post_slug );
	error_log( '[SPD Approach Debug] _wp_page_template=' . $tpl_meta );
	error_log( '[SPD Approach Debug] is_singular(page)=' . var_export( is_singular( 'page' ), true ) );
	error_log( '[SPD Approach Debug] is_singular()=' . var_export( is_singular(), true ) );
	if ( $qo ) {
		error_log( '[SPD Approach Debug] queried_object class=' . get_class( $qo ) );
	}
}
add_action( 'wp', 'hello_elementor_child_debug_approach_post_type' );

/**
 * DEBUG — log the final template file resolved by template_include (priority 99 = last).
 * Remove together with the function above once confirmed.
 */
function hello_elementor_child_debug_approach_template_include( $template ) {
	if ( is_admin() ) {
		return $template;
	}
	$uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
	if ( preg_match( '#/(?:expertise|approach-expertise)/#', $uri ) ) {
		error_log( '[SPD Approach Debug] template_include (final)=' . $template );
	}
	return $template;
}
add_filter( 'template_include', 'hello_elementor_child_debug_approach_template_include', 99 );

/**
 * Evitar que el tema padre encole header-footer.css (usamos nuestro navbar/footer).
 */
function hello_elementor_child_disable_parent_header_footer_css() {
	if ( is_admin() ) {
		return;
	}
	wp_dequeue_style( 'hello-elementor-header-footer' );
	wp_deregister_style( 'hello-elementor-header-footer' );
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_disable_parent_header_footer_css', 20 );

/**
 * CSS global del tema hijo (si existe).
 */
function hello_elementor_child_enqueue_styles() {
	$path = get_stylesheet_directory();
	$base = get_stylesheet_directory_uri();
	$custom_file = $path . '/css/custom.css';
	if ( file_exists( $custom_file ) ) {
		wp_enqueue_style(
			'hello-elementor-child-global',
			$base . '/css/custom.css',
			array(),
			filemtime( $custom_file )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_styles', 20 );

/**
 * Forzar plantilla Contact Us cuando la página tiene slug contact-us-2,
 * para que se muestre hero, formulario, contact-info y related projects con los estilos del tema.
 */
function hello_elementor_child_force_contact_template( $template ) {
	if ( is_singular( 'page' ) ) {
		$slug = get_post_field( 'post_name', get_queried_object_id() );
		if ( $slug === 'contact-us-2' ) {
			$contact_template = get_stylesheet_directory() . '/template-contact-us.php';
			if ( file_exists( $contact_template ) ) {
				return $contact_template;
			}
		}
	}
	return $template;
}
add_filter( 'template_include', 'hello_elementor_child_force_contact_template', 5 );

/**
 * Forzar single-project.php para CPT project (evitar que Elementor Theme Builder lo sustituya).
 */
function hello_elementor_child_force_cpt_project_template( $template ) {
	if ( is_singular( 'project' ) ) {
		$single = get_stylesheet_directory() . '/single-project.php';
		if ( file_exists( $single ) ) {
			return $single;
		}
	}
	return $template;
}
add_filter( 'template_include', 'hello_elementor_child_force_cpt_project_template', 15 );

/**
 * Forzar plantilla Project Single cuando el slug de la página — o el path de la URL — coincide
 * con un proyecto en projects-data.php. Cubre dos casos:
 *   1) La página WP existe como child de /projects/ → is_singular('page') + slug del post.
 *   2) La página WP NO existe pero la URL es /projects/{slug} → fallback por REQUEST_URI.
 * Prioridad 20: corre después de Elementor (≈12) para sobreescribir si hace falta.
 */
function hello_elementor_child_force_project_single_template( $template ) {
	$stylesheet_dir   = get_stylesheet_directory();
	$project_template = $stylesheet_dir . '/template-single-project.php';
	if ( ! file_exists( $project_template ) ) {
		return $template;
	}

	$projects = include $stylesheet_dir . '/inc/projects-data.php';

	/* --- Caso 1: página WP cuyo post_name coincide con un slug de proyecto --- */
	if ( is_singular( 'page' ) ) {
		$slug = get_post_field( 'post_name', get_queried_object_id() );
		if ( $slug ) {
			foreach ( $projects as $p ) {
				if ( isset( $p['slug'] ) && $p['slug'] === $slug ) {
					return $project_template;
				}
			}
		}
	}

	/* --- Caso 2: URL del tipo /projects/{slug} aunque no exista página WP --- */
	$uri_path = isset( $_SERVER['REQUEST_URI'] )
		? parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH )
		: '';
	if ( $uri_path && preg_match( '#/projects/([^/?#]+)/?$#', $uri_path, $m ) ) {
		$url_slug = $m[1];
		foreach ( $projects as $p ) {
			if ( isset( $p['slug'] ) && $p['slug'] === $url_slug ) {
				return $project_template;
			}
		}
	}

	return $template;
}
add_filter( 'template_include', 'hello_elementor_child_force_project_single_template', 20 );

/**
 * Forzar template-approach-single.php cuando el slug de la página coincide con un servicio
 * de inc/approach-data.php, o cuando la URL es /expertise/{slug} o /approach-expertise/{slug}.
 *
 * Detection order (first match wins):
 *   0. Explicit template meta: _wp_page_template is set to our template file.  This is the
 *      authoritative signal — the user selected it in WP Admin.  Always honored, beats Elementor.
 *   1. Slug match: any singular (non-project) whose post_name is a known service slug.
 *   2. URL fallback: /expertise/{slug} or /approach-expertise/{slug} when no WP object exists.
 *
 * Priority 22: runs after project-single (20) and after Elementor's template_include (~10),
 * so we always get the last word.
 */
function hello_elementor_child_force_approach_single_template( $template ) {
	$stylesheet_dir    = get_stylesheet_directory();
	/* Canonical path — must match the key stored in _wp_page_template meta by WP. */
	$approach_template = $stylesheet_dir . '/page-templates/template-approach-single.php';
	if ( ! file_exists( $approach_template ) ) {
		return $template;
	}

	if ( is_singular() && ! is_singular( 'project' ) ) {
		$post_id = get_queried_object_id();

		/*
		 * --- Check 0: explicit template meta assignment (highest priority).
		 * get_page_template_slug() reads _wp_page_template post-meta; works for any post_type,
		 * not just 'page'.  Accepts both the current canonical path and the legacy root path
		 * so that posts saved before the file was moved continue to work.
		 */
		$meta_val = (string) get_page_template_slug( $post_id );
		if ( in_array( $meta_val, array(
			'page-templates/template-approach-single.php',
			'template-approach-single.php',
		), true ) ) {
			return $approach_template;
		}

		/*
		 * --- Check 1: post slug is a known service slug.
		 * Covers CPT posts that haven't had the template manually selected yet.
		 */
		$approach_map = include $stylesheet_dir . '/inc/approach-data.php';
		$slugs        = array_keys( $approach_map );
		$post_slug    = get_post_field( 'post_name', $post_id );
		if ( $post_slug && in_array( $post_slug, $slugs, true ) ) {
			return $approach_template;
		}
	}

	/* --- Check 2: URL /expertise/{slug} or /approach-expertise/{slug} (no WP object) --- */
	$uri_path = isset( $_SERVER['REQUEST_URI'] )
		? parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH )
		: '';
	if ( $uri_path && preg_match( '#/(?:expertise|approach-expertise)/([^/?#]+)/?$#', $uri_path, $m ) ) {
		if ( ! isset( $approach_map ) ) {
			$approach_map = include $stylesheet_dir . '/inc/approach-data.php';
			$slugs        = array_keys( $approach_map );
		}
		if ( in_array( $m[1], $slugs, true ) ) {
			return $approach_template;
		}
	}

	return $template;
}
add_filter( 'template_include', 'hello_elementor_child_force_approach_single_template', 22 );

/**
 * URL del project detail: página por slug, o CPT project por slug / slug-project.
 */
function spd_project_page_url( $slug ) {
	if ( empty( $slug ) ) {
		return home_url( '/' );
	}
	$page = get_page_by_path( $slug );
	if ( $page ) {
		return get_permalink( $page );
	}
	$project_post = get_posts( array(
		'post_type'      => 'project',
		'name'           => $slug,
		'posts_per_page' => 1,
		'post_status'    => 'publish',
	) );
	if ( ! empty( $project_post ) ) {
		return get_permalink( $project_post[0] );
	}
	$project_post = get_posts( array(
		'post_type'      => 'project',
		'name'           => $slug . '-project',
		'posts_per_page' => 1,
		'post_status'    => 'publish',
	) );
	if ( ! empty( $project_post ) ) {
		return get_permalink( $project_post[0] );
	}
	return home_url( '/projects/' . $slug . '/' );
}

/**
 * URL de una página WP por slug (ej: company-info, approach-expertise). Sin hardcode de dominio.
 */
function spd_page_url_by_slug( $slug ) {
	if ( empty( $slug ) ) {
		return home_url( '/' );
	}
	$page = get_page_by_path( $slug, OBJECT, 'page' );
	if ( $page ) {
		return get_permalink( $page );
	}
	return home_url( '/' . $slug . '/' );
}

/**
 * Navbar y footer SPD en todo el sitio: Inter, base, layout, components, navbar + navbar.js.
 * Se cargan en todas las páginas del front para que header.php y footer.php del tema hijo los muestren bien.
 * Se desencola el header-footer.css del tema padre para evitar que sus estilos globales pisen los nuestros.
 */
function hello_elementor_child_enqueue_spd_header_footer() {
	if ( is_admin() ) {
		return;
	}
	$path = get_stylesheet_directory();
	$uri  = get_stylesheet_directory_uri();

	wp_enqueue_style(
		'hello-child-inter-font',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	if ( ! wp_style_is( 'hello-child-material-icons', 'enqueued' ) ) {
		wp_enqueue_style(
			'hello-child-material-icons',
			'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200',
			array(),
			null
		);
	}

	$header_footer_styles = array(
		'base'       => '/css/base.css',
		'layout'     => '/css/layout.css',
		'components' => '/css/components.css',
		'navbar'     => '/css/navbar.css',
	);
	$prev = 'hello-child-inter-font';
	foreach ( $header_footer_styles as $handle => $file ) {
		$full = $path . $file;
		if ( ! file_exists( $full ) ) {
			continue;
		}
		$dep = $handle === 'base' ? array( 'hello-child-inter-font' ) : array( $prev );
		wp_enqueue_style(
			'hello-child-' . $handle,
			$uri . $file,
			$dep,
			filemtime( $full )
		);
		$prev = 'hello-child-' . $handle;
	}

	$navbar_js = $path . '/js/navbar.js';
	if ( file_exists( $navbar_js ) ) {
		wp_enqueue_script(
			'hello-child-navbar',
			$uri . '/js/navbar.js',
			array(),
			filemtime( $navbar_js ),
			true
		);
		wp_add_inline_script(
			'hello-child-navbar',
			'window.projectPageBase="' . esc_js( home_url( '/projects/' ) ) . '";window.projectLinkSuffix="";',
			'before'
		);
		wp_add_inline_script(
			'hello-child-navbar',
			"document.addEventListener('DOMContentLoaded',function(){if(window.Navbar&&window.Navbar.init)window.Navbar.init();});",
			'after'
		);
	}

	/* Remove white gap above navbar: WP adds margin-top to html when admin bar shows; we override globally */
	wp_add_inline_style( 'hello-child-navbar', 'html { margin-top: 0 !important; }' );

	/* Forzar navbar, mega menú Projects y footer por encima de Elementor/tema padre */
	$navbar_override = '
		body.spd-theme #site-header.site-header {
			position: fixed !important;
			top: 0 !important;
			left: 0 !important;
			right: 0 !important;
			width: 100% !important;
			max-width: 100% !important;
			min-width: 100% !important;
			height: 72px !important;
			background: #0d1b2a !important;
			z-index: 100 !important;
			display: flex !important;
			align-items: center !important;
			padding: 0 !important;
			box-sizing: border-box !important;
		}
		body.spd-theme #site-footer.site-footer {
			width: 100% !important;
			max-width: 100% !important;
			min-width: 100% !important;
			background: #1b263b !important;
			color: #ffffff !important;
			padding: 48px 0 32px !important;
			box-sizing: border-box !important;
		}
		/* Mega menú Projects: forzar estilos para que no los pise Elementor */
		body.spd-theme #site-header .nav__dropdown.nav__mega,
		body.spd-theme #site-header #nav-dropdown-projects {
			display: grid !important;
			grid-template-columns: 280px 1fr !important;
			min-width: 520px !important;
			max-width: 600px !important;
			background: rgba(13, 27, 42, 0.98) !important;
			border-radius: 0 0 8px 8px !important;
			box-shadow: 0 12px 32px rgba(0, 0, 0, 0.4) !important;
			padding: 0 !important;
		}
		body.spd-theme #site-header .nav__mega-cols,
		body.spd-theme #site-header #nav-dropdown-projects .nav__mega-cols {
			background: transparent !important;
			padding: 12px 0 !important;
		}
		body.spd-theme #site-header .nav__mega-category {
			background: transparent !important;
			color: rgba(255, 255, 255, 0.9) !important;
			border: none !important;
		}
		body.spd-theme #site-header .nav__mega-category:hover,
		body.spd-theme #site-header .nav__mega-category:focus {
			background: rgba(255, 255, 255, 0.06) !important;
			color: #ffffff !important;
		}
		body.spd-theme #site-header .nav__mega-category.is-active {
			background: rgba(224, 124, 36, 0.15) !important;
			color: #e07c24 !important;
		}
		body.spd-theme #site-header .nav__mega-panel-wrap {
			border-left: 1px solid rgba(255, 255, 255, 0.12) !important;
			background: transparent !important;
		}
		body.spd-theme #site-header .nav__mega-panel {
			background: rgba(0, 0, 0, 0.25) !important;
			border-radius: 8px !important;
			margin: 12px 12px 12px 0 !important;
			padding: 16px 20px !important;
		}
		body.spd-theme #site-header .nav__mega-panel-inner a {
			color: rgba(255, 255, 255, 0.92) !important;
			text-decoration: none !important;
		}
		body.spd-theme #site-header .nav__mega-panel-inner a:hover {
			color: #e07c24 !important;
		}
		/* Dropdown común (panel): Projects y Approach – fondo, sombra, esquinas */
		body.spd-theme #site-header .nav__dropdown,
		body.spd-theme #site-header #nav-dropdown-projects,
		body.spd-theme #site-header #nav-dropdown-approach {
			background: rgba(13, 27, 42, 0.98) !important;
			border-radius: 0 0 8px 8px !important;
			box-shadow: 0 12px 32px rgba(0, 0, 0, 0.4) !important;
			padding: 0 !important;
		}
		/* Approach & Expertise: lista de enlaces */
		body.spd-theme #site-header #nav-dropdown-approach .nav__dropdown-list,
		body.spd-theme #site-header .nav__dropdown:not(.nav__mega) .nav__dropdown-list {
			padding: 8px 0 !important;
		}
		body.spd-theme #site-header #nav-dropdown-approach .nav__dropdown-list a,
		body.spd-theme #site-header .nav__dropdown:not(.nav__mega) .nav__dropdown-list a {
			color: #ffffff !important;
			text-decoration: none !important;
			padding: 10px 20px !important;
		}
		body.spd-theme #site-header #nav-dropdown-approach .nav__dropdown-list a:hover,
		body.spd-theme #site-header .nav__dropdown:not(.nav__mega) .nav__dropdown-list a:hover {
			background: rgba(255, 255, 255, 0.1) !important;
			color: #e07c24 !important;
		}
	';
	wp_add_inline_style( 'hello-child-navbar', $navbar_override );
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_spd_header_footer', 999 );

/**
 * Assets para plantillas Homepage, Projects, Contact, Project Single (página) y CPT project (single-project.php).
 *
 * Service pages (Approach & Expertise subpages) are detected BEFORE project-single so that
 * $is_approach_single can exclude them from $is_single_project.  This prevents project-single.js
 * (which populates the page with project data) from loading on service pages.
 */
function hello_elementor_child_enqueue_spd_template_assets() {
	$is_homepage    = is_page_template( 'template-custom-homepage.php' );
	$is_projects    = is_page_template( 'template-projects.php' );
	$is_cpt_project = is_singular( 'project' );
	$is_contact_page_slug = is_page() && get_post_field( 'post_name', get_queried_object_id() ) === 'contact-us-2';
	$is_contact     = is_page_template( 'template-contact-us.php' ) || $is_contact_page_slug;
	$is_company_info = is_page_template( 'template-company-info.php' );
	$is_approach    = is_page_template( 'template-approach.php' );

	/* --- Detect service (Approach & Expertise) subpages ---
	 * Service pages are WP Pages whose post_name is a known service slug, OR any URL that matches
	 * /expertise/{slug} or /approach-expertise/{slug}.  We resolve this BEFORE $is_single_project
	 * so service pages are never mistakenly treated as project-single.
	 */
	$_service_slugs = array( 'preconstruction', 'construction-management', 'project-management', 'subcontracting', 'design-build', 'construction-manager-at-risk', 'self-perform' );

	/* Check 1: page template meta — check both the canonical path and the legacy root shim */
	$is_approach_single = is_page_template( 'page-templates/template-approach-single.php' )
	                   || is_page_template( 'template-approach-single.php' );

	/* Check 2: any singular (Page or CPT, excluding 'project') whose slug is a service slug */
	if ( ! $is_approach_single && is_singular() && ! is_singular( 'project' ) ) {
		$_slug = get_post_field( 'post_name', get_queried_object_id() );
		if ( $_slug && in_array( $_slug, $_service_slugs, true ) ) {
			$is_approach_single = true;
		}
	}

	/* Check 3: URL-based fallback — /expertise/{slug} or /approach-expertise/{slug} */
	if ( ! $is_approach_single ) {
		$_uri = isset( $_SERVER['REQUEST_URI'] ) ? parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) : '';
		if ( $_uri && preg_match( '#/(?:expertise|approach-expertise)/([^/?#]+)/?$#', $_uri, $_um ) ) {
			if ( in_array( $_um[1], $_service_slugs, true ) ) {
				$is_approach_single = true;
			}
		}
	}

	/* is_page_template('template-single-project.php') reads the _wp_page_template post-meta,
	 * which stays set even after our template_include filter overrides the actual file.
	 * Explicitly exclude service pages so their meta value never triggers project-single assets. */
	$is_single_project = ! $is_approach_single && is_page_template( 'template-single-project.php' );

	if ( ! $is_homepage && ! $is_projects && ! $is_contact && ! $is_single_project && ! $is_cpt_project && ! $is_company_info && ! $is_approach && ! $is_approach_single ) {
		return;
	}
	$path = get_stylesheet_directory();
	$uri  = get_stylesheet_directory_uri();

	$carousel_css = $path . '/css/vendor/carousel.css';
	if ( file_exists( $carousel_css ) ) {
		wp_enqueue_style(
			'hello-child-carousel',
			$uri . '/css/vendor/carousel.css',
			array( 'hello-child-navbar' ),
			filemtime( $carousel_css )
		);
	}
	$pages_css = $path . '/css/pages.css';
	if ( file_exists( $pages_css ) ) {
		wp_enqueue_style(
			'hello-child-pages',
			$uri . '/css/pages.css',
			array( 'hello-child-navbar' ),
			filemtime( $pages_css )
		);
	}

	$carousel_js = $path . '/js/vendor/carousel.js';
	if ( file_exists( $carousel_js ) ) {
		wp_enqueue_script(
			'hello-child-carousel',
			$uri . '/js/vendor/carousel.js',
			array(),
			filemtime( $carousel_js ),
			true
		);
	}

	if ( $is_homepage ) {
		$homepage_js = $path . '/js/homepage.js';
		if ( file_exists( $homepage_js ) ) {
			wp_enqueue_script(
				'hello-child-homepage',
				$uri . '/js/homepage.js',
				array( 'hello-child-carousel', 'hello-child-navbar' ),
				filemtime( $homepage_js ),
				true
			);
		}
	}

	if ( $is_contact ) {
		$contact_css = $path . '/css/pages/contact-us.css';
		if ( file_exists( $contact_css ) ) {
			wp_enqueue_style(
				'hello-child-contact-us',
				$uri . '/css/pages/contact-us.css',
				array( 'hello-child-pages' ),
				filemtime( $contact_css )
			);
		}
	}

	/* project.css is shared by project-single AND approach-single (both use .project-hero etc.) */
	if ( $is_single_project || $is_cpt_project || $is_approach_single ) {
		$project_css = $path . '/css/pages/project.css';
		if ( file_exists( $project_css ) ) {
			wp_enqueue_style(
				'hello-child-project',
				$uri . '/css/pages/project.css',
				array( 'hello-child-pages' ),
				filemtime( $project_css )
			);
		}
	}

	/* project-single.js populates the page with project data — NEVER load it on service pages */
	if ( $is_single_project || $is_cpt_project ) {
		$project_single_js = $path . '/js/pages/project-single.js';
		if ( file_exists( $project_single_js ) ) {
			wp_enqueue_script(
				'hello-child-project-single',
				$uri . '/js/pages/project-single.js',
				array( 'hello-child-carousel', 'hello-child-navbar' ),
				filemtime( $project_single_js ),
				true
			);
			$projects  = include $path . '/inc/projects-data.php';
			$images    = array();
			$excerpts  = array();
			foreach ( $projects as $p ) {
				if ( ! empty( $p['slug'] ) ) {
					$images[ $p['slug'] ]   = isset( $p['image'] ) ? $p['image'] : '';
					$excerpts[ $p['slug'] ] = isset( $p['excerpt'] ) ? $p['excerpt'] : '';
				}
			}
			wp_localize_script( 'hello-child-project-single', 'projectsImages', $images );
			wp_localize_script( 'hello-child-project-single', 'projectsExcerpts', $excerpts );

			$projects_data = array();
			foreach ( $projects as $p ) {
				if ( empty( $p['slug'] ) ) {
					continue;
				}
				$slug = $p['slug'];
				$projects_data[ $slug ] = array(
					'slug'    => $slug,
					'title'   => isset( $p['title'] ) ? $p['title'] : ( isset( $p['label'] ) ? $p['label'] : $slug ),
					'excerpt' => isset( $p['excerpt'] ) ? $p['excerpt'] : '',
					'image'   => isset( $p['image'] ) ? $p['image'] : '',
					'url'     => spd_project_page_url( $slug ),
				);
			}
			wp_localize_script( 'hello-child-project-single', 'projectsData', $projects_data );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_enqueue_spd_template_assets', 16 );
