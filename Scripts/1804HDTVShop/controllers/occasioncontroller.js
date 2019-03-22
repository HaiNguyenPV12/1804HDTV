app.controller('occasioncontroller', function ($scope, $location, $anchorScroll, $timeout) {
    document.title = 'Dịp';
    //scroll to top on load
    $('html,body').animate({ scrollTop: 0 }, 100); //miliseconds
});