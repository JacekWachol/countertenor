<?php /* 
Template Name: About 
*/
  get_header();  ?>
    <!-- basic page markup  -->


    <?php if(have_posts()) : while(have_posts()) : the_post();  ?>

        <section class="content">
            <div class="container"><i id="show-content" class="fa fa-caret-down" aria-hidden="true"></i>
                <h1 class="title"><?php the_title(); ?></h1>

                <?php   the_content();?>
                    <?php endwhile; endif; ?>
            </div>
            <div id="download-bar"><a href="<?php echo get_template_directory_uri(); ?>/download/Jakub_Jozef_Orlinski_Biography.pdf" download><img src="<?php echo get_template_directory_uri(); ?>/img/download-button.png">Download full biography (.pdf)</a></div>
        </section>
        <?php get_footer(); ?>
