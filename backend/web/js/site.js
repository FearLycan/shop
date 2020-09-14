$(document).ready(function () {
    $(document).ajaxStart(function () {
        $("#overlay").fadeIn();
    }).ajaxStop(function () {
        $("#overlay").fadeOut();
    });
});
