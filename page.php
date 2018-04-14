<?php   get_header();  ?>
    <!-- basic page markup  -->


    <?php if(have_posts()) : while(have_posts()) : the_post();  ?>

        <section class="content container">


            <?php   the_content();?>
                <?php endwhile; endif; ?>
        </section>
        <?php get_footer(); ?>
