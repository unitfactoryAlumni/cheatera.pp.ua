
$('button[name=toInputButton]').click(function(event) {
    event.preventDefault();

    $('#calculator-lvlstart').val( $('#fm').text() );
    $('#fm').text('');
    $('#calculator-finalmark').val( 125 );
});
