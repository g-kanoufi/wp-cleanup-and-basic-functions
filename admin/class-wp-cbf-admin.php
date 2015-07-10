<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @license   GPL-2.0+
 * @link       http://lostwebdesigns.com
 * @since      1.0.0
 *
 * @subpackage Wp_Cbf/admin
 * @copyright 2015 WordPress Cleanup and base functions, head cleanup, addons supports
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Cbf
 * @subpackage Wp_Cbf/admin
 * @author     Guillaume Kanoufi <guillaume@lostwebdesigns.com>
 */
class Wp_Cbf_Admin {

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
	public function __construct( $plugin_name, $version, $options_slug, $options_data ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->options_slug = $options_slug;
		$this->options_data = $options_data;
		$this->wp_cbf_options = get_option($this->options_slug);

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
		 * defined in Wp_Cbf_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Cbf_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if ( 'settings_page_wp-cbf' == get_current_screen() -> id ) {
			wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-cbf-admin.css', array(), $this->version, 'all' );
			// Css rules for Color Picker
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style('thickbox');
		}

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
		 * defined in Wp_Cbf_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Cbf_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		if ( 'settings_page_wp-cbf' == get_current_screen() -> id ) {
			wp_enqueue_script('thickbox');
		        	wp_enqueue_script('media-upload');
			wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-cbf-admin.js', array( 'jquery', 'wp-color-picker', 'media-upload' ), $this->version, false );
		}

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		/*
		 * Add a settings page for this plugin to the Settings menu.
		 *
		 * NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		 *
		 *        Administration Menus: http://codex.wordpress.org/Administration_Menus
		 *
		 */
		$plugin_screen_hook_suffix = add_options_page( 'WP Cleanup and Base Options Functions Setup', 'WP Cleanup', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
		);
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_setup_page() {
		include_once( 'partials/wp-cbf-admin-display.php' );
	}


	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {


		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __( 'Settings', $this->plugin_name ) . '</a>'
			),
			$links
		);

	}


	/**
	 * 	Save the plugin options
	 *
	 *
	 * @since    1.0.0
	 */
	public function options_update() {
		register_setting( $this->options_slug, $this->options_slug, array($this, 'validate') );
	}

	public function validate($input) {
		// All checkboxes inputs
		$options = get_option($this->options_slug);
		$valid = array();

	    //Cleanup
	  	$valid['cleanup'] = (isset($input['cleanup'])) ? 1 : 0;
	  	$valid['comments_css_cleanup'] = (isset($input['comments_css_cleanup'])) ? 1: 0;
	  	$valid['gallery_css_cleanup'] = (isset($input['gallery_css_cleanup'])) ? 1 : 0;
	  	$valid['body_class_slug'] = (isset($input['body_class_slug'])) ? 1 : 0;
	  	$valid['prettify_search'] = (isset($input['prettify_search'])) ? 1 : 0;
	  	$valid['css_js_versions'] = (isset($input['css_js_versions'])) ? 1 : 0;
	  	$valid['jquery_cdn'] = (isset($input['jquery_cdn'])) ? 1 : 0;
	  	$valid['hide_admin_bar'] = (isset($input['hide_admin_bar'])) ? 1 : 0;
	  	$valid['write_log_fn'] = (isset($input['write_log_fn'])) ? 1 : 0;
	  	$valid['yoast_comments_cleanup'] = (isset($input['yoast_comments_cleanup'])) ? 1 : 0;

	  // Images
	  	$valid['images_figure_wrap'] = (isset($input['images_figure_wrap'])) ? 1 : 0;
	  	$valid['inline_wp_caption'] = (isset($input['inline_wp_caption'])) ? 1 : 0;
	  	$valid['images_attributes'] = (isset($input['images_attributes'])) ? 1 : 0;
	  	$valid['images_wh'] = (isset($input['images_wh'])) ? 1 : 0;
	  	$valid['retina_support'] = (isset($input['retina_support'])) ? 1 : 0;
	  	$valid['add_retina_js'] = (isset($input['add_retina_js'])) ? 1 : 0;
	  	$valid['new_images_size'] = 0;

	  	// New images sizes
	  	if(is_array($input['existing_images_size'])) {
			$existing_images_sizes = $input['existing_images_size'];
			foreach($existing_images_sizes as $existing_images_size_name => $existing_images_size_value):
				$existing_images_sizes[$existing_images_size_name]['crop'] = (isset($existing_images_size_value['crop'])) ? 1 : 0;
			endforeach;
		}else{
			$existing_images_sizes = array();
		}
		$new_images_size = array();

	  	if(isset($input['new_images_size'])){
	  		$images_size_slug = sanitize_title($input['images_size']['name']);
	  		$images_size_name = sanitize_text_field($input['images_size']['name']);
	  		if(empty($images_size_slug)){
	  			add_settings_error(
				        'new_images_size_error',                     // Setting title
				        'new_images_size_error_texterror',            // Error ID
				        'Please enter a new images size name',     // Error message
				        'error'                         // Type of message
				);
	  		}else{
	  			$new_images_size[$images_size_slug]['name'] = $images_size_name;
	  			$new_images_size[$images_size_slug]['width'] = sanitize_text_field($input['images_size']['width']);
		  		if(empty($new_images_size[$images_size_slug]['width'])){
		  			add_settings_error(
					        'new_images_size_width_error',                     // Setting title
					        'new_images_size_width_error_texterror',            // Error ID
					        'Please enter a width to '.$images_size_name.' images size',     // Error message
					        'error'                         // Type of message
					);
		  		}

		  		$new_images_size[$images_size_slug]['height'] = sanitize_text_field($input['images_size']['height']);
		  		if(empty($new_images_size[$images_size_slug]['height'])){
		  			add_settings_error(
					        'new_images_size_heigth_error',                     // Setting title
					        'new_images_size_heigth_error_texterror',            // Error ID
					        'Please enter a height to '.$images_size_name.' images sizes',     // Error message
					        'error'                         // Type of message
					);
		  		}
		  		$new_images_size[$images_size_slug]['crop'] = (isset($input['images_size']['crop'])) ? 1 : 0;

	  		}
	  	}
	  	if(!empty($images_size_slug) && !empty($new_images_size[$images_size_slug]['width']) && !empty($new_images_size[$images_size_slug]['height'])){
	  			$valid['images_size_arr'] = array_merge($existing_images_sizes, $new_images_size);
  		}else{
	  		$valid['images_size_arr'] = $existing_images_sizes;
	  	}

	  	$valid['gallery_images_size'] = sanitize_text_field($input['gallery_images_size']);


	  	//  Privacy settings
	  	$valid['referrer_meta'] = (isset($input['referrer_meta'])) ? 1 : 0;
	  	$valid['referrer_meta_value'] = sanitize_text_field($input['referrer_meta_value']);

	  	// Admin customizations
	  	$valid['login_logo'] = (isset($input['login_logo'])) ? esc_url($input['login_logo']) : 0;
	  	$valid['login_logo_link'] = (isset($input['login_logo_link'])) ? 1 : 0;

	  	$valid['login_background_color'] = (isset($input['login_background_color']) && !empty($input['login_background_color'])) ? sanitize_text_field($input['login_background_color']) : '';
	  		if ( !empty($valid['login_background_color']) && !preg_match( '/^#[a-f0-9]{6}$/i', $valid['login_background_color']  ) ) { // if user insert a HEX color with #
				add_settings_error(
				        'login_background_color',                     // Setting title
				        'login_background_color_texterror',            // Error ID
				        'Please enter a valid hex value color',     // Error message
				        'error'                         // Type of message
				);
			}
		$valid['login_button_primary_color'] = (isset($input['login_button_primary_color']) && !empty($input['login_button_primary_color'])) ? sanitize_text_field($input['login_button_primary_color']) : '';
	  		if ( !empty($valid['login_button_primary_color']) && !preg_match( '/^#[a-f0-9]{6}$/i', $valid['login_button_primary_color']  ) ) { // if user insert a HEX color with #
				add_settings_error(
				        'login_button_primary_color',                     // Setting title
				        'login_button_primary_color_texterror',            // Error ID
				        'Please enter a valid hex value color',     // Error message
				        'error'                         // Type of message
				);
			}

	  	$valid['remove_admin_bar_icon'] = (isset($input['remove_admin_bar_icon'])) ? 1 : 0;
	  	$valid['admin_footer_text'] = (!empty($input['admin_footer_text'])) ? wp_kses($input['admin_footer_text'], array('a' => array( 'href' => array(), 'title' => array()))) : '';



	    return $valid;
	}


	public function wp_cbf_replace_thickbox_text($translated_text, $text, $domain) {
	    if ('Insert into Post' == $text) {
	        $referer = strpos( wp_get_referer(), 'wp_cbf_upload-settings' );
	        if ( $referer != '' ) {
	            return __('Make this my login logo', $this->plugin_name);
	        }
	    }
	    return $translated_text;
	}



	/**
	 * Admin customizations Functions
	 *
	 * @since    1.0.0
	 */
	private function wp_cbf_login_logo_css(){
		if(isset($this->wp_cbf_options['login_logo']) && !empty($this->wp_cbf_options['login_logo'])){
			$login_logo_css  = "body.login h1 a {background-image: url(".$this->wp_cbf_options['login_logo']."); width:253px; height:102px; background-size: contain;}";
			return $login_logo_css;
		}
	}

	// Change login logo link to homepage
	public function wp_cbf_login_logo_link(){
		if($this->wp_cbf_options['login_logo_link']){
			return home_url();
		}
	}
	// Change login logo title attribute your site title, instead of 'WordPress'.
	public function wp_cbf_login_logo_headertitle(){
		if($this->wp_cbf_options['login_logo_link']){
			return get_bloginfo( 'name' );
		}
	}

	// Get Background color is set and different from #fff return it's css
	private function wp_cbf_login_background_color(){
		if(isset($this->wp_cbf_options['login_background_color']) && !empty($this->wp_cbf_options['login_background_color']) ){
			$background_color_css  = "body.login{ background:".$this->wp_cbf_options['login_background_color']."!important;}";
			return $background_color_css;
		}
	}
	// Get Button and links color is set and different from #00A0D2 return it's css
	private function wp_cbf_login_button_color(){
		if(isset($this->wp_cbf_options['login_button_primary_color']) && !empty($this->wp_cbf_options['login_button_primary_color']) ){
			$button_color = $this->wp_cbf_options['login_button_primary_color'];
			$border_color = $this->sass_darken($button_color, 10);
			$message_color = $this->sass_lighten($button_color, 10);
			$button_color_css = "body.login #nav a, body.login #backtoblog a {
						           color: ".$button_color." !important;
			     }
			     .login .message {
				  border-left: 4px solid ".$message_color.";
			     }
			     body.login #nav a:hover, body.login #backtoblog a:hover {
			           color: ". $border_color." !important;
			     }

			     body.login .button-primary {
			            background: ".$button_color."; /* Old browsers */
			            background: -moz-linear-gradient(top, ".$button_color." 0%, ". $border_color.", 10%) 100%); /* FF3.6+ */
			            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,".$button_color."), color-stop(100%, ". $border_color.", 10%))); /* Chrome,Safari4+ */
			            background: -webkit-linear-gradient(top, ".$button_color." 0%, ". $border_color.", 10%) 100%); /* Chrome10+,Safari5.1+ */
			            background: -o-linear-gradient(top, ".$button_color." 0%, ". $border_color.", 10%) 100%); /* Opera 11.10+ */
			            background: -ms-linear-gradient(top, ".$button_color." 0%, ". $border_color.", 10%) 100%); /* IE10+ */
			            background: linear-gradient(to bottom, ".$button_color." 0%, ". $border_color.", 10%) 100%); /* W3C */

			            -webkit-box-shadow: none!important;
					 box-shadow: none !important;

			            border-color:". $border_color."!important;
		           }
		           body.login .button-primary:hover, body.login .button-primary:active {
		            	background: ". $border_color."; /* Old browsers */
		                background: -moz-linear-gradient(top, ". $border_color." 0%, ". $border_color.", 10%) 100%); /* FF3.6+ */
		                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,". $border_color."), color-stop(100%,". $border_color.", 10%))); /* Chrome,Safari4+ */
		                background: -webkit-linear-gradient(top, ". $border_color." 0%,". $border_color.", 10%) 100%); /* Chrome10+,Safari5.1+ */
		                background: -o-linear-gradient(top, ". $border_color." 0%,". $border_color.", 10%) 100%); /* Opera 11.10+ */
		                background: -ms-linear-gradient(top, ". $border_color." 0%,". $border_color.", 10%) 100%); /* IE10+ */
		                background: linear-gradient(to bottom, ". $border_color." 0%,". $border_color.", 10%) 100%); /* W3C */
		           }

		           body.login input[type=checkbox]:checked:before{
		           	color:".$button_color."!important;
		           }

		           body.login input[type=checkbox]:focus,
		           body.login input[type=email]:focus,
		           body.login input[type=number]:focus,
		           body.login input[type=password]:focus,
		           body.login input[type=radio]:focus,
		           body.login input[type=search]:focus,
		           body.login input[type=tel]:focus,
		           body.login input[type=text]:focus,
		           body.login input[type=url]:focus,
		           body.login select:focus,
		           body.login textarea:focus {
				border-color: ".$button_color."!important;
				-webkit-box-shadow: 0 0 2px ".$button_color."!important;
				box-shadow: 0 0 2px ".$button_color."!important;
			}";

			return $button_color_css;
		}
	}

	// Write the actually needed css for admin customizations
	public function wp_cbf_admin_css(){
		if( !empty($this->wp_cbf_options['login_logo']) || $this->wp_cbf_login_background_color() != null || $this->wp_cbf_login_button_color() != null){
			echo '<style>';
			if( !empty($this->wp_cbf_options['login_logo'])){
				echo $this->wp_cbf_login_logo_css();
			}
			if($this->wp_cbf_login_background_color() != null){
				echo $this->wp_cbf_login_background_color();
			}
			if($this->wp_cbf_login_button_color() != null){
				echo $this->wp_cbf_login_button_color();
			}
			echo '</style>';
		}
	}

	public function wp_cbf_remove_wp_icon_from_admin_bar() {
		if($this->wp_cbf_options['remove_admin_bar_icon']){
			global $wp_admin_bar;
			$wp_admin_bar->remove_menu('wp-logo');
		}
	}

	public function wp_cbf_admin_footer_text($footer_text){
		if(!empty($this->wp_cbf_options['admin_footer_text'])){
			$footer_text = $this->wp_cbf_options['admin_footer_text'];
		}
		return $footer_text;
	}






	/**
	 * Utility functions
	 *
	 * @since    1.0.0
	 */

	private function sass_darken($hex, $percent) {
	    preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors);
		str_replace('%', '', $percent);
		$color = "#";
		for($i = 1; $i <= 3; $i++) {
			$primary_colors[$i] = hexdec($primary_colors[$i]);
			$primary_colors[$i] = round($primary_colors[$i] * (100-($percent*2))/100);
			$color .= str_pad(dechex($primary_colors[$i]), 2, '0', STR_PAD_LEFT);
		}

		return $color;
	}

	private function sass_lighten($hex, $percent) {
		preg_match('/^#?([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i', $hex, $primary_colors);
		str_replace('%', '', $percent);
		$color = "#";
		for($i = 1; $i <= 3; $i++) {
			$primary_colors[$i] = hexdec($primary_colors[$i]);
			$primary_colors[$i] = round($primary_colors[$i] * (100+($percent*2))/100);
			$color .= str_pad(dechex($primary_colors[$i]), 2, '0', STR_PAD_LEFT);
		}

		return $color;
	}




}
