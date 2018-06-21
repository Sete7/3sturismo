//---------------------------------------SCRIPT MOBILE------------------------------------------------------
$(document).ready(function () {
    $(".sidebarBtn").click(function () {
        $(".sidebar").toggleClass('active');
        $(".sidebarBtn").toggleClass('toggle');
    });
});


//----------------------------------------SCRIPT SCROOL ---------------------------------------------------
$(window).scroll(function () {
    var windowTop = $(this).scrollTop();
    $('.anime').each(function () {
        if (windowTop > $(this).offset().top - 500) {
            $(this).addClass('anime-init');
        } else {
            $(this).removeClass('anime-init');
        }
    });
});
