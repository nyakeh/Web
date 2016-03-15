const MONTHS_PER_YEAR = 12;
var assumptionsHidden = true;

$('#calculatorSubmit').click(function() {
    var costOfLiving = $('#costOfLivingInput').val();
    var monthlySaving = $('#monthlySavingsInput').val();
    var portfolio = $('#portfolioInput').val();
    var interestRate = $('#interestRateInput').val() / 100;
    var withdrawalRate = $('#withdrawalRateInput').val() / 100;

    var yearsInvesting = [];
    var returnOnInvestmentHistory = [];
    var netWorthHistory = [];    
    var savingsAmountHistory = [];

    var requiredInvestedAmount = costOfLiving / withdrawalRate;
    var netWorth = portfolio;
    var years = 0;
    var monthlyInterestRate = (interestRate / MONTHS_PER_YEAR);
    var currentYear = new Date().getFullYear();

    while (netWorth < requiredInvestedAmount) {
        years++;
        yearsInvesting.push(currentYear++);
        var monthsInTerm = MONTHS_PER_YEAR * years;

        var termInterestRate = Math.pow((1 + monthlyInterestRate), monthsInTerm);
        var principalReturn = portfolio * termInterestRate;

        var compoundTermInterestRate = (termInterestRate - 1) / monthlyInterestRate;
        var savingsReturn = monthlySaving * compoundTermInterestRate;
        netWorth = principalReturn + savingsReturn;
        
        var totalSavedToDate = monthlySaving * monthsInTerm;
        savingsAmountHistory.push(totalSavedToDate.toFixed(2));
        returnOnInvestmentHistory.push((savingsReturn-totalSavedToDate).toFixed(2));
        netWorthHistory.push(netWorth.toFixed(2));
    }

    $('#principalReturn').text('£' + principalReturn.formatMoney());
    $('#savingsReturn').text('£' + savingsReturn.formatMoney());
    $('#futureNetWorth').text('£' + netWorth.formatMoney());
    $('#yearsTillRetirement').text(years + ' years');

    var data = {
        labels: yearsInvesting,
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(71,121,101,0.4)",
                strokeColor: "rgba(71,121,101,1)",
                pointColor: "rgba(71,121,101,1)",
                pointHighlightFill: "rgba(71,121,101,0.2)",
                data: savingsAmountHistory
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(176,0,17,0.2)",
                strokeColor: "rgba(176,0,17,1)",
                pointColor: "rgba(176,0,17,1)",
                pointHighlightFill: "rgba(176,0,17,0.5)",
                data: returnOnInvestmentHistory
            },
            {
                label: "My Second dataset",
                fillColor: "rgba(121,101,71,0.2)",
                strokeColor: "rgba(121,101,71,1)",
                pointColor: "rgba(121,101,71,1)",
                pointHighlightFill: "rgba(121,101,71,0.5)",
                data: netWorthHistory
            }
        ]
    };

    var ctx = $("#retirementChart").get(0).getContext("2d");
    var myLineChart = new Chart(ctx);
    myLineChart.Line(data, {
        pointDotRadius: 4,
        datasetStrokeWidth: 4,
        bezierCurve: true,
        scaleShowVerticalLines: false,
        scaleGridLineColor: "black",
        responsive: true,
        maintainAspectRatio: true
    });
});

$('#assumptionsToggle').click(function() {
    if (assumptionsHidden) {
        $('.assumptions').show();
        assumptionsHidden = false;
    } else {
        $('.assumptions').hide();
        assumptionsHidden = true;
    }
});

Number.prototype.formatMoney = function() {
    var n = this,
        c = 2,
        t = ",",
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? "." + Math.abs(n - i).toFixed(c).slice(2) : "");
};