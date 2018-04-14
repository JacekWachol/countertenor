<!DOCTYPE html>
<html>

<head>


    <meta charset="utf-8">
    <meta name="author" content="ironBuilt">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">


    <title>
        <?php
        wp_title( '|', true, 'right' );
        bloginfo( 'name' );

    ?>

    </title>
    <?php if(has_post_thumbnail()) {?>
        <style media="screen" type="text/css">
            body {
                background-image: url("<?php the_post_thumbnail_url( 'full' );?>");
            }

        </style>
        <?php } ?>
            <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <div id="burger"><span></span><span></span><span></span><span></span></div>
        <a href="<?php echo home_url(); ?>" id="logo" class="container"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png"></a>
        <ul class="social-icons pull-right">
            <li class='icon social fb'>
                <a target="_blank" href="https://www.facebook.com/jjorlinski"><img src="<?php echo get_template_directory_uri(); ?>/img/facebook.png"></a>
                <li class='icon social in'>
                    <a target="_blank" href="https://www.instagram.com/jakub.jozef.orlinski/?hl=en"><img src="<?php echo get_template_directory_uri(); ?>/img/instagram.png"></a></li>
                <li class='icon social yt'>
                    <a target="_blank" href="https://www.youtube.com/channel/UCjAGMG-toVsnw_DIUVnSpFg"><img src="<?php echo get_template_directory_uri(); ?>/img/youtube.png"><img src="<?php echo get_template_directory_uri(); ?>/img/youtubemobile.png"></a></li>
        </ul>
    </header>

    <?php wp_nav_menu(array(
        'theme_location' => 'header-menu',
        'container' => 'nav',
        'items_wrap' => '<div class="container"><ul id="%1$s" class="%2$s">%3$s</ul></div>'



)); ?>
