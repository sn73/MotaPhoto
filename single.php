<?php get_header();
?>

<main <?php body_class('single-page'); ?>>
    <section class="infos">
        <div class="details-image">
            <div class="content-photo">
                <h2><?php the_title(); ?></h2>

                <?php $post_id = get_the_ID(); ?>

                <span>RÉFÉRENCE : <span class="ref_form"> <?php the_field('ref_photo'); ?></span></span>
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

        <!-- Ajout du partials pour le carrousel -->
        <?php get_template_part('partials/content', 'carrousel'); ?>

    </section>
    <section class="like-more">
        <?php
        $args = array(
            'post_type' => 'photographie',
            'posts_per_page' => 2,
            // 'meta_key'  => '_main_char_field',
            // 'orderby'   => '',
            'post__not_in' => array($post_id)
        );
        $photographies_query = new WP_Query($args);
        ?>

        <section class="images-container">
            <?php
            if ($photographies_query->have_posts()) : while ($photographies_query->have_posts()) : $photographies_query->the_post(); ?>
                    <?php $post_id = get_the_ID(); ?>
                    <div id="overlay-box" class="image-box">
                        <?php the_post_thumbnail(array(590, 500)); ?>
                        <div class="hidden overlay">
                            <i class="fa-solid fa-expand icon_full" style="color: #ffffff;" data-post-id="<?php echo $post_id; ?>">

                                <!-- Ajout du partials pour la lightbox -->
                                <?php get_template_part('partials/content', 'lightbox'); ?>

                            </i>
                            <a href="<?php the_permalink(); ?>">
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
</main>

<?php
get_footer();
