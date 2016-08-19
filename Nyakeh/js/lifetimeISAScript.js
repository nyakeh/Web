const MONTHS_PER_YEAR = 12;
const MAX_CONTRIBUTION_YEAR = 50;
var assumptionsHidden = true;

Number.prototype.formatMoney = function () {
    var n = this,
        c = 2,
        t = ",",
        s = n < 0 ? "-" : "",
        i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
        j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? "." + Math.abs(n - i).toFixed(c).slice(2) : "");
};

$('#calculatorSubmit').click(function () {
    calculateLifetimeISA();
});

var calculateLifetimeISA = function () {
    var age = $('#ageInput').val();
    if (age > 50) {
        $('#error_feedback').text('Sorry, the maximum contributing age is 50.');
        $('#personalContribution').html('&nbsp');
        $('#governmentBonus').html('&nbsp');
        $('#ISAInterest').html('&nbsp');
        $('#lifetimeISATotal').html('&nbsp');
        return;
    }

    $('#error_feedback').text('');
    var contribution = $('#ContributionInput').val();
    var interestRate = $('#interestRateInput').val() / 100;

    var contributingYears = MAX_CONTRIBUTION_YEAR - age;
    var monthlyInterestRate = interestRate / MONTHS_PER_YEAR;
    var monthsInTerm = contributingYears * MONTHS_PER_YEAR;
    var totalPersonalContribution = contribution * monthsInTerm;

    var yearlyPersonalContribution = contribution * MONTHS_PER_YEAR;
    var yearlyGovernmentContribution = yearlyPersonalContribution * 0.25;
    var totalGovermentContribution = yearlyGovernmentContribution * contributingYears;

    var termInterestRate = Math.pow((1 + monthlyInterestRate), monthsInTerm);
    var compoundTermInterestRate = (termInterestRate - 1) / monthlyInterestRate;
    var savingsReturn = contribution * compoundTermInterestRate;

    var termInterestRate = Math.pow((1 + interestRate), contributingYears);
    var compoundInterestRate = (termInterestRate - 1) / interestRate;
    var govermentContributionDuringBonusYears = yearlyGovernmentContribution * compoundInterestRate;

    var termInterestRate = Math.pow((1 + monthlyInterestRate), 120);
    var govermentContributionReturn = govermentContributionDuringBonusYears * termInterestRate;
    var personalContributionReturn = savingsReturn * termInterestRate;

    var interestEarned = (personalContributionReturn + govermentContributionReturn) - (totalPersonalContribution + totalGovermentContribution)

    $('#personalContribution').text('£' + totalPersonalContribution.formatMoney());
    $('#governmentBonus').text('£' + totalGovermentContribution.formatMoney());
    $('#ISAInterest').text('£' + interestEarned.formatMoney());
    $('#lifetimeISATotal').text('£' + (personalContributionReturn + govermentContributionReturn).formatMoney());
};

$('#assumptionsToggle').click(function () {
    if (assumptionsHidden) {
        $('.assumptions').show();
        assumptionsHidden = false;
    } else {
        $('.assumptions').hide();
        assumptionsHidden = true;
    }
});

calculateLifetimeISA();