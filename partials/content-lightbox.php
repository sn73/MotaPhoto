<?php $post_id = get_the_ID(); ?>


<section class="lightbox" id="lightbox_<?php echo $post_id; ?>">
    <div class="lightbox_box">
        <div class="lightbox_close">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
        <div class="lightbox_container">
            <?php the_post_thumbnail('large'); ?>
            <span class="arrow_left prev-link">
                <?php
                $prev_post = get_previous_post();
                if (!empty($prev_post)) :
                ?>
                    <i class="fa-solid fa-arrow-left-long"></i>
                    <a href="<?php echo get_permalink($prev_post->ID); ?>">
                        Précédente
                    </a>
                <?php endif; ?>
            </span>
            <span class="arrow_right next-link">
                <?php
                $next_post = get_next_post();
                if (!empty($next_post)) :
                ?>
                    <a href="<?php echo get_permalink($next_post->ID); ?>">
                        Suivante
                    </a>
                <?php endif; ?>
                <i class="fa-solid fa-arrow-right-long"></i>
            </span>
        </div>
        <div class="lightbox_info">
            <span><?php the_field('ref_photo'); ?></span>
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