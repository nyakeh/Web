$("#deskImage").click(function(){
    imagePath = $("#deskImage").attr("src");
    if(imagePath == "/img/desk.png"){
        $("#deskImage").attr("src", "/img/deskAlt.png");
    }else{
        $("#deskImage").attr("src", "/img/desk.png");        
    }
});