<?php

/**
 * Partial of the clean up settings
 *
 *
 *
 * @link       http://lostwebdesigns.com
 * @since      1.0.0
 *
 * @package    Wp_Cbf
 * @subpackage Wp_Cbf/admin/partials
 */
?>

<div id="clean-up" class="wrap metabox-holder columns-2 wp_cbf-metaboxes">

	<h2><?php esc_attr_e( 'Cleanup and basic functionalities', $this->plugin_name ); ?></h2>

	<!-- remove some meta and generators from the <head> -->
	<fieldset>
        <legend class="screen-reader-text"><span><?php _e('Clean WordPress head section', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-cleanup">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-cleanup" name="<?php echo $this->plugin_name;?>[cleanup]" value="1" <?php checked( $cleanup, 1 ); ?> />
			<span><?php esc_attr_e( 'Clean up the head section', $this->plugin_name ); ?></span>
		</label>
	</fieldset>

	<!-- remove injected CSS from comments widgets -->
	<fieldset>
        <legend class="screen-reader-text"><span><?php _e('Remove Injected CSS for comment widget', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-comments_css_cleanup">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-comments_css_cleanup" name="<?php echo $this->plugin_name;?>[comments_css_cleanup]" value="1" <?php checked($comments_css_cleanup , 1);?>/>
			<span><?php esc_attr_e( 'Remove Injected CSS for comment widget', $this->plugin_name ); ?></span>
		</label>
	</fieldset>

	<!-- remove injected CSS from gallery -->
	<fieldset>
                <legend class="screen-reader-text"><span><?php _e('Remove Injected CSS for galleries', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-gallery_css_cleanup">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-gallery_css_cleanup" name="<?php echo $this->plugin_name;?>[gallery_css_cleanup]" value="1" <?php checked($gallery_css_cleanup, 1);?>/>
			<span><?php esc_attr_e( 'Remove Injected CSS for galleries', $this->plugin_name ); ?></span>
		</label>
	</fieldset>

	<!-- add post,page or product slug class to body class -->
	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Add Post, page or product slug to body class', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-body_class_slug">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-body_class_slug" name="<?php echo $this->plugin_name;?>[body_class_slug]" value="1" <?php checked($body_class_slug, 1);?>/>
			<span><?php esc_attr_e('Add Post slug to body class', $this->plugin_name);?></span>
		</label>
	</fieldset>

	<!-- prettify search -->
	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Prettify search url - http://yourwebsite/search/search_terms/', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-prettify_search">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-prettify_search" name="<?php echo $this->plugin_name;?>[prettify_search]" value="1" <?php checked($prettify_search, 1);?>/>
			<span><?php esc_attr_e('Make search url pretty(ex: http://yourwebsite/search/search_terms/)', $this->plugin_name);?></span>
		</label>
	</fieldset>

	<!-- remove css and js query string versions -->
	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Remove CSS and JS files query string versions', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-css_js_versions">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-css_js_versions" name="<?php echo $this->plugin_name;?>[css_js_versions]" value="1" <?php checked($css_js_versions, 1);?>/>
			<span><?php esc_attr_e('Remove CSS and JS versions (uncheck for dev)', $this->plugin_name);?></span>
		</label>
	</fieldset>


	<!-- load jQuery from CDN -->
	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Load jQuery from CDN instead of the basic wordpress script', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-jquery_cdn">
			<input type="checkbox" class="show-child-if-checked" id="<?php echo $this->plugin_name;?>-jquery_cdn" name="<?php echo $this->plugin_name;?>[jquery_cdn]" value="1" <?php checked($jquery_cdn, 1);?>/>
			<span><?php esc_attr_e('Load jQuery from CDN', $this->plugin_name);?></span>
		</label>
                <fieldset class="<?php if( '1' != $jquery_cdn ) echo 'hidden';?>" >
                <p><?php _e('You can choose your own cdn provider and jQuery version(default will be Google Cdn and version 1.11.1)-Recommended CDN are <a href="https://cdnjs.com/libraries/jquery">CDNjs</a>, <a href="https://code.jquery.com/jquery/">jQuery official CDN</a>, <a href="https://developers.google.com/speed/libraries/#jquery">Google CDN</a> and <a href="http://www.asp.net/ajax/cdn#jQuery_Releases_on_the_CDN_0">Microsoft CDN</a>', $this->plugin_name);?></p>
                    <legend class="screen-reader-text"><span><?php _e('Choose your prefered cdn provider', $this->plugin_name);?></span></legend>
                    <input type="url" class="regular-text" id="<?php echo $this->plugin_name;?>-cdn_provider" name="<?php echo $this->plugin_name;?>[cdn_provider]" value="<?php if(!empty($cdn_provider)) echo $cdn_provider;?>"/>
                </fieldset>
	</fieldset>

	<!-- Hide Admin Bar -->
	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Hide Admin Bar on the Front-end', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-hide_admin_bar">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-hide_admin_bar" name="<?php echo $this->plugin_name;?>[hide_admin_bar]" value="1" <?php checked( $hide_admin_bar, 1);?>/>
			<span><?php esc_attr_e('Hide Admin Bar', $this->plugin_name);?></span>
		</label>
	</fieldset>

	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Create write_log() function to log errors in debug.log file (WP_DEBUG_LOG must be set to true)', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-write_log_fn">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-write_log_fn" name="<?php echo $this->plugin_name;?>[write_log_fn]" value="1" <?php checked($write_log_fn, 1);?>/>
			<span><?php esc_attr_e('Create write_log() function to log errors in debug.log file , note: WP_DEBUG_LOG must be set to true. Use it as follow: write_log("your debug message") ', $this->plugin_name);?></span>
		</label>
	</fieldset>

	<?php	if (defined('WPSEO_VERSION')):?>
		<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Get rid of YOAST SEO plugin comments in head', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-yoast_comments_cleanup">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-yoast_comments_cleanup" name="<?php echo $this->plugin_name;?>[yoast_comments_cleanup]" value="1" <?php checked($yoast_comments_cleanup, 1);?>/>
			<span><?php esc_attr_e('Get rid of YOAST SEO plugin comments in head', $this->plugin_name);?></span>
		</label>
	</fieldset>
	<?php endif;?>
</div>
