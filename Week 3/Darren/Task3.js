
function initialise()
{
    var row = "<table>";
    var mySpan = document.getElementById('jsOutput');
    for (var x = 1;x <=10; x++) {
        row += "<tr>"
        for (var y = 1;y <=10; y++) {
            row += "<td>" + (x*y) + "</td>";
        }
        row += "</tr>"
    }
    row += "</table>"
    mySpan.innerHTML = row;
}
window.onload=initialise;