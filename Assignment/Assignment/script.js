var btnText = 0;
var registrationFields =  '<p><label>Forename: <input type="text" id="forename" name="forename"></label></p>' +
                          '<p><label>Surname: <input type="text" id="surname" name="surname"></label></p>' +
                          '<p><label>Phone: <input type="text" id="phone" name="phone"></label></p>' +
                          '<p><label>Address: <input type="text" id="address" name="address"></label></p>' +
                          '<p><label>Email Address: <input type="email" id="email" name="email"> <span id="emailMsg"></span></label></p>';
function initialise()
{
}

function changeText() {
    if (btnText == 0){
        btnText = 1;
        document.getElementById('intent').value='register'
        $('#new').html(registrationFields);
    } else {
        $('#new').html('');
        document.getElementById('intent').value='login'
        btnText = 0;
    }
}

window.onload=initialise;