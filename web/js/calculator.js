
$("document").ready(function () {

    $("#new_note").on("pjax:end", function() {
        $.pjax.reload({container:"#calculator"});  // Reload ActiveForm
    });

});
