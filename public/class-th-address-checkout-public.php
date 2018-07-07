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

/* Custome Thai Province order */
if (get_locale() == 'th' || 'en') {
	add_filter( 'woocommerce_states', 'walnut_woocommerce_states' );
}
function walnut_woocommerce_states( $states ) {
	$states['TH'] = array(
		'TH-81' => 'กระบี่',
		'TH-10' => 'กรุงเทพมหานคร',
		'TH-71' => 'กาญจนบุรี',
		'TH-46' => 'กาฬสินธุ์',
		'TH-62' => 'กำแพงเพชร',
		'TH-40' => 'ขอนแก่น',
		'TH-22' => 'จันทบุรี',
		'TH-24' => 'ฉะเชิงเทรา',
		'TH-20' => 'ชลบุรี',
		'TH-18' => 'ชัยนาท',
		'TH-36' => 'ชัยภูมิ',
		'TH-86' => 'ชุมพร',
		'TH-57' => 'เชียงราย',
		'TH-50' => 'เชียงใหม่',
		'TH-92' => 'ตรัง',
		'TH-23' => 'ตราด',
		'TH-63' => 'ตาก',
		'TH-26' => 'นครนายก',
		'TH-73' => 'นครปฐม',
		'TH-48' => 'นครพนม',
		'TH-30' => 'นครราชสีมา',
		'TH-80' => 'นครศรีธรรมราช',
		'TH-60' => 'นครสวรรค์',
		'TH-12' => 'นนทบุรี',
		'TH-96' => 'นราธิวาส',
		'TH-55' => 'น่าน',
		'TH-38' => 'บึงกาฬ',
		'TH-31' => 'บุรีรัมย์',
		'TH-13' => 'ปทุมธานี',
		'TH-77' => 'ประจวบคีรีขันธ์',
		'TH-25' => 'ปราจีนบุรี',
		'TH-94' => 'ปัตตานี',
		'TH-14' => 'พระนครศรีอยุธยา',
		'TH-56' => 'พะเยา',
		'TH-82' => 'พังงา',
		'TH-93' => 'พัทลุง',
		'TH-66' => 'พิจิตร',
		'TH-65' => 'พิษณุโลก',
		'TH-76' => 'เพชรบุรี',
		'TH-67' => 'เพชรบูรณ์',
		'TH-54' => 'แพร่',
		'TH-83' => 'ภูเก็ต',
		'TH-44' => 'มหาสารคาม',
		'TH-49' => 'มุกดาหาร',
		'TH-58' => 'แม่ฮ่องสอน',
		'TH-35' => 'ยโสธร',
		'TH-95' => 'ยะลา',
		'TH-45' => 'ร้อยเอ็ด',
		'TH-85' => 'ระนอง',
		'TH-21' => 'ระยอง',
		'TH-70' => 'ราชบุรี',
		'TH-16' => 'ลพบุรี',
		'TH-52' => 'ลำปาง',
		'TH-51' => 'ลำพูน',
		'TH-42' => 'เลย',
		'TH-33' => 'ศรีสะเกษ',
		'TH-47' => 'สกลนคร',
		'TH-90' => 'สงขลา',
		'TH-91' => 'สตูล',
		'TH-11' => 'สมุทรปราการ',
		'TH-75' => 'สมุทรสงคราม',
		'TH-74' => 'สมุทรสาคร',
		'TH-27' => 'สระแก้ว',
		'TH-19' => 'สระบุรี',
		'TH-17' => 'สิงห์บุรี',
		'TH-64' => 'สุโขทัย',
		'TH-72' => 'สุพรรณบุรี',
		'TH-84' => 'สุราษฎร์ธานี',
		'TH-32' => 'สุรินทร์',
		'TH-43' => 'หนองคาย',
		'TH-39' => 'หนองบัวลำภู',
		'TH-15' => 'อ่างทอง',
		'TH-37' => 'อำนาจเจริญ',
		'TH-41' => 'อุดรธานี',
		'TH-53' => 'อุตรดิตถ์',
		'TH-61' => 'อุทัยธานี',
		'TH-34' => 'อุบลราชธานี'
		);
	return $states;
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

// Account Edit Adresses: Reorder billing email and phone fields
add_filter(  'woocommerce_shipping_fields', 'custom_shipping_fields', 20, 1 );
function custom_shipping_fields( $fields ) {
    // Only on account pages
    if( ! is_account_page() ) return $fields;

    ## ---- 2.  Sort billing email and phone fields ---- ##
	
	$fields['shipping_email']['priority'] = 30;
	$fields['shipping_email']['class'] = array('form-row-first');
	$fields['shipping_email']['label'] = 'Email';
	$fields['shipping_email']['required'] = true;
    $fields['shipping_phone']['priority'] = 40;
	$fields['shipping_phone']['class'] = array('form-row-last');
	$fields['shipping_phone']['label'] = 'Phone';
	$fields['shipping_district']['priority'] = 50;
	$fields['shipping_district']['class'] = array('form-row-first');
	$fields['shipping_district']['label'] = 'District';
	$fields['shipping_district']['required'] = true;
    $fields['shipping_city']['priority'] = 60;
    $fields['shipping_city']['class'] = array('form-row-last');
	$fields['shipping_state']['priority'] = 70;
    $fields['shipping_state']['class'] = array('form-row-first');
    $fields['shipping_postcode']['priority'] = 80;
    $fields['shipping_postcode']['class'] = array('form-row-last');

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
	$args['shipping_district'] = get_user_meta( $customer_id, $name . '_district', true );
    return $args;
}, 10, 3 ); 
