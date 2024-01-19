<?php
function mon_theme_enqueue_style()
{
	$theme   = wp_get_theme('montheme');
	$version = $theme->get('Version');

	wp_enqueue_style('montheme-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), $version);
	wp_enqueue_script('global-script', get_stylesheet_directory_uri() . '/assets/js/script.js', array('jquery'), $version);

	wp_enqueue_script('script-ajax', get_template_directory_uri() . '/assets/js/ajax.js', array('jquery'));
	wp_localize_script('script-ajax', 'ajaxurl', admin_url('admin-ajax.php'));

	wp_enqueue_script('single-ajax-script', get_stylesheet_directory_uri() . '/assets/js/ajax_single.js', array('jquery'), $version, array(
		'strategy'  => 'defer',
	));
	wp_enqueue_script('fontawesome-script', 'https://kit.fontawesome.com/5fbe3dd629.js', array());
	wp_enqueue_script('jquery-script', 'https://code.jquery.com/jquery-3.6.4.min.js', array());
}
add_action('wp_enqueue_scripts', 'mon_theme_enqueue_style', 20);

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


// function FindSelectFilter()
// {
// 	global $args_query;

// 	if (isset($_GET['categories']) and ($_GET['categories'] != '')) {
// 		$select_categorie = $_GET['categories'];
// 		$args_query['tax_query'][] = array(
// 			'taxonomy' => 'categorie',
// 			'field' => 'slug',
// 			'terms' => $select_categorie,
// 		);
// 	}
// 	if (isset($_GET['formats']) and ($_GET['formats'] != '')) {
// 		$select_format = $_GET['formats'];
// 		$args_query['tax_query'][] = array(
// 			'taxonomy' => 'format',
// 			'field' => 'slug',
// 			'terms' => $select_format,
// 		);
// 	}
// 	if (isset($_GET['sortby']) and ($_GET['sortby'] != '')) {
// 		$select_sortby = $_GET['sortby'];
// 		$args_query['order'] = $select_sortby;
// 	}
// }

function FilterPosts()
{
	$page = $_GET["page"];
	$numberposts = 8;
	$totalposts = $numberposts * $page;

	$args_query = array(
		'post_type' => 'photographie',
		'posts_per_page' => $totalposts,
		// 'meta_key'  => '_main_char_field',
		// 'orderby'   => '',
		'paged' => 1,
	);

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
	return $args_query;
}
add_action('wp_ajax_FilterPosts', 'FilterPosts');
add_action('wp_ajax_nopriv_FilterPosts', 'FilterPosts');


function loadPosts()
{
	$args_query = FilterPosts();
	// print_r($args_query);

	$photographies_query = new WP_Query($args_query);

	$max_page = $photographies_query->max_num_pages;
	echo $max_page;

	ob_start();

	if ($photographies_query->have_posts()) : while ($photographies_query->have_posts()) : $photographies_query->the_post();
			$post_id = get_the_ID();


			// Partie pour le Overlay 
			echo '<div class="image-box overlay-box">';
			the_post_thumbnail(array(590, 500));
			echo '<div class="hidden overlay">
                <i class="fa-solid fa-expand icon_full" style="color: #ffffff;" data-post-id="' . $post_id . '">';

			// Ajout du partials pour la lightbox 
			get_template_part('partials/content', 'lightbox');

			echo '</i>
                <a class="icon_eye_link" href="' . get_permalink() . '">
                    <i class="fa-regular fa-eye icon_eye" style="color: #ffffff;"></i>
                </a>
                <div class="content">
                    <span class="content_title">' . get_the_title() . '</span>
                    <span class="content_categorie">';
			$categs = get_the_terms($post_id, 'categorie');
			if ($categs && !is_wp_error($categs)) {
				foreach ($categs as $categ) {
					echo $categ->name;
				}
			} else {
				echo 'Aucune catégorie associée à cet article.';
			}
			echo   '</span>
                </div>
            </div>
        </div>';
		endwhile;
	else :
		echo 'Aucun résultat trouvé.';
	endif;
	wp_reset_postdata();

	$content = ob_get_clean();

	// echo $content;
	$response = array('content' => $content, 'max' => $max_page);

	ob_clean();

	wp_send_json($response);
}
add_action('wp_ajax_loadPosts', 'loadPosts');
add_action('wp_ajax_nopriv_loadPosts', 'loadPosts');

function loadPosts_Single()
{
	$page_single = $_GET["page"];
	$numberposts_single = 2;
	$totalposts_single = $numberposts_single * $page_single;


	$args = array(
		'post_type' => 'photographie',
		'posts_per_page' => $totalposts_single,
		// 'meta_key'  => '_main_char_field',
		// 'orderby'   => '',
		'post__not_in' => array($post_id)
	);
	$photographies_query = new WP_Query($args);

	$max_page_single = $photographies_query->max_num_pages;
	echo $max_page_single;

	ob_start();

	if ($photographies_query->have_posts()) : while ($photographies_query->have_posts()) : $photographies_query->the_post();
			$post_id = get_the_ID();
			echo '<div class="image-box overlay-box">';
			the_post_thumbnail(array(590, 500));
			echo '<div class="hidden overlay">
                <i class="fa-solid fa-expand icon_full" style="color: #ffffff;" data-post-id="' . $post_id . '">';

			// Ajout du partials pour la lightbox 
			get_template_part('partials/content', 'lightbox');

			echo '</i>
                <a class="icon_eye_link" href="' . get_permalink() . '">
                    <i class="fa-regular fa-eye icon_eye" style="color: #ffffff;"></i>
                </a>
                <div class="content">
                    <span class="content_title">' . get_the_title() . '</span>
                    <span class="content_categorie">';
			$categs = get_the_terms($post_id, 'categorie');
			if ($categs && !is_wp_error($categs)) {
				foreach ($categs as $categ) {
					echo $categ->name;
				}
			} else {
				echo 'Aucune catégorie associée à cet article.';
			}
			echo   '</span>
                </div>
            </div>
        </div>';
		endwhile;
	else :
		echo 'Aucun résultat trouvé.';
	endif;
	wp_reset_postdata();

	$content_single = ob_get_clean();

	// echo $content;
	$response_single = array('content' => $content_single, 'max' => $max_page_single);

	ob_clean();

	wp_send_json($response_single);
}
add_action('wp_ajax_loadPosts_Single', 'loadPosts_Single');
add_action('wp_ajax_nopriv_loadPosts_Single', 'loadPosts_Single');
