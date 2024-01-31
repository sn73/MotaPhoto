<?php get_header(); ?>
<main id="front_main">
    <section>
        <div class="hero_home">
            <?php if (get_field('titre_hero')) : ?>
                <h1 class="text-hero">
                    <?php the_field('titre_hero'); ?>
                </h1>
            <?php endif; ?>
            <?php
            $args_hero = array(
                'post_type' => 'photographie',
                'posts_per_page' => 1,
                // 'meta_key' => '_main_char_field',
                'orderby' => 'rand',
            );
            $photographies_query = new WP_Query($args_hero);
            ?>
            <?php
            if ($photographies_query->have_posts()) : while ($photographies_query->have_posts()) : $photographies_query->the_post();
                    the_post_thumbnail(array(1440, 1000,));
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </section>

    <?php get_template_part('partials/content', 'filter'); ?>

    <section id="images-container" class="images-container">

    </section>

    <button type="button" class="cta" id="load-more">Charger plus
        <input type="hidden" name="FilterNonce" value="<?php echo wp_create_nonce('nonce_Filter'); ?>">
    </button>

</main>
<?php
get_footer();
