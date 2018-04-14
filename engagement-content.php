<artcicle class="single-engagement">
    <div class="container">
        <h2 class="engagement-title"><?php the_title(); ?></h2>
        <div class="engagement-date">
            <?php echo get_post_meta( $post->ID, '_engagements_date', true ); ?>
        </div>
        <div class="engagement-place">
            <?php the_content(); ?>
        </div>

        <div class="engagement-links">
            <a target="_blank" href="<?php echo get_post_meta( $post->ID, '_engagements_event_link', true ); ?>">Event Page</a>

            <?php if(get_post_meta( $post->ID, '_engagements_type', true ) == 'current') {?> <a target="_blank" href="<?php echo get_post_meta( $post->ID, '_engagements_ticket_link', true ); ?>">Buy Ticket</a>
                <?php } ?>
        </div>
    </div>

</artcicle>
