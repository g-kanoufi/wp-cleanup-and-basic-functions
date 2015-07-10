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
	    <a href="#clean-up" class="nav-tab nav-tab-active">Clean up</a>
	    <a href="#images-settings" class="nav-tab">Images settings</a>
	     <a href="#privacy-settings" class="nav-tab">Privacy settings</a>
	    <a href="#admin-custom" class="nav-tab">Admin Customizations</a>
	</h2>

	<form method="post" name="cleanup_options" action="options.php">
		<?php
			// /*
			// * Grab all value if already set
			// *
			// */
			$options = get_option($this->options_slug);

			// Cleanup
			$cleanup = $options['cleanup'];
			$comments_css_cleanup = $options['comments_css_cleanup'];
			$gallery_css_cleanup = $options['gallery_css_cleanup'];
			$body_class_slug = $options['body_class_slug'];
			$prettify_search = $options['prettify_search'];
			$css_js_versions = $options['css_js_versions'];
			$jquery_cdn = $options['jquery_cdn'];
			$hide_admin_bar = $options['hide_admin_bar'];
			$write_log_fn = $options['write_log_fn'];
			$yoast_comments_cleanup = $options['yoast_comments_cleanup'];

			// Images
			$inline_wp_caption = $options['inline_wp_caption'];
			$images_attributes = $options['images_attributes'];
			$images_wh = $options['images_wh'];
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
			$login_logo = $options['login_logo'];
			$login_logo_link = $options['login_logo_link'];
			$login_background_color = $options['login_background_color'];
			$login_button_primary_color = $options['login_button_primary_color'];
			$remove_admin_bar_icon = $options['remove_admin_bar_icon'];
			$admin_footer_text  = $options['admin_footer_text'];
			/*
			* Set up hidden fields
			*
			*/
			settings_fields($this->options_slug);


		 // Include tabs partials
			require_once('wp-cbf-cleanup_settings.php');
			require_once('wp-cbf-images_settings.php');
			require_once('wp-cbf-privacy_settings.php');
			require_once('wp-cbf-admin_settings.php');
		?>

		<p class="submit">
            <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>
        </p>

    </form>

</div>
