<?php

/**
 * Partial of the privacy settings | Cookies banner, noreferrer meta
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

<div id="privacy-settings" class="wrap metabox-holder columns-2 wp_cbf-metaboxes hide">

	<h2><?php esc_attr_e( 'Extra privacy settings', $this->plugin_name ); ?></h2>

	<!-- wrap images in <figure> tags -->
	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Add a meta tag for referrer', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->options_slug;?>-referrer_meta">
			<input type="checkbox" id="<?php echo $this->options_slug;?>-referrer_meta" name="<?php echo $this->options_slug;?>[referrer_meta]" class="show-child-if-checked" value="1" <?php if($referrer_meta == '1') echo 'checked';?>/>
			<span><?php esc_attr_e('Add a meta tag for referrer', $this->plugin_name);?></span>
		</label>
		<fieldset class="referrer-select <?php if($referrer_meta == '0') echo 'hide'; ?>">
			<legend class="screen-reader-text"><span><?php _e('Choose one of the value below for the referrer meta', $this->plugin_name);?></span></legend>
				<h4><?php esc_attr_e('Choose one of the value below for the referrer meta, for more info check', $this->plugin_name);?> <a href="http://w3c.github.io/webappsec/specs/referrer-policy/#referrer-policy-delivery-meta"><?php esc_attr_e('W3C page about Referrer meta tag', $this->plugin_name);?></a></h4>
				<select name="<?php echo $this->options_slug;?>[referrer_meta_value]">
					<option value="no-referrer" <?php if($referrer_meta_value == 'no-referrer') echo 'selected';?>>No Referrer</option>
					<option value="origin" <?php if($referrer_meta_value == 'origin') echo 'selected';?>>Origin</option>
					<option value="no-referrer-when-downgrade" <?php if($referrer_meta_value == 'no-referrer-when-downgrade') echo 'selected';?>>No Referrer When Downgrade</option>
					<option value="origin-when-crossorigin" <?php if($referrer_meta_value == 'origin-when-crossorigin') echo 'selected';?>>Origin When Cross Origin</option>
					<option value="unsafe-url" <?php if($referrer_meta_value == 'unsafe-url') echo 'selected';?>>Unsafe Url</option>
				</select>
		</fieldset>
	</fieldset>
</div>
