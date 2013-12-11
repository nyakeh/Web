function initialise()
{

}

function RedirectToRegister() {
    location.href = 'register.php';
}

function SaveSearch() {
    var x ="<?php SaveSearch() ?>";
    alert(x);
    return x;
}

 // potential input field on change validation?
 // <input type="text" name="Email" size="20" onChange="emailvalidation(this,'The E-mail is not valid');">
window.onload=initialise;

/*
function changeSearchIntent() {
    if (btnText == 0){
        btnText = 1;
        document.getElementById('criteria').value='make'
    } else {
        document.getElementById('criteria').value='colour'
        btnText = 0;
    }
}*/
