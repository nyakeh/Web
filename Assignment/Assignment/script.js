var btnText = 0;
function initialise()
{
    registerValidation(document.getElementById('userPassword'), document.getElementById('passwordMsg'));
    registerValidation(document.getElementById('username'), document.getElementById('usernameMsg'));
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
        $('#new').html('<p><label>Email Address: <input type="email" id="email" name="email"/> <span id="emailMsg"></span></label></p>');
        registerValidation(document.getElementById('email'), document.getElementById('emailMsg'));
    } else {
        $('#register').html('register');
        $('#new').html('');
        btnText = 0;
    }
}

function logout() {

}


window.onload=initialise;