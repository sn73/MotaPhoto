<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width" />
    <?php wp_head(); ?>
    <title>Mota Photographies</title>
</head>

<body>
    <?php wp_body_open(); ?>
    <header>
        <div class="header_top">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Logo.png" alt="logo Mota Photographie" />
            <nav class="nav-link">
                <?php wp_nav_menu(array('theme_location' => 'header', 'container_class' => 'link_header')); ?>
            </nav>
        </div>
    </header>