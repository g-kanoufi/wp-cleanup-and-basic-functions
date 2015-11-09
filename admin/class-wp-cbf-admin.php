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
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->wp_cbf_options = get_option($this->plugin_name);

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
            // Css rules for Color Picker
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-cbf-admin.css', array('wp-color-picker'), $this->version, 'all' );
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
            wp_enqueue_media();
            wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-cbf-admin.js', array( 'jquery', 'wp-color-picker' ), $this->version, false );
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
        $plugin_screen_hook_suffix = add_options_page( __('WP Cleanup and Base Options Functions Setup', $this->plugin_name ), 'WP Cleanup', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
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
     *  Save the plugin options
     *
     *
     * @since    1.0.0
     */
    public function options_update() {
        register_setting( $this->plugin_name, $this->plugin_name, array($this, 'validate') );
    }

    public function validate($input) {
        // All checkboxes inputs
        $options = get_option($this->plugin_name);
        $valid = array();

        //Cleanup
        $valid['cleanup'] = (isset($input['cleanup']) && !empty($input['cleanup'])) ? 1 : 0;
        $valid['comments_css_cleanup'] = (isset($input['comments_css_cleanup']) && !empty($input['comments_css_cleanup'])) ? 1: 0;
        $valid['gallery_css_cleanup'] = (isset($input['gallery_css_cleanup']) && !empty($input['gallery_css_cleanup'])) ? 1 : 0;
        $valid['body_class_slug'] = (isset($input['body_class_slug']) && !empty($input['body_class_slug'])) ? 1 : 0;
        $valid['prettify_search'] = (isset($input['prettify_search']) && !empty($input['prettify_search'])) ? 1 : 0;
        $valid['css_js_versions'] = (isset($input['css_js_versions']) && !empty($input['css_js_versions'])) ? 1 : 0;
        $valid['jquery_cdn'] = (isset($input['jquery_cdn']) && !empty($input['jquery_cdn'])) ? 1 : 0;
        $valid['cdn_provider'] = esc_url($input['cdn_provider']);
        $valid['hide_admin_bar'] = (isset($input['hide_admin_bar']) && !empty($input['hide_admin_bar'])) ? 1 : 0;
        $valid['write_log_fn'] = (isset($input['write_log_fn']) && !empty($input['write_log_fn'])) ? 1 : 0;
        $valid['yoast_comments_cleanup'] = (isset($input['yoast_comments_cleanup']) && !empty($input['yoast_comments_cleanup'])) ? 1 : 0;

      // Images
        $valid['images_figure_wrap'] = (isset($input['images_figure_wrap']) && !empty($input['images_figure_wrap'])) ? 1 : 0;
        $valid['inline_wp_caption'] = (isset($input['inline_wp_caption']) && !empty($input['inline_wp_caption'])) ? 1 : 0;
        $valid['images_attributes'] = (isset($input['images_attributes']) && !empty($input['images_attributes'])) ? 1 : 0;
        $valid['images_wh'] = (isset($input['images_wh']) && !empty($input['images_wh'])) ? 1 : 0;
        $valid['svg_support'] = (isset($input['svg_support']) && !empty($input['svg_support'])) ? 1 : 0;
        $valid['retina_support'] = (isset($input['retina_support']) && !empty($input['retina_support'])) ? 1 : 0;
        $valid['add_retina_js'] = (isset($input['add_retina_js']) && !empty($input['add_retina_js'])) ? 1 : 0;
        $valid['new_images_size'] = 0;

        // New images sizes
        if(isset($input['existing_images_size']) && is_array($input['existing_images_size'])) {
            $existing_images_sizes = $input['existing_images_size'];
            foreach($existing_images_sizes as $existing_images_size_name => $existing_images_size_value):
                $existing_images_sizes[$existing_images_size_name]['crop'] = (isset($existing_images_size_value['crop'])) ? 1 : 0;
            endforeach;
        }else{
            $existing_images_sizes = array();
        }
        $new_images_size = array();

        if(isset( $input['new_images_size']) &&  !empty($input['new_images_size']) ){
            $images_size_slug = sanitize_title($input['images_size']['name']);
            $images_size_name = sanitize_text_field($input['images_size']['name']);
            if(empty($images_size_slug)){
                add_settings_error(
                        'new_images_size_error',                     // Setting title
                        'new_images_size_error_texterror',            // Error ID
                        __('Please enter a new images size name', $this->plugin_name),    // Error message
                        'error'                         // Type of message
                );
            }else{
                $new_images_size[$images_size_slug]['name'] = $images_size_name;
                $new_images_size[$images_size_slug]['width'] = sanitize_text_field($input['images_size']['width']);
                if(empty($new_images_size[$images_size_slug]['width'])){
                    add_settings_error(
                            'new_images_size_width_error',                     // Setting title
                            'new_images_size_width_error_texterror',            // Error ID
                            __('Please enter a width to '.$images_size_name.' images size', $this->plugin_name),    // Error message
                            'error'                         // Type of message
                    );
                }

                $new_images_size[$images_size_slug]['height'] = sanitize_text_field($input['images_size']['height']);
                if(empty($new_images_size[$images_size_slug]['height'])){
                    add_settings_error(
                            'new_images_size_heigth_error',                     // Setting title
                            'new_images_size_heigth_error_texterror',            // Error ID
                            __('Please enter a height to '.$images_size_name.' images sizes', $this->plugin_name),     // Error message
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
        $valid['referrer_meta'] = (isset($input['referrer_meta']) && !empty($input['referrer_meta'])) ? 1 : 0;
        $valid['referrer_meta_value'] = sanitize_text_field($input['referrer_meta_value']);

        // Admin customizations
        $valid['login_logo_id'] = (isset($input['login_logo_id']) && !empty($input['login_logo_id'])) ? absint($input['login_logo_id']) : 0;

        $valid['login_logo_link'] = (isset($input['login_logo_link']) && !empty($input['login_logo_link'])) ? 1 : 0;

        $valid['login_background_color'] = (isset($input['login_background_color']) && !empty($input['login_background_color'])) ? sanitize_text_field($input['login_background_color']) : '';
            if ( !empty($valid['login_background_color']) && !preg_match( '/^#[a-f0-9]{6}$/i', $valid['login_background_color']  ) ) { // if user insert a HEX color with #
                add_settings_error(
                        'login_background_color',                     // Setting title
                        'login_background_color_texterror',            // Error ID
                        __('Please enter a valid hex value color', $this->plugin_name),     // Error message
                        'error'                         // Type of message
                );
            }
        $valid['login_button_primary_color'] = (isset($input['login_button_primary_color']) && !empty($input['login_button_primary_color'])) ? sanitize_text_field($input['login_button_primary_color']) : '';
            if ( !empty($valid['login_button_primary_color']) && !preg_match( '/^#[a-f0-9]{6}$/i', $valid['login_button_primary_color']  ) ) { // if user insert a HEX color with #
                add_settings_error(
                        'login_button_primary_color',                     // Setting title
                        'login_button_primary_color_texterror',            // Error ID
                        __('Please enter a valid hex value color', $this->plugin_name),     // Error message
                        'error'                         // Type of message
                );
            }
      

        $valid['remove_admin_bar_icon'] = (isset($input['remove_admin_bar_icon']) && !empty($input['remove_admin_bar_icon'])) ? 1 : 0;

        global $menu;
        $menu_item_arr = array();
        //error_log(print_r($input, true));
      if(isset($input['admin_menu_items'])):
          foreach($input['admin_menu_items'] as $menu_item_key => $menu_item_val){
            //$menu_item_arr[$menu_item_key] = json_decode($input['admin_menu_items_val'][$menu_item_key]);
        
            $menu_item_arr[$menu_item_key] = (isset($input['admin_menu_items_val'])) ? unserialize($input['admin_menu_items_val'][$menu_item_key]) : $menu[$menu_item_key];
            $menu_item_arr[$menu_item_key]['hidden'] = ($input['admin_menu_items'][$menu_item_key] == 1) ? 1 : 0; 
          }
        $valid['admin_menu_items'] = $menu_item_arr;
      else:
        $valid['admin_menu_items'] = array();
      endif;

        $valid['admin_footer_text'] = (isset($input['admin_footer_text']) && !empty($input['admin_footer_text'])) ? wp_kses($input['admin_footer_text'], array('a' => array( 'href' => array(), 'title' => array()))) : '';


        // Smtp Support
        $valid['smtp_support'] = (isset($input['smtp_support']) && !empty($input['smtp_support'])) ? 1 : 0;

        $valid['smtp_from_name'] = (isset($input['smtp_from_name']) && !empty($input['smtp_from_name'])) ? sanitize_text_field($input['smtp_from_name']) : '';
            if (!empty($input['smtp_support']) &&  empty($valid['smtp_from_name']) ) { 
                add_settings_error(
                        'smtp_from_name',                     // Setting title
                        'smtp_from_name_texterror',            // Error ID
                        __('Please enter a name', $this->plugin_name),     // Error message
                        'error'                         // Type of message
                );
            }
        $valid['smtp_from_email'] = (isset($input['smtp_from_email']) && !empty($input['smtp_from_email'])) ? sanitize_text_field($input['smtp_from_email']) : '';
            if ( !empty($input['smtp_support']) && !empty($valid['smtp_from_email']) && !preg_match( '/^([a-z0-9_\.-]+\@[\da-z\.-]+\.[a-z\.]{2,6})/i', $valid['smtp_from_email']  ) ) { 
                add_settings_error(
                        'smtp_from_email',                     // Setting title
                        'smtp_from_email_texterror',            // Error ID
                        __('Please enter a valid email address', $this->plugin_name),     // Error message
                        'error'                         // Type of message
                );
            }
        $valid['smtp_authentication'] = (isset($input['smtp_authentication']) && !empty($input['smtp_authentication'])) ? 1 : 0;

        $valid['smtp_port'] = (isset($input['smtp_port']) && !empty($input['smtp_port'])) ? sanitize_text_field($input['smtp_port']) : '';
            if ( !empty($input['smtp_support']) && !empty($valid['smtp_port']) && !preg_match( '/[\d]{2,4}/i', $valid['smtp_port']  ) ) { 
                add_settings_error(
                        'smtp_port',                     // Setting title
                        'smtp_port_texterror',            // Error ID
                        __('Please enter a valid port number', $this->plugin_name),     // Error message
                        'error'                         // Type of message
                );
            }


        $valid['smtp_host'] = (isset($input['smtp_host']) && !empty($input['smtp_host'])) ? sanitize_text_field($input['smtp_host']) : '';
            if ( !empty($input['smtp_support']) && empty($valid['smtp_host']) ) { 
                add_settings_error(
                        'smtp_host',                     // Setting title
                        'smtp_host_texterror',            // Error ID
                        __('Please enter a smtp hostname', $this->plugin_name),     // Error message
                        'error'                         // Type of message
                );
            }


        $valid['smtp_encryption'] = sanitize_text_field($input['smtp_encryption']);

        $valid['smtp_authentication'] = (isset($input['smtp_authentication']) && !empty($input['smtp_authentication'])) ? 1 : 0;

        $valid['smtp_username'] = (isset($input['smtp_username']) && !empty($input['smtp_username'])) ? sanitize_text_field($input['smtp_username']) : '';
            if ( !empty($input['smtp_support']) && empty($valid['smtp_username']) ) { 
                add_settings_error(
                        'smtp_username',                     // Setting title
                        'smtp_username_texterror',            // Error ID
                        __('Please enter a username', $this->plugin_name),     // Error message
                        'error'                         // Type of message
                );
            }

        
        $valid['smtp_password'] = (isset($input['smtp_password']) && !empty($input['smtp_password'])) ? sanitize_text_field($input['smtp_password']) : '';
            if ( !empty($input['smtp_support']) && empty($valid['smtp_password']) ) { 
                add_settings_error(
                        'smtp_password',                     // Setting title
                        'smtp_password_texterror',            // Error ID
                        __('Please enter a password', $this->plugin_name),     // Error message
                        'error'                         // Type of message
                );
            }



        return $valid;
    }



    /*
    *
    * Images / Media uploader
    *
     */


    // Add Media Uploader svg support
    public function wp_cbf_svg_support($mimes){
        if(!empty($this->wp_cbf_options['svg_support'])){
            $mimes['svg'] = 'image/svg+xml';
        }
        return $mimes;
    }

    public function wp_cbf_fix_svg_thumb_display() {
        if(!empty($this->wp_cbf_options['svg_support'])){
            $svg_css =  'td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail {
              width: 100% !important;
              height: auto !important;
            }';
            return $svg_css;
        }
    }



    /**
     * Admin customizations Functions
     *
     * @since    1.0.0
     */
    private function wp_cbf_login_logo_css(){
        if(isset($this->wp_cbf_options['login_logo_id']) && !empty($this->wp_cbf_options['login_logo_id'])){
            $login_logo = wp_get_attachment_image_src($this->wp_cbf_options['login_logo_id'], 'thumbnail');
            $login_logo_url = $login_logo[0];
            $login_logo_css  = "body.login h1 a {background-image: url(".$login_logo_url."); width:253px; height:102px; background-size: contain;}";
            return $login_logo_css;
        }
    }

    // Change login logo link to homepage
    public function wp_cbf_login_logo_link(){
        if(!empty($this->wp_cbf_options['login_logo_link'])){
            return home_url();
        }
    }
    // Change login logo title attribute your site title, instead of 'WordPress'.
    public function wp_cbf_login_logo_headertitle(){
        if(!empty($this->wp_cbf_options['login_logo_link'])){
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
        if( !empty($this->wp_cbf_options['login_logo_id']) || null != $this->wp_cbf_login_background_color()  || null != $this->wp_cbf_login_button_color() ){
            echo '<style>';
            if( !empty($this->wp_cbf_options['login_logo_id'])){
                echo $this->wp_cbf_login_logo_css();
            }
            if( null != $this->wp_cbf_login_background_color() ){
                echo $this->wp_cbf_login_background_color();
            }
            if( null != $this->wp_cbf_login_button_color() ){
                echo $this->wp_cbf_login_button_color();
            }
            echo '</style>';
        }
    }

    public function wp_cbf_remove_wp_icon_from_admin_bar() {
        if(!empty($this->wp_cbf_options['remove_admin_bar_icon'])){
            global $wp_admin_bar;
            $wp_admin_bar->remove_menu('wp-logo');
        }
    }


    public function wp_cbf_hide_admin_menu_items(){
        if(isset($this->wp_cbf_options['admin_menu_items'])){
          foreach($this->wp_cbf_options['admin_menu_items'] as $menu_item_key => $menu_item_value){
            if(isset($this->wp_cbf_options['admin_menu_items'][$menu_item_key][2])){
                remove_menu_page( $this->wp_cbf_options['admin_menu_items'][$menu_item_key][2] ); 
            }
          }
        }
    
    }


    public function wp_cbf_admin_footer_text($footer_text){
        if(!empty($this->wp_cbf_options['admin_footer_text'])){
            $footer_text = $this->wp_cbf_options['admin_footer_text'];
        }
        return $footer_text;
    }

    /**
     *
     * Add smtp email possibilities
     *
     */

    function wp_cbf_send_smtp_email( $phpmailer ){
        if(!empty($this->wp_cbf_options['smtp_support']) && !empty($this->wp_cbf_options['smtp_host']) && !empty($this->wp_cbf_options['smtp_port'])){
            // Define that we are sending with SMTP
            $phpmailer->isSMTP();

            // The hostname of the mail server
            $phpmailer->Host = $this->wp_cbf_options['smtp_host'];

            // Use SMTP authentication (true|false)
            $phpmailer->SMTPAuth = true;

            // SMTP port number - likely to be 25, 465 or 587
            $phpmailer->Port = $this->wp_cbf_options['smtp_port'];
            
            // Set SMTPDebug to true
            //$phpmailer->SMTPDebug = true;

            if('1' == $this->wp_cbf_options['smtp_authentication']){

                // Username to use for SMTP authentication
                $phpmailer->Username = $this->wp_cbf_options['smtp_username'];

                // Password to use for SMTP authentication
                $phpmailer->Password = $this->wp_cbf_options['smtp_password'];

            }

            // The encryption system to use - ssl (deprecated) or tls
            $phpmailer->SMTPSecure = $this->wp_cbf_options['smtp_encryption'];

            if(!empty($this->wp_cbf_options['smtp_from_email']))
                $phpmailer->From = $this->wp_cbf_options['smtp_from_email'];

            if(!empty($this->wp_cbf_options['smtp_from_name']))
                $phpmailer->FromName = $this->wp_cbf_options['smtp_from_name'];
        }
    }


    // Smtp ajax test email
    public function wp_cbf_send_test_email_callback(){
        $email_addr = $_POST['email_addr'];
        $subject = 'WP Cleanup: ' . __('This is a test mail form WP Cleanup SMTP settings to ', $this->plugin_name) . $email_addr;
        $message = __('This test email has been successfully sent using your SMTP settings - Congrats!', $this->plugin_name);
        
        
        // Start output buffering to grab smtp debugging output
        ob_start();

        // Send the test mail
        $result = wp_mail($email_addr, $subject, $message);
        
        // Strip out the language strings which confuse users
        //unset($phpmailer->language);
        // This property became protected in WP 3.2
        
        // Grab the smtp debugging output
        $smtp_debug = ob_get_clean();
        
        echo json_encode(array('result' => $result));
        wp_die();
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
