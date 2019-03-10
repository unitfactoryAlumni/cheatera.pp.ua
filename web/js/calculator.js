
void function () {
    if ( $('#fm').text() ) {
        $('#calculator-lvlstart').val( $('#fm').text() );
    }
}();

$('button[name=toInputButton]').click(function(event) {
    event.preventDefault();

    $('#calculator-lvlstart').val( $('#fm').text() );
    $('#fm').text('');
});
