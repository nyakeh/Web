function calculateVAT(value)
{
    var vat = 0.175;
    return value * vat;
}
function initialise()
{
    var userValue = 25;
    var mySpan = document.getElementById('jsOutput');
    mySpan.textContent = calculateVAT(userValue);
}
window.onload=initialise;