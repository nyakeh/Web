$("#deskImage").click(function () {
    imagePath = $("#deskImage").attr("src");
    if (imagePath == "/img/desk.png") {
        $("#deskImage").attr("src", "/img/deskAlt.png");
    } else {
        $("#deskImage").attr("src", "/img/desk.png");
    }
});

var changeExpensesMonth = function($selectedDate) {
    var dateInputs = $selectedDate.split(',');
    populateExpensesChart(dateInputs[0], dateInputs[1]);
} 

var data = {
    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(71,121,101,0.2)",
            strokeColor: "rgba(71,121,101,1)",
            pointColor: "rgba(71,121,101,1)",
            pointHighlightFill: "rgba(71,121,101,0.2)",
            data: [65, 59, 80, 81, 56, 55, 40]
        },
        {
            label: "My Second dataset",
            fillColor: "rgba(176,0,17,0.2)",
            strokeColor: "rgba(176,0,17,1)",
            pointColor: "rgba(176,0,17,1)",
            pointHighlightFill: "rgba(176,0,17,0.5)",
            data: [28, 48, 40, 19, 86, 27, 90]
        },
        {
            label: "My Second dataset",
            fillColor: "rgba(121,101,71,0.2)",
            strokeColor: "rgba(121,101,71,1)",
            pointColor: "rgba(121,101,71,1)",
            pointHighlightFill: "rgba(121,101,71,0.5)",
            data: [12, 11, 1, 21, 14, 12, 16]
        }
    ]
};

var ctx = $("#financeChart").get(0).getContext("2d");
var myLineChart = new Chart(ctx);
myLineChart.Line(data, {
    pointDotRadius: 6,
    bezierCurve: true,
    scaleShowVerticalLines: false,
    scaleGridLineColor: "black",
    responsive: true,
    maintainAspectRatio: true,
    multiTooltipTemplate: "<%= datasetLabel %>: <%= value %>"
});

var populateExpensesChart = function($month, $year) {
    $('#expensesChart').replaceWith('<canvas id="expensesChart" width="500" height="500"></canvas>');
    var expensesChart = $("#expensesChart").get(0).getContext("2d");
    var expensesData = []
    $.ajax({ url: 'Expenses_Function.php',
                data: { month: $month, year: $year },
                type: 'post',
                success: function (output) {
                    try {
                        var results = JSON.parse(output);                        
                        var table = '<table><thead><tr><th>Category</th><th>Amount</th></tr></thead><tbody>';
                        
                        results.sort(function(a, b){
                            return a.Amount - b.Amount;
                        })
                        
                        for (var i in results) {
                            r = Math.floor(Math.random() * 200);
                            g = Math.floor(Math.random() * 200);
                            b = Math.floor(Math.random() * 200);
                            colour = 'rgb(' + r + ', ' + g + ', ' + b + ')';
                            
                            expensesData.push({
                                value: results[i].Amount,
                                color: colour,
                                label: results[i].Category
                            })                            
                            
                            table += '<tr><td>'+results[i].Category+'</td><td>£'+results[i].Amount+'</td></tr>';
                        }
                        var myExpensesChart = new Chart(expensesChart);
                        myExpensesChart.Pie(expensesData,{
                            percentageInnerCutout : 0,
                            responsive: true,
                            maintainAspectRatio: true
                        });                        
                        table += '</tbody></table>';
                        $("#expensesTable").html(table);
                    } catch(exception) {
                        console.log(exception);
                    }
                }
    });
}
populateExpensesChart("february","2016");

var datasets = []
$.ajax({ url: 'Net_Worth_Function.php',
            type: 'post',
            success: function (output) {
                try {
                    var results = JSON.parse(output);
                    
                    for (var i in results.Data) {
                        var lineColour = results.Data[i].Colour + "1)";
                        var fillColour = results.Data[i].Colour+"0.2)"
                        datasets.push({
                            label: results.Data[i].Name,
                            strokeColor: lineColour,
                            pointColor: lineColour,
                            fillColor: fillColour,
                            pointHighlightFill: fillColour,
                            data: results.Data[i].Data
                        })
                    }
                    
                    var netWorthData = {
                        labels: results.Labels,
                        datasets: datasets
                    };

                    var ctx = $("#netWorthChart").get(0).getContext("2d");
                    var myLineChart = new Chart(ctx);
                    myLineChart.Line(netWorthData, {
                        pointDotRadius: 4,
                        datasetStrokeWidth : 4,
                        bezierCurve: true,
                        scaleShowVerticalLines: false,
                        scaleGridLineColor: "black",
                        responsive: true,
                        maintainAspectRatio: true,                        
                        multiTooltipTemplate: "<%= datasetLabel %>: <%= value %>",
                        scaleOverride : true,
                        scaleSteps : 16,
                        scaleStepWidth : 250,
                        scaleStartValue : -250 
                    });
                } catch(exception) {
                    console.log(exception);
                }
            }
});

var savingRateDataset = []
$.ajax({ url: 'Saving_Rate_Function.php',
            type: 'post',
            success: function (output) {
                try {
                    var results = JSON.parse(output);
                    console.log("results.EarningData.Data: "+results.EarningData.Data);
                    console.log("results.SpendingData.Data: "+results.SpendingData.Data);
                    var earningLineColour = results.EarningData.Colour + "1)";
                    var earningFillColour = results.EarningData.Colour + "0.5)";
                    savingRateDataset.push({
                        label: results.EarningData.Name,
                        fillColor: earningFillColour,
                        strokeColor: earningLineColour,
                        highlightFill: earningFillColour,
                        highlightStroke: earningLineColour,
                        data: results.EarningData.Data
                    });
                    
                    var spendingLineColour = results.SpendingData.Colour + "1)";
                    var spendingFillColour = results.SpendingData.Colour + "0.5)";
                    savingRateDataset.push({
                        label: results.SpendingData.Name,
                        fillColor: spendingFillColour,
                        strokeColor: spendingLineColour,
                        highlightFill: spendingFillColour,
                        highlightStroke: spendingLineColour,
                        data: results.SpendingData.Data
                    });
                    
                    var savingRateData = {
                        labels: results.Labels,
                        Datasets: savingRateDataset
                    };
                    
                    var data = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [
                        {
                            label: "My First dataset",
                            fillColor: "rgba(220,220,220,0.5)",
                            strokeColor: "rgba(220,220,220,0.8)",
                            highlightFill: "rgba(220,220,220,0.75)",
                            highlightStroke: "rgba(220,220,220,1)",
                            data: [65.43, 59.20, 80, 81, 56, 55, 40]
                        },
                        {
                            label: "My Second dataset",
                            fillColor: "rgba(151,187,205,0.5)",
                            strokeColor: "rgba(151,187,205,0.8)",
                            highlightFill: "rgba(151,187,205,0.75)",
                            highlightStroke: "rgba(151,187,205,1)",
                            data: [28, 48, 40, 19, 86, 27, 90]
                        }
                    ]
                    };

                    var ctx = $("#savingRateChart").get(0).getContext("2d");
                    var savingRateChart = new Chart(ctx);
                    savingRateChart.Bar(data, {
                        barShowStroke: false
                    });
                } catch(exception) {
                    console.log(exception);
                }
            }
});