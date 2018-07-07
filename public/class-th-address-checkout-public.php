<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://walnutztudio.com
 * @since      1.0.0
 *
 * @package    Th_Address_Checkout
 * @subpackage Th_Address_Checkout/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Th_Address_Checkout
 * @subpackage Th_Address_Checkout/public
 * @author     WalnutZtudio <walnutztudio@gmail.com>
 */
class Th_Address_Checkout_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Th_Address_Checkout_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Th_Address_Checkout_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name .'-jquery-thaiaddress' , plugin_dir_url( __FILE__ ) . 'css/jquery.Thailand.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/th-address-checkout-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Th_Address_Checkout_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Th_Address_Checkout_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if ( is_checkout() || is_wc_endpoint_url( 'edit-address' ) ) {
			wp_enqueue_script( $this->plugin_name .'-jquery-th', '//code.jquery.com/jquery-3.2.1.min.js', array( 'jquery' ), $this->version, true);
			wp_enqueue_script( $this->plugin_name .'-jql', plugin_dir_url( __FILE__ ) . 'js/JQL.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name .'-typehead', plugin_dir_url( __FILE__ ) . 'js/typeahead.bundle.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name .'-jquery-thaiaddress', plugin_dir_url( __FILE__ ) . 'js/jquery.Thailand.min.js', array( 'jquery' ), $this->version, true );
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/th-address-checkout-public.js', array( 'jquery' ), $this->version, true );
		
			wp_localize_script( 
				$this->plugin_name, 
				'plugin_path', 
				array(
					'url' => plugin_dir_url( __FILE__ ),
					)
				);		
		}
	}
}

// Account Edit Adresses: Remove and reorder addresses fields
add_filter(  'woocommerce_default_address_fields', 'custom_default_address_fields', 20, 1 );
function custom_default_address_fields( $fields ) {
    // Only on account pages
    if( ! is_account_page() ) return $fields;

    ## ---- 1.  Remove 'address_2' field ---- ##

	unset($fields['address_2']);
	unset($fields['company']);

    ## ---- 2.  Sort Address fields ---- ##

    // Set the order (sorting fields) in the array below
    $sorted_fields = array('first_name','last_name','email','phone','address_1','district','city','state','postcode','country');

    $new_fields = array();
    $priority = 0;

    // Reordering billing and shipping fields
    foreach($sorted_fields as $key_field){
        $priority += 10;

        if( $key_field == 'district' )
            $priority += 20; // keep space for email and phone fields

        $new_fields[$key_field] = $fields[$key_field];
        $new_fields[$key_field]['priority'] = $priority;
    }
    return $new_fields;
}

// Account Edit Adresses: Reorder billing email and phone fields
add_filter(  'woocommerce_billing_fields', 'custom_billing_fields', 20, 1 );
function custom_billing_fields( $fields ) {
    // Only on account pages
    if( ! is_account_page() ) return $fields;

    ## ---- 2.  Sort billing email and phone fields ---- ##

    $fields['billing_email']['priority'] = 30;
    $fields['billing_email']['class'] = array('form-row-first');
    $fields['billing_phone']['priority'] = 40;
	$fields['billing_phone']['class'] = array('form-row-last');
	$fields['billing_district']['priority'] = 50;
	$fields['billing_district']['class'] = array('form-row-first');
	$fields['billing_district']['label'] = 'District';
	$fields['billing_district']['required'] = true;
    $fields['billing_city']['priority'] = 60;
    $fields['billing_city']['class'] = array('form-row-last');
	$fields['billing_state']['priority'] = 70;
    $fields['billing_state']['class'] = array('form-row-first');
    $fields['billing_postcode']['priority'] = 80;
    $fields['billing_postcode']['class'] = array('form-row-last');

    return $fields;
}

// Account Displayed Addresses : Remove 'address_2'
add_filter( 'woocommerce_my_account_my_address_formatted_address' , 'my_account_address_formatted_addresses', 20, 3 );
function my_account_address_formatted_addresses( $address, $customer_id, $address_type ) {
	unset($address['address_2']); // remove Address 2
	unset($address['company']);

    return $address;
}
add_filter( 'woocommerce_my_account_my_address_formatted_address', function( $args, $customer_id, $name ){
    // the phone is saved as billing_phone and shipping_phone
    $args['billing_district'] = get_user_meta( $customer_id, $name . '_district', true );
    return $args;
}, 10, 3 ); 