$(document).ready(function () {
    $.ajax({
        url: "/welcome",
        type: 'POST',
        showLoader: true
    });
});