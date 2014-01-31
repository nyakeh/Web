
$(document).ready(function() {
//http://nyakehbowl.azurewebsites.net/api/game

    $('#game_get_submit').click( function() {
        $.ajax({
            url: 'GameGet.php',
            data: '',
            dataType: 'json',
            success: function(data) {
                alert(data);
                $("#game_get").text(data);
                console.log("yay");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(xhr.statusText);
                console.log(thrownError);
                console.log("No");
            }
        });
    });

    $('#game_get_id_submit').click( function() {
        $.ajax({
            url: 'http://localhost:50565/api/game/3',
            type: 'GET',
            contentType: "application/json",
            dataType: 'json',
            data: '',
            success: function(data) {
                $("#game_get_id").text(data);
                console.log("Success");

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(xhr.statusText);
                console.log(thrownError);
                console.log("Fail");
            }
        });
    });

    $('#game_post_submit').click( function() {
        $.ajax({
            url: 'http://localhost:50565/api/game',
            type: 'POST',
            contentType: "application/json",
            crossDomain: true,
            dataType: 'json',
            data: 'web ting',
            success: function(data) {
                $("#game_post_id").text(data);
                console.log("Si");

            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(xhr.statusText);
                console.log(thrownError);
                console.log("Nada");
            }
        });
    });

});