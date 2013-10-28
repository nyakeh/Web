var btnText = 0;
window.onload=initialise;
function initialise() {
    registerValidation(
        document.getElementById('emailAddress'),
        document.getElementById('emailMsg')
    );
    registerValidation(
        document.getElementById('userPassword'),
        document.getElementById('passwordMsg')
    );
}

function registerValidation(element, span)
{
    element.onblur = function() {
        span.textContent = element.validationMessage;
        alert(element.validationMessage);
    }
}

function changeText() {
    $('#Username').toggleClass('show');
    if (btnText == 0){
        btnText = 1;
        $('#register').html('login');
        $('#new').html('<p><label>Email Address: <input type="email" name="emailAddress" id="emailAddress"> <span id="emailMsg"></span></label></p>');
    } else {
        $('#register').html('register');
        $('#new').html('');
        btnText = 0;
    }
}
