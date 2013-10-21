function initialise()
{
    var heading = "Why Choose Us";
    var description = "Our courses are hands on from day one whether automotive, robotic, film or music technology, games design or programming.";
    var mySpan = document.getElementById('jsOutput');
    mySpan.innerHTML = heading + description;
}
window.onload = initialise;