$(document).ready(function() {
    $('.post-info').click(function() {
        $('.green, .blue, .red, .orange').remove();
        $.ajax({
            method: 'POST',
            url: 'afvalkalender-js.php',
            data: {
                zipcode: $('#zipcode').val(),
                number: $('#number').val(),
                suffix: $('#suffix').val(),
                maxDays: $('#maxdays').val()
            }
        })
        .done(function(res) {
            $('.result').append(res).show();
        });
    });
});