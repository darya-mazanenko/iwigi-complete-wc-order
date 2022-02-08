<?php

/**
 * The admin-specific functionality of the plugin.
 */

class Iwigi_Complete_Wc_Order_Admin 
{

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
	 * Two query vars are added to the main query vars
	 *
	 * @since    1.0.0
	 */
	public function add_custom_query( $qvars ) {
	    $qvars[] = 'iwigi_order';
        $qvars[] = 'iwigi_token';
        
        return $qvars;
	}
	
	/**
	 * Prints a link to complete an order before the order table.
	 *
	 * @since    1.0.0
	 */
	public function link_before_order_table( $order, $sent_to_admin, $plain_text, $email ) {        
        if( 'new_order' == $email->id ){
            printf( '<div style="margin-bottom: 20px;"><a href="%s">%s</a></div>', esc_url( $this->link( $order ) ), 'Complete This Order' );
        }
    }
    
    /**
	 * Builds URL with the query parameters of order number and unique token
	 *
	 * @since    1.0.0
	 */
    public function link( $order ) {        
        add_post_meta( $order->get_id(), '_iwigi_order_token', bin2hex( random_bytes(5) ), true );
        
        return 
            add_query_arg( 
                array(
                    'iwigi_order' => $order->get_id(),
                    'iwigi_token' => get_post_meta( $order->get_id(), '_iwigi_order_token', true )
                ), 
                get_site_url() . '/complete-order/' 
            );
    }
    
    /**
	 * Delete _iwigi_order_token value from the database when order status has been changed to Completed
	 *
	 * @since    1.0.0
	 */
    public function delete_order_token( $order ) {        
        if( get_post_meta($order, '_iwigi_order_token', true ) ) {            
            delete_post_meta($order, '_iwigi_order_token');
        }    
    }
    
    
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/iwigi-complete-wc-order-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/iwigi-complete-wc-order-admin.js', array( 'jquery' ), $this->version, false );
	}

}
