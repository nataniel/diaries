$(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('body > .container').toggleClass('active');
        $('#sidebarCollapse').toggleClass('flaticon-delete-cross').toggleClass('flaticon-view-details');
    });

});