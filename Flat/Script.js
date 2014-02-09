$(document).ready(function() {
    $(window).scroll(function() {
        if($(window).scrollTop() >= 180) {
            $('header').css('height','68px');
            $('#logo a > img').css('height','60px');
            $('nav ul').css('margin','12px 20px 0 0');
        } else {
            $('header').css('height','130px');
            $('#logo a > img').css('height','122px');
            $('nav ul').css('margin','40px 20px 0 0');
        }
    });

    $('#login_submit_Button').click( function() {
        $email = '/'+$('#login_email').val();
        $password = '/'+$('#login_password').val();
        $.ajax({ url: 'Login_Function.php',
            data: { email: $email, password: $password },
            type: 'post',
            success: function(output) {
                $("#login_message").text(output);
            }
        });
    });

});