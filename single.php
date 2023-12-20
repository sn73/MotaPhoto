<?php get_header();
?>
<main>
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
        <div class="mini-carrousel">
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
                            <i class="fa-solid fa-expand icon_full" style="color: #ffffff;"></i>
                            <a href="<?php the_permalink(); ?>">
                                <i class="fa-regular fa-eye icon_eye" style="color: #ffffff;"></i>
                            </a>
                            <span class="title-photo"><?php the_title(); ?></span>
                            <span class="categorie-photo">
                                <?php
                                $categs = get_the_terms($post_id, 'categorie');
                                foreach ($categs as $categ) {
                                    echo $categ->name;
                                } ?>
                            </span>
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
