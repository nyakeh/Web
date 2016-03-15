const MONTHS_PER_YEAR = 12;
var assumptionsHidden = true;

$('#calculatorSubmit').click(function() {
    var costOfLiving = $('#costOfLivingInput').val();
    var monthlySaving = $('#monthlySavingsInput').val();
    var portfolio = $('#portfolioInput').val();
    var interestRate = $('#interestRateInput').val()/100;
    var withdrawalRate = $('#withdrawalRateInput').val()/100;

    var requiredInvestedAmount = costOfLiving / withdrawalRate;
    var netWorth = portfolio;
    var years = 0;
    var monthlyInterestRate = (interestRate / MONTHS_PER_YEAR);
    
    while (netWorth < requiredInvestedAmount) {
        years++;
        var monthsInTerm = MONTHS_PER_YEAR * years;

        var termInterestRate = Math.pow((1 + monthlyInterestRate), monthsInTerm);
        var principalReturn = portfolio * termInterestRate;

        var compoundTermInterestRate = (termInterestRate - 1) / monthlyInterestRate;
        var savingsReturn = monthlySaving * compoundTermInterestRate;
        netWorth = principalReturn + savingsReturn;
    }

    $('#principalReturn').text('£' + principalReturn.formatMoney());
    $('#savingsReturn').text('£' + savingsReturn.formatMoney());
    $('#futureNetWorth').text('£' + netWorth.formatMoney());
    $('#yearsTillRetirement').text(years + ' years');
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