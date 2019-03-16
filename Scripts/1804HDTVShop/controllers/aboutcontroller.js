app.controller('aboutcontroller', function ($scope, $location, $anchorScroll, $timeout) {
    document.title = 'Về Chúng Tôi';
    //scroll to top on load
    $('html,body').animate({ scrollTop: 0 }, 100); //miliseconds

});