
$.each($(".dropdown"), function(k, v) {
    $(v).mouseenter(function() {
        $(this).addClass("open");
    });
    $(v).mouseleave(function() {
        $(this).removeClass("open");
    });
});
