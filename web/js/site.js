
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
