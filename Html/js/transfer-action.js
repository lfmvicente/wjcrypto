$(document).on('click', '.transfer', function () {
    $.ajax({
        url: "/transfer",
        type: 'POST',
        showLoader: true,
        data: {
            'amount': $('input[name="amount"]')[0].value,
            'account': $('input[name="account"]')[0].value
        }
    });
});