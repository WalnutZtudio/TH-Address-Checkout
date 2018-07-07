<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://walnutztudio.com
 * @since      1.0.0
 *
 * @package    Th_Address_Checkout
 * @subpackage Th_Address_Checkout/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Th_Address_Checkout
 * @subpackage Th_Address_Checkout/admin
 * @author     WalnutZtudio <walnutztudio@gmail.com>
 */
class Th_Address_Checkout_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	
	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/th-address-checkout-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/th-address-checkout-admin.js', array( 'jquery' ), $this->version, false );

	}

}
/**
 * Customize admin billing fields
 */
function my_custom_admin_billing_fields($fields) {
	unset($fields['company']);
	unset($fields['address_2']);
	
	$fields['address_1'] = array(
		'label'       => __( 'Address', 'woocommerce' ),
		'show'        => false,
	  );

	$fields['district'] = array(
	  'label'       => __( 'District', 'th-address-checkout' ),
	  'show'        => false,
	);
	return $fields;
  }
  add_filter('woocommerce_admin_billing_fields', 'my_custom_admin_billing_fields', 10, 1);

  /**
 * Customize admin billing fields
 */
function my_custom_admin_shipping_fields($fields) {
	unset($fields['company']);
	unset($fields['address_2']);
	
	$fields['address_1'] = array(
		'label'       => __( 'Address', 'woocommerce' ),
		'show'        => false,
	  );

	$fields['district'] = array(
	  'label'       => __( 'District', 'th-address-checkout' ),
	  'show'        => false,
	);
	return $fields;
  }
  add_filter('woocommerce_admin_shipping_fields', 'my_custom_admin_shipping_fields', 10, 1);

/**
 * Add fields to customer API response
 */
function my_api_customer_response_billing($customer_data, $customer, $fields, $server) {
	$district = get_user_meta($customer->ID, 'billing_district', true);
	$customer_data['billing_address']['district'] = (!empty($district) ? $district : '');
	return $customer_data;
  }
  add_filter('woocommerce_api_customer_response', 'my_api_customer_response_billing', 10, 4);
  function my_api_customer_response_shipping($customer_data, $customer, $fields, $server) {
	$district = get_user_meta($customer->ID, 'shipping_district', true);
	$customer_data['shipping_address']['district'] = (!empty($district) ? $district : '');
	return $customer_data;
  }
  add_filter('woocommerce_api_customer_response', 'my_api_customer_response_shipping', 10, 4);
  
  /**
   * Adds fields to edit customer billing address API
   */
  function my_api_customer_billing_address($fields) {
	$fields[] = 'district';
	return $fields;
  }
	add_filter('woocommerce_api_customer_billing_address', 'my_api_customer_billing_address', 10, 1);
	
  function my_api_customer_shipping_address($fields) {
	$fields[] = 'district';
	return $fields;
  }
	add_filter('woocommerce_api_customer_shipping_address', 'my_api_customer_shipping_address', 10, 1);
	

/**
 * Add fields to Profile information
 */
	add_action( 'show_user_profile', 'yoursite_extra_user_profile_fields' );
	add_action( 'edit_user_profile', 'yoursite_extra_user_profile_fields' );
	function yoursite_extra_user_profile_fields( $user ) {
	?>
		<h3><?php _e("Extra profile information", "blank"); ?></h3>
		<table class="form-table">
			<tr>
				<th><label for="district"><?php _e("District"); ?></label></th>
				<td>
					<input type="text" name="district" id="district" class="regular-text" 
							value="<?php echo esc_attr( get_the_author_meta( 'billing_district', $user->ID ) ); ?>" /><br />
			</td>
			</tr>
		</table>
	<?php
	}
	
	add_action( 'personal_options_update', 'yoursite_save_extra_user_profile_fields' );
	add_action( 'edit_user_profile_update', 'yoursite_save_extra_user_profile_fields' );
	function yoursite_save_extra_user_profile_fields( $user_id ) {
		$saved = false;
		if ( current_user_can( 'edit_user', $user_id ) ) {
			update_user_meta( $user_id, 'billing_district', $_POST['billing_district'] );
			$saved = true;
		}
		return true;
	}