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
add_action('wp_ajax_script_ajax', 'script_ajax');
add_action('wp_ajax_nopriv_script_ajax', 'script_ajax');



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
