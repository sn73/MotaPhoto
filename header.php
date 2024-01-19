<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <title>Mota Photographies</title>
</head>

<body>
    <?php wp_body_open(); ?>
    <header>
        <div class="header">
            <img class="header_logo" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Logo.png" alt="logo Mota Photographie" />
            <nav class="nav-link">
                <?php wp_nav_menu(array('theme_location' => 'header', 'container_class' => 'link_header')); ?>
            </nav>
            <button class="menu_mobile">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </button>
        </div>
        <section class="popup">
            <div class="popup_container">
                <div class="popup_contenu">
                    <div class="contact-hero" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Contact.png'); "></div>
                    <?php echo do_shortcode('[contact-form-7 id="1c9b1d5" title="Sans titre"]'); ?>
                </div>
            </div>
        </section>
    </header>