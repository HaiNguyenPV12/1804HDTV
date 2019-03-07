var app = angular.module("1804HDTVShop", ["ngRoute"]);

app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'home.php',
            controller: 'homecontroller'
        })
        .when('/browse.php', {
            templateUrl: 'browse.php',
            controller: 'browsecontroller'
        })
        .otherwise({ redirectTo: '/' });
}]);