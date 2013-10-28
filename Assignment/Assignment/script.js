var btnText = 0;
function initialise() {
     $('#Username').toggleClass('show');
}
function changeText() {
    $('#Username').toggleClass('show');
    if (btnText == 0){
        btnText = 1;
        $('#register').html('login');
        $('#new').html('<p><label>Email Address: <input type="email" name="email" id="email"> <span id="emailMsg"></span></label></p>');
    } else {
        $('#register').html('register');
        $('#new').html('');
        btnText = 0;
    }
}

window.onload=initialise;