<?php
/*
Plugin Name: Forget About Shortcode Buttons
Plugin URI: http://www.designsandcode.com/551/wordpress-forget-about-shortcode-buttons/
Description: A visual way to add CSS buttons in the post editor screen.
Author: Designs & Code
Author URI: http://www.designsandcode.com/
License: GPL v3
Version: 1.1.0
Text Domain: fascbuttons
*/

/*
* Set up Plugin Globals
*/
if (!defined('FASC_BUTTONS_VERSION_NUM'))
    define('FASC_BUTTONS_VERSION_NUM', '1.1.0');
	
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
		
		public function __construct()
		{			
			//admin styles
			add_action( 'admin_enqueue_scripts', array($this, 'fasc_admin_styles') );
			add_filter( 'mce_css', array($this,'plugin_mce_css') );
			
			//admin script
			//add_action( 'admin_enqueue_scripts', array($this, 'add_plugin_ver_to_js') );
			add_action('init', array($this,'tiny_mce_fasc_button'));
			
			//regular styles
			add_action( 'wp_print_styles', array($this, 'fasc_fe_styles') );
			
			//Admin Ajax
			add_action( 'wp_ajax_fasc_buttons', array($this, 'fasc_buttons') ); //if logged in
			
			add_action('admin_head', array($this, 'my_add_styles_admin'));
		}
		
		public function my_add_styles_admin() {

			global $current_screen;
			$type = $current_screen->post_type;

			if (is_admin() && $type == 'post' || $type == 'page') {
				?>
				<script type="text/javascript">
				var fasc_ajaxurl  = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
				var fasc_ver  = '<?php echo FASC_BUTTONS_VERSION_NUM; ?>';
				</script>
				<?php
			}
		}
		public function fasc_buttons()
		{
			if($_GET['load']=="save_button")
			{
				//$buttons = get_user_meta(get_current_user_id(), 'fasc-buttons', true); //get existing buttons
				$buttons = get_option('fasc-buttons'); //get existing buttons
				
				//var_dump($buttons);
				if(!is_array($buttons))
				{
					$buttons = array();
				}
				
				$button_html = $_POST['button'];
				if($button_html!="")
				{
					
					$button_html = stripslashes($button_html);
					
					$button_number = count($buttons)+1;
					
					$button_data = array();
					$button_data['name'] = "Button ".$button_number;
					$button_data['html'] = $button_html;
					
					array_push($buttons, $button_data);
					
				}
				
				//update_user_meta(get_current_user_id(), 'fasc-buttons', $buttons);
				update_option('fasc-buttons', $buttons);
				
				$buttons = array_reverse($buttons);
				
				echo json_encode($buttons);
			}
			else if($_GET['load']=="get_buttons")
			{
				//$buttons = get_user_meta(get_current_user_id(), 'fasc-buttons', true); //get existing buttons
				$buttons = get_option('fasc-buttons'); //get existing buttons
				
				if(!is_array($buttons))
				{
					$buttons = array();
				}
				
				$buttons = array_reverse($buttons);
				
				echo json_encode($buttons);
			}
			else if($_GET['load']=="remove_button")
			{
				//$buttons = get_user_meta(get_current_user_id(), 'fasc-buttons', true); //get existing buttons
				$buttons = get_option('fasc-buttons'); //get existing buttons
				
				if(!is_array($buttons))
				{
					$buttons = array();
				}
				
				$buttons = array_reverse($buttons);
				
				$removeIndex = (int)$_GET['index'];
				
				unset($buttons[$removeIndex]);
				
				$newButtons = array_reverse($buttons);
				//update_user_meta(get_current_user_id(), 'fasc-buttons', $newButtons);
				update_option('fasc-buttons', $newButtons);
				
				echo json_encode($buttons);
			}
			else if($_GET['load']=="update_button")
			{
				//$buttons = get_user_meta(get_current_user_id(), 'fasc-buttons', true); //get existing buttons
				$buttons = get_option('fasc-buttons'); //get existing buttons
				
				if(!is_array($buttons))
				{
					$buttons = array();
				}
				
				$buttons = array_reverse($buttons);
				
				$renameIndex = (int)$_GET['index'];
				
				$name = $_GET['name'];
				$buttons[$renameIndex]['name'] = $name;
				
				$newButtons = array_reverse($buttons);
				//update_user_meta(get_current_user_id(), 'fasc-buttons', $newButtons);
				update_option('fasc-buttons', $newButtons);
				
				echo json_encode($buttons);
			}
			else
			{
				$msg = array();
				$msg['error'] = "1";
				
				echo json_encode($msg);
			}
			
			//var_dump($_GET);
			//delete_user_meta(get_current_user_id(), 'fasc-buttons');
			exit;
		}
		
		public function save_presets()
		{
		
		}
		
		public function fasc_fe_styles()
		{
			wp_enqueue_style( 'fasc-buttons-style', plugins_url( '/assets/css/button-styles.css' , __FILE__ ), array(), FASC_BUTTONS_VERSION_NUM );
			wp_enqueue_style( 'font-awesome-style', plugins_url( '/assets/css/font-awesome.min.css' , __FILE__ ), array(), FASC_BUTTONS_VERSION_NUM );
		}
		public function fasc_admin_styles()
		{
			wp_enqueue_style( 'fasc-buttons-style', plugins_url( '/assets/css/fasc-buttons.css' , __FILE__ ), array(), FASC_BUTTONS_VERSION_NUM);
		}
		
		public function plugin_mce_css( $mce_css )
		{
			if ( ! empty( $mce_css ) )
				$mce_css .= ',';

			$mce_css .= plugins_url( '/assets/css/custom-editor-style.css?ver='.FASC_BUTTONS_VERSION_NUM , __FILE__ );
			
			return $mce_css;
		}
		
		public function add_mce_plugin( $plugin_array )
		{
		   $plugin_array["fascbuttons"] = plugins_url( '/assets/js/'.PLUGIN_SLUG.'/scripts.min.js?ver='.FASC_BUTTONS_VERSION_NUM , __FILE__ );
		   return $plugin_array;
		}
		
		function add_plugin_ver_to_js() {
		?>
		<script type="text/javascript">
		/* <![CDATA[ */
		var fasc_buttons_ver = <?php echo FASC_BUTTONS_VERSION_NUM; ?>;/* ]]> */
		</script>
		<?php
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



