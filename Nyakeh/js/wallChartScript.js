var summaryHidden = true;

Number.prototype.formatMoney = function () {
    var n = this,
        c = 2,
        t = ",",
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? "." + Math.abs(n - i).toFixed(c).slice(2) : "");
};

var percentageFrom = function ($value) {
    return ($value * 100).toFixed(0) + '%';
}

var extractMonth = function ($date) {
    var month = {
        "01": "January",
        "02": "February",
        "03": "March",
        "04": "April",
        "05": "May",
        "06": "June",
        "07": "July",
        "08": "August",
        "09": "September",
        "10": "October",
        "11": "November",
        "12": "December"
    };
    return month[$date.substring(5, 7)];
}

var populateFuturePredictions = function ($timePeriod, $Spending, $Income) {
    var annualSpending = ($Spending * 12);
    var annualIncome = ($Income * 12);
    var profit = (annualIncome - annualSpending);
    $("#futurePredictions").append("<p>At " + $timePeriod + " pace... <br> Annual spending will be <span class=\"red\"><b>£" + annualSpending.formatMoney() +
        "</b></span>. <br> Annual net income will be <span class=\"green\"><b>£" + annualIncome.formatMoney() + "</b></span>." +
        " <br> Leaving <span class=\"gold\"><b>£" + profit.formatMoney() + "</b></span> Profit.</p>");
}

$('#wallChartCheckin').submit(function () {
    var made = $('#madeInput').val();
    var spent = $('#spentInput').val();
    var invested = $('#investedInput').val();
    var date = $('#dateInput').val();

    $.ajax({
        url: 'Wall_Chart.php',
        data: { date: date, made: made, spent: spent, invested: invested },
        type: 'post'
    });
});

var initialise = function () {
    $.ajax({
        url: 'Wall_Chart.php',
        type: 'get',
        success: function (output) {
            try {
                var results = JSON.parse(output);
                var datasetTable = '<table><thead><tr><th>Date</th><th>Made</th><th>Spent</th><th>Invested</th></tr></thead><tbody>';
                var checkInDates = [];
                var madeData = [];
                var spentData = [];
                var investedData = [];
                for (var i in results) {
                    datasetTable += '<tr><td>' + results[i].Date + '</td><td>£' + results[i].Made + '</td><td>£' + results[i].Spent + '</td><td>£' + results[i].Invested + '</td></tr>';
                    checkInDates.push(results[i].Date)
                    madeData.push(results[i].Made)
                    spentData.push(results[i].Spent)
                    investedData.push(results[i].Invested)
                }
                datasetTable += '</tbody></table>';
                $("#datasetTable").html(datasetTable);
                var data = {
                    labels: checkInDates,
                    datasets: [
                        {
                            label: "Made",
                            fill: false,
                            lineTension: 0.1,
                            backgroundColor: "rgba(71,121,101,0.4)",
                            borderColor: "rgba(71,121,101,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(71,121,101,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(71,121,101,1)",
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
                            backgroundColor: "rgba(176,0,17,0.4)",
                            borderColor: "rgba(176,0,17,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(176,0,17,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(176,0,17,1)",
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
                            backgroundColor: "rgba(121,101,71,0.4)",
                            borderColor: "rgba(121,101,71,1)",
                            borderCapStyle: 'butt',
                            borderDash: [],
                            borderDashOffset: 0.0,
                            borderJoinStyle: 'miter',
                            pointBorderColor: "rgba(121,101,71,1)",
                            pointBackgroundColor: "#fff",
                            pointBorderWidth: 1,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "rgba(121,101,71,1)",
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
                        responsive: true
                    }
                });

                var movingAveragesTable = '<table><thead><tr><th>Subset</th><th>Made</th><th>Spent</th><th>Invested</th></tr></thead><tbody>';
                if (results.length >= 3) {
                    var threeMonthMadeAverage = (parseInt(madeData[madeData.length - 1]) + parseInt(madeData[madeData.length - 2]) + parseInt(madeData[madeData.length - 3])) / 3;
                    var threeMonthSpentAverage = (parseInt(spentData[spentData.length - 1]) + parseInt(spentData[spentData.length - 2]) + parseInt(spentData[spentData.length - 3])) / 3;
                    var threeMonthInvestedAverage = (parseInt(investedData[investedData.length - 1]) + parseInt(investedData[investedData.length - 2]) + parseInt(investedData[investedData.length - 3])) / 3;
                    movingAveragesTable += '<tr><td>3 Months</td><td>£' + threeMonthMadeAverage.formatMoney() + '</td><td>£' + threeMonthSpentAverage.formatMoney() + '</td><td>£' + threeMonthInvestedAverage.formatMoney() + '</td></tr>';

                    populateFuturePredictions("<b>last</b> months", parseInt(spentData[spentData.length - 1]), parseInt(madeData[madeData.length - 1]));
                    populateFuturePredictions("<b>three</b> months", threeMonthSpentAverage, threeMonthMadeAverage);

                    if (results.length >= 6) {
                        var sixMonthMadeAverage = (parseInt(madeData[madeData.length - 1]) + parseInt(madeData[madeData.length - 2]) + parseInt(madeData[madeData.length - 3]) + parseInt(madeData[madeData.length - 4]) + parseInt(madeData[madeData.length - 5]) + parseInt(madeData[madeData.length - 6])) / 6;
                        var sixMonthSpentAverage = (parseInt(spentData[spentData.length - 1]) + parseInt(spentData[spentData.length - 2]) + parseInt(spentData[spentData.length - 3]) + parseInt(spentData[spentData.length - 4]) + parseInt(spentData[spentData.length - 5]) + parseInt(spentData[spentData.length - 6])) / 6;
                        var sixMonthInvestedAverage = (parseInt(investedData[investedData.length - 1]) + parseInt(investedData[investedData.length - 2]) + parseInt(investedData[investedData.length - 3]) + parseInt(investedData[investedData.length - 4]) + parseInt(investedData[investedData.length - 5]) + parseInt(investedData[investedData.length - 6])) / 6;
                        movingAveragesTable += '<tr><td>6 Months</td><td>£' + sixMonthMadeAverage.formatMoney() + '</td><td>£' + sixMonthSpentAverage.formatMoney() + '</td><td>£' + sixMonthInvestedAverage.formatMoney() + '</td></tr>';

                        populateFuturePredictions("<b>six</b> months", sixMonthSpentAverage, sixMonthMadeAverage);
                        if (results.length >= 12) {
                            var twelveMonthMadeAverage = (parseInt(madeData[madeData.length - 1]) + parseInt(madeData[madeData.length - 2]) + parseInt(madeData[madeData.length - 3]) + parseInt(madeData[madeData.length - 4]) + parseInt(madeData[madeData.length - 5]) + parseInt(madeData[madeData.length - 6]) + parseInt(madeData[madeData.length - 7]) + parseInt(madeData[madeData.length - 8]) + parseInt(madeData[madeData.length - 9]) + parseInt(madeData[madeData.length - 10]) + parseInt(madeData[madeData.length - 11]) + parseInt(madeData[madeData.length - 12])) / 12;
                            var twelveMonthSpentAverage = (parseInt(spentData[spentData.length - 1]) + parseInt(spentData[spentData.length - 2]) + parseInt(spentData[spentData.length - 3]) + parseInt(spentData[spentData.length - 4]) + parseInt(spentData[spentData.length - 5]) + parseInt(spentData[spentData.length - 6]) + parseInt(spentData[spentData.length - 7]) + parseInt(spentData[spentData.length - 8]) + parseInt(spentData[spentData.length - 9]) + parseInt(spentData[spentData.length - 10]) + parseInt(spentData[spentData.length - 11]) + parseInt(spentData[spentData.length - 12])) / 12;
                            var twelveMonthInvestedAverage = (parseInt(investedData[investedData.length - 1]) + parseInt(investedData[investedData.length - 2]) + parseInt(investedData[investedData.length - 3]) + parseInt(investedData[investedData.length - 4]) + parseInt(investedData[investedData.length - 5]) + parseInt(investedData[investedData.length - 6]) + parseInt(investedData[investedData.length - 7]) + parseInt(investedData[investedData.length - 8]) + parseInt(investedData[investedData.length - 9]) + parseInt(investedData[investedData.length - 10]) + parseInt(investedData[investedData.length - 11]) + parseInt(investedData[investedData.length - 12])) / 12;
                            movingAveragesTable += '<tr><td>12 Months</td><td>£' + twelveMonthMadeAverage.formatMoney() + '</td><td>£' + twelveMonthSpentAverage.formatMoney() + '</td><td>£' + twelveMonthInvestedAverage.formatMoney() + '</td></tr>';
                            populateFuturePredictions("<b>twelve</b> months", twelveMonthSpentAverage, twelveMonthMadeAverage);
                        }
                    }
                }
                movingAveragesTable += '</tbody></table>';
                $("#movingAveragesTable").html(movingAveragesTable);

                var headerRow = '<thead><tr><th></th>';
                var spentAmountRow = '<tr><td>Spent</td>';
                var madeAmountRow = '<tr><td>Made</td>';
                var spentPercentRow = '<tr><td>Spent</td>';
                var madePercentRow = '<tr><td>Made</td>';
                var monthCount = 1;
                for (var i = spentData.length; i--;) {
                    if (monthCount > 12) {
                        break;
                    }
                    headerRow += '<th>' + (extractMonth(checkInDates[i])) + '</th>';
                    spentAmountRow += '<td>' + (parseInt(spentData[i]) - parseInt(spentData[i - 1])) + '</td>';
                    madeAmountRow += '<td>' + (parseInt(madeData[i]) - parseInt(madeData[i - 1])) + '</td>';
                    spentPercentRow += '<td>' + percentageFrom((parseInt(spentData[i]) / parseInt(spentData[i - 1])) - 1) + '</td>';
                    madePercentRow += '<td>' + percentageFrom((parseInt(madeData[i]) / parseInt(madeData[i - 1])) - 1) + '</td>';
                    monthCount++;
                }
                headerRow += '</tr></thead>';
                spentAmountRow += '</tr>';
                madeAmountRow += '</tr>';
                var changeLogTable = '<table><tbody>' + headerRow + spentPercentRow + spentAmountRow + madePercentRow + madeAmountRow + '</tbody></table>';
                $("#changeLogTable").html(changeLogTable);

                $('#changeLogTable td').each(function () {
                    if (parseInt($(this).text()) > 0) {
                        $(this).css('color', '#b00011');
                    } else if (parseInt($(this).text()) < 0) {
                        $(this).css('color', '#477965');
                    }
                });
            } catch (exception) {
                console.log(exception);
            }
        }
    });
};

$('#datasetToggle').click(function () {
    if (summaryHidden) {
        $('.dataset').show();
        summaryHidden = false;
    } else {
        $('.dataset').hide();
        summaryHidden = true;
    }
});

$('#dateInput').val(new Date().toISOString().slice(0, 10));
initialise();