<?php
$post_id = get_the_ID();

$prev_post = get_previous_post();
$prev_post_id = !empty($prev_post) ? $prev_post->ID : null;

$next_post = get_next_post();
$next_post_id = !empty($next_post) ? $next_post->ID : null;
?>

<section class="lightbox" id="lightbox_<?php echo $post_id; ?>">
    <div class="lightbox_box">
        <div class="lightbox_close">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
        <div class="lightbox_container">
            <?php the_post_thumbnail('large'); ?>
            <span class="arrow_left prev-link" data-post-id="<?php echo $prev_post_id; ?>">
                <i class="fa-solid fa-arrow-left-long"></i>
                Précédente
            </span>
            <span class="arrow_right next-link" data-post-id="<?php echo $next_post_id; ?>">
                Suivante
                <i class="fa-solid fa-arrow-right-long"></i>
            </span>
        </div>
        <div class="lightbox_info">
            <span><?php echo get_field('ref_photo', $post_id); ?></span>
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