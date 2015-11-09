<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://lostwebdesigns.com
 * @since      1.0.0
 *
 * @package    Wp_Cbf
 * @subpackage Wp_Cbf/admin/partials
 */
?>

<div class="wrap">

	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<h2 class="nav-tab-wrapper">
            <a href="#clean-up" class="nav-tab nav-tab-active"><?php _e('Clean up', $this->plugin_name);?></a>
            <a href="#images-settings" class="nav-tab"><?php _e('Images settings', $this->plugin_name);?></a>
            <a href="#privacy-settings" class="nav-tab"><?php _e('Privacy settings', $this->plugin_name);?></a>
            <a href="#admin-custom" class="nav-tab"><?php _e('Admin Customizations', $this->plugin_name);?></a>
            <a href="#smtp" class="nav-tab"><?php _e('Smtp Settings', $this->plugin_name);?></a>
	</h2>

	<form method="post" name="cleanup_options" action="options.php">
		<?php
			// /*
			// * Grab all value if already set
			// *
			// */
			$options = get_option($this->plugin_name);
    
      global $menu;

			// Cleanup
			$cleanup = $options['cleanup'];
			$comments_css_cleanup = $options['comments_css_cleanup'];
			$gallery_css_cleanup = $options['gallery_css_cleanup'];
			$body_class_slug = $options['body_class_slug'];
			$prettify_search = $options['prettify_search'];
			$css_js_versions = $options['css_js_versions'];
			$jquery_cdn = $options['jquery_cdn'];
			$cdn_provider = $options['cdn_provider'];
			$hide_admin_bar = $options['hide_admin_bar'];
			$write_log_fn = $options['write_log_fn'];
			$yoast_comments_cleanup = $options['yoast_comments_cleanup'];

			// Images
			$inline_wp_caption = $options['inline_wp_caption'];
			$images_attributes = $options['images_attributes'];
			$images_wh = $options['images_wh'];
			$svg_support = $options['svg_support'];
			$images_figure_wrap = $options['images_figure_wrap'];
			$retina_support = $options['retina_support'];
			$add_retina_js = $options['add_retina_js'];
			$new_images_size = $options['new_images_size'];
			$images_size_arr = $options['images_size_arr'];
			// array_push($images_size_arr, $options['images_size_arr']);
			$gallery_images_size = $options['gallery_images_size'];

			// Privacy
			$referrer_meta = $options['referrer_meta'];
			$referrer_meta_value = $options['referrer_meta_value'];

			// Admin Customizations
			$login_logo_id = $options['login_logo_id'];
                        $login_logo = wp_get_attachment_image_src( $login_logo_id, 'thumbnail');
                        $login_logo_url = $login_logo[0];
			$login_logo_link = $options['login_logo_link'];
			$login_background_color = $options['login_background_color'];
			$login_button_primary_color = $options['login_button_primary_color'];
			$remove_admin_bar_icon = $options['remove_admin_bar_icon'];
      $menu_items = (isset($options['admin_menu_items'])) ? wp_parse_args($options['admin_menu_items'], $menu) : $menu ;      
      $all_menu_items = array();
      foreach($menu_items as $menu_item_key => $menu_item_val){
        if(isset($menu_item_val[0])){
          $all_menu_items[$menu_item_key] = $menu_item_val;
          $all_menu_items[$menu_item_key]['hidden'] = (isset($menu_items[$menu_item_key]['hidden'])) ? 1 : 0;
        }
      }
			$admin_footer_text  = $options['admin_footer_text'];

      // Smtp Support
      $smtp_support = $options['smtp_support'];
      $smtp_from_name = $options['smtp_from_name'];
      $smtp_from_email = $options['smtp_from_email'];
      $smtp_port = $options['smtp_port'];
      $smtp_host = $options['smtp_host'];
      $smtp_encryption = $options['smtp_encryption'];
      $smtp_authentication = $options['smtp_authentication'];
      $smtp_username = $options['smtp_username'];
      $smtp_password = $options['smtp_password'];

			/*
			* Set up hidden fields
			*
			*/
			settings_fields($this->plugin_name);
                        do_settings_sections($this->plugin_name);


		 // Include tabs partials
			require_once('wp-cbf-cleanup_settings.php');
			require_once('wp-cbf-images_settings.php');
			require_once('wp-cbf-privacy_settings.php');
			require_once('wp-cbf-admin_settings.php');
			require_once('wp-cbf-smtp.php');
		?>

		<p class="submit">
            <?php submit_button(__('Save all changes', $this->plugin_name), 'primary','submit', TRUE); ?>
        </p>

    </form>

</div>
