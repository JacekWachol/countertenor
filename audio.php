<?php /* 
Template Name: Audio 
*/
  get_header(); ?>
    <div class="page-title">
        <h1><?php the_title(); ?></h1>


    </div>
    <?php $args = array( 'post_type' => 'audio', 'posts_per_page' => -1);
$audio = new WP_Query($args);?>

        <?php if ( $audio->have_posts() ) : while ( $audio->have_posts() ) : $audio->the_post();  
            $thumbnail = get_the_post_thumbnail_url();
           
            ?>

            <article class="single-audio with-border <?php if($thumbnail) {echo 'with-background';} ?>" <?php if($thumbnail) {echo 'style="background-image: url('.$thumbnail. ');"';} ?>>

                <h2><?php the_title() ;?></h2>
                <div class="audio-player">
                    <?php the_content(); ?>
                </div>
                <div class="audio-details">
                    <p class="audio-vocal">
                        <?php echo get_post_meta( $post->ID, '_vocal', true ); ?>
                    </p>
                    <p class="audio-music">
                        <?php echo get_post_meta( $post->ID, '_music', true ); ?>
                    </p>
                    <p class="recording-details">
                        <?php echo get_post_meta( $post->ID, '_rec_details', true ); ?>
                    </p>

                </div>


            </article>
            <?php  wp_reset_postdata(); endwhile; endif; ?>



                <?php get_footer(); ?>
