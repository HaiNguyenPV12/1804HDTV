var app = angular.module("1804HDTVShop", ["ngRoute"]);

app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'home.php',
            controller: 'homecontroller'
        })
        .when('/browse.php/:bid', {
            templateUrl: function (params) {
                return "browse.php?cate=" + params.bid;
            },
            // templateUrl: 'browse.php'
            controller: 'browsecontroller'
        })
        .otherwise({ redirectTo: '/' });
}]);