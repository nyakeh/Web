
function initialise()
{
    var currentDate = new Date();
    var mySpan = document.getElementById('jsOutput');
    var button = document.getElementById('click')
    button.onclick = function() {
        mySpan.textContent = currentDate.toLocaleDateString() + "  -  " + currentDate.toLocaleTimeString();
    }
}
window.onload=initialise;