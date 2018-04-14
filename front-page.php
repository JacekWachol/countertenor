<?php   get_header();  ?>
    <!-- basic page markup  -->




    <section>

        <div id="comment">
            <p>“The Polish countertenor Jakub Józef Orliński combined beauty of tone and an uncommon unity of color and polish across his range in selections by Britten and Handel.”
            </p>
            <p>Corinna da Fonseca-Wollheim, The New York Times</p>
        </div>

        <div id="music-box">
            <audio id="fara" src="<?php echo get_template_directory_uri(); ?>/audio/spada.m4a" loop></audio>
            <div id="audio-control" class="play">
                <img id="play-button" class="active-audio" src="<?php echo get_template_directory_uri(); ?>/img/audio/play-btn.png">
                <img id="stop-button" src="<?php echo get_template_directory_uri(); ?>/img/audio/stop-btn.png"></div>
            <h1>"Fara la mia spada"</h1>
            <p>Jakub Józef Orliński - contratenor Cappella di Ospedale della Pietà Venezia Evoe Records</p>
        </div>


    </section>
    <?php get_footer(); ?>
