<?php get_header(); ?>



        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <?php get_template_part('post', 'content'); ?>


                <?php     endwhile; endif;?>
    </section>

    <section class="news container"><!--
       <div class="row">
            <div class="single-post col-md-4">
                <div class="thumb"><img src="wp-content/themes/kazik/img/ha.jpg"></div>
                <div class="info">
                    <a class="title">
                        <h3>Some Title</h3>
                    </a>
                    <div class="date"> 13 Luty 2004 </div>

                    <p class="text">
                        Lorem Ipsum jest tekstem stosowanym jako przykładowy wypełniacz w przemyśle poligraficznym. Został po raz pierwszy użyty w XV w. przez nieznanego drukarza do wypełnienia tekstem próbnej książki. Pięć wieków później zaczął być używany przemyśle elektronicznym, pozostając praktycznie niezmienionym. Spopularyzował się w latach 60.
                    </p>
                    <a href="#" class="btn btn-info pull-right" role="button"> ZOBACZ </a>
            </div>
        </div>-->
        
        <?php echo do_shortcode('[wmls name="main posts" id="1"]'); ?>
    </section>


    <?php get_footer(); ?>
