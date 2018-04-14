<?php get_header(); ?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(), 'fullsize' );?>

        <section class="single-news container">
            <div class="row">
                <div class="header-image" <?php echo 'style="background-image: url('. $thumbnail[0] . ')";'; ?>>

                </div>
            </div>
            <div class="row news-title">
                <h2> <?php the_title(); ?>  </h2>
            </div>
            <div class="row news-meta">
                <?php echo get_the_date('j F Y'); ?>
            </div>
            <div class="row news-content">
                <?php the_content(); ?>

            </div>
            <div class="button-row row">
                <a href="<?php echo get_home_url(); ?>" class="back-button pull-right" role="button"> WRÓĆ </a>
            </div>

        </section>

        <?php endwhile; endif; ?>

            <?php get_footer(); ?>
