app.controller('browsecontroller', function ($scope, $location, $anchorScroll, $timeout) {
    document.title = '1804HDTV Tìm Hoa';
    //scroll to top on load
    $('html,body').animate({ scrollTop: 0 }, 100); //miliseconds

    //form toggling
    //basic form
    $('#btnSwtich').click(function (e) {
        e.preventDefault();
        $('#filterAdv').toggle(250);
        $('#filterGen').toggle(250);
    });
    //advanced form
    $('#btnSwtich2').click(function (e) {
        e.preventDefault();
        $('#filterAdv').toggle(250);
        $('#filterGen').toggle(250);
    });

});