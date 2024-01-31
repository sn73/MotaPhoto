<?php
$post_id = get_the_ID();

$prev_post = get_previous_post();
$prev_post_id = !empty($prev_post) ? $prev_post->ID : null;

$next_post = get_next_post();
$next_post_id = !empty($next_post) ? $next_post->ID : null;

$current_ref = get_field('ref_photo', $post_id);

$categs_data = '';

$categs = get_the_terms($post_id, 'categorie');
if ($categs && !is_wp_error($categs)) {
    foreach ($categs as $categ) {
        $categs_data .= ' data-categorie="' . esc_attr($categ->name) . '"';
    }
}
?>

<section class="lightbox" id="lightbox_<?php echo $post_id; ?>" data-post-id="<?php echo $post_id; ?>">
    <div class="lightbox_box">
        <div class="lightbox_close">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
        <div class="lightbox_container">
            <img class="lightbox_image" src="<?php echo get_the_post_thumbnail_url($post_id, 'large'); ?>" alt="Image">
            <div class="arrow_left prev-link">
                <i class="fa-solid fa-arrow-left-long"></i>
                <span>Précédente</span>
            </div>
            <div class="arrow_right next-link">
                <span>Suivante</span>
                <i class="fa-solid fa-arrow-right-long"></i>
            </div>
        </div>
        <div class="lightbox_info">
            <span class="ref_photo" data-ref="<?php echo $current_ref; ?>"><?php echo $current_ref; ?></span>
            <span class="categ" <?php echo $categs_data; ?>>
                <?php
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