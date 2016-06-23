const MONTHS_PER_YEAR = 12;
var assumptionsHidden = true;

Number.prototype.formatMoney = function() {
    var n = this,
        c = 2,
        t = ",",
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? "." + Math.abs(n - i).toFixed(c).slice(2) : "");
};

$('#calculatorSubmit').click(function() {
    calculateCompoundInterest();
});

var calculateCompoundInterest = function() {
    var monthlyInvestment = $('#monthlyInvestmentInput').val();
    var yearsInvesting = $('#yearsInvestingForInput').val();
    var yearsToGrow = $('#yearsToGrowInput').val();
    var interestRate = $('#interestRateInput').val() / 100;

    var monthsInvesting = yearsInvesting * MONTHS_PER_YEAR;
    var totalContribution = monthlyInvestment * monthsInvesting;

    var monthlyInterestRate = (interestRate / MONTHS_PER_YEAR);
    var termInterestRate = Math.pow((1 + monthlyInterestRate), monthsInvesting);
    var compoundTermInterestRate = (termInterestRate - 1) / monthlyInterestRate;
    var futureSum = monthlyInvestment * compoundTermInterestRate;
    var investmentReturn = futureSum - totalContribution;
    $('#totalContribution').text('£' + totalContribution.formatMoney());
    $('#investmentReturn').text('£' + investmentReturn.formatMoney());
    $('#futureSum').text('£' + futureSum.formatMoney());
};

$('#assumptionsToggle').click(function() {
    if (assumptionsHidden) {
        $('.assumptions').show();
        assumptionsHidden = false;
    } else {
        $('.assumptions').hide();
        assumptionsHidden = true;
    }
});

calculateCompoundInterest();