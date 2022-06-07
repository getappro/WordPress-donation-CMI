<?php

/*
Plugin Name: CMI Donation
Description: A simple and easy way to create, manage and collecting donations through  CMI Payment Provider on your website.
Tags: CMI, donate, donations, , CMI donation, ecommerce, gateway, payment, CMI button, CMI donation, CMI donate, CMI payment, CMI plugin
Author: CMI
Author URI: http://www.cmi.co.ma/
Version: 1.0
Text Domain: cmi-donation
Domain Path: /languages
*/

//// variables
// plugin function 	  = cmiedon
// shortcode 		  = cmiedon
$plugin_basename = plugin_basename(__FILE__);


//// plugin functions
cmiedon_wpedonation::init_cmiedonwpedonation();

class cmiedon_wpedonation {
	public static function init_cmiedonwpedonation() {
	register_deactivation_hook( __FILE__, array( __CLASS__, "cmiedon_deactivate" ));
	register_uninstall_hook( __FILE__, array( __CLASS__, "cmiedon_uninstall" ));
	
	load_plugin_textdomain('cmi-donation',false,dirname( plugin_basename( __FILE__ ) ) .  '/languages');

	$cmiedon_settingsoptions = array(
		'merchant_id'    			=> '',
		'SLKSecretkey'   			=> '',
		'actionslk'    		=> '',
		'confirmation_mode'    	=> '',
		'term'    		=> '',
		'cancel'    		=> '',
		'return'    		=> '',
	);

	add_option("cmiedon_settingsoptions", $cmiedon_settingsoptions);
	}
	
	function cmiedon_deactivate() {
		delete_option("cmiedon_notice_shown");
	}

	function cmiedon_uninstall() {
	}
}

//// plugin includes

// private settings page
include_once ('includes/private_functions.php');

// private button inserter
include_once ('includes/private_button_inserter.php');

// private orders page
include_once ('includes/private_orders.php');

// private buttons page
include_once ('includes/private_buttons.php');

// private currencies page
include_once ('includes/private_currencies.php');

// private settings page
include_once ('includes/private_settings.php');

// public shortcode
include_once ('includes/public_shortcode.php');

// private filters
include_once ('includes/private_filters.php');

// private widget
include_once ('includes/private_widget.php');

// public ipn
include_once ('includes/public_ipn.php');

?>