$(document).ready(function () {
	$currentSelected = null;
	$currentCalculationId = null;	
	$compareCurrentSelected = null;
	$compareCurrentCalculationId = null;
    $('#account_submit_Button').click(function () {
		$("#account_message").html("<img src=\"img/loader.gif\">");
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
		$("#mortgage_results").html("<p class=\"center_message\">We're just <span class=\"bold\">calculating</span> your mortgage.</p><p class=\"center_message\"><img src=\"img/loader.gif\"></p>");
        $("#mortgage_message").text('');
		$houseValue = $('#input_property').val();
        $deposit = $('#input_deposit').val();
        $term = $('#input_term').val();
        $interest = $('#input_interest').val();
        $fees = $('#input_fees').val();
		$errorMessage = calculateInputValidation($houseValue,$deposit,$term, $interest, $fees);
		if($errorMessage != '') {
			$("#mortgage_message").text($errorMessage);
			$("#mortgage_results").html('');
		} else {
			$.ajax({ url: 'Mortgage_Calculate_Function.php',
            data: { houseValue: $houseValue, deposit: $deposit, term: $term, interest: $interest, fees: $fees },
            type: 'post',
            success: function (output) {
                try {
                    sessionStorage.setItem('calculation', output);
                    var calculation = JSON.parse(output);
                    var resultsTable = buildMortgageResultsTable(calculation);
                    $("#mortgage_message").text('');
                    $("#mortgage_results").html(resultsTable);
                } catch (exception) {
                    $("#mortgage_message").text(output);
                    $("#mortgage_results").html('');
                }
			}});
		}
    });

    $('#borrow_submit_button').click(function () {
		$("#borrow_results").html("<p class=\"center_message\">We're just <span class=\"bold\">working out</span> how much a mortgae provider might offer you.</p><p class=\"center_message\"><img src=\"img/loader.gif\"></p>");
		$("#borrow_message").text('');
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
		$("#compare_results").html("<p class=\"center_message\">We're just <span class=\"bold\">comparing</span> multiple mortgage providers.</p><p class=\"center_message\"><img src=\"img/loader.gif\"></p>");
        $("#compare_message").text('');
		$houseValue = $('#input_property').val();
        $deposit = $('#input_deposit').val();
        $term = $('#input_term').val();
		
		$errorMessage = compareInputValidation($houseValue,$deposit,$term);
		if($errorMessage != '') {
			$("#compare_message").text($errorMessage);
			$("#compare_results").html('');
		} else {
			$.ajax({ url: 'Mortgage_Compare_Function.php',
            data: { houseValue: $houseValue, deposit: $deposit, term: $term },
            type: 'post',
            success: function (output) {
				var prefix = output.substring(0, 1);
				if(prefix == 'P') {
					$("#compare_message").text(output);
					$("#compare_results").html("");
				} else {
					$("#compare_results").html(output);
				}				
			}}
			);
		}
        
    });
	
	$('#calculation_lookup_submit_Button').click(function () {
        $calcId = $('#input_calcId').val();
		preLoadCalculation($calcId);
    });
	
	$('#email_favourite').click(function () {
		if($currentCalculationId) {
			emailCalculation($currentCalculationId)
		} else {
        	$(".detailed_error").text("Please select a calculation to email");
		}
    });
});

function buildMortgageResultsTable(calculation) {
    var result = '<table><tr><th>Interest Rate</th><th>Loan-To-Value</th><th>Product Fees</th><th>Monthly Payment</th><th>Total Interest</th><th>Total Owed</th>';
    var result1 = '<tr><td>' + calculation.InterestRate + '%</td><td>' + calculation.LoanToValue + '</td><td>' + calculation.Fees + '</td><td>' + calculation.MonthlyRepayment + '</td><td>' + calculation.TotalInterest + '</td><td>' + calculation.TotalPaid + '</td>';
	
	if(calculation.AccountId > 0) {
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
	emailCalculation($calculationId)
	
});

function emailCalculation(calculationId) {
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

$("#favourite_compare").live("click", function() {
	$calculationId = $compareCurrentCalculationId;	
	$(".detailed_error").html('<img src=\"img/loader.gif\">');
	$.ajax({ url: 'Favourite_Calculation_Function.php',
		data: { calculationId: $calculationId },
		type: 'post',
		success: function(output) {
			$(".detailed_error").html('Calculation added to favourites');
		}
	});
});
$("#email_compare").live("click", function() {
	$calculationId = $compareCurrentCalculationId;
	emailCalculation($calculationId);	
});
function buildBorrowResultsTable(calculation) {
    var result = '<table><tr><th>Loan-To-Value</th><th>Max Loan</th></tr>';
    for (var i in calculation) {
        result += '<tr><td>'+calculation[i].LoanToValue+'%</td><td>'+calculation[i].Amount+'</td></tr>';
    }
    result += '</table>';
    return result;
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
	$("#calculationTable").html("<p class=\"center_message\">We're just <span class=\"bold\">retreiving</span> your calculation.</p><p class=\"center_message\"><img src=\"img/loader.gif\"></p>");
	loadCalculation(id);
}

function loadCalculation(id) {
	if(id) {
		$.ajax({ url: 'Load_Calculation_Function.php',
			data: { calculationId: id },
			type: 'post',
			success: function(output) {
				$("#calculationTable").html(output);
			}
		});		
	}
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
			tableRow.style.backgroundColor = '#ffffff';
			$currentSelected = null;	
			$currentCalculationId = null;
		}
	} else {
		//deselect old table row
		if($currentSelected != null) {
			$currentSelected.style.backgroundColor = '#ffffff'
		}
		$currentSelected = tableRow;
		$currentCalculationId = calculationId;
		tableRow.style.backgroundColor = '#33b5e5';
	}
}

function highlightCompare(tableRow, calculationId) {
	if($compareCurrentSelected == tableRow) {
		if(tableRow.style.backgroundColor == "rgb(230, 233, 234)") {
			tableRow.style.backgroundColor = '#33b5e5';
		} else {
			tableRow.style.backgroundColor = '#ffffff';
			$compareCurrentSelected = null;	
			$compareCurrentCalculationId = null;
		}
	} else {
		if($compareCurrentSelected != null) {
			$compareCurrentSelected.style.backgroundColor = '#ffffff'
		}
		$compareCurrentSelected = tableRow;
		$compareCurrentCalculationId = calculationId;
		tableRow.style.backgroundColor = '#33b5e5';
	}
}

function calculateInputValidation(houseValue, deposit, term, interestRate, fees) {
	var errorMessage = compareInputValidation(houseValue, deposit, term);
	if(errorMessage == ""){
		interestRate = parseFloat(interestRate);
		fees = parseInt(fees);
		if(interestRate < 0.01){
			errorMessage = 'Interest Rate entered too low.';
		} else if(fees < 0){
			errorMessage = 'Fees entered too low.';
		}
	}
	return errorMessage;
}

function compareInputValidation(houseValue, deposit, term) {
	var errorMessage = '';
	houseValue = parseInt(houseValue);
	deposit = parseInt(deposit);
	term = parseInt(term);
	if(houseValue < 10000) {
		errorMessage = 'Property Value entered too low. Must be over £10000';
	} else if(deposit < 1000) {
		errorMessage = 'Deposit entered too low. Must be over £1000';
	} else if(term < 1) {
		errorMessage = 'Term entered too low. Must be over 1';
	} else if(term > 100) {
		errorMessage = 'Term entered too high. Must be under 100';
	} else if(deposit > houseValue) {
		errorMessage = 'Deposit can\'t be greater then the property value.';
	}
	return errorMessage;
}
