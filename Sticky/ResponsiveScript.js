$('.nav-primary').find('h3')
    .bind('click focus', function(){
        $(this).parent().toggleClass('expanded')
    });