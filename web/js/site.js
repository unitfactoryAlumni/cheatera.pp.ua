
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


void function calculatorJS()
{
    if (window.location.pathname.split('/')[1] === 'calculator') {
        $.each($('.tier-key'), function() {
            $(this).click(function () {
                $.pjax.defaults.timeout = false;
                $.pjax.reload({container:"#calculator"});  // Reload ActiveForm
            })
        });
    }
}();
