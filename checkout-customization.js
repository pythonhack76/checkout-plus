jQuery(document).ready(function($) {
    // Nascondi i campi al caricamento della pagina
    $('#custom_checkout_fields').hide();
    
    // Mostra/nascondi i campi quando la casella "Vuoi una fattura?" viene spuntata/deselzionata
    $('body').on('change', 'input[name="want_invoice"]', function() {
        if ($(this).is(':checked')) {
            $('#custom_checkout_fields').slideDown();
        } else {
            $('#custom_checkout_fields').slideUp();
        }
    });
});