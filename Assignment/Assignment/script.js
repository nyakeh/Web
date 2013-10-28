var btnText = 0;
function initialise()
{
    registerValidation(document.getElementById('url'), document.getElementById('urlMsg'));
    registerValidation(document.getElementById('email'), document.getElementById('emailMsg'));
    registerValidation(document.getElementById('userPassword'), document.getElementById('passwordMsg'));
    registerValidation(document.getElementById('username'), document.getElementById('usernameMsg'));
    /**/
    registerValidation(
        document.getElementById('number'),
        document.getElementById('numMsg')
    );
}
function registerValidation(element, span)
{
    element.onblur = function()  {
        span.textContent = element.validationMessage;
    }
}
function changeText() {
    $('#Username').toggleClass('show');
    if (btnText == 0){
        btnText = 1;
        $('#register').html('login');
        $('#new').html('<p><label>Email Address: <input type="email" name="mail" id="mail"> <span id="mailMsg"></span></label></p>');

        registerValidation(document.getElementById('mail'), document.getElementById('mailMsg'));
    } else {
        $('#register').html('register');
        $('#new').html('');
        btnText = 0;
    }
}

window.onload=initialise;