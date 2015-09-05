<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://lostwebdesigns.com
 * @since      1.0.0
 *
 * @package    Wp_Cbf
 * @subpackage Wp_Cbf/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Cbf
 * @subpackage Wp_Cbf/public
 * @author     Guillaume Kanoufi <guillaume@lostwebdesigns.com>
 */
class Wp_Cbf_Public {

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
		$this->wp_cbf_options = get_option($this->plugin_name);


	}


	/**
	 * Cleanup functions depending on each checkbox returned value in admin
	 *
	 * @since    1.0.0
	 */
	// Cleanup head
	public function wp_cbf_cleanup() {

		if(!empty($this->wp_cbf_options['cleanup'])){


			remove_action( 'wp_head', 'rsd_link' );                 // RSD link
			remove_action( 'wp_head', 'feed_links_extra', 3 );            // Category feed link
			remove_action( 'wp_head', 'feed_links', 2 );                // Post and comment feed links
			remove_action( 'wp_head', 'index_rel_link' );
			remove_action( 'wp_head', 'wlwmanifest_link' );
			remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );        // Parent rel link
			remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );       // Start post rel link
			remove_action( 'wp_head', 'rel_canonical', 10, 0 );
			remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
			remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Adjacent post rel link
			remove_action( 'wp_head', 'wp_generator' );               // WP Version
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );


		}
	}
	//Cleanup head
	public function wp_cbf_remove_rss_version() {
		return '';
	}
	// Cleanup head
	public function wp_cbf_remove_x_pingback($headers) {
		if(!empty($this->wp_cbf_options['cleanup'])){
			unset($headers['X-Pingback']);
			return $headers;
		}
	}

	// Remove Comment inline CSS
	public function wp_cbf_remove_comments_inline_styles() {
		if(!empty($this->wp_cbf_options['comments_css_cleanup'])){
			global $wp_widget_factory;
			if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
				remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
			}

			if ( isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments']) ) {
				remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
			}
		}
	}

	// Remove gallery inline CSS
	public function wp_cbf_remove_gallery_styles($css) {
		if(!empty($this->wp_cbf_options['gallery_css_cleanup'])){
			return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
		}

	}


	// Add post/page slug
	public function wp_cbf_body_class_slug( $classes ) {
		if(!empty($this->wp_cbf_options['body_class_slug'])){
			global $post;
			if(is_singular()){
				$classes[] = $post->post_name;
			}
		}
                return $classes;
	}

	// Prettify search
	public function wp_cbf_prettify_search_redirect() {
		if(!empty($this->wp_cbf_options['prettify_search'])){
			global $wp_rewrite;
			if ( !isset( $wp_rewrite ) || !is_object( $wp_rewrite ) || !$wp_rewrite->using_permalinks() ) return;

			$search_base = $wp_rewrite->search_base;
			if ( is_search() && !is_admin() && strpos( $_SERVER['REQUEST_URI'], "/{$search_base}/" ) === false ) {
				wp_redirect( home_url( "/{$search_base}/" . urlencode( get_query_var( 's' ) ) ) );
				exit();
			}
		}
	}

	// Remove  CSS and JS query strings versions
	public function wp_cbf_remove_cssjs_ver( ) {
		if(!empty($this->wp_cbf_options['css_js_versions'])){
			function wp_cbf_remove_cssjs_ver_filter($src ){
				 if( strpos( $src, '?ver=' ) ) $src = remove_query_arg( 'ver', $src );
				 return $src;
			}
			add_filter( 'style_loader_src', 'wp_cbf_remove_cssjs_ver_filter', 10, 2 );
			add_filter( 'script_loader_src', 'wp_cbf_remove_cssjs_ver_filter', 10, 2 );
		}
	}

	// Load jQuery from CDN if available
	public function wp_cbf_cdn_jquery(){
		if(!empty($this->wp_cbf_options['jquery_cdn'])){
			if(!is_admin()){
                            if(!empty($this->wp_cbf_options['cdn_provider'])){
                                $link = $this->wp_cbf_options['cdn_provider'];
                            }else{
                                $link = 'http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js';
                            }
                            $try_url = @fopen($link,'r');
                            if( $try_url !== false ) {
                                wp_deregister_script( 'jquery' );
                                wp_register_script('jquery', $link, array(), null, false);
                            }
			}
		}
	}

	// Hide Admin Bar
	public function wp_cbf_remove_admin_bar(){
		if(!empty($this->wp_cbf_options['hide_admin_bar'])){
			add_filter('show_admin_bar', '__return_false');
		}
	}

	// Use write_log() function
	public function wp_cbf_write_log(){
		if(!empty($this->wp_cbf_options['write_log_fn'])){
			if ( ! function_exists('write_log')) {
				function write_log ( $log )  {
					if ( is_array( $log ) || is_object( $log ) ) {
						error_log( print_r( $log, true ) );
					} else {
						error_log( $log );
					}
				}
			}

		}
	}

	// Remove YOAST SEO head comments - Only if yoast is activated
	public function wp_cbf_yoast_comments_cleanup(){
		if(!empty($this->wp_cbf_options['yoast_comments_cleanup'])){
			if (defined('WPSEO_VERSION')){
			  add_action('get_header',function (){ ob_start(function ($o){
			  return preg_replace('/\n?<.*?yoast.*?>/mi','',$o); }); });
			  add_action('wp_head',function (){ ob_end_flush(); }, 999);
			}
		}
	}

	/**
	 * Images setup function depending on each checkbox returned value in admin
	 *
	 * @since    1.0.0
	 */

	// Wrap images with figure tag - Credit: Robert O'Rourke - http://bit.ly/1q0WHFs
	public function wp_cbf_img_unautop_figure($content){
		if(!empty($this->wp_cbf_options['images_figure_wrap'])){
				if( is_singular() && is_main_query() ) {
					$content = preg_replace( '/<p>\\s*?(<a .*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s', '<figure>$1</figure>', $content );
				}
		}
		return $content;
	}


	// Remove inline wp caption CSS
	public function wp_cbf_remove_caption_inline_css(){
		if(!empty($this->wp_cbf_options['inline_wp_caption'])){
			if ( ! function_exists( 'wp_cbf_fixed_img_caption_shortcode' ) ) :
				add_shortcode( 'wp_caption', 'wp_cbf_fixed_img_caption_shortcode' );
				add_shortcode( 'caption', 'wp_cbf_fixed_img_caption_shortcode' );
				function wp_cbf_fixed_img_caption_shortcode($attr, $content = null) {
					if ( !isset( $attr['caption'] ) ) {
						if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
						    $content = $matches[1];
						    $attr['caption'] = trim( $matches[2] );
						}
					}
					$output = apply_filters( 'img_caption_shortcode', '', $attr, $content );
					if ( '' != $output ) {
						return $output; }
					extract(shortcode_atts(array(
						'id'    => '',
						'align' => 'alignnone',
						'width' => '',
						'caption' => '',
						'class'   => '',
					), $attr));
					if ( 1 > (int) $width || empty($caption) ) {
					             return $content;
					}
					$markup = '<figure';
					if ( $id ) { $markup .= ' id="' . esc_attr( $id ) . '"'; }
					if ( $class ) { $markup .= ' class="' . esc_attr( $class ) . '"'; }
					$markup .= '>';
					$markup .= do_shortcode( $content ) . '<figcaption>' . $caption . '</figcaption></figure>';
					return $markup;
				}
			endif;
		}
	}


	// Clean the output of attributes of images in editor
	public function wp_cbf_image_tag_class($class, $id, $align, $size) {
		if(!empty($this->wp_cbf_options['images_attributes'])){
			$align = 'align' . esc_attr( $align );
			return $align;
		}
	}


	// Break add media in post editor - Removed - Remove width and height in editor, for a better responsive world.
	/*public function wp_cbf_image_editor($html, $id, $alt, $title) {*/
		//if(!empty($this->wp_cbf_options['images_wh'])){
			//return preg_replace(
			//array(
				     //'/\s+width="\d+"/i',
				     //'/\s+height="\d+"/i',
				     //'/alt=""/i',
			//),
			//array(
				     //'',
				//'',
				//'',
				//'alt="' . $title . '"',
			//),
			//$html);
		//}
	/*}*/







	// Retina images
	public function wp_cbf_retina_support_attachment_meta( $metadata, $attachment_id ) {
		if(!empty($this->wp_cbf_options['retina_support'])){
		/**
		 * Retina images
		 *
		 * This function is attached to the 'wp_generate_attachment_metadata' filter hook.
		 */

			foreach ( $metadata as $key => $value ) {
				if ( is_array( $value ) ) {
					foreach ( $value as $image => $attr ) {
						if ( is_array( $attr ) ) $this->wp_cbf_retina_support_create_images( get_attached_file( $attachment_id ), $attr['width'], $attr['height'], true );
					}
				}
			}
		}
		return $metadata;
	}


	/**
	 * Create retina-ready images
	 *
	 * Referenced via retina_support_attachment_meta().
	 */
	private function wp_cbf_retina_support_create_images( $file, $width, $height, $crop = false ) {
		if ( $width || $height ) {
			$resized_file = wp_get_image_editor( $file );
			if ( ! is_wp_error( $resized_file ) ) {
				$filename = $resized_file->generate_filename( $width . 'x' . $height . '@2x' );

				$resized_file->resize( $width * 2, $height * 2, $crop );
				$resized_file->save( $filename );

				$info = $resized_file->get_size();

				return array(
					'file' => wp_basename( $filename ),
					'width' => $info['width'],
					'height' => $info['height'],
				);
			}
		}
		return false;
	}


	/**
	 * Delete retina-ready images
	 *
	 * This function is attached to the 'delete_attachment' filter hook.
	 */
	public function wp_cbf_delete_retina_support_images( $attachment_id ) {
		$meta = wp_get_attachment_metadata( $attachment_id );
		$upload_dir = wp_upload_dir();
		$path = pathinfo( $meta['file'] );
		foreach ( $meta as $key => $value ) {
			if ( 'sizes' === $key ) {
				foreach ( $value as $sizes => $size ) {
					$original_filename = $upload_dir['basedir'] . '/' . $path['dirname'] . '/' . $size['file'];
					$retina_filename = substr_replace( $original_filename, '@2x.', strrpos( $original_filename, '.' ), strlen( '.' ) );
					if ( file_exists( $retina_filename ) )
						unlink( $retina_filename );
				}
			}
		}
	}
	// Add 	Retina.js script fron cdn
	public function wp_cbf_add_retinajs_script(){
		if(!empty($this->wp_cbf_options['add_retina_js'])){
			wp_enqueue_script('retinajs', '//cdnjs.cloudflare.com/ajax/libs/retina.js/1.3.0/retina.min.js', array('jquery'), null, true);
		}
	}


	// Add new images size
	public function wp_cbf_add_images_size(){
		if(is_array($this->wp_cbf_options['images_size_arr'])):
			foreach($this->wp_cbf_options['images_size_arr'] as $images_size_name => $images_size):
				$images_size_w =  $images_size['width'];
				$images_size_h =  $images_size['height'];
				$images_size_c =  ($images_size['crop'] == 1) ? true : false;
				add_image_size( $images_size_name, $images_size_w, $images_size_h, $images_size_c );

			endforeach;
		endif;
	}

	// Add new image sizes to media size selection menu
	public function wp_cbf_image_size_names_choose( $sizes ) {
		if(is_array($this->wp_cbf_options['images_size_arr'])):
			foreach($this->wp_cbf_options['images_size_arr'] as $images_size_name => $images_size):
				$sizes[$images_size_name] = $images_size['name'];
			endforeach;
		endif;
		return $sizes;
	}


	//Add gallery image size to default gallery
	public function wp_cbf_gallery_image_size( $output, $attr ) {
		if(null != $this->wp_cbf_options['gallery_images_size']){
			extract(shortcode_atts(array(
				'size' => $this->wp_cbf_options['gallery_images_size'],
			), $attr));
		}
		return $output;
	}


	/*
	*
	* Privacy
	*
	 */
	public function wp_cbf_referrer_meta(){
		if(!empty($this->wp_cbf_options['referrer_meta'])){
			$referrer_meta_value = $this->wp_cbf_options['referrer_meta_value'];
			echo '<meta name="referrer" content="'.$referrer_meta_value.'">';
		}
	}

}
