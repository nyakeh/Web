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

var calculateRetirement = function () {
	$.ajax({
        url: 'Wall_Chart.php',
        type: 'get',
        success: function (output) {
            console.log('Success feedback:' + output);

			try {
                var results = JSON.parse(output);
                var table = '<table><thead><tr><th>Date</th><th>Made</th><th>Spent</th><th>Invested</th></tr></thead><tbody>';
                for (var i in results) {
                    table += '<tr><td>' + results[i].Date + '</td><td>£' + results[i].Made + '</td><td>£' + results[i].Spent + '</td><td>£' + results[i].Invested + '</td></tr>';
                }
                table += '</tbody></table>';
                $("#checkInTable").html(table);
            } catch (exception) {
                console.log(exception);
            }
        }
    });
};

$('#dateInput').val(new Date().toISOString().slice(0, 10));
calculateRetirement();