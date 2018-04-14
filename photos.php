<?php/* 
Template Name: Photos 
*/ ?>



    <?php  get_header();  ?>
        <div class="photo-wrapper">
            <div class="photo-nav">
                <?php wp_nav_menu(array(
        'theme_location' => 'photo-menu',
        'container' => false,
    'items_wrap' => '<div class="container"><ul id="%1$s">%3$s</ul></div>'
  
    

)); ?>
            </div>
            <?php if(have_posts()) : while(have_posts()) : the_post();  ?>

                <section class="gallery-content">


                    <?php   the_content();?>
                        <?php endwhile; endif; ?>
                </section>

        </div>
        <?php get_footer(); ?>
