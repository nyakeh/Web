$(document).ready(function() {
    $(window).scroll(function() {
        if($(window).scrollTop() >= 80) {
            $('header').css('padding','0');
            $('h1 img').attr('src', "img/logoalt.png")
        } else {
            $('header').css('padding','25px 0');
            $('h1 img').attr('src', "img/logo.png")
        }
    });
});