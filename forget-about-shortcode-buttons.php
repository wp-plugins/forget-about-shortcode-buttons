<?php
/*
Plugin Name: Forget About Shortcode Buttons
Plugin URI: http://www.designsandcode.com/551/wordpress-forget-about-shortcode-buttons/
Description: A visual way to add CSS buttons in the post editor screen.
Author: Designs & Code
Author URI: http://www.designsandcode.com/
License: GPL v3
Version: 1.0.3
Text Domain: fascbuttons
*/

/*
* Set up Plugin Globals
*/
if (!defined('FASC_BUTTONS_VERSION_NUM'))
    define('FASC_BUTTONS_VERSION_NUM', '1.0.3');
	
if (!defined('PLUGIN_SLUG'))
    define('PLUGIN_SLUG', 'fasc-buttons');

if (!defined('FASC_BUTTONS_THEME_DIR'))
    define('FASC_BUTTONS_THEME_DIR', ABSPATH . 'wp-content/themes/' . get_template());

if (!defined('FASC_BUTTONS_PLUGIN_NAME'))
    define('FASC_BUTTONS_PLUGIN_NAME', trim(dirname(plugin_basename(__FILE__)), '/'));

if (!defined('FASC_BUTTONS_PLUGIN_DIR'))
    define('FASC_BUTTONS_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . FASC_BUTTONS_PLUGIN_NAME);

if (!defined('FASC_BUTTONS_PLUGIN_URL'))
    define('FASC_BUTTONS_PLUGIN_URL', WP_PLUGIN_URL . '/' . FASC_BUTTONS_PLUGIN_NAME);

if (!defined('FASC_BUTTONS_BASENAME'))
    define('FASC_BUTTONS_BASENAME', plugin_basename(__FILE__));

if (!defined('FASC_BUTTONS_VERSION_KEY'))
    define('FASC_BUTTONS_VERSION_KEY', 'fascbuttons_version');


add_option(FASC_BUTTONS_VERSION_KEY, FASC_BUTTONS_VERSION_NUM);


/*
* Set up Plugin Globals
*/
if ( ! class_exists( 'FascButtons' ) )
{
	class FascButtons
	{
		private $has_form_posted = false;

		public function __construct()
		{			
			//admin styles
			add_action( 'admin_enqueue_scripts', array($this, 'fasc_admin_styles') );
			add_filter( 'mce_css', array($this,'plugin_mce_css') );
			
			//admin script
			add_action('init', array($this,'tiny_mce_fasc_button'));
			
			//regular styles
			add_action( 'wp_print_styles', array($this, 'fasc_fe_styles') );
			
		}
		public function fasc_fe_styles()
		{
			wp_enqueue_style( 'fasc-buttons-style', plugins_url( '/assets/css/button-styles.css' , __FILE__ ) );
			wp_enqueue_style( 'font-awesome-style', plugins_url( '/assets/css/font-awesome.min.css' , __FILE__ ) );
		}
		public function fasc_admin_styles()
		{
			wp_enqueue_style( 'fasc-buttons-style', plugins_url( '/assets/css/fasc-buttons.css' , __FILE__ ) );
		}
		
		public function plugin_mce_css( $mce_css )
		{
			if ( ! empty( $mce_css ) )
				$mce_css .= ',';

			$mce_css .= plugins_url( '/assets/css/custom-editor-style.css' , __FILE__ );
			
			return $mce_css;
		}
		
		public function add_mce_plugin( $plugin_array )
		{
		   $plugin_array["fascbuttons"] = plugins_url( '/assets/js/'.PLUGIN_SLUG.'/scripts.js' , __FILE__ );
		   return $plugin_array;
		}

		public function tiny_mce_fasc_button()
		{

		   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		   {
			  return;
		   }

		   if ( get_user_option('rich_editing') == 'true' )
		   {
			  add_filter( 'mce_external_plugins', array($this, 'add_mce_plugin') );
			  add_filter( 'mce_buttons', array($this, 'register_button') );
		   }

		}
		
		public function register_button( $buttons )
		{
		   array_push( $buttons, "|", 'fascbuttons' );
		   return $buttons;
		}
	}
}

if ( class_exists( 'FascButtons' ) )
{
	global $FascButtons;
	$FascButtons = new FascButtons();
}



