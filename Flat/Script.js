$(document).ready(function() {
    $(window).scroll(function() {
        if($(window).scrollTop() >= 180) {
            $('header').css('height','68px');
            $('#logo > img').css('height','60px');
            $('nav ul').css('margin','12px 20px 0 0');
        } else {
            $('header').css('height','130px');
            $('#logo > img').css('height','122px');
            $('nav ul').css('margin','40px 20px 0 0');
        }
    });
});