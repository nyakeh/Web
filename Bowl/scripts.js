
$(document).ready(function() {

    //criteriaStr = document.getElementById('criteria');
    $('#game_get_submit').click( function() {
        $.ajax({ url: 'HatGet.php',
            data: { params: '' },
            type: 'post',
            success: function(output) {
                var transformed = JSON.parse(output);
                $("#game_get").text(transformed[0]['Name'] + ' ' + transformed[0]['Colour']);
            }
        });
    });

    $('#game_get_id_submit').click( function() {
        $param = '/'+$('#form_game_get').val();
        $.ajax({ url: 'HatGet.php',
            data: { params: $param },
            type: 'post',
            success: function(output) {
                $("#game_get_id").text(output);
            }
        });
    });

    $('#game_post_submit').click( function() {
        $name = $('#form_name').val();
        $colour = $('#form_colour').val();
        $.ajax({ url: 'HatPost.php',
            data: { name: $name, colour: $colour },
            type: 'post',
            success: function(output) {
                $("#game_post_id").text(output);
            }
        });
    });
});