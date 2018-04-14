<article class="single-video">
    <h1 class="video-title"><?php the_title(); ?></h1>




    <div class="the-video">
        <?php 
            global $wp_embed;
            
            echo $wp_embed->run_shortcode('[embed]'. get_post_meta( $post->ID, '_yt_link', true ).'&showinfo=0[/embed]'); ?>

    </div>
    <div class="video-description">
        <?php the_content(); ?>
    </div>
</article>
