<?php
/*
Plugin Name: Checkout Customization
Plugin URI: https://lucarulvoni.it/plugins
Description: Personalizza la pagina di checkout di WooCommerce.
Version: 1.0
Author: Luca Rulvoni
Author URI: https://www.lucarulvoni.it/
*/

// Aggiungi qui il codice per personalizzare la pagina di checkout


// Aggiungi campi personalizzati alla pagina di checkout
function custom_checkout_fields() {
    echo '<div id="custom_checkout_fields">';
    
    // Mostra i campi solo se la casella "Vuoi una fattura?" è spuntata
    woocommerce_form_field('want_invoice', array(
        'type'      => 'checkbox',
        'class'     => array('form-row-wide'),
        'label'     => __('Vuoi una fattura?'),
    ), WC()->checkout->get_value('want_invoice'));
    
    // Partita IVA
    woocommerce_form_field('partita_iva', array(
        'type'      => 'text',
        'class'     => array('form-row-wide'),
        'label'     => __('Partita IVA'),
        'required'  => false,
    ), WC()->checkout->get_value('partita_iva'));
    
    // Codice Fiscale
    woocommerce_form_field('codice_fiscale', array(
        'type'      => 'text',
        'class'     => array('form-row-wide'),
        'label'     => __('Codice Fiscale'),
        'required'  => false,
    ), WC()->checkout->get_value('codice_fiscale'));
    
    // Codice SDI
    woocommerce_form_field('codice_sdi', array(
        'type'      => 'text',
        'class'     => array('form-row-wide'),
        'label'     => __('Codice SDI'),
        'required'  => false,
    ), WC()->checkout->get_value('codice_sdi'));
    
    // Rappresentante legale
    woocommerce_form_field('rappresentante_legale', array(
        'type'      => 'text',
        'class'     => array('form-row-wide'),
        'label'     => __('Rappresentante legale'),
        'required'  => false,
    ), WC()->checkout->get_value('rappresentante_legale'));
    
    // Email PEC
    woocommerce_form_field('email_pec', array(
        'type'      => 'text',
        'class'     => array('form-row-wide'),
        'label'     => __('Email PEC'),
        'required'  => false,
    ), WC()->checkout->get_value('email_pec'));
    
    echo '</div>';
}
add_action('woocommerce_checkout_before_terms_and_conditions', 'custom_checkout_fields');


// Salvataggio dei dati personalizzati nel database
function save_custom_checkout_fields($order_id) {
    if ($_POST['want_invoice']) {
        // Partita IVA
        if (!empty($_POST['partita_iva'])) {
            update_post_meta($order_id, 'Partita IVA', sanitize_text_field($_POST['partita_iva']));
        }
        
        // Codice Fiscale
        if (!empty($_POST['codice_fiscale'])) {
            update_post_meta($order_id, 'Codice Fiscale', sanitize_text_field($_POST['codice_fiscale']));
        }
        
        // Codice SDI
        if (!empty($_POST['codice_sdi'])) {
            update_post_meta($order_id, 'Codice SDI', sanitize_text_field($_POST['codice_sdi']));
        }
        
        // Rappresentante legale
        if (!empty($_POST['rappresentante_legale'])) {
            update_post_meta($order_id, 'Rappresentante legale', sanitize_text_field($_POST['rappresentante_legale']));
        }
        
        // Email PEC
        if (!empty($_POST['email_pec'])) {
            update_post_meta($order_id, 'Email PEC', sanitize_email($_POST['email_pec']));
        }
    }
}
add_action('woocommerce_checkout_update_order_meta', 'save_custom_checkout_fields');


// Collega il file JavaScript
function custom_checkout_scripts() {
    wp_enqueue_script('checkout-customization', plugin_dir_url(__FILE__) . 'js/checkout-customization.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'custom_checkout_scripts');