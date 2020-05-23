$(document).on('click', '.withdraw', function () {
    $.ajax({
        url: "/withdraw",
        type: 'POST',
        showLoader: true,
        data: {
            'amount': $('input[name="amount"]')[0].value
        }
    });
});