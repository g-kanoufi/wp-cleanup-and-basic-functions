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

<div id="admin-custom" class="wrap metabox-holder columns-2 wp_cbf-metaboxes hidden">

	<h2><?php esc_attr_e( 'Customize the login page and the admin', $this->plugin_name ); ?></h2>
        <p><?php _e('Add logo to login form change buttons color, disable admin bar on front-end, etc...', $this->plugin_name);?></p>

	<!-- add your log to login -->
	<fieldset>
		<legend class="screen-reader-text"><span><?php esc_attr_e('Login Logo', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-login_logo">
			<input type="hidden" id="login_logo_id" name="<?php echo $this->plugin_name;?>[login_logo_id]" value="<?php echo $login_logo_id; ?>" />
			<input id="upload_login_logo_button" type="button" class="button <?php if(!empty($login_logo_id)) echo ' hidden';?>" value="<?php _e( 'Upload Logo', $this->plugin_name); ?>" />
			<span><?php esc_attr_e('Login Logo', $this->plugin_name);?></span>
		</label>
		<div id="upload_logo_preview" class="wp_cbf-upload-preview <?php if(empty($login_logo_id)) echo 'hidden';?>">
			<img src="<?php echo $login_logo_url ; ?>" />
			<button id="wp_cbf-delete_logo_button" class="wp_cbf-delete-image">X</button>
		</div>
	</fieldset>
	<!-- login logo link to homepage instead of wordpress.org -->
	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Link Login Logo to homepage instead of WordPress.org', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-login_logo_link">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-login_logo_link" name="<?php echo $this->plugin_name;?>[login_logo_link]" value="1" <?php checked($login_logo_link, 1);?>/>
			<span><?php esc_attr_e('Link Login Logo to homepage instead of WordPress.org', $this->plugin_name);?></span>
		</label>
	</fieldset>

	<!-- login background color-->
	<fieldset class="wp_cbf-admin-colors">
		<legend class="screen-reader-text"><span><?php _e('Login Background Color', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-login_background_color">
			<input type="text" class="<?php echo $this->plugin_name;?>-color-picker" id="<?php echo $this->plugin_name;?>-login_background_color" name="<?php echo $this->plugin_name;?>[login_background_color]" value="<?php echo $login_background_color;?>" />
			<span><?php esc_attr_e('Login Background Color', $this->plugin_name);?></span>
		</label>
	</fieldset>
	<!-- login buttons and links primary color-->
	<fieldset class="wp_cbf-admin-colors">
		<legend class="screen-reader-text"><span><?php _e('Login Button and Links Color', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-login_button_primary_color">
			<input type="text" class="<?php echo $this->plugin_name;?>-color-picker" id="<?php echo $this->plugin_name;?>-login_button_primary_color" name="<?php echo $this->plugin_name;?>[login_button_primary_color]" value="<?php echo $login_button_primary_color;?>" />
			<span><?php esc_attr_e('Login Button and Links Color', $this->plugin_name);?></span>
		</label>
	</fieldset>
	<!-- Remove wp icon from admin bar -->
	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Remove WordPress Icon from admin bar', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-remove_admin_bar_icon">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-remove_admin_bar_icon" name="<?php echo $this->plugin_name;?>[remove_admin_bar_icon]" value="1" <?php checked($remove_admin_bar_icon, 1);?>/>
			<span><?php esc_attr_e('Remove WordPress Icon from admin bar', $this->plugin_name);?></span>
		</label>
	</fieldset>
	<!-- Change WordPress admin footer text -->
	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Change Admin footer text with your own', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-admin_footer_text">
			<span><?php esc_attr_e('Change Admin footer text with your own', $this->plugin_name);?></span>
		</label><br/>
		<input type="text" class="regular-text" id="<?php echo $this->plugin_name;?>-admin_footer_text" name="<?php echo $this->plugin_name;?>[admin_footer_text]" value="<?php if(!empty($admin_footer_text)) esc_attr_e($admin_footer_text, $this->plugin_name);?>" placeholder="<?php esc_attr_e('Theme created for your awesome business', $this->plugin_name);?>" />
	</fieldset>

</div>
