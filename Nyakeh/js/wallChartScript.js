$('#wallChartCheckin').submit(function () {
    var made = $('#madeInput').val();
    var spent = $('#spentInput').val();
    var invested = $('#investedInput').val();
    var date = $('#dateInput').val();
    
    console.log('made: ' + made + 'spent: ' + spent + 'invested: ' + invested + 'date: ' + date);
});