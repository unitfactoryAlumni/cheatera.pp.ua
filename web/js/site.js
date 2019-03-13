
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

void function mainPhpBottomCode()
{
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).on({
        mouseenter: function (e) {
            var test = e.target.getAttribute("name");
            $("#ah-"+test).css("display", "block");
        },
        mouseleave: function (e) {
            var test = e.target.getAttribute("name");
            $("#ah-"+test).css("display", "none");
        }
    }, "#ah");
}();

// void function changeTheme()
// {
//     themes = $( '#w' + ($('#w0-collapse ul').length - 1) ); // second node from the end is Themes <ul>
//     console.log( themes );
// }();
