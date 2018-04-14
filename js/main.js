(function ($) {
    var $menu = $('.menu');



    function switchMenuClass() {
        $('#burger').is(':visible') ? $menu.addClass('mobile-menu') : $menu.removeClass('mobile-menu');
    }

    $(document).ready(function ($) {
        var screenHeight = $(window).height();
        var scrollOffset = $(window).width() < 768 ? 85 : 0;

        var audio = document.getElementById('fara'),

            documentHeight = '';



        switchMenuClass();
        setContentGap(screenHeight);
        // setContactMargin(screenHeight);

        documentHeight = $(document).height();


        window.addEventListener('resize', function () {
            if ($('#burger').hasClass('open')) {
                $('#burger').removeClass('open');

            }

            $menu.css('display', '');
            switchMenuClass();
            screenHeight = $(window).height();
            scrollOffset = $(window).width() < 768 ? 85 : 0;


            setContentGap(screenHeight);
            //setContactMargin(screenHeight);

            documentHeight = $(document).height();




        });


        var distance = '';
        if (documentHeight >= screenHeight * 2) {
            distance = screenHeight;
        } else {
            distance = documentHeight;
        }
        $('#show-content').on('click', function (e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: distance - scrollOffset
            }, 500);
            return false;
        });

        $('#burger').on('click', function () {
            $(this).toggleClass('open');
            $('.menu').toggleClass('menu-open');
        });

        $('#hide-menu').on('click', function () {
            $('#burger').removeClass('open');
            $('.menu').removeClass('menu-open');
        });

        $('#audio-control').on('click', function () {
            if ($(this).hasClass('play')) {
                $('#play-button').removeClass('active-audio');
                $('#stop-button').addClass('active-audio');
                $(this).addClass('stop').removeClass('play');
                audio.play();
            } else {
                $('#stop-button').removeClass('active-audio');
                $('#play-button').addClass('active-audio');
                $(this).addClass('play').removeClass('stop');
                audio.pause();

            }
        });




        function setContentGap(screenHeight) {
            var addOffset = $(window).width() < 768 ? 62 : 227;

            $('.about-page .content').css('marginTop', screenHeight - addOffset);
        }


        function setContactMargin(screenHeight) {
            if ($('#cont-bg')) {
                if ($(window).width() > 767) {
                    var singleMargin = screenHeight > 852 ? (screenHeight - 857) / 2 : 0;

                    $('#cont-bg').css({
                        'paddingTop': singleMargin,
                        'paddingBottom': singleMargin,

                    });
                }
            }
        }

        document.addEventListener('play', function (e) {
            var audios = document.getElementsByTagName('audio');
            for (var i = 0, len = audios.length; i < len; i++) {
                if (audios[i] != e.target) {
                    audios[i].pause();
                }
            }
        }, true);



    }); // $(document).ready() end





})(jQuery);
