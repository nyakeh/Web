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

    $('#account_submit_Button').click( function() {
        $forename = $('#account_forename').val();
        $surname = $('#account_surname').val();
        $email = $('#account_email').val();
        $password = $('#account_password').val();
        $.ajax({ url: 'Account_Details_Update_Function.php',
            data: { forename: $forename, surname: $surname, email: $email, password: $password },
            type: 'post',
            success: function(output) {
                $("#account_message").text(output);
            }
        });
    });
});

function validate_textbox(text_box,message,span) {
    if(isEmptyTextBox(text_box,message,span)) {
        return false
    }
    return true
}
function isEmptyTextBox(text_box, message, span) {
    var lbl = document.getElementById(span);
    if(text_box.value.replace(/\s+$/, "") == "") {
        lbl.innerHTML = message;
        return true;
    } else {
        lbl.innerHTML = "";
        return false;
    }
}