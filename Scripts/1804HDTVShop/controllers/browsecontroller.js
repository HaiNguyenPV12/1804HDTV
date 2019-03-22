app.controller('browsecontroller', function ($scope, $location, $anchorScroll, $timeout) {
    document.title = 'Tìm Hoa';
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

    //basic form values
    var cateFilter = document.getElementById("cateFilter");
    var colFilter = document.getElementById("colFilter");
    var occaFilter = document.getElementById("occaFilter");
    var fnameFilter = document.getElementById("fnameFilter");
    var priceFilter = document.getElementById("priceFilter");
    // console.log(occaFilter.value);
    //change link on form change
    $('#filterGen').change(function (e) {
        e.preventDefault();
        $('#filterGenLink').attr('href', '#!browse.php/filter/' + cateFilter.value + '/' + colFilter.value + '/' + occaFilter.value + '/'  + fnameFilter.value + '/'  + priceFilter.value);
    });

});