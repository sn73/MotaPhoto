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
                    <?php $categs = get_the_terms($post_id, 'categorie'); ?>
                    <span id="categorieSpan" data-value="<?php echo $categs[0]->slug; ?>" data-id="<?php echo get_the_ID(); ?>">
                        <?php
                        foreach ($categs as $categ) {
                            echo $categ->name;
                        } ?>
                    </span>
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

    <section class="LikeMore">
        <h3 class="LikeMore_text">Vous aimerez aussi</h3>

        <div id="images-container" class="images-container margin">

        </div>
    </section>
    <!-- Bouton pour afficher plus de posts -->
    <!-- <button id="load-more-single" class="cta" type="button">Toutes les photos</button> -->
    </section>
</main>

<?php
get_footer();
