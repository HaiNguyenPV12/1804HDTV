app.controller('smcontroller', function ($scope, $location, $anchorScroll, $timeout) {
    document.title = 'Sitemap';
    //scroll to top on load
    $('html,body').animate({ scrollTop: 0 }, 100); //miliseconds
});