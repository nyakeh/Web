/*alert("hello world");*/
/*
$('register').on('click', function() { alert("hello ");});

$('button').on('click', function() { alert(" world");});

$('button').on('loginDetails', function() { alert(" world");});

$('div').on('click', function() {
    alert(" world");
});
*/
var btnText = 0;
function initialise() {
    /*var button = document.getElementById('register');
    var username = document.getElementById('username');

    button.onclick = function() {
        alert("jaascrit ")
        username.toggle('hide');
    }

 $('button').on('click', function() {
 $('username').toggleClass('hide');
 });
*/
    $('#Username').toggleClass('show');
    /*alert("hi");*/
    /*$('#register').on('click', function() {
        $('#Username').toggleClass('show');
    });*/
}
function changeText() {
    $('#Username').toggleClass('show');
    if (btnText == 0){
        btnText = 1;
        $('#register').html('login');
        $('#new').html('<p><label>Email Address: <input type="text" name="email"></label></p>');
    } else {
        $('#register').html('register');
        $('#new').html('');
        btnText = 0;
    }
}

window.onload=initialise;



