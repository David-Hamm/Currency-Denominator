$('#denomSubmit').click(function(event) {
    event.preventDefault();
    $.post('processes/denominate.php', $('#denomForm').serialize(), function(data) {
        $('#silverDollar').html(data.ones);
        $('#halfDollar').html(data.halfDollars);
        $('#quarter').html(data.quarters);
        $('#dime').html(data.dimes);
        $('#nickel').html(data.nickels);
        $('#penny').html(data.pennies);
    });
})
