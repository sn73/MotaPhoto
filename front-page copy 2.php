<?php get_header(); ?>
<main>
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
    <?php
    // $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    FindSelectFilter()
    ?>

    <?php get_template_part('partials/content', 'form'); ?>

    <section class="images-container">
    <?php
    $photographies_query = new WP_Query($args_query);
    ?>
        <?php
        if ($photographies_query->have_posts()) : while ($photographies_query->have_posts()) : $photographies_query->the_post(); ?>
                <?php $post_id = get_the_ID(); ?>

                <!-- Partie pour le Overlay -->
                <div class="image-box overlay-box">
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
    </section>
    <button type="button" class="cta">Charger plus</button>
</main>
<?php
get_footer();
