const ANNUAL_RETURN_ON_INVESTMENT = 0.05;
const WITHDRAWAL_RATE = 0.04;
const MONTHS_PER_YEAR = 12;

$('#calculatorSubmit').click(function() {
    var costOfLiving = $('#costOfLivingInput').val();
    var monthlySaving = $('#monthlySavingsInput').val();
    var portfolio = $('#portfolioInput').val();

    var monthlyInterestRate = (ANNUAL_RETURN_ON_INVESTMENT / MONTHS_PER_YEAR);
    var monthsInTerm = MONTHS_PER_YEAR * (10);
    
    var termInterestRate = Math.pow((1 + monthlyInterestRate), monthsInTerm);
    var principalReturn = portfolio * termInterestRate;
    
    var compoundTermInterestRate = (termInterestRate-1) / monthlyInterestRate;
    var savingsReturn = monthlySaving * compoundTermInterestRate;

    $('#principalReturn').text('£' + principalReturn.toFixed(2));
    $('#savingsReturn').text('£' + savingsReturn.toFixed(2));
    $('#futureNetWorth').text('£' + (principalReturn + savingsReturn).toFixed(2));
})