<?php
function mon_theme_enqueue_style()
{
	$theme   = wp_get_theme('montheme');
	$version = $theme->get('Version');

	wp_enqueue_style('montheme-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), $version);
	wp_enqueue_script('montheme-script', get_stylesheet_directory_uri() . '/assets/js/script.js', array('jquery'), $version);
	wp_enqueue_script('fontawesome-script', 'https://kit.fontawesome.com/5fbe3dd629.js', array());
	wp_enqueue_script('jquery-script', 'https://code.jquery.com/jquery-3.6.4.min.js', array());
}
add_action('wp_enqueue_scripts', 'mon_theme_enqueue_style');

function script_ajax()
{
	// Enqueue votre fichier ajax.js
	wp_enqueue_script('script-ajax', get_template_directory_uri() . '/assets/js/ajax.js', array('jquery'));

	// Ajouter une variable JavaScript avec la valeur de l'URL de l'admin-ajax.php
	wp_localize_script('script-ajax', 'ajaxurl', admin_url('admin-ajax.php'));
}

// Hook pour ajouter le script et les paramètres Ajax à la fin de la file d'attente
add_action('wp_enqueue_scripts', 'script_ajax');



/* Ajout d'un menu au header */
function header_menu()
{
	register_nav_menu('header', 'Menu_Header');
}
add_action('init', 'header_menu');

/* Ajout d'un menu au footer */
function footer_menu()
{
	register_nav_menu('footer', 'Menu_Footer');
}
add_action('init', 'footer_menu');


// Activer la fonctionnalité d'image mise en avant
add_theme_support('post-thumbnails');


// Ajouter une taille d'image personnalisée
add_image_size('custom-thumbnail-hero', 1440, 1000, true);
add_image_size('custom-thumbnail-home', 590, 500, true);
add_image_size('custom-thumbnail-carrousel', 91, 71, true);
add_image_size('custom-preview-carrousel', 60, 48, true);

add_theme_support('title-tag');

// ENLEVER LES BALISE P DE CONTACT FORM 7
add_filter('wpcf7_autop_or_not', '__return_false');

function get_lightbox_content()
{
	$post_id = $_POST['post_id'];

	// Récupérer l'image mise en avant
	$image_url = get_the_post_thumbnail_url($post_id, 'large');

	// Récupérer la référence du champ ACF
	$ref_photo = get_field('ref_photo', $post_id);

	// Récupérer la taxonomie "categorie"
	$categs = get_the_terms($post_id, 'categorie');
	$categories = array();

	if ($categs && !is_wp_error($categs)) {
		foreach ($categs as $categ) {
			$categories[] = $categ->name;
		}
	}

	// Préparez les données à renvoyer
	$lightbox_data = array(
		'image_url' => $image_url,
		'ref_photo' => $ref_photo,
		'categories' => $categories,
	);

	wp_send_json($lightbox_data);
}

add_action('wp_ajax_get_lightbox_content', 'get_lightbox_content');
add_action('wp_ajax_nopriv_get_lightbox_content', 'get_lightbox_content');

function FindSelectFilter()
{
	global $args_query;

	if (isset($_GET['categories']) and ($_GET['categories'] != '')) {
		$select_categorie = $_GET['categories'];
		$args_query['tax_query'][] = array(
			'taxonomy' => 'categorie',
			'field' => 'slug',
			'terms' => $select_categorie,
		);
	}
	if (isset($_GET['formats']) and ($_GET['formats'] != '')) {
		$select_format = $_GET['formats'];
		$args_query['tax_query'][] = array(
			'taxonomy' => 'format',
			'field' => 'slug',
			'terms' => $select_format,
		);
	}
	if (isset($_GET['sortby']) and ($_GET['sortby'] != '')) {
		$select_sortby = $_GET['sortby'];
		$args_query['order'] = $select_sortby;
	}
}
