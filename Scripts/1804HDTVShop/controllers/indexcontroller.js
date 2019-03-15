var app = angular.module("1804HDTVShop", ["ngRoute"]);

// SPA routings
app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'home.php',
            controller: 'homecontroller'
        })
        //browse
        .when('/browse.php', {
            templateUrl: function (params) {
                return "browse.php";
            },
            controller: 'browsecontroller'
        })
        //flower category
        .when('/browse.php/cate/:bid', {
            templateUrl: function (params) {
                return "browse.php?cate=" + params.bid;
            },
            controller: 'browsecontroller'
        })
        //flower color
        .when('/browse.php/col/:bid', {
            templateUrl: function (params) {
                return "browse.php?col=" + params.bid;
            },
            controller: 'browsecontroller'
        })
        //Occasions
        .when('/browse.php/occa/:bid', {
            templateUrl: function (params) {
                return "browse.php?occa=" + params.bid;
            },
            controller: 'browsecontroller'
        })
        //FilterGen
        .when('/browse.php/filter/:cate/:col/:occa', {
            templateUrl: function (params) {
                return "browse.php?cate=" + params.cate + "&col=" + params.col + "&occa=" + params.occa;
            },
            controller: 'browsecontroller'
        })
        .otherwise({ redirectTo: '/' });
}]);