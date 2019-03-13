
void function menuOpenOnHover()
{
    $.each($('.dropdown'), function(k, v) {
        $(v).mouseenter(function() {
            $(this).addClass('open');
        });
        $(v).mouseleave(function() {
            $(this).removeClass('open');
        });
    });
}();

$(document).on({
    mouseenter: function (e) {
        //stuff to do on mouse enter
        var test = e.target.getAttribute("name");
        $("#ah-"+test).css("display", "block");
    },
    mouseleave: function (e) {
        //stuff to do on mouse leave
        var test = e.target.getAttribute("name");
        $("#ah-"+test).css("display", "none");
    }
}, "#ah");

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

// void function changeTheme()
// {
//     themes = $( '#w' + ($('#w0-collapse ul').length - 1) ); // second node from the end is Themes <ul>
//     console.log( themes );
// }();
