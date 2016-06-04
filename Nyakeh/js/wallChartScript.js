$('#wallChartCheckin').submit(function () {
    var made = $('#madeInput').val();
    var spent = $('#spentInput').val();
    var invested = $('#investedInput').val();
    var date = $('#dateInput').val();

    console.log('made: ' + made + 'spent: ' + spent + 'invested: ' + invested + 'date: ' + date);

    $.ajax({
        url: 'Wall_Chart.php',
        data: { date: date, made: made, spent: spent, invested: invested },
        type: 'post',
        success: function (output) {
            console.log('Success feedback:' + output);
        }
    });
});

var calculateRetirement = function() {
	$.ajax({
        url: 'Wall_Chart.php',
        type: 'get',
        success: function (output) {
            console.log('Success feedback:' + output);
        }
    });
};

$('#dateInput').val(new Date().toISOString().slice(0, 10));
calculateRetirement();