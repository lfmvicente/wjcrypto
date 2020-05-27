$(document).ready(function () {
    $.ajax({
        url: "/welcome",
        type: 'GET',
        showLoader: true
    }).done(function(xhr) {
        $('.welcome')[0].innerText = xhr.msg
    });
});