$('#wallChartCheckin').submit(function () {
    var made = $('#madeInput').val();
    var spent = $('#spentInput').val();
    var invested = $('#investedInput').val();
    var date = $('#dateInput').val();

    console.log('made: ' + made + 'spent: ' + spent + 'invested: ' + invested + 'date: ' + date);

    $.ajax({
        url: 'Wall_Chart.php',
        data: { date: date, made: made, spent: spent, invested: invested },
        type: 'put',
        success: function (output) {
            console.log('Success feedback');
        }
    });
});

$('#dateInput').val(new Date().toISOString().slice(0, 10));