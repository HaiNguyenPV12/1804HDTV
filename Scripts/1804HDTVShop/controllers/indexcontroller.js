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
            templateUrl: "browse.php",
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
        .when('/browse.php/filter/:cate/:col/:occa/:fname/:price', {
            templateUrl: function (params) {
                return "browse.php?cate=" + params.cate + "&col=" + params.col + "&occa=" + params.occa + "&fname=" + params.fname +"&price=" + params.price;
            },
            controller: 'browsecontroller'
        })
        //about us
        .when('/about.php', {
            templateUrl: "about.php",
            controller: 'aboutcontroller'
        })
        .when('/flowercate', {
            templateUrl: "flowercate.php"
        })
        .when('/flowercate/:fcate', {
            templateUrl: function (params) {
                return "flowercate.php?fcate=" + params.fcate;
            },
            controller: 'flowercatecontroller'
        })
        .when('/flower/:fid', {
            templateUrl: function (params) {
                return "flower.php?fid=" + params.fid;
            },
            controller: 'flowercontroller'
        })
        .when('/product/:bid', {
            templateUrl: function (params) {
                return "product.php?bid=" + params.bid;
            },
            controller: 'productcontroller'
        })
        .when('/login', {
            templateUrl: 'member_login.php',
            controller: 'logincontroller'
        })
        .when('/feedback', {
            templateUrl: 'feedback.php',
            // controller: 'logincontroller'
        })
        .otherwise({ redirectTo: '/' });
}]);