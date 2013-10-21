/*alert("hello world");*/
/*
$('register').on('click', function() { alert("hello ");});

$('button').on('click', function() { alert(" world");});

$('button').on('loginDetails', function() { alert(" world");});

$('div').on('click', function() {
    alert(" world");
});
*/

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
    $('#register').on('click', function() {
        $('#username').toggleClass('hide');
    });
}
window.onload=initialise;



