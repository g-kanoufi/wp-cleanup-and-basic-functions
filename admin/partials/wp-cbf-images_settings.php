<?php

/**
 * Partial of the images settings
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

<div id="images-settings" class="wrap metabox-holder columns-2 wp_cbf-metaboxes hidden">

	<h2><?php esc_attr_e( 'Images specific functionalities', $this->plugin_name ); ?></h2>
        <p><?php _e('Clean up images and captions markup but also add images sizes and create retina ready images on upload', $this->plugin_name);?></p>

	<!-- wrap images in <figure> tags -->
	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Wrap images in figure tags', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-images_figure_wrap">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-images_figure_wrap" name="<?php echo $this->plugin_name;?>[images_figure_wrap]" value="1" <?php checked($images_figure_wrap, 1);?>/>
			<span><?php esc_attr_e('Wrap images with figure tags', $this->plugin_name);?></span>
		</label>
	</fieldset>

	<!-- remove inline css for images captions -->
	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Remove Inline CSS added to Images wp-caption', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-inline_wp_caption">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-inline_wp_caption" name="<?php echo $this->plugin_name;?>[inline_wp_caption]" value="1" <?php checked($inline_wp_caption, 1);?>/>
			<span><?php esc_attr_e('Remove wp-caption inline CSS', $this->plugin_name);?></span>
		</label>
	</fieldset>

	<!-- clean output of attributes of images -->
	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Clean output of images attributes in editor', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-images_attributes">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-images_attributes" name="<?php echo $this->plugin_name;?>[images_attributes]" value="1" <?php checked($images_attributes, 1);?>/>
			<span><?php esc_attr_e('Clean output of images attributes in editor', $this->plugin_name);?></span>
		</label>
	</fieldset>

	<!-- remove width and height in editor - Break editor add media - Removed -->
	<!-- fieldset>
		<legend class="screen-reader-text"><span><?php _e('Remove width and height in editor for better respoonsive images', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-images_wh">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-images_wh" name="<?php echo $this->plugin_name;?>[images_wh]" value="1" <?php checked($images_wh, 1);?>/>
			<span><?php esc_attr_e('Remove width and height in editor', $this->plugin_name);?></span>
		</label>
	</fieldset>

	<!-- allow svg upload to the media uploader  -->
	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Add svg upload capability to the Media Uploader (Thumbnail in list and grid won\'t show, but it\'s there)', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-svg_support">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-svg_support" name="<?php echo $this->plugin_name;?>[svg_support]" value="1" <?php checked($svg_support, 1);?>/>
			<span><?php esc_attr_e('Add svg upload capability to the Media Uploader (Thumbnail in list and grid won\'t show, but it\'s there)', $this->plugin_name);?></span>
		</label>
	</fieldset>

	<!-- add retina support - generate @2x images and add support to create delete those images -->
	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Add retina support', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-retina_support">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-retina_support" class="show-child-if-checked" name="<?php echo $this->plugin_name;?>[retina_support]" value="1" <?php checked($retina_support, 1);?>/>
			<span><?php esc_attr_e('Add retina support', $this->plugin_name);?></span>
		</label>
		<fieldset class="retina-js <?php if($retina_support != '1') echo 'hidden'; ?>">
			<legend class="screen-reader-text"><span><?php _e('Add retina js script to front end', $this->plugin_name);?></span></legend>
			<label for="<?php echo $this->plugin_name;?>-add_retina_js">
				<input type="checkbox" id="<?php echo $this->plugin_name;?>-add_retina_js" name="<?php echo $this->plugin_name;?>[add_retina_js]" value="1" <?php checked($add_retina_js, 1);?>/>
				<span><?php esc_attr_e('Add retina js script to front-end', $this->plugin_name);?></span>
			</label>
		</fieldset>
	</fieldset>

	<!-- Add images sizes -->
	<?php global $_wp_additional_image_sizes;
		  $img_sizes = get_intermediate_image_sizes();
		  $new_images_size_position = count($_wp_additional_image_sizes);
	?>

	<fieldset>
		<p><?php __( 'Add your new images size with desired width, height and hard cropping option', $this->plugin_name);?></p>
		<legend class="screen-reader-text"><span><?php _e('Add New Image sizes', $this->plugin_name);?></span></legend>
		<label for="<?php echo $this->plugin_name;?>-new_images_size">
			<input type="checkbox" id="<?php echo $this->plugin_name;?>-new_images_size" class="show-child-if-checked" name="<?php echo $this->plugin_name;?>[new_images_size]" value="1" <?php checked($new_images_size, 1);?>/>
			<span><?php esc_attr_e('Add New Image size', $this->plugin_name);?></span>
		</label>
		<fieldset class="new-images-size <?php if($new_images_size != '1') echo 'hidden'; ?>">
			<label for="<?php echo $this->plugin_name;?>-new_images_size_name">
				<input id="<?php echo $this->plugin_name;?>-new_images_size_name" name="<?php echo $this->plugin_name;?>[images_size][name]" type="text" placeholder="ex: blog_featured">
				<span><?php esc_attr_e('New Images size name', $this->plugin_name);?></span>
			</label>
			<br/>
			<label for="t<?php echo $this->plugin_name;?>-new_images_size_w">Width</label>
			<input name="<?php echo $this->plugin_name;?>[images_size][width]" type="number" step="1" min="0" id="<?php echo $this->plugin_name;?>-new_images_size_w" placeholder="500" class="small-text">
			<label for="<?php echo $this->plugin_name;?>-new_images_size_h">Height</label>
			<input name="<?php echo $this->plugin_name;?>[images_size][height]" type="number" step="1" min="0" id="<?php echo $this->plugin_name;?>-new_images_size_h" placeholder="300"  class="small-text">
			<br>
			<label for="<?php echo $this->plugin_name;?>-new_images_size_crop">
				<input name="<?php echo $this->plugin_name;?>[images_size][crop]" type="checkbox" id="<?php echo $this->plugin_name;?>-new_images_size_crop">
				<span><?php esc_attr_e('Crop thumbnail to exact dimensions (normally thumbnails are proportional)',  $this->plugin_name);?></span>
			</label>
		</fieldset>
		<fieldset class="existing-images-size-container <?php if($new_images_size_position < 2) echo 'hidden'; ?>">
                <h3><?php _e('Already Existing Images sizes', $this->plugin_name);?></h3>
                        <?php if(is_array($images_size_arr)):
                                foreach ($images_size_arr as $existing_images_size_name => $existing_images_size_values) :?>
				<?php if($existing_images_size_name != 'post-thumbnail'):?>
				<fieldset class="existing-images-size">
					<h4><?php echo $existing_images_size_name;?></h4>
					<label for="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_w">Width</label>
					<input name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][name]"
						type="hidden"
						value="<?php echo $existing_images_size_values['name'];?>"
					>
					<input name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][width]"
					            type="number"
					            step="1"
					            min="0"
					            id="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_w"
					            value="<?php echo $existing_images_size_values['width'];?>"
					            class="small-text"
					>
					<label for="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_h">Height</label>
					<input name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][height]"
						type="number"
						step="1"
						min="0"
						id="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_h"
						value="<?php echo $existing_images_size_values['height'];?>"
						class="small-text">
					<br>
					<label for="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_crop">
						<input name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop]"
						type="checkbox"
						id="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_crop"
						<?php checked($existing_images_size_values['crop'], 1);?> >
						<span><?php esc_attr_e('Crop thumbnail to exact dimensions (normally thumbnails are proportional)',  $this->plugin_name);?></span>
					</label>
				</fieldset>
				<?php endif;?>
			<?php endforeach;?>
                    <?php endif;?>
		</fieldset>
	</fieldset>

	<!-- Add one image size to default gallery -->
	<fieldset>
		<legend class="screen-reader-text"><span><?php _e('Add one of images sizes to default gallery', $this->plugin_name);?></span></legend>
		<h4><?php esc_attr_e('Add one of images sizes to default gallery', $this->plugin_name);?></h4>
		<select name="<?php echo $this->plugin_name;?>[gallery_images_size]">
			<option value="null" <?php selected($gallery_images_size, null);?>>Default (none)</option>
			<?php foreach ($img_sizes as $_size):
				if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {

                    $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
                    $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
                    $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );

                } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {

                        $sizes[ $_size ] = array(
                                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
                        );

                }
            ?>
			<option value="<?php echo $_size;?>" <?php selected($gallery_images_size, $_size);?>><?php echo $_size;?> - <?php echo $sizes[$_size]['width'];?>x<?php echo $sizes[$_size]['height'];?></option>
			<?php endforeach;?>
		</select>
	</fieldset>
</div>
