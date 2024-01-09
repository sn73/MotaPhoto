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
    $args_query = array(
        'post_type' => 'photographie',
        'posts_per_page' => 8,
        // 'meta_key'  => '_main_char_field',
        // 'orderby'   => 's',
        'paged' => 1,
    );
    if (isset($_GET['categories']) and ($_GET['categories'] != '')) {
        $select_categorie = $_GET['categories'];
        $args_query['tax_query'][] = array(
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $select_categorie,
        );
    }
    if (isset($_GET['formats']) and ($_GET['formats'] != '')) {
        $select_format = $_GET['formats'];
        $args_query['tax_query'][] = array(
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $select_format,
        );
    }
    if (isset($_GET['sortby']) and ($_GET['sortby'] != '')) {
        $select_sortby = $_GET['sortby'];
        $args_query['order'] = $select_sortby;
    } ?>

    <form class="dropdown" action="" method="GET">
        <div class="dropdown_categories dropdown_height">
            <select class="dropdown_btn" id="categorie" name="categories">
                <option value="" class="dropdown_btn_list">Catégories</option>
                <?php
                $selected_category = isset($_GET['categories']) ? $_GET['categories'] : ''; // Récupère la valeur sélectionnée, si elle existe

                $category_terms = get_terms('categorie');
                foreach ($category_terms as $term_cat) {
                    $selected = ($term_cat->slug == $selected_category) ? 'selected' : '';
                    echo '<option class="dropdown_btn_list" value="' . $term_cat->slug . '" ' . $selected . '>' . $term_cat->name . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="dropdown_format dropdown_height">
            <select class="dropdown_btn" id="format" name="formats">
                <option class="dropdown_btn_list" value="">Format</option>
                <?php
                $selected_format = isset($_GET['formats']) ? $_GET['formats'] : ''; // Récupère la valeur sélectionnée, si elle existe

                $format_terms = get_terms('format');
                foreach ($format_terms as $term_form) {
                    $selected = ($term_form->slug == $selected_format) ? 'selected' : '';
                    echo '<option class="dropdown_btn_list" value="' . $term_form->slug . '" ' . $selected . '>' . $term_form->name . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="dropdown_sortby dropdown_height">
            <select class="dropdown_btn" id="sortby" name="sortby">
                <?php
                $select_sortby = isset($_GET['sortby']) ? $_GET['sortby'] : '';
                ?>
                <option class="dropdown_btn_list" value="" <?php echo ($select_sortby == '') ? 'selected' : ''; ?>>Trier par </option>
                <option class="dropdown_btn_list" value="ASC" <?php echo ($select_sortby == 'ASC') ? 'selected' : ''; ?>>Du plus récent au plus ancien</option>
                <option class="dropdown_btn_list" value="DESC" <?php echo ($select_sortby == 'DESC') ? 'selected' : ''; ?>>Du plus ancien au plus récent</option>
            </select>
        </div>
        <input class="cta_form" type="submit" value="OK">
    </form>

    <?php
    $photographies_query = new WP_Query($args_query);
    ?>
    <section class="images-container">
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
    <a href="#!" class="cta" id="load-more">Charger plus</a>
    <!-- <button type="button" class="cta">Charger plus</button> -->
</main>
<?php
get_footer();
