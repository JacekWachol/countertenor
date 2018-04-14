<?php $thumbnail = get_the_post_thumbnail_url();  ?>
    <article class="single-press with-border magazine">
        <div class="press-wrap">
            <div class="magazine-details">
                <div class="press-description">
                    <?php the_content(); ?>

                </div>

                <div class="purchase-details">
                    <p>It can be purchased here:</p>
                    <a target="_blank" href="<?php echo get_post_meta( $post->ID, '_press_link', true ); ?>">
                        <?php the_title();?>
                    </a>
                </div>
                <p class="press-date">
                    <?php echo get_post_meta( $post->ID, '_press_date', true ); ?>
                </p>

            </div>
            <div class="magazine-cover">
                <?php the_post_thumbnail('medium_large');?>
            </div>
        </div>

    </article>
