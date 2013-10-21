
function initialise()
{
    var result;
    var mySpan = document.getElementById('jsOutput');
    var button = document.getElementById('click')
    button.onclick = function() {
        result = Math.floor((Math.random() * 2) + 1);
        if(result == 1){
            mySpan.textContent = "Heads";
        } else {
            mySpan.textContent = "Tails";
        }
    }
}
window.onload=initialise;