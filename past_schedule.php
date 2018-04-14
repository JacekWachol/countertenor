<?php /* 
Template Name: Past Engagements 
*/
  get_header();  ?>
    <div id="schedule-top" class="container">
        <h1>Past engagements</h1>
        <a href="<?php echo get_permalink( get_page_by_title( 'Schedule' ) ); ?>"><h2>Show current engagements</h2></a>


    </div>

    <?php

$args = array( 'post_type' => 'engagements', 'posts_per_page' => -1, 'meta_key' => '_engagements_type', 'meta_value' => 'past');
$engagements = new WP_Query($args);
                    //reverse the order of the posts, latest last
                //    $array_rev = array_reverse($engagements->posts);
                    //reassign the reversed posts array to the $home_shows object
                  //  $engagements->posts = $array_rev;
                ?>
        <div id="engagements">
            <?php if ( $engagements->have_posts() ) : ?>
                <?php while ( $engagements->have_posts() ) : $engagements->the_post();  ?>

                    <?php get_template_part('engagement', 'content');?>

                        <?php wp_reset_postdata(); ?>

                            <?php endwhile; endif; ?>

        </div>

        <?php get_footer(); ?>
