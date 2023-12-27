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
    $args_dropdown = array(
        'post_type' => 'photographie',
        'tax_query' => array(
            array(
                'taxonomy' => 'categorie',
                'field' => 'slug',
            ),
            array(
                'taxonomy' => 'format',
                'field' => 'slug',
            ),
        ),
    );
    $query = new WP_Query($args_dropdown);
    var_dump($args_dropdown) ;?>
    <form class="dropdown" action="" method="GET">

        <div class="dropdown_categories">
            <select class="dropdown_btn" id="category" name="category">
                <option value="">Catégories</option>
                <?php
                $category_terms = get_terms('categorie'); // Assurez-vous de remplacer 'categories' par le nom de votre taxonomie
                foreach ($category_terms as $term_cat) {
                    echo '<option value="' . $term_cat->slug . '">' . $term_cat->name . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="dropdown_format">
            <select class="dropdown_btn" id="category" name="category">
                <option value="">Format</option>
                <?php
                $format_terms = get_terms('format'); // Assurez-vous de remplacer 'categories' par le nom de votre taxonomie
                foreach ($format_terms as $term_form) {
                    echo '<option value="' . $term_form->slug . '">' . $term_form->name . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="dropdown_sortby">
            <select class="dropdown_btn" id="category" name="category">
                <option value="">Trier par </option>
                <option value="ASC">Du plus récent au plus ancien</option>
                <option value="DESC">Du plus ancien au plus récent</option>
            </select>
        </div>
        <input type="submit" value="OK">
    </form>

    <?php
    $args_front = array(
        'post_type' => 'photographie',
        'posts_per_page' => 8,
        // 'meta_key'  => '_main_char_field',
        // 'orderby'   => 'rand',
    );
    $photographies_query = new WP_Query($args_front);
    ?>
    <section class="images-container">
        <?php
        if ($photographies_query->have_posts()) : while ($photographies_query->have_posts()) : $photographies_query->the_post(); ?>
                <div class="image-box overlay-box">
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
                                            $post_id = get_the_ID();
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
                        </i>
                        <a href="<?php the_permalink(); ?>">
                            <i class="fa-regular fa-eye icon_eye" style="color: #ffffff;"></i>
                        </a>
                        <div class="content">
                            <span class="content_title"><?php the_title(); ?></span>
                            <span class="content_categorie">
                                <?php
                                $post_id = get_the_ID();
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
        <button type="button" class="cta">Charger plus</button>
    </section>
</main>
<?php
get_footer();
