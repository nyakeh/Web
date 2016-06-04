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
                var chartLabels = [];
                var madeData = [];
                var spentData = [];
                var investedData = [];
                for (var i in results) {
                    table += '<tr><td>' + results[i].Date + '</td><td>£' + results[i].Made + '</td><td>£' + results[i].Spent + '</td><td>£' + results[i].Invested + '</td></tr>';
                    chartLabels.push(results[i].Date)
                    madeData.push(results[i].Made)
                    spentData.push(results[i].Spent)
                    investedData.push(results[i].Invested)
                }
                table += '</tbody></table>';
                $("#checkInTable").html(table);
                
                var data = {
                    labels: chartLabels,
                    datasets: [
                        {
                            label: "Made",
                            fill: false,
                            lineTension: 0.1,
                            backgroundColor: "rgba(75,192,192,0.4)",
                            borderColor: "rgba(75,192,192,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(75,192,192,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(75,192,192,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: madeData,
                        },
                        {
                            label: "Spent",
                            fill: false,
                            lineTension: 0.1,
                            backgroundColor: "rgba(75,192,192,0.4)",
                            borderColor: "rgba(75,192,192,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(75,192,192,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(75,192,192,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: spentData,
                        },
                        {
                            label: "Invested",
                            fill: false,
                            lineTension: 0.1,
                            backgroundColor: "rgba(75,192,192,0.4)",
                            borderColor: "rgba(75,192,192,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(75,192,192,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(75,192,192,1)",
                            pointHoverBorderColor: "rgba(220,220,220,1)",
                            pointHoverBorderWidth: 2,
                            pointRadius: 1,
                            pointHitRadius: 10,
                            data: investedData,
                        }
                    ]
                };
                var wallChartCanvas = $("#wallChart");
                var WallChart = new Chart(wallChartCanvas, {
                    type: 'line',
                    data: data,
                    options: {
                        responsive: true,
                        elements: {
                            line: {
                                lineTension: 0.1
                            }
                        }
                    }
                });
                
            } catch (exception) {
                console.log(exception);
            }
        }
    });
};

$('#dateInput').val(new Date().toISOString().slice(0, 10));
calculateRetirement();