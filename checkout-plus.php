<?php
/*
Plugin Name: Checkout Personalizzato
Description: Aggiunge campi personalizzati alla pagina di checkout di WooCommerce.
Version: 1.0
Author: Luca Rulvoni
*/



// Aggiungi campi personalizzati al checkout
function aggiungi_campi_checkout_personalizzati($checkout_fields) {
    $checkout_fields['billing']['partita_iva'] = array(
        'type'        => 'text',
        'label'       => 'Partita IVA',
        'placeholder' => 'Inserisci la Partita IVA',
        'required'    => false,
        'class'       => array('form-row-wide'),
        'clear'       => true,
    );

    $checkout_fields['billing']['codice_fiscale'] = array(
        'type'        => 'text',
        'label'       => 'Codice Fiscale',
        'placeholder' => 'Inserisci il Codice Fiscale',
        'required'    => false,
        'class'       => array('form-row-wide'),
        'clear'       => true,
    );

    $checkout_fields['billing']['codice_sdi'] = array(
        'type'        => 'text',
        'label'       => 'Codice SDI',
        'placeholder' => 'Inserisci il Codice SDI',
        'required'    => false,
        'class'       => array('form-row-wide'),
        'clear'       => true,
    );

    $checkout_fields['billing']['rappresentante_legale'] = array(
        'type'        => 'text',
        'label'       => 'Rappresentante Legale',
        'placeholder' => 'Inserisci il Rappresentante Legale',
        'required'    => false,
        'class'       => array('form-row-wide'),
        'clear'       => true,
    );

    $checkout_fields['billing']['email_pec'] = array(
        'type'        => 'email',
        'label'       => 'Email PEC',
        'placeholder' => 'Inserisci l\'Email PEC',
        'required'    => false,
        'class'       => array('form-row-wide'),
        'clear'       => true,
    );

    return $checkout_fields;
}
add_filter('woocommerce_checkout_fields', 'aggiungi_campi_checkout_personalizzati');


// Mostra o nascondi i campi in base al checkbox "vuoi una fattura?"
function mostra_nascondi_campi_checkout_personalizzati() {
    echo '<script>
        jQuery(document).ready(function($){
            var $fatturaCheckbox = $("input#fattura_checkbox");

            if (!$fatturaCheckbox.is(":checked")) {
                $(".woocommerce-billing-fields__field-wrapper").hide();
            }

            $fatturaCheckbox.on("change", function() {
                if ($(this).is(":checked")) {
                    $(".woocommerce-billing-fields__field-wrapper").show();
                } else {
                    $(".woocommerce-billing-fields__field-wrapper").hide();
                }
            });
        });
    </script>';
}
add_action('woocommerce_after_checkout_form', 'mostra_nascondi_campi_checkout_personalizzati');