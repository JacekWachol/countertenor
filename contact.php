<?php /* 
Template Name: Contact 
*/
  get_header();  ?>
    <!-- basic page markup  -->


    <?php if(have_posts()) : while(have_posts()) : the_post();  ?>
        <div id="cont-bg">
            <section id="contact">

                <div class="title">
                    <div class="container">
                        <h1><?php the_title(); ?></h1>
                        <h2>by IMG Artist Managers</h2>
                    </div>
                </div>
                <div class="contact-people with-border with-background">
                    <div class="container">
                        <div class="contact-person">
                            <p class="contact-name">Matthew A.Horner</p>
                            <p class="contact-role"> General Management </p>

                            <p class="contact-mail"> <a href="mailto:mhorner@imgartists.com">mhorner@imgartists.com</a></p>
                        </div>
                        <div class="contact-person">

                            <p class="contact-name">Markus Beam</p>
                            <p class="contact-role"> Artist Manager</p>

                            <p class="contact-mail"><a href="mailto:mbeam@imgartists.com">mbeam@imgartists.com</a></p>
                        </div>






                        <a id="my-img-page" target="_blank" href="http://imgartists.com/artist/jakub_jozef_orliski">My IMG Artist page</a>
                    </div>
                </div>
                <div class="title">
                    <div class="container">
                        <h1><?php the_title(); ?></h1>
                        <h2>direct to Artist</h2>
                    </div>
                </div>
                <div class="contact-people with-border with-background">
                    <div class="container">
                        <div class="contact-person">
                            <p class="contact-name">Jakub Józef Orliński</p>
                            <p class="contact-role">Countertenor</p>

                            <p class="contact-mail"> <a href="mailto:jjo.contact@gmail.com">jjo.contact@gmail.com</a></p>
                        </div>


                    </div>

                </div>

            </section>
        </div>
        <?php endwhile; endif;
get_footer(); ?>
