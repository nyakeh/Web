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
        $deposit = $('#account_surname').val();
        $term = $('#account_email').val();
        $interest = $('#account_password').val();
        $.ajax({ url: 'Account_Details_Update_Function.php',
            data: { forename: $forename, surname: $deposit, email: $term, password: $interest },
            type: 'post',
            success: function(output) {
                $("#account_message").text(output);
            }
        });
    });

    $('#mortgage_submit_Button').click( function() {
        $houseValue = $('#input_property').val();
        $deposit = $('#input_deposit').val();
        $term = $('#input_term').val();
        $interest = $('#input_interest').val();
        $fees = $('#input_fees').val();
        $.ajax({ url: 'Mortgage_Calculate_Function.php',
            data: { houseValue: $houseValue, deposit: $deposit, term: $term, interest: $interest, fees: $fees },
            type: 'post',
            success: function(output) {
                try {
                    var calculation = JSON.parse(output);
                    $("#mortgage_message").text(calculation.Fees);
                } catch(exception) {
                    $("#mortgage_message").text(output);
                }
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

function isEmptyNumberBox(text_box, span) {
    var lbl = document.getElementById(span);
    lbl.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;";
    if(text_box.value.replace(/\s+$/, "") == "") {
        lbl.className = "cross";
        return true;
    } else if(isNaN(text_box.value)) {
        lbl.className = "cross";
        return true;
    } else {
        lbl.className = "tick";
        return false;
    }
}