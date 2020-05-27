$(document).on('click', '.deposit', function () {
    $.ajax({
        url: "/deposit",
        type: 'POST',
        showLoader: true,
        data: {
           'amount': $('input[name="amount"]')[0].value
        }
    });
});