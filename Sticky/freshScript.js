$(document).ready(function() {
    $(window).scroll(function() {
        if($(window).scrollTop() >= 120) {
            $('header').css('padding','0');
            $('header').css('background','#000');
            $('h1 img').attr('src', "img/logoalt.png")
        } else {
            $('header').css('padding','25px 0');
            $('header').css('background','rgba(0,0,0, 0.3)');
            $('h1 img').attr('src', "img/logo.png")
        }
    });
});