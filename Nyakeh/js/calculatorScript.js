const ANNUAL_RETURN_ON_INVESTMENT = 0.05;
const WITHDRAWAL_RATE = 0.04;
const MONTHS_PER_YEAR = 12;

$('#calculatorSubmit').click(function() {
    var costOfLiving = $('#costOfLivingInput').val();
    var monthlySaving = $('#monthlySavingsInput').val();
    var portfolio = $('#portfolioInput').val();
    var years = $('#yearsInput').val();

    var monthlyInterestRate = (ANNUAL_RETURN_ON_INVESTMENT / MONTHS_PER_YEAR);
    var monthsInTerm = MONTHS_PER_YEAR * years;
    
    var termInterestRate = Math.pow((1 + monthlyInterestRate), monthsInTerm);
    var principalReturn = portfolio * termInterestRate;
    
    var compoundTermInterestRate = (termInterestRate-1) / monthlyInterestRate;
    var savingsReturn = monthlySaving * compoundTermInterestRate;

    $('#principalReturn').text('£' + principalReturn.formatMoney());
    $('#savingsReturn').text('£' + savingsReturn.formatMoney());
    $('#futureNetWorth').text('£' + (principalReturn + savingsReturn).formatMoney());
})

Number.prototype.formatMoney = function(){
var n = this,
    c = 2,
    t = ",",
    s = n < 0 ? "-" : "", 
    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? "." + Math.abs(n - i).toFixed(c).slice(2) : "");
 };