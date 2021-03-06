// Phát hiện và đặt active cho link khi # đổi
$(window).on('hashchange', function () {
    var adressBarHash = window.location.hash.replace("#!/", "");

    if (adressBarHash.indexOf("/") != -1) {
        adressBarHash = adressBarHash.split("/", 1)[0];
    }
    //console.log(adressBarHash);
    $('.list-group-item').removeClass('active');
    if (adressBarHash != "") {
        if ($('.list-group-item[href="#!' + adressBarHash + '"]').length) {
            $('.list-group-item[href="#!' + adressBarHash + '"]').addClass('active');
        }
    }

});

// Phát hiện và đặt active cho link khi page đã load (và sau khi reload)
$(document).ready(function () {
    var adressBarHash = window.location.hash.replace("#!/", "");

    if (adressBarHash.indexOf("/") != -1) {
        adressBarHash = adressBarHash.split("/", 1)[0];
    }
    //console.log(adressBarHash);
    $('.list-group-item').removeClass('active');
    if (adressBarHash != "") {
        if ($('.list-group-item[href="#!' + adressBarHash + '"]').length) {
            $('.list-group-item[href="#!' + adressBarHash + '"]').addClass('active');
        }
    }
});

//angular: SPA
var app = angular.module("myApp", ["ngRoute"]);

app.config(function ($routeProvider) {
    $routeProvider
        .when("/", {
            templateUrl: "home.php",
            //template: "<h2>Xin chào</h2>"
        })
        .when("/bouquet", {
            templateUrl: "bouquet.php"
        })
        .when("/flower", {
            templateUrl: "flower.php",
        })
        .when("/bouquet/img/:bid", {
            templateUrl: function (params) { // <-- 
                return 'bouquetimg.php?bid=' + params.bid;
            }
        })
        .when("/bouquet/notselling/:bid", {
            templateUrl: function (params) { // <-- 
                return 'bouquetselling.php?notselling&&bid=' + params.bid;
            }
        })
        .when("/bouquet/selling/:bid", {
            templateUrl: function (params) { // <-- 
                return 'bouquetselling.php?selling&&bid=' + params.bid;
            }
        })
        .when("/flower/category", {
            templateUrl: "flowercate.php",
        })
        .when("/color", {
            templateUrl: "color.php",
        })
        .when("/staff", {
            cache: false,
            templateUrl: "staff.php",
        })
        .when("/staff/edit/:id", {
            cache: false,
            templateUrl: function (params) {
                return 'staffedit.php?id=' + params.id;
            },
        })
        .when("/staff/edit/update/:id/:name/:role/:email/:uname/:pass/:phone/:add/:employed/:sadd", {
            cache: false,
            templateUrl: function (params) {
                return 'staffeditres.php?id=' + params.id + '&name=' + params.name + '&role=' +
                    params.role + '&email=' + params.email + '&uname=' + params.uname + '&pass=' +
                    params.pass + '&phone=' + params.phone + '&add=' + params.add + '&employed=' +
                    params.employed + '&sadd=' + params.sadd;
            }
        })
        .when("/staffadd", {
            templateUrl: "staffadd.php",
        })
        .when("/staffright", {
            templateUrl: "staffright.php",
        })
        .when("/order", {
            templateUrl: "order.php",
        })
        .when("/order/delivered/:oid", {
            cache: false,
            templateUrl: function (params) {
                return 'order_process.php?delivered&oid=' + params.oid;
            },
        })
        .when("/order/aborted/:oid", {
            cache: false,
            templateUrl: function (params) {
                return 'order_process.php?aborted&oid=' + params.oid;
            },
        })
        .when("/member", {
            templateUrl: "member.php"
        })
        .when("/customer", {
            templateUrl: "customer.php",
        })
        .when("/role", {
            templateUrl: "role.php"
        })
        .when("/statistic", {
            templateUrl: "statistic.php"
        })
        .when("/statistic/:year", {
            templateUrl: function (params) {
                return 'statistic.php?year=' + params.year;
            },
        })
        .when("/comment", {
            templateUrl: "comment.php"
        })
        .when("/feedback", {
            templateUrl: "feedback.php"
        })
        .when("/occasion", {
            templateUrl: "occasion.php"
        })
        .when("/occasion/edit/:id", {
            cache: false,
            templateUrl: function (params) {
                return 'occasionedit.php?id=' + params.id;
            },
        })
        .when("/occasion/edit/update/:id/:idnew/:name/:detail/:fp/:oadd", {
            templateUrl: function (params) {
                return 'occasioneditres.php?id=' + params.id + '&idnew=' + params.idnew + '&name='
                    + params.name + '&detail=' + params.detail + '&fp=' + params.fp + '&oadd=' + params.oadd;
            },
        })
        .when("/occasion/img/:bid", {
            templateUrl: function (params) {
                return 'occasionimg.php?bid=' + params.bid;
            },
        })
        .when("/occasion/bouq/:occaID", {
            templateUrl: function (params) {
                return 'occasionbouq.php?occaID=' + params.occaID;
            },
        })
        .when("/occasion/bouq/del/:bid/:occaID", {
            templateUrl: function (params) {
                return 'occasionbouqdel.php?bid=' + params.bid + '&occaID=' + params.occaID;
            },
        })
        .when("/occasion/bouq/add/:bid/:occaID", {
            templateUrl: function (params) {
                return 'occasionbouqadd.php?bid=' + params.bid + '&occaID=' + params.occaID;;
            },
        })
        .when("/occasion/add", {
            templateUrl: function (params) {
                return 'occasionadd.php';
            },
        })
        .when("/occasion/delete/:bid", {
            templateUrl: function (params) {
                return 'occasiondelete.php?bid=' + params.bid;
            },
        })
        .when("/redirect/:page", {
            templateUrl: function (params) { // <-- 
                return 'redirect.php?' + params.page + "=''";
            }
        })
        .otherwise({
            template: "<h2>Không tìm thấy trang!</h2>"
        });
});
app.controller('myModal', function ($scope) {
    $scope.modalHeader = function (str) {
        modalHText = str;
    }
    //$scope.tpl = {};
});
app.controller('myImgModal', function ($scope) {
    $scope.imgModalHeader = function (str) {
        imgModalHText = str;
    }
    //$scope.tpl = {};
});

app.controller('myMain', ['$scope', '$route', function ($scope, $route) {
    $scope.reloadData = function () {
        $route.reload();
    }
}]);

// stops pages from caching
app.run(function ($rootScope, $templateCache) {
    $rootScope.$on('$viewContentLoaded', function () {
        $templateCache.removeAll();
    });
});

/*
$(window).on('hashchange',function() {
    $('div a[href*="' + location.pathname.split("#!/")[1] + '"]').addClass('active');
});

/*
$(document).ready(function() {
    $('.list-group-item').click(function() {
        $('.list-group-item').removeClass('active');
        $(this).closest('.list-group-item').addClass('active')
    });
});
*/