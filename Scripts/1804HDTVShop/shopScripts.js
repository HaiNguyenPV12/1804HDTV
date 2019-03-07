$(document).ready(function () {
    //scroll to top button
    if ($('.ScrollToTop').length) {
        var scrollTrigger = 100, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $('.ScrollToTop').addClass('show');
                } else {
                    $('.ScrollToTop').removeClass('show');
                }
            };
        backToTop();
        $(window).on('scroll', function () {
            backToTop();
        });
        $('.ScrollToTop').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({ scrollTop: 0 }, 100); //miliseconds
        });
    }
});