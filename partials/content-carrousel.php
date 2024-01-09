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
                        <?php the_post_thumbnail(array(60, 48)); ?>
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
                        <?php the_post_thumbnail(array(60, 48)); ?>
                    </div>
                    <a href="<?php echo get_permalink($next_post->ID); ?>">
                        <i class="fa-solid fa-arrow-right-long" style="color: #000000;"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>