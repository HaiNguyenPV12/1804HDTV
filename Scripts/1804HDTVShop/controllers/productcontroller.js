app.controller('productcontroller', function ($scope, $location, $anchorScroll, $timeout) {
    document.title = '1804HDTV Shop';

    $(".thumbnail").on("click", function() {
        if (!$(this).hasClass("selected")) {
            var clicked = $(this);
            var newSelection = clicked.data('big');
            var $img = $('.primary').css("background-image", "url(" + newSelection + ")");
            clicked.parent().find('.thumbnail').removeClass('selected');
            clicked.addClass('selected');
            $('.primary').empty().append($img.hide().fadeIn('fast'));
        }
    });
});