<?php $thumbnail = get_the_post_thumbnail_url();  ?>
    <article class="single-press with-border review with-background" <?php if($thumbnail) {echo '  style="background-image: url('.$thumbnail. ');"';} ?>>

        <div class="press-wrap">

            <div class="press-description">
                <?php the_content(); ?>
            </div>
            <div class="review-details">

                <a target="_blank" href="<?php echo get_post_meta( $post->ID, '_press_link', true ); ?>">
                    <?php the_title();?>
                </a>
                <p class="press-date">
                    <?php echo get_post_meta( $post->ID, '_press_date', true ); ?>
                </p>

            </div>
        </div>

    </article>
