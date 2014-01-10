
$(document).ready(function() {
    
    $('a#menu_btn').click(function() {
        alert("hi");
        $('H1').toggleClass('open_menu');
    });

    document.getElementById('menu_btn').click(function() {
        alert("hello");
    });


});