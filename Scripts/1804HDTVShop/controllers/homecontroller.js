app.controller('homecontroller', function ($scope, $location, $anchorScroll, $timeout) {
    document.title = '1804HDTV Shop';
    //scroll to top on load
    $('html,body').animate({ scrollTop: 0 }, 100); //miliseconds
});