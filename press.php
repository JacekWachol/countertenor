<?php /* 
Template Name: Press 
*/
  get_header(); ?>
    <div class="page-title">
        <h1><?php the_title(); ?></h1>


    </div>
    <?php $args = array( 'post_type' => 'press', 'posts_per_page' => -1);
$press = new WP_Query($args);

if ( $press->have_posts() ) : while ( $press->have_posts() ) : $press->the_post();  
  
$press_type = get_post_meta($post->ID, '_press_type', true);

           $press_type == 'magazine' ? get_template_part('press', 'magazine') : get_template_part('press', 'review');
    wp_reset_postdata(); endwhile; endif;

get_footer(); ?>
