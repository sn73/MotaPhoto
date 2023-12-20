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
            $args = array(
                'post_type' => 'photographie',
                'posts_per_page' => 1,
                // 'meta_key' => '_main_char_field',
                'orderby' => 'rand',
            );
            $photographies_query = new WP_Query($args);
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
    <section class="dropdown-box">
        <div class="categories-dropdown">
            <button onclick="categoriesDropdown()">Catégories <span><img src="<?php the_field('icon_dropdown'); ?>"> </span></button>
            <ul>
                <li onclick="selectcat('Réception')">Réception</li>
                <li onclick="selectcat('Télévision')">Télévision</li>
                <li onclick="selectcat('Concert')">Concert</li>
                <li onclick="selectcat('Mariage')">Mariage</li>
            </ul>
        </div>
        <div class="format-dropdown">
            <button onclick="formatDropdown()">Formats <span><img src="<?php the_field('icon_dropdown'); ?>"> </span> </button>
            <ul>
                <li onclick="selectformat('Portrait')">Portrait</li>
                <li onclick="selectformat('Paysage')">Paysage</li>
            </ul>
        </div>
        <div class="sortby-dropdown">
            <button onclick="sortbyDropdown()">Trier par <span><img src="<?php the_field('icon_dropdown'); ?>"> </span> </button>
            <ul>
                <li onclick="selectsortby('Du plus récent au plus ancien')">Du plus récent au plus ancien</li>
                <li onclick="selectsortby('Du plus ancien au plus récent')">Du plus ancien au plus récent</li>
            </ul>
        </div>
    </section>

    <section class="images-container">
        <?php
        $args = array(
            'post_type' => 'photographie',
            'posts_per_page' => -1,
            // 'meta_key'  => '_main_char_field',
            // 'orderby'   => 'rand',
        );
        $photographies_query = new WP_Query($args);
        ?>
        <?php
        if ($photographies_query->have_posts()) : while ($photographies_query->have_posts()) : $photographies_query->the_post(); ?>
                <div class="image-box overlay-box">
                    <?php the_post_thumbnail(array(590, 500)); ?>
                    <div class="hidden overlay">
                        <i class="fa-solid fa-expand icon_full" style="color: #ffffff;">
                            <div class="lightbox hidden">
                                <?php the_post_thumbnail('large'); ?>
                                <span><?php the_field('ref_photo'); ?></span>
                                <span class="categ">
                                    <?php
                                    $categs = get_the_terms($post_id, 'categorie');
                                    foreach ($categs as $categ) {
                                        echo $categ->name;
                                    } ?>
                                </span>
                            </div>
                        </i>
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
        <button type="button" class="cta">Charger plus</button>
    </section>

</main>
<?php
get_footer();
