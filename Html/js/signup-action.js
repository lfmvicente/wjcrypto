$(document).on('click', '.signup', function () {
    $.ajax({
        url: "/signup",
        type: 'POST',
        showLoader: true,
        data: {
            'name': $('input[name="name"]')[0].value,
            'document': $('input[name="document"]')[0].value,
            'additional_document': $('input[name="additional_document"]')[0].value,
            'dt_origin': $('input[name="dt_origin"]')[0].value,
            'phone': $('input[name="phone"]')[0].value,
            'address': $('input[name="address"]')[0].value,
            'username': $('input[name="username"]')[0].value,
            'password': $('input[name="password"]')[0].value
        }
    });
});