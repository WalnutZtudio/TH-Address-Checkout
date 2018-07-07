<?php

/**
 * Add custom field and Sort field
 *
 * @link       https://walnutztudio.com
 * @since      1.0.0
 *
 * @package    Th_Address_Checkout
 * @subpackage Th_Address_Checkout/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Th_Address_Checkout
 * @subpackage Th_Address_Checkout/includes
 * @author     WalnutZtudio <walnutztudio@gmail.com>
 */
class Th_Address_Checkout_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		

    }

}

// Reference: https://businessbloomer.com/woocommerce-add-house-number-field-checkout/

add_filter( 'woocommerce_checkout_fields' , 'walnut_add_field_and_reorder_fields' );
function walnut_add_field_and_reorder_fields( $fields ) {
 
    // Add New Fields
    $fields['billing']['billing_district'] = array(
        'label'     => __('District', 'woocommerce'),
        'placeholder'   => _x('', 'placeholder', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-wide'),
        'clear'     => true
     );
    $fields['shipping']['shipping_district'] = array(
        'label'     => __('District', 'woocommerce'),
        'placeholder'   => _x('', 'placeholder', 'woocommerce'),
        'required'  => true,
        'class'     => array('form-row-wide'),
        'clear'     => true
    );

    // Remove Fields
    unset($fields['billing']['billing_company']);
    unset($fields['shipping']['shipping_company']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['shipping']['shipping_address_2']);
 
    // Make Fields Half Width 
    //$fields['billing']['billing_city']['class'] = array('form-row-last');
    //$fields['billing']['billing_state']['class'] = array('form-row-first');
	//$fields['billing']['billing_postcode']['class'] = array('form-row-last');

    //$fields['shipping']['shipping_city']['class'] = array('form-row-last');
    //$fields['shipping']['shipping_state']['class'] = array('form-row-first');
    //$fields['shipping']['shipping_postcode']['class'] = array('form-row-last');
    

    // Billing: Sort Fields
    $newfields['billing']['billing_first_name'] = $fields['billing']['billing_first_name'];
    $newfields['billing']['billing_last_name']  = $fields['billing']['billing_last_name'];
    //$newfields['billing']['billing_company']    = $fields['billing']['billing_company'];
    $newfields['billing']['billing_email']      = $fields['billing']['billing_email'];
    $newfields['billing']['billing_phone']      = $fields['billing']['billing_phone'];
    $newfields['billing']['billing_country']    = $fields['billing']['billing_country'];
    $newfields['billing']['billing_address_1']  = $fields['billing']['billing_address_1'];
    //$newfields['billing']['billing_address_2']  = $fields['billing']['billing_address_2'];   
    $newfields['billing']['billing_district']    = $fields['billing']['billing_district'];
    $newfields['billing']['billing_city']       = $fields['billing']['billing_city'];
    $newfields['billing']['billing_postcode']   = $fields['billing']['billing_postcode'];
    $newfields['billing']['billing_state']      = $fields['billing']['billing_state'];
   
    // Shipping: Sort Fields
    $newfields['shipping']['shipping_first_name'] = $fields['shipping']['shipping_first_name'];
    $newfields['shipping']['shipping_last_name']  = $fields['shipping']['shipping_last_name'];
    //$newfields['shipping']['shipping_company']    = $fields['shipping']['shipping_company'];
    $newfields['shipping']['shipping_country']    = $fields['shipping']['shipping_country'];
    $newfields['shipping']['shipping_address_1']  = $fields['shipping']['shipping_address_1'];
    //$newfields['shipping']['shipping_address_2']  = $fields['shipping']['shipping_address_2'];  
    $newfields['shipping']['shipping_district']    = $fields['shipping']['shipping_district'];
    $newfields['shipping']['shipping_city']       = $fields['shipping']['shipping_city'];
    $newfields['shipping']['shipping_state']      = $fields['shipping']['shipping_state'];
    $newfields['shipping']['shipping_postcode']   = $fields['shipping']['shipping_postcode'];
 
    $checkout_fields = array_merge( $fields, $newfields);
    return $checkout_fields;
}
 
// ------------------------------------
// Add Billing District # to Address Fields
add_filter( 'woocommerce_order_formatted_billing_address' , 'walnut_default_billing_address_fields', 10, 2 );
function walnut_default_billing_address_fields( $fields, $order ) {
	$fields['billing_district'] = get_post_meta( $order->id, '_billing_district', true );
return $fields;
}
 
// ------------------------------------
// Add Shipping District # to Address Fields
add_filter( 'woocommerce_order_formatted_shipping_address' , 'walnut_default_shipping_address_fields', 10, 2 );
function walnut_default_shipping_address_fields( $fields, $order ) {
	$fields['shipping_district'] = get_post_meta( $order->id, '_shipping_district', true );
return $fields;
}
 
// ------------------------------------
// Show Shipping & Billing District
add_filter( 'woocommerce_localisation_address_formats', 'walnut_new_address_formats');
function walnut_new_address_formats( $formats ) {
    $bill = $formats['default'] ="{billing_district}";
    $ship = $formats['default'] ="{shipping_district}";
    if ($bill == $ship) {

       $district = "\n{billing_district}";
    } else{
        $district = "\n{billing_district}, {shipping_district}";
    }

    $formats['default'] = "{name}\n{company}\n{address_1}" . $district . " {city}\n{state} {postcode}\n{country}";

    return $formats;
}

// ------------------------------------
// Create 'replacements' for new Address Fields
add_filter( 'woocommerce_formatted_address_replacements', 'add_new_replacement_fields',10,2 );
function add_new_replacement_fields( $replacements, $address ) {
	$replacements['{billing_district}'] = isset($address['billing_district']) ? $address['billing_district'] : '';
	$replacements['{shipping_district}'] = isset($address['shipping_district']) ? $address['shipping_district'] : '';
return $replacements;
}

