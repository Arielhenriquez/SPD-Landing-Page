<?php
/**
 * Datos de las subpáginas Approach & Expertise.
 * Cada entrada corresponde a un slug de página WP.
 * El contenido (overview/scope) puede sobreescribirse editando la página en el admin;
 * estos valores actúan como fallback cuando la página no tiene contenido WP.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$img = 'https://lh3.googleusercontent.com/aida-public/';

return array(

	'preconstruction' => array(
		'slug'       => 'preconstruction',
		'title'      => 'Preconstruction',
		'hero_image' => $img . 'AB6AXuD3JQg437_0B3vCiKfaxkuXxBr7tklMmMGSxQ6woYhPuddhZsLBcmmTGvvGZhmLS3FhrL3924HFxHy48fK8XJ1szlHbWnY1zsQc_cd1vRq1ijUkGx4C52oXROl0gerfp-KdD7G2KKKl72qJevoBAzp2cxAtE20nxUrixTTzeXwgsrm0b_7xgLrtgmqkgDw2d6S4mNtX2YNrR_Jzmd6ytXLT_iTUCcEItRUluEF7rOwYaMWcHUMSJ75-irwMa2yRA5nfGij4TxoFZEdx',
		'overview'   => 'SPD Contracting\'s preconstruction services lay the groundwork for every successful project. We work with owners and design teams early in the process to assess feasibility, develop accurate budgets, evaluate constructability, and identify long-lead procurement items — before a single shovel hits the ground.',
		'scope'      => 'Services include: site analysis, cost estimating, value engineering, schedule development, subcontractor pre-qualification, permit strategy, and phasing planning for occupied facilities.',
		'gallery'    => array(),
	),

	'construction-management' => array(
		'slug'       => 'construction-management',
		'title'      => 'Construction Management',
		'hero_image' => $img . 'AB6AXuAjinhFGO_lpubKSzSNbZYr5cLxUWxBQyH1kgX1y86ydTaUrFRRiqfv8e9b-maCzhAjJsLkp1SgXDGKt5d_DlWn463L-IC6-FYk0Iam0EaycP5KEJeivYLvZRVMQnX6jMz2oLUNtn1TIR7haVa2kmXsKuW0UOdDpHsKlfAQcEx3qfkClxtVy54EECc09DIrYBUBE5mAa9YnwW9CjEU28S95nqb2PjIzJ71xhKOwP0XYR1mdjunBcHgMFpQjT6dYI8bHBJls_EHN4ckH',
		'overview'   => 'As construction manager, SPD Contracting acts as the owner\'s on-site representative — coordinating all trades, managing the schedule, controlling costs, and ensuring quality at every phase. We bring transparency and accountability to complex, multi-phase projects.',
		'scope'      => 'Services include: bid packaging and trade coordination, RFI/submittal management, schedule oversight, cost reporting, safety compliance, punch-list management, and closeout documentation.',
		'gallery'    => array(),
	),

	'project-management' => array(
		'slug'       => 'project-management',
		'title'      => 'Project Management',
		'hero_image' => $img . 'AB6AXuBxD6bpHRp1-5Z_0rLDrrDMJnm7XdoncyHhlevv5od5R0GvJLyuwIGsRCepMMwbG6YqM97j_87lfRg7kJg0-DxWcnE3lwcz78tWxc_4FEsMo15UvSmsYMIxnaKT0JkvDXZBCo3aVIOgEHB6gexOnikQvzQdKQV1Yd_hO2U9MnXXy0nFhl1StivDu5RGXcNKZTOFoQlK101_hJG8_zyKC52tWNtvMSviLBe6VyjpfwkY2GJPBEUSGObBh6UweqP89ZIWDTO91wzVu0gz',
		'overview'   => 'Our project management approach centers on keeping scope, schedule, and budget aligned from day one. SPD Contracting assigns dedicated project managers who own every aspect of delivery — from agency coordination and permit tracking to daily field supervision and stakeholder reporting.',
		'scope'      => 'Services include: project scheduling (CPM), budget monitoring, agency/owner liaison, subcontractor management, change order review, progress reporting, and lessons-learned documentation.',
		'gallery'    => array(),
	),

	'subcontracting' => array(
		'slug'       => 'subcontracting',
		'title'      => 'Subcontracting',
		'hero_image' => $img . 'AB6AXuA3F6jZ3DkPnziBg5BxFojepkLPpcfLWFG5LRvUWR-F8mjVIe-rrDjLjM7EFsb1B5ai1GusjXwflwN7kQnxet_G_zP-rRy8czEE_o8FRDiRGkQsOpXVZXi8VpjjhApFxNT5I31W9PkNAvhrgBmSCHGom4ud02WK8CD2rUdrB2EL46WBgSYuNXPndmQ27tBtDIKytIJdwUM06ugkWzYniW_9g1VG-JsprI2D7NynmD0_NxASpaFOlHTl_LJjgTMifvEa_e_ltPmOy0RM',
		'overview'   => 'SPD Contracting has built a deep network of pre-qualified local subcontractors across all major trades. We manage subcontractor selection, contracting, compliance, and performance — ensuring that every partner on the job meets our standards for quality, safety, and schedule.',
		'scope'      => 'Services include: subcontractor pre-qualification, scope-of-work definition, bid leveling, subcontract administration, certified payroll compliance, minority/SBE subcontractor coordination, and performance evaluation.',
		'gallery'    => array(),
	),

	'design-build' => array(
		'slug'       => 'design-build',
		'title'      => 'Design-Build',
		'hero_image' => $img . 'AB6AXuApFjBuw1vvOBW0zWuPjFAIfMWDQNpoZ6rTs9LAUxf5pwUaJXp_WTpeBcd9t0uToTpAwQ8DzwdWDMRDbgtQiMOlyeFJLObYjuA9Fc37QeGW27OxXTheVVWEPTpe65PCyiQ_ko5UdjBEQZBFnYDKbsX5tnfToDHuwNyeHrKhzLH6Hh6yRJCRkxrm_pZXtcb94afcC_1ixMh4VEB96vZzyuJR2udGwSfPWS0yCVoFiv_SV5dKkHh84yuM9N3ZTgDSIMa5Uo0jwvmSRkx6',
		'overview'   => 'As design-builder, SPD Contracting holds a single contract covering both design and construction — streamlining communication, eliminating finger-pointing between designer and contractor, and delivering projects faster and within budget. We\'ve delivered successful design-build projects for DGS and MPD.',
		'scope'      => 'Services include: design team selection and management, bridging documents review, integrated design-construction scheduling, value engineering during design, early procurement, and single-source accountability.',
		'gallery'    => array(),
	),

	'construction-manager-at-risk' => array(
		'slug'       => 'construction-manager-at-risk',
		'title'      => 'Construction Manager at Risk',
		'hero_image' => $img . 'AB6AXuAKftn1FM49MrhtgBmDwmIOdNhWVGqoEpne48N-dmpk9mqgz-0aBbgVV0yAjhvDq1ystaPPqbk23-REg5REcZZ4-tfBMgXMKC5r3MkNiIelg81ksjPFt-byyTrO-46nX2rWMqyeHQ5qt-yB18Ww09RTgwe-D3XvQp71KbudhFclejx0R7q5KiqYk4ydiwkDbKFi1sGz4adUTXVMIfzUnXk4FfXSyt59DZtG0UZ45lghfUcJf2KLptaI1TX3OfCKqvvMQtNEKhDSZyh9',
		'overview'   => 'In the Construction Manager at Risk (CMAR) model, SPD Contracting provides preconstruction services during design and then commits to a Guaranteed Maximum Price (GMP) — assuming the risk of cost overruns above that GMP. This model gives owners price certainty without sacrificing quality or schedule flexibility.',
		'scope'      => 'Services include: preconstruction collaboration, GMP development, open-book estimating, constructability reviews, phased GMP packages, self-performance of key trades, and final GMP reconciliation.',
		'gallery'    => array(),
	),

	'self-perform' => array(
		'slug'       => 'self-perform',
		'title'      => 'Self-Perform',
		'hero_image' => $img . 'AB6AXuAiyGks4jyMLMwQ4wLCg4gl3XV06YIhes4x0BUYEXthHNtgMw2fBqZJgT0-BqEVFxAIDx6HYz4FuVTZIyDjPjMxauMVhEM6H1_NWMKxIxUYCINMhuDCagKB4yNnAlfnKEeR1knKXAQOBMfav_RIcLG0J3FD8UAH1nVL9kl0YMJ_04qZ7lnLfqTODSXJ7x3DHr5iAWP0aOIwETxQRqiPsET9jO6LdOUI1nEz8CbN8T2NRL_oDDPYaVCz6g1UBamiHYg3oxjUiphgbPy3',
		'overview'   => 'SPD Contracting\'s ability to self-perform critical construction trades gives us a distinct advantage in quality control, scheduling, and cost efficiency. By keeping core work in-house, we eliminate layers of markup, maintain direct accountability, and can mobilize faster than competitors who subcontract everything.',
		'scope'      => 'Self-perform capabilities include: general carpentry and rough framing, selective demolition, concrete work, drywall and finishes, painting, site work, and temporary protection. Scope expands as workforce grows.',
		'gallery'    => array(),
	),

);
