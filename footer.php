<footer>
    <div class="container">
        <p>&copy; Jakub Józef Orliński <?php echo date('Y'); ?></p>
        <?php if(!is_front_page()) { ?>
            <ul class="social-icons pull-right">
                <li class='icon social fb'>
                    <a target="_blank" href="https://www.facebook.com/jjorlinski"><img src="<?php echo get_template_directory_uri(); ?>/img/facebook.png"></a>
                    <li class='icon social in'>
                        <a target="_blank" href="https://www.instagram.com/jakub.jozef.orlinski/?hl=en"><img src="<?php echo get_template_directory_uri(); ?>/img/instagram.png"></a></li>
                    <li class='icon social yt'>
                        <a target="_blank" href="https://www.youtube.com/channel/UCjAGMG-toVsnw_DIUVnSpFg"><img src="<?php echo get_template_directory_uri(); ?>/img/youtube.png"><img src="<?php echo get_template_directory_uri(); ?>/img/youtubemobile.png"></a></li>
            </ul>
            <?php } ?>

    </div>

</footer>

<?php wp_footer(); ?>
    </body>

    </html>
