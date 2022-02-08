<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://daryamazanenko.com
 * @since      1.0.0
 */
class Iwigi_Complete_Wc_Order_Public 
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}
	
	/**
	 * Display message on Complete Order page
	 *
	 * @since    1.0.0
	 */
	public function display_message_oncomplete( $content ) {	    
	    if( is_page( 'complete-order' ) ) {	        
	        return $content . $this->generate_message( $this->query_var( 'iwigi_token' ), $this->query_var( 'iwigi_order' ) );	        
	    }	    
	    return $content;
	}
	
	/**
	 * Generate message depending on result of reading query vars
	 *
	 * @since    1.0.0
	 */
	public function generate_message( $iwigi_token, $iwigi_order ) {	    
	    if( $iwigi_token && $iwigi_order ){	            
            $token    = $iwigi_token;
            $order_id = $iwigi_order;
                
            if( $this->is_token( $token, $order_id ) ){                
                return $this->complete_order( $order_id ) ? $this->display_message() : $this->display_message( 'Something went wrong' );
            }                
            return $this->display_message( 'Order Completed Already' );    
       }       
	}
	
	/**
	 * Return true if an order is successfully completed. Otherwise return false.
	 *
	 * @since    1.0.0
	 */
	public function complete_order( $order_id ) {	    
	    $order = wc_get_order( $order_id );
                
        return  true === $order->update_status( 'completed' );	    
	}

	/**
	 * Check if query var is not empty. Sanitize the query var
	 *
	 * @since    1.0.0
	 */
	public function query_var( $var ) {	    
	    return sanitize_text_field( get_query_var( $var ) ) ? sanitize_text_field( get_query_var( $var ) ) : '';
	}
	
	/**
	 * Check if $token is the same value as order meta key _iwigi_order_token
	 *
	 * @since    1.0.0
	 */
	public function is_token( $token, $order_id ) {	    
	    return $token === get_post_meta($order_id, '_iwigi_order_token', true);	    
	}
	
	/**
	 * Prepare a message with the default 'Order Completed' text and link to Home
	 * with a very simple inline styles
	 * 
	 * @since    1.0.0
	 */
	public function display_message( $message = 'Order Completed', $home = 'HOME' ) {	    
	    $style  = 'text-align: center; margin-top: 50px;';
	    $format = '<p style="%1$s">%2$s</p><p style="%1$s"><a href="%3$s">%4$s</a></p>';
	    
	    return sprintf( $format, $style, esc_html( $message ), get_site_url(), esc_html( $home ) );
	}
	
	/**
	 * Load the custom template for the Complete Order page
	 *
	 * @since    1.0.0
	 */
	public function load_page_template($single_template) {	    
        if ( is_page( 'complete-order' ) ) {            
            $single_template = plugin_dir_path( __FILE__ ) . 'templates/iwigi-template-complete-order.php'; 
        }
        
        return $single_template;        
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {		
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/iwigi-complete-wc-order-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/iwigi-complete-wc-order-public.js', array( 'jquery' ), $this->version, false );
	}
}