$("#deskImage").click(function () {
    imagePath = $("#deskImage").attr("src");
    if (imagePath == "/img/desk.png") {
        $("#deskImage").attr("src", "/img/deskAlt.png");
    } else {
        $("#deskImage").attr("src", "/img/desk.png");
    }
});


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
    maintainAspectRatio: true
});

var expensesData = [
    {
        value: 300,
        color:"#F7464A",
        label: "Red"
    },
    {
        value: 50,
        color: "#46BFBD",
        label: "Green"
    },
    {
        value: 100,
        color: "#FDB45C",
        label: "Yellow"
    }
]

var expensesChart = $("#expensesChart").get(0).getContext("2d");
$.ajax({ url: 'Expenses_Function.php',
            data: { month: "January", year: "2016" },
            type: 'post',
            success: function (output) {
                try {
                    var results = JSON.parse(output);
                    for (var i in results) {
                        expensesData.push({
                            value: results[i].Amount,
                            color: results[i].Colour,
                            label: results[i].Category
                        })                    
                    }
                    var myExpencesChart = new Chart(expensesChart);
                    myExpencesChart.Pie(expensesData,{
                        percentageInnerCutout : 0
                    });
                    console.log(results);
                } catch(exception) {
                    console.log("exception");
                    console.log(exception);
                }
            }
        });

