<?php /* 
Template Name: Videos 
*/
  get_header();  ?>

    <div class="video-wrap">
        <div class="page-title">
            <h1><?php the_title(); ?></h1>


        </div>


        <?php 
      
$featured_video = '';
$args = array( 'post_type' => 'videos', 'posts_per_page' => -1);
$videos = new WP_Query($args);

/*function pr($videos)
{
    echo "<pre>";
    print_r($videos); 
    echo "</pre>";
}

pr($videos->posts);*/
foreach($videos->posts as $post) {
   
    if(get_post_meta( $post->ID, '_featured_vid', true )){
        $featured_video = $post;
        break;
    }
}

?>



            <section id="featured-container">

                <h1 class="video-title"><?php echo $featured_video->post_title; ?></h1>




                <div class="the-video">
                    <?php 
            global $wp_embed;
            
            echo $wp_embed->run_shortcode('[embed]'. get_post_meta( $featured_video->ID, '_yt_link', true ).'&showinfo=0[/embed]'); ?>

                </div>
                <div class="video-description">
                    <?php echo $featured_video->post_content; ?>
                </div>

            </section>
            <section id="vid-container">
                <?php if ( $videos->have_posts() ) : while ( $videos->have_posts() ) : $videos->the_post();  
    if($post->ID != $featured_video->ID) {
        get_template_part('videos', 'content');
    }
        wp_reset_postdata(); ?>

                    <?php endwhile; endif; ?>
            </section>

            <?php /*wp_reset_postdata(); ?>
                <?php endwhile; endif; */?>

    </div>
    <?php get_footer(); ?>
