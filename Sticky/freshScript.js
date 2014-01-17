$(document).ready(function() {
    myFunction();
    $(window).scroll(function() {
        if($(window).scrollTop() >= 120) {
            $('header').css('padding','0');
            $('header').css('background','rgba(0,0,0, 0.8)');
            /*$('h1 img').attr('src', "img/logoalt.png")*/
        } else {
            $('header').css('padding','25px 0');
            $('header').css('background','rgba(0,0,0, 0.3)');
            /*$('h1 img').attr('src', "img/logo.png")*/
        }
    });
});


$(window).addEventListener('resize', myFunction()) ;
navBool = true;
function showNav() {
    if(navBool) {
        $('#nav>li').css('display','list-item');
        navBool = false;
    } else {
            $('#nav>li').css('display','none');
            navBool = true;
    }
};

function myFunction() {
    if($(window).width() >= 659) {
        $('#nav>li').css('display','block');
        navBool = false;
    } else {
        $('#nav>li').css('display','none');
        navBool = true;
    }
};