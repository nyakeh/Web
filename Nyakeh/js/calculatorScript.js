const ANNUAL_RETURN_ON_INVESTMENT = 0.05;
const WITHDRAWAL_RATE = 0.04;
const MONTHS_PER_YEAR = 12;

$('#calculatorSubmit').click(function() {
    var costOfLiving = $('#costOfLivingInput').val();
    var monthlySavings = $('#monthlySavingsInput').val();
    var portfolioValue = $('#portfolioValueInput').val();

    var monthlyInterestRate = (1+ANNUAL_RETURN_ON_INVESTMENT/MONTHS_PER_YEAR);
    var monthsInTerm = MONTHS_PER_YEAR*(10);
    var termInterestRate = Math.pow(monthlyInterestRate,monthsInTerm)
    var endPrincipalAmount = portfolioValue * termInterestRate;
    console.log(endPrincipalAmount);
})