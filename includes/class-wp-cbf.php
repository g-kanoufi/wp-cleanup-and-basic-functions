<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://lostwebdesigns.com
 * @since      1.0.0
 *
 * @package    Wp_Cbf
 * @subpackage Wp_Cbf/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wp_Cbf
 * @subpackage Wp_Cbf/includes
 * @author     Guillaume Kanoufi <guillaume@lostwebdesigns.com>
 */
class Wp_Cbf {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wp_Cbf_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Unique identifier for your plugin options.
	 *
	 *
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	private $options_slug;


	/**
	 * Default Settings Values.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	private $options_data;


	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'wp-cbf';
		$this->version = '2.1.0';
		$this->plugin_screen_hook_suffix = null;
		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wp_Cbf_Loader. Orchestrates the hooks of the plugin.
	 * - Wp_Cbf_i18n. Defines internationalization functionality.
	 * - Wp_Cbf_Admin. Defines all hooks for the admin area.
	 * - Wp_Cbf_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-cbf-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-cbf-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-cbf-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-cbf-public.php';

		$this->loader = new Wp_Cbf_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wp_Cbf_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Wp_Cbf_i18n();
		$plugin_i18n->set_domain( $this->get_plugin_name() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Wp_Cbf_Admin( $this->get_plugin_name(), $this->get_version()) ;

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_plugin_admin_menu' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'options_update');

		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_name . '.php' );
                //write_log($plugin_basename);
		$this->loader->add_filter( 'plugin_action_links_' . $plugin_basename, $plugin_admin, 'add_action_links' );


		// Images / Media Uploader
		$this->loader->add_filter('upload_mimes', $plugin_admin, 'wp_cbf_svg_support');
		$this->loader->add_action('admin_head', $plugin_admin, 'wp_cbf_fix_svg_thumb_display');

		//Admin Customizations
		$this->loader->add_action( 'login_headerurl', $plugin_admin, 'wp_cbf_login_logo_link' );
		$this->loader->add_action( 'login_headertitle', $plugin_admin, 'wp_cbf_login_logo_headertitle' );
		$this->loader->add_action( 'login_enqueue_scripts', $plugin_admin, 'wp_cbf_admin_css' );
    $this->loader->add_action('admin_menu', $plugin_admin, 'wp_cbf_hide_admin_menu_items');

		$this->loader->add_filter( 'wp_before_admin_bar_render', $plugin_admin, 'wp_cbf_remove_wp_icon_from_admin_bar');
		$this->loader->add_filter( 'admin_footer_text', $plugin_admin, 'wp_cbf_admin_footer_text');

                // Smtp support
                $this->loader->add_action('phpmailer_init',$plugin_admin, 'wp_cbf_send_smtp_email');
                $this->loader->add_action('wp_ajax_wp_cbf_send_test_email', $plugin_admin, 'wp_cbf_send_test_email_callback');




	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Wp_Cbf_Public( $this->get_plugin_name(), $this->get_version());

		// $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		// $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		// Cleanup
		$this->loader->add_action( 'init', $plugin_public, 'wp_cbf_cleanup' );
		$this->loader->add_action( 'wp_loaded', $plugin_public, 'wp_cbf_remove_comments_inline_styles' );
		$this->loader->add_action( 'wp_loaded', $plugin_public, 'wp_cbf_remove_gallery_styles' );
		$this->loader->add_action( 'template_redirect', $plugin_public, 'wp_cbf_prettify_search_redirect' );
		$this->loader->add_action( 'after_setup_theme', $plugin_public, 'wp_cbf_remove_cssjs_ver');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'wp_cbf_cdn_jquery', PHP_INT_MAX);
		$this->loader->add_action( 'after_setup_theme', $plugin_public, 'wp_cbf_remove_admin_bar');
		$this->loader->add_action( 'init', $plugin_public, 'wp_cbf_write_log' );
		$this->loader->add_action( 'wp_loaded', $plugin_public, 'wp_cbf_yoast_comments_cleanup' );

		$this->loader->add_filter('the_generator', $plugin_public, 'wp_cbf_remove_rss_version');
		$this->loader->add_filter('wp_headers', $plugin_public, 'wp_cbf_remove_x_pingback');
		$this->loader->add_filter( 'body_class', $plugin_public, 'wp_cbf_body_class_slug' );

		//Images
		$this->loader->add_action( 'after_setup_theme', $plugin_public, 'wp_cbf_remove_caption_inline_css');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'wp_cbf_add_retinajs_script');
		$this->loader->add_action( 'after_setup_theme', $plugin_public, 'wp_cbf_add_images_size' );

		$this->loader->add_filter('the_content', $plugin_public, 'wp_cbf_img_unautop_figure');
		// Breaks add media in post - Removed - $this->loader->add_filter( 'get_image_tag', $plugin_public, 'wp_cbf_image_editor', 0, 4 );
		$this->loader->add_filter( 'get_image_tag_class', $plugin_public, 'wp_cbf_image_tag_class', 10, 4 );
		$this->loader->add_filter( 'wp_generate_attachment_metadata', $plugin_public, 'wp_cbf_retina_support_attachment_meta', 10, 2);
		$this->loader->add_filter( 'delete_attachment', $plugin_public, 'wp_cbf_delete_retina_support_images' );
		$this->loader->add_filter( 'image_size_names_choose', $plugin_public, 'wp_cbf_image_size_names_choose' );
		$this->loader->add_filter( 'post_gallery', $plugin_public, 'wp_cbf_gallery_image_size', 10, 2 );

		// Privacy
		$this->loader->add_action('wp_head', $plugin_public, 'wp_cbf_referrer_meta', 1);

                // SMTP


	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wp_Cbf_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
