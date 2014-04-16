$(document).ready(function () {
	$currentSelected = null;
	$currentCalculationId = null;
    $('#account_submit_Button').click(function () {
        $forename = $('#account_forename').val();
        $deposit = $('#account_surname').val();
        $term = $('#account_email').val();
        $interest = $('#account_password').val();
        $.ajax({ url: 'Account_Details_Update_Function.php',
            data: { forename: $forename, surname: $deposit, email: $term, password: $interest },
            type: 'post',
            success: function (output) {
                $("#account_message").text(output);
			}
			});
    });

    $('#mortgage_submit_Button').click(function () {
		$("#mortgage_results").html("<p>We're just <span class=\"bold\">calculating</span> your mortgage.</p><p><img src=\"img/loader.gif\"></p>");
        $houseValue = $('#input_property').val();
        $deposit = $('#input_deposit').val();
        $term = $('#input_term').val();
        $interest = $('#input_interest').val();
        $fees = $('#input_fees').val();
        $.ajax({ url: 'Mortgage_Calculate_Function.php',
            data: { houseValue: $houseValue, deposit: $deposit, term: $term, interest: $interest, fees: $fees },
            type: 'post',
            success: function (output) {
                try {
                    sessionStorage.setItem('calculation', output);
                    var calculation = JSON.parse(output);
                    var resultsTable = buildMortgageResultsTable(calculation);
                    var paymentSceduleTable = buildPaymentSceduleTable(calculation);
                    $("#mortgage_message").text('');
                    $("#mortgage_results").html(resultsTable);
                    $("#mortgage_detailed_results").html(paymentSceduleTable);
                } catch (exception) {
                    $("#mortgage_message").text(output);
                    $("#mortgage_results").html('');
                }
            }});
    });

    $('#borrow_submit_button').click(function () {
		$("#borrow_results").html("<p>We're just <span class=\"bold\">working out</span> how much a mortgae provider might offer you.</p><p><img src=\"img/loader.gif\"></p>");
        $deposit = $('#input_borrow_deposit').val();
        $.ajax({ url: 'How_Much_Can_I_Borrow_Function.php',
            data: { deposit: $deposit },
            type: 'post',
            success: function (output) {
                try {
                    var results = JSON.parse(output);
                    var resultsTable = buildBorrowResultsTable(results);
                    $("#borrow_message").text('');
                    $("#borrow_results").html(resultsTable);
                } catch(exception) {
                    $("#borrow_message").text(output);
                    $("#borrow_results").html('');
                }
            }
        	});
    });

    $('#compare_submit_Button').click(function () {
		$("#compare_results").html("<p>We're just <span class=\"bold\">comparing</span> multiple mortgage providers.</p><p><img src=\"img/loader.gif\"></p>");
        $houseValue = $('#input_property').val();
        $deposit = $('#input_deposit').val();
        $term = $('#input_term').val();
        $.ajax({ url: 'Mortgage_Calculate_Function.php',
            data: { houseValue: $houseValue, deposit: $deposit, term: $term, interest: '0', fees: '0' },
            type: 'post',
            success: function (output) {
                try {
                    var calculation = JSON.parse(output);
                    var resultsTable = buildCompareResultsTable(calculation);
                    $("#compare_message").text('');
                    $("#compare_results").html(resultsTable);
                } catch (exception) {
                    $("#compare_message").text(output);
                    $("#compare_results").html('');
                }
            }
        	});
    });
	
	$('#calculation_lookup_submit_Button').click(function () {
        $calcId = $('#input_calcId').val();
		preLoadCalculation($calcId);
    });
	
	
	$('#email_favourite').click(function () {
		if($currentCalculationId) {
			emailCalulation($currentCalculationId)
		} else {
        	$(".detailed_error").text("Please select a calculation to email");
		}
    });
});

function buildMortgageResultsTable(calculation) {
    var result = '<table><tr><th>Interest Rate</th><th>Loan-To-Value</th><th>Product Fees</th><th>Monthly Payment</th><th>Total Interest</th><th>Total Owed</th>';
    var result1 = '<tr><td>' + calculation.InterestRate + '%</td><td>' + calculation.LoanToValue + '</td><td>' + calculation.Fees + '</td><td>' + calculation.MonthlyRepayment + '</td><td>' + calculation.TotalInterest + '</td><td>' + calculation.TotalPaid + '</td>';
	
	if(calculation.AccountId != 0) {
		result += '<th>Favourite</th><th>Email</th></tr>';
		result1 += '<td><button class="favouriteBtn" data-calculationid="'+calculation.CalculationId+'">Favourite</button></td><td><button class="emailBtn" data-calculationid="'+calculation.CalculationId+'">Email</button></td></tr></table>';
	} else {
		result +='</tr>';
		result1 += '</table>';
	}
    return result + result1;
}

$(".favouriteBtn").live("click", function() {
	$calculationId = $(this).data("calculationid");
	
	$.ajax({ url: 'Favourite_Calculation_Function.php',
		data: { calculationId: $calculationId },
		type: 'post',
		success: function(output) {
			if($(".favouriteBtn").text() == "Favourite") {
				$(".favouriteBtn").text('Remove');
			} else {
				$(".favouriteBtn").text('Favourite');
			}
		}
	});
});
$(".emailBtn").live("click", function() {
	$("#mortgage_message").text("");	
	$calculationId = $(this).data("calculationid");
	emailCalulation($calculationId)
	
});

function emailCalulation(calculationId) {
	$email = prompt("Input Email Address to share to: ");
	$(".detailed_error").html('<img src=\"img/loader.gif\">');
	if($email != null && $email != "") {
		$.ajax({ url: 'Email_Calculation_Function.php',
			data: { calculationId: calculationId, email: $email },
			type: 'post',
			success: function(output) {
				$(".detailed_error").text(output);
			}
		});
	} else {
		$(".detailed_error").text("Blank email address entered");
	}
}

function buildCompareResultsTable(calculation) {
    var result = '<table><tr><th>Bank</th><th>Interest Rate</th><th>Loan-To-Value</th><th>Product Fees</th><th>Monthly Payment</th><th>Total Interest</th><th>Total Owed</th></tr>';
    for (var i in calculation) {
    result += '<tr><td>'+calculation[i].Bank+'</td><td>'+calculation[i].InterestRate+'</td><td>'+calculation[i].LoanToValue+'</td><td>'+calculation[i].Fees+'</td><td>'+calculation[i].MonthlyRepayment+'</td><td>'+calculation[i].TotalInterest+'</td><td>'+calculation[i].TotalPaid+'</td></tr>';
    }
    result += '</table>';
    return result;
}
function buildBorrowResultsTable(calculation) {
    var result = '<table><tr><th>Loan-To-Value</th><th>Max Loan</th></tr>';
    for (var i in calculation) {
        result += '<tr><td>'+calculation[i].LoanToValue+'</td><td>'+calculation[i].Amount+'</td></tr>';
    }
    result += '</table>';
    return result;
}
function buildPaymentSceduleTable(calculation) {
    //var result = '<table><tr><th>Year</th><th>Total</th><th>Capital</th><th>Interest</th><th>Repayments</th></tr>'
     //for(var year in calculation.RepaymentSchedule) {
      //  result += '<tr><td>Natwest</td><td>'+calculation.InterestRate+'</td><td>'+calculation.LoanToValue+'</td><td>'+calculation.Fees+'</td><td>'+calculation.MonthlyRepayment+'</td></tr>';
    //}
    //result += '<tr><td>'+calculation.RepaymentSchedule["1"]+'</td><td>'+calculation.InterestRate+'</td><td>'+calculation.LoanToValue+'</td><td>'+calculation.Fees+'</td><td>'+calculation.MonthlyRepayment+'</td></tr>';
    //result += '</table>';
    //return result;
}

function validate_textbox(text_box,message,span) {
    if(isEmptyTextBox(text_box,message,span)) {
        return false
    }
    return true
}
function isEmptyTextBox(text_box, message, span) {
    var lbl = document.getElementById(span);
    if(text_box.value.replace(/\s+$/, "") == "") {
        lbl.innerHTML = message;
        return true;
    } else {
        lbl.innerHTML = "";
        return false;
    }
}

function isEmptyNumberBox(text_box, span) {
    var lbl = document.getElementById(span);
    lbl.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;";
    if(text_box.value.replace(/\s+$/, "") == "") {
        lbl.className = "cross";
        return true;
    } else if(isNaN(text_box.value)) {
        lbl.className = "cross";
        return true;
    } else {
        lbl.className = "tick";
        return false;
    }
}

function preLoadCalculation(id) {
	$("#calculationTable").html("<p>We're just <span class=\"bold\">retreiving</span> your calculation.</p><p><img src=\"img/loader.gif\"></p>");
	loadCalculation(id);
}

function loadCalculation(id) {
	$.ajax({ url: 'Load_Calculation_Function.php',
		data: { calculationId: id },
		type: 'post',
		success: function(output) {
			$("#calculationTable").html(output);
		}
	});
}

function loadCalculationHistory(userId) {
	$.ajax({ url: 'Load_Calculation_History_Function.php',
		data: { userId: userId },
		type: 'post',
		success: function(output) {
			$("#calculationHistoryResults").html(output);
		}
	});
}

function loadFavourites(userId) {
	$.ajax({ url: 'Load_Calculation_Favourites_Function.php',
		data: { userId: userId },
		type: 'post',
		success: function(output) {
			$("#favouritesTable").html(output);
		}
	});
}

function highlight(tableRow, calculationId) {
	
	if($currentSelected == tableRow) {
		if(tableRow.style.backgroundColor == "rgb(230, 233, 234)") {
			tableRow.style.backgroundColor = '#33b5e5';
		} else {
			tableRow.style.backgroundColor = '#e6e9ea';
			$currentSelected = null;	
			$currentCalculationId = null;
		}
	} else {
		//deselect old table row
		if($currentSelected != null) {
			$currentSelected.style.backgroundColor = '#e6e9ea'
		}
		$currentSelected = tableRow;
		$currentCalculationId = calculationId;
		tableRow.style.backgroundColor = '#33b5e5';
		// highlight new
	}
}