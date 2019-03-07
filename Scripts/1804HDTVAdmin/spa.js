// Phát hiện và đặt active cho link khi # đổi
$(window).on('hashchange',function() {
    var adressBarHash = window.location.hash.replace("#!/","");
    
    if (adressBarHash.indexOf("/")!=-1) {
        adressBarHash= adressBarHash.split("/",1)[0];
    }
    //console.log(adressBarHash);
    $('.list-group-item').removeClass('active');
    if (adressBarHash!="") {
        if ($('.list-group-item[href="#!' + adressBarHash + '"]').length) {
            $('.list-group-item[href="#!' + adressBarHash + '"]').addClass('active');
        }
    }
    
});

// Phát hiện và đặt active cho link khi page đã load (và sau khi reload)
$(document).ready(function() {
    var adressBarHash = window.location.hash.replace("#!/","");
    
    if (adressBarHash.indexOf("/")!=-1) {
        adressBarHash= adressBarHash.split("/",1)[0];
    }
    //console.log(adressBarHash);
    $('.list-group-item').removeClass('active');
    if (adressBarHash!="") {
        if ($('.list-group-item[href="#!' + adressBarHash + '"]').length) {
            $('.list-group-item[href="#!' + adressBarHash + '"]').addClass('active');
        }
    }
});

//angular: SPA
var app = angular.module("myApp", ["ngRoute"]);

app.config(function($routeProvider) {
    $routeProvider
    .when("/", {
        templateUrl : "main.htm",
        template : "<h2>Xin chào</h2>"
    })
    .when("/bouquet", {
        templateUrl : "Pages/bouquet.php"
    })
    .when("/flower", {
        templateUrl : "Pages/flower.php",
    })
    .when("/bouquet/img/:bid", {
        templateUrl : function(params) { // <-- 
            return 'Pages/bouquetimg.php?bid=' + params.bid;    
        }
    })
    .when("/bouquet/notselling/:bid", {
        templateUrl : function(params) { // <-- 
            return 'Pages/bouquetselling.php?notselling&&bid=' + params.bid;    
        }
    })
    .when("/bouquet/selling/:bid", {
        templateUrl : function(params) { // <-- 
            return 'Pages/bouquetselling.php?selling&&bid=' + params.bid;    
        }
    })
    .when("/flower/category", {
        templateUrl : "Pages/flowercate.php",
    })
    .when("/color", {
        templateUrl : "Pages/color.php",
    })
    .when("/staff", {
        templateUrl : "Pages/staff.php",
    })
    .when("/staffright", {
        templateUrl : "Pages/staffright.php",
    })
    .when("/role", {
        templateUrl : "Pages/role.php"
    })
    .otherwise({
        template : "<h2>Không tìm thấy trang!</h2>"
    });
});
app.controller('myModal', function ($scope) {
    $scope.modalHeader = function(str){
        modalHText = str;
    }
    //$scope.tpl = {};
});
app.controller('myImgModal', function ($scope) {
    $scope.imgModalHeader = function(str){
        imgModalHText = str;
    }
    //$scope.tpl = {};
});

app.controller('myMain', ['$scope', '$route', function($scope, $route) {
    $scope.reloadData = function(){
        $route.reload();
    }
}]);


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