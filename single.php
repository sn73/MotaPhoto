<?php get_header();
?>
<main <?php body_class('single-page'); ?>>
    <section class="infos">
        <div class="details-image">
            <div class="content-photo">
                <h2><?php the_title(); ?></h2>

                <?php $post_id = get_the_ID(); ?>

                <span class="ref_form">RÉFÉRENCE : <?php the_field('ref_photo'); ?></span>
                <span>CATÉGORIES :
                    <?php
                    $categs = get_the_terms($post_id, 'categorie');
                    foreach ($categs as $categ) {
                        echo $categ->name;
                    } ?>
                </span>
                <span>FORMAT :
                    <?php
                    $categs = get_the_terms($post_id, 'format');
                    foreach ($categs as $categ) {
                        echo $categ->name;
                    } ?>
                </span>
                <span>TYPE :
                    <?php
                    $categs = get_the_terms($post_id, 'type_photo');
                    foreach ($categs as $categ) {
                        echo $categ->name;
                    } ?>
                </span>
                <span>ANNÉE :
                    <?php
                    $categs = get_the_terms($post_id, 'annee');
                    foreach ($categs as $categ) {
                        echo $categ->name;
                    } ?>
                </span>
            </div>
        </div>
        <div class="current-image">
            <?php the_post_thumbnail('custom-thumbnail-home'); ?>
        </div>
    </section>
    <section class="order-photo">
        <div class="order">
            <span>Cette photo vous interesse ?</span>
            <button class="cta_order" type="button">Contact</button>
            <section class="popup">
                <div class="popup_container">
                    <div class="popup-contenu">
                        <div class="contact-hero" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/assets/images/Contact.png'); "></div>
                        <?php echo do_shortcode('[contact-form-7 id="1c9b1d5" title="Sans titre"]'); ?>
                    </div>
                </div>
            </section>
        </div>
        <div class="carrousel">
            <?php
            $id = get_the_ID();
            $args_single = array(
                'post_type' => 'photographie',
                'posts_per_page' => 1,
                // 'meta_key'  => '_main_char_field',
                // 'orderby'   => 'rand',
                'post__not_in' => array($id)

            );
            $photographies_query = new WP_Query($args_single);
            ?>
            <div class="carrousel_content">
                <?php the_post_thumbnail(array(91, 71)); ?>
                <div class="carrousel_content_arrow">
                    <span class="carrousel_content_arrow_left">
                        <i class="fa-solid fa-arrow-left-long" style="color: #000000;"></i>
                    </span>
                    <span class="carrousel_content_arrow_right">
                        <i class="fa-solid fa-arrow-right-long" style="color: #000000;"></i>
                    </span>
                </div>
            </div>
        </div>
    </section>
    <section class="like-more">
        <?php
        $id = get_the_ID();
        $args = array(
            'post_type' => 'photographie',
            'posts_per_page' => 2,
            // 'meta_key'  => '_main_char_field',
            // 'orderby'   => '',
            'post__not_in' => array($id)

        );
        $photographies_query = new WP_Query($args);
        ?>

        <section class="images-container">
            <?php
            if ($photographies_query->have_posts()) : while ($photographies_query->have_posts()) : $photographies_query->the_post(); ?>
                    <div id="overlay-box" class="image-box">
                        <?php the_post_thumbnail(array(590, 500)); ?>
                        <div class="hidden overlay">
                            <i class="fa-solid fa-expand icon_full" style="color: #ffffff;">
                                <section class="lightbox">
                                    <div class="lightbox_box">
                                        <div class="lightbox_container">
                                            <span class="arrow_left">
                                                <i class="fa-solid fa-arrow-left-long"></i>
                                                <span> Précédente</span>
                                            </span>
                                            <?php the_post_thumbnail('large'); ?>
                                            <span class="arrow_right">
                                                <span> Suivante</span>
                                                <i class="fa-solid fa-arrow-right-long"></i>
                                            </span>
                                        </div>
                                        <div class="lightbox_info">
                                            <span><?php the_field('ref_photo'); ?></span>
                                            <span class="categ">
                                                <?php
                                                $categs = get_the_terms($post_id, 'categorie');
                                                if ($categs && !is_wp_error($categs)) {
                                                    foreach ($categs as $categ) {
                                                        echo $categ->name;
                                                    }
                                                }
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                </section>
                            </i> <a href="<?php the_permalink(); ?>">
                                <i class="fa-regular fa-eye icon_eye" style="color: #ffffff;"></i>
                            </a>
                            <div class="content">
                                <span class="content_title"><?php the_title(); ?></span>
                                <span class="content_categorie">
                                    <?php
                                    $categs = get_the_terms($post_id, 'categorie');
                                    if ($categs && !is_wp_error($categs)) {
                                        foreach ($categs as $categ) {
                                            echo $categ->name;
                                        }
                                    } else {
                                        echo 'Aucune catégorie associée à cet article.';
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>
                    </div>
            <?php
                endwhile;
            else :
                echo 'Aucun résultat trouvé.';
            endif;
            wp_reset_postdata();
            ?>
            <button class="cta_all-pic" type="button">Toutes les photos</button>
        </section>

        <section class="lightbox">
            <div class="lightbox_container">
                <span class="arrow_left">
                    <i class="fa-solid fa-arrow-left-long"></i>
                    <span> Précédente</span>
                </span>
                <?php the_post_thumbnail('large'); ?>
                <span class="arrow_right">
                    <span> Suivante</span>
                    <i class="fa-solid fa-arrow-right-long"></i>
                </span>
            </div>
            <div class="lightbox_info">
                <span><?php the_field('ref_photo'); ?></span>
                <span class="categ">
                    <?php
                    $categs = get_the_terms($post_id, 'categorie');
                    if ($categs && !is_wp_error($categs)) {
                        foreach ($categs as $categ) {
                            echo $categ->name;
                        }
                    }
                    ?>
                </span>
            </div>
        </section>

</main>

<?php
get_footer();
