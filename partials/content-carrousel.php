<div class="carrousel">
    <?php
    $post_id = get_the_ID();
    $args_single = array(
        'post_type' => 'photographie',
        'posts_per_page' => 1,
        // 'meta_key'  => '_main_char_field',
        // 'orderby'   => 'rand',
        'post__not_in' => array($post_id)

    );
    $prev_post = get_adjacent_post(false, '', true); // Post précédent
    $next_post = get_adjacent_post(false, '', false); // Post suivant

    $prev_post_id = $prev_post ? $prev_post->ID : ''; // ID du post précédent
    $next_post_id = $next_post ? $next_post->ID : ''; // ID du post suivant
    $prev_post_thumbnail = $prev_post_id ? wp_get_attachment_image_src(get_post_thumbnail_id($prev_post_id), 'custom-preview-carrousel') : '';
    $next_post_thumbnail = $next_post_id ? wp_get_attachment_image_src(get_post_thumbnail_id($next_post_id), 'custom-preview-carrousel') : '';


    $photographies_query = new WP_Query($args_single);
    ?>
    <div class="carrousel_content">
        <?php the_post_thumbnail(array(91, 71)); ?>
        <div class="carrousel_content_arrow">
            <div class="carrousel_content_arrow_left">
                <?php
                $prev_post = get_previous_post();
                if (!empty($prev_post)) :
                ?>
                    <div class="prev_post">
                        <?php
                        if ($prev_post_thumbnail) {
                            echo '<img src="' . esc_url($prev_post_thumbnail[0]) . '" alt="Image du post précédent" width="' . esc_attr($prev_post_thumbnail[1]) . '" height="' . esc_attr($prev_post_thumbnail[2]) . '">';
                        }
                        ?>
                    </div>
                    <a href="<?php echo get_permalink($prev_post->ID); ?>">
                        <i class="fa-solid fa-arrow-left-long" style="color: #000000;"></i>
                    </a>
                <?php endif; ?>
            </div>
            <div class="carrousel_content_arrow_right">
                <?php
                $next_post = get_next_post();
                if (!empty($next_post)) :
                ?>
                    <div class="next_post">
                        <?php
                        if ($next_post_thumbnail) {
                            echo '<img src="' . esc_url($next_post_thumbnail[0]) . '" alt="Image du post suivant" width="' . esc_attr($next_post_thumbnail[1]) . '" height="' . esc_attr($next_post_thumbnail[2]) . '">';
                        }
                        ?>
                    </div>
                    <a href="<?php echo get_permalink($next_post->ID); ?>">
                        <i class="fa-solid fa-arrow-right-long" style="color: #000000;"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>