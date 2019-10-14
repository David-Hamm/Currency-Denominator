

$('#denomSubmit').click(function(event) {
    event.preventDefault();
    $.post('processes/denominate.php', $('#denomForm').serialize(), function(data) {
        clearTableValues();
        // Clear out existing warnings
        $('#warnings').html('');
        if (data.status != null) {
            $('#warnings').append("<div class='alert alert-danger'>" + data.status + "</div>")
        }

        $('#silverDollar').html(data.ones);
        $('#halfDollar').html(data.halfDollars);
        $('#quarter').html(data.quarters);
        $('#dime').html(data.dimes);
        $('#nickel').html(data.nickels);
        $('#penny').html(data.pennies);
    });
});

function clearTableValues() {
    $('#silverDollar').html(0);
    $('#halfDollar').html(0);
    $('#quarter').html(0);
    $('#dime').html(0);
    $('#nickel').html(0);
    $('#penny').html(0);
}
