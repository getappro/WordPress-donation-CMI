<?php

// display activation notice
add_action('admin_notices', 'cmiedon_admin_notices');
function cmiedon_admin_notices() {
	if (!get_option('cmiedon_notice_shown')) {
		echo "<div class='updated'><p><a href='admin.php?page=cmiedon_settings'>Click here to view the plugin settings</a>.</p></div>";
		update_option("cmiedon_notice_shown", "true");
	}
}



// add cmi menu
add_action("admin_menu", "cmiedon_plugin_menu");
function cmiedon_plugin_menu() {
	global $plugin_dir_url;
	
	add_menu_page("CMI Donations", "CMI Donations", "manage_options", "cmiedon_menu", "cmiedon_plugin_orders",'dashicons-cart','28.5');
	
	add_submenu_page("cmiedon_menu", "Donations", "Donations", "manage_options", "cmiedon_menu", "cmiedon_plugin_orders");
	
	add_submenu_page("cmiedon_menu", "Buttons", "Buttons", "manage_options", "cmiedon_buttons", "cmiedon_plugin_buttons");
	
	add_submenu_page("cmiedon_menu", "Currencies", "Currencies", "manage_options", "cmiedon_currencies", "cmiedon_plugin_currencies");
	
	add_submenu_page("cmiedon_menu", "Settings", "Settings", "manage_options", "cmiedon_settings", "cmiedon_plugin_options");
}



function cmiedon_action_links($links) {

global $edit_link, $settings_link;
   $links[] = '<a href="admin.php?page=cmiedon_settings">Settings</a>';
   return $links;
}

add_filter( 'plugin_action_links_' . $plugin_basename, 'cmiedon_action_links' );

add_filter( 'the_posts', 'generate_confirmationdon_page', -10 );
add_filter( 'the_posts', 'ok_fail_page', -10 );
/**
 * Create a fake page called "fake"
 *
 * $fake_slug can be modified to match whatever string is required
 *
 *
 * @param   object  $posts  Original posts object
 * @global  object  $wp     The main WordPress object
 * @global  object  $wp     The main WordPress query object
 * @return  object  $posts  Modified posts object
 */
function generate_confirmationdon_page( $posts ) {
	global $wp, $wp_query;
	$options = get_option('cmiedon_settingsoptions');
	foreach ($options as $k => $v ) { $value[$k] = esc_attr($v); }
	if (isset($value)  && $value) {
		$merchant_id = $value['merchant_id'];
		$SLKSecretkey = $value['SLKSecretkey'];
		$actionslk = $value['actionslk'];
		$confirmation_mode = $value['confirmation_mode'];
		$term = $value['term'];
		if(isset($value['return']) && $value['return']){
			$return = $value['return'];
		}		
		if(isset($value['cancel']) && $value['cancel']){
			$cancel = $value['cancel'];
		}
			
	}
	$currArr = getCurrencies();
	
	$url_slug = 'confirmationdon'; // URL slug of the fake page

	if ( ! defined( 'CONFIRMDON_PAGE' ) && ( strtolower( $wp->request ) == $url_slug ) ) {

		// stop interferring with other $posts arrays on this page (only works if the sidebar is rendered *after* the main page)
		define( 'CONFIRMDON_PAGE', true );
		// ;
		$storeKey = $SLKSecretkey;
		
		// create a fake virtual page
		$post = new stdClass;
		$post->post_author    = 1;
		$post->post_name      = $url_slug;
		$post->guid           = home_url() . '/' . $url_slug;
		$post->post_title     = __( 'Confirmation Don', 'cmi-donation' );
		$postParams = array();
		$currRate = array();
		if(isset($_POST) && !empty($_POST)){
			$_POST = array_filter($_POST);
			$symbolCur = $_POST['symbolCur'];
			unset($_POST['submit']);
			if($symbolCur == "MAD"){
				unset($_POST['symbolCur']);	
				if($_POST['montant_'.$symbolCur] == "autres"){
					echo "1";
					$_POST['amount'] = number_format(floatval($_POST['autres_montant_'.$symbolCur]), 2, '.', '' );
					unset($_POST['autres_montant_'.$symbolCur]);
					unset($_POST['montant_'.$symbolCur]);
				} else {
					$_POST['amount'] = number_format(floatval($_POST['montant_'.$symbolCur]), 2, '.', '' );
					unset($_POST['autres_montant_'.$symbolCur]);
					unset($_POST['montant_'.$symbolCur]);
				}
				$recapAmount = 	$_POST['amount'];					
				$recapCurrency = 	"MAD";			
			} else {
				$currsRate = getCurrencyRate();
				$conversion_rate = $currsRate[$symbolCur];
				if(isset($currsRate["MAD"]) && $currsRate["MAD"]){
				$currency_mad = $currsRate["MAD"];
				// var_dump($currRate);		
				} else {
					$currency_mad = "1";
				}
				if($_POST['montant_'.$symbolCur] == "autres"){
					$_POST['amount'] = number_format(floatval(($_POST['autres_montant_'.$symbolCur]*$currency_mad) / $conversion_rate), 2, '.', '' );
					$_POST['amount'] = number_format(floatval(($_POST['autres_montant_'.$symbolCur]*$currency_mad) / $conversion_rate), 2, '.', '' );
					$_POST['amountCur'] = $_POST['autres_montant_'.$symbolCur];	
					unset($_POST['autres_montant_'.$symbolCur]);
					unset($_POST['montant_'.$symbolCur]);
				} else {
					$_POST['amount'] = number_format(floatval(($_POST['montant_'.$symbolCur]*$currency_mad) / $conversion_rate), 2, '.', '' );
					unset($_POST['autres_montant_'.$symbolCur]);
					$_POST['amountCur'] = $_POST['montant_'.$symbolCur];
					unset($_POST['montant_'.$symbolCur]);	
				}				
				$recapAmount = 	number_format(floatval($_POST['amountCur']), 2, '.', '' );		
				$recapCurrency = 	$_POST['symbolCur'];	
			}
			if(!empty($_POST['lastName']) || !empty($_POST['firstName'])){ 
					$_POST['BillToName'] = $_POST['firstName'].' '.$_POST['lastName'];
					unset($_POST['firstName']);
					unset($_POST['lastName']);
			}
			if($_POST["type_don"]=="anonyme"){ 
					unset($_POST['BillToCountry']);
			}
			$locale = get_locale(); //browser or user locale
			$fmt = new NumberFormatter( $locale."@currency=$recapCurrency", NumberFormatter::CURRENCY );
			$symbolrecap = $fmt->getSymbol(NumberFormatter::CURRENCY_SYMBOL);
			$currLabel = getCurrencyLabel();
			$recapCurrencyLabel = $currLabel[$recapCurrency];	
				$recapAmountMAD = 	$_POST['amount'];
			$output = "<div class='fullpage'><h3 class='txt_marron'>".__( 'Vos informations de don', 'cmi-donation' )."</h3>";
			if($recapCurrency == "MAD"){
				$output .= "<strong>".__( 'MONTANT', 'cmi-donation' )." :</strong> $recapAmount $symbolrecap<br>";
			} else {
				$output .= "<strong>".__( 'MONTANT SAISI', 'cmi-donation' )." :</strong> $recapAmount $symbolrecap<br>";
				$output .= "<div class='separator_detail_don'></div>";
				$output .= "<strong>".__( 'MONTANT A DEBITER', 'cmi-donation' )." :</strong> $recapAmountMAD MAD<br>";
			}
			$output .= "<div class='separator_detail_don'></div>";
			
			if($_POST["type_don"]!="anonyme"){
				$recapBillToName = 	$_POST['BillToName'];
				$recapTel = 	$_POST['tel'];
				$recapEmail = 	$_POST['email'];
				$output .= "<strong>".__( 'Nom', 'cmi-donation' )." / ".__( 'Prénom', 'cmi-donation' ).":</strong> $recapBillToName <br>";
				$output .= "<div class='separator_detail_don'></div>";
				$output .= "<strong>".__( 'Téléphone', 'cmi-donation' )." :</strong> $recapTel <br>";
				$output .= "<div class='separator_detail_don'></div>";
				$output .= "<strong>".__( 'E-mail', 'cmi-donation' )." :</strong> $recapEmail <br>";
			} else {
				$output .= "<strong>".__( 'VOTRE DON SERA RENDU', 'cmi-donation' ).":</strong> ".__( 'Anonyme', 'cmi-donation' )."<br>";				
			}
			$output .= "<form name='pay_form' method='post' action='$actionslk'>";
		$_POST['BillToName'] = str_without_accents($_POST['BillToName']);	
		$_POST['BillToStreet1'] = str_without_accents($_POST['BillToStreet1']);	
		$_POST['BillToCity'] = str_without_accents($_POST['BillToCity']);	
		foreach ($_POST as $key => $value){
			array_push($postParams, $key);
			$output .= "<input type=\"hidden\" name=\"" .$key ."\" value=\"" .trim(html_entity_decode($value))."\" />";
		}
		
		natcasesort($postParams);		
		
		$hashval = "";					
		foreach ($postParams as $param){				
			$paramValue = trim($_POST[$param]);
			$escapedParamValue = str_replace("|", "\\|", str_replace("\\", "\\\\", $paramValue));	
			$escapedParamValue = preg_replace('/document(.)/i', 'document.', $escapedParamValue);	
				
			$lowerParam = strtolower($param);
			if($lowerParam != "hash" && $lowerParam != "encoding" )	{
				$hashval = $hashval . $escapedParamValue . "|";
			}
		}
		
		
		$escapedStoreKey = str_replace("|", "\\|", str_replace("\\", "\\\\", $storeKey));	
		$hashval = $hashval . $escapedStoreKey;
		
		$calculatedHashValue = hash('sha512', $hashval);  
		$hash = base64_encode (pack('H*',$calculatedHashValue));
			$output .=  "<input type=\"hidden\" name=\"HASH\" value=\"" .$hash."\" /><br />";
			$output .=  "<input type='submit' class='subDonConfirm' value='Confirmer le don'><span class='backDonConfirm'><a href='javascript:history.back()' >Retour</a></span>";
			$output .=  "</form></div>";
		
		} else {
			$output = __( 'Vous n\'avez effectué aucun don', 'cmi-donation' );
		}
		$post->post_content   = $output ;
		
		$post->ID             = 99999999999999999;
		$post->post_type      = 'page';
		$post->post_status    = 'static';
		$post->comment_status = 'closed';
		$post->ping_status    = 'open';
		$post->comment_count  = 0;
		$post->post_date      = current_time( 'mysql' );
		$post->post_date_gmt  = current_time( 'mysql', 1 );
		$posts                = NULL;
		$posts[]              = $post;

		// make wpQuery believe this is a real page too
		$wp_query->is_page             = true;
		$wp_query->is_singular         = true;
		$wp_query->is_home             = false;
		$wp_query->is_archive          = false;
		$wp_query->is_category         = false;
		unset( $wp_query->query[ 'error' ] );
		$wp_query->query_vars[ 'error' ] = '';
		$wp_query->is_404 = false;
	}

	return $posts;
}
function wptuts_scripts_with_jquery()
{
    // Register the script like this for a plugin:
	wp_register_style( 'customcss', plugins_url( 'assets/css/frontend/style.css', __FILE__ ));
    wp_enqueue_style( 'customcss' );
    wp_register_script( 'script-jquery', plugins_url( 'assets/js/frontend/jquery-1.12.4.js', __FILE__ ), array( 'jquery' ) );
    wp_register_script( 'script-js', plugins_url( 'assets/js/frontend/script.js', __FILE__ ), array( 'jquery' ) );
    wp_enqueue_script( 'script-jquery' );
    wp_enqueue_script( 'script-js' );
}
add_action( 'wp_enqueue_scripts', 'wptuts_scripts_with_jquery' );

function ok_fail_page( $posts ) {
	global $wp, $wp_query;
	$options = get_option('cmiedon_settingsoptions');
	foreach ($options as $k => $v ) { $value[$k] = esc_attr($v); }
	if (isset($value)  && $value) {
		$merchant_id = $value['merchant_id'];
		$SLKSecretkey = $value['SLKSecretkey'];
		$actionslk = $value['actionslk'];
		$confirmation_mode = $value['confirmation_mode'];
		$term = $value['term'];
		if(isset($value['return']) && $value['return']){
			$return = $value['return'];
		}		
		if(isset($value['cancel']) && $value['cancel']){
			$cancel = $value['cancel'];
		}
		
		
	}
	$url_slug = 'confirmcmidon'; // URL slug of the fake page

	if ( ! defined( 'OKFAIL_PAGE' ) && ( strtolower( $wp->request ) == $url_slug ) ) {

		// stop interferring with other $posts arrays on this page (only works if the sidebar is rendered *after* the main page)
		define( 'OKFAIL_PAGE', true );
		// create a fake virtual page
		$post = new stdClass;
		$post->post_author    = 1;
		$post->post_name      = $url_slug;
		$post->guid           = home_url() . '/' . $url_slug;
		$postParams = array();
		if(isset($_POST) && $_POST){
			foreach ($_POST as $key => $value){
				array_push($postParams, $key);				
			}
			
			natcasesort($postParams);		
			
			$hashval = "";					
			foreach ($postParams as $param){				
				$paramValue = trim(html_entity_decode($_POST[$param], ENT_QUOTES, 'UTF-8')); 
				$escapedParamValue = str_replace("|", "\\|", str_replace("\\", "\\\\", $paramValue));	
					
				$lowerParam = strtolower($param);
				if($lowerParam != "hash" && $lowerParam != "encoding" )	{
					$hashval = $hashval . $escapedParamValue . "|";
				}
			}
			$options = get_option('cmiedon_settingsoptions');
			// foreach ($options as $k => $v ) { $value[$k] = esc_attr($v); }
			if (isset($options)  && $options) {
				$SLKSecretkey = $options['SLKSecretkey'];		
			}
			$storeKey = $SLKSecretkey;
			$escapedStoreKey = str_replace("|", "\\|", str_replace("\\", "\\\\", $storeKey));	
			$hashval = $hashval . $escapedStoreKey;
			
			$calculatedHashValue = hash('sha512', $hashval);  
			$actualHash = base64_encode (pack('H*',$calculatedHashValue));
			
			$retrievedHash = $_POST["HASH"];
			if($retrievedHash == $actualHash)	{
				if($_POST["ProcReturnCode"] == "00" )	{
					$post->post_title     =  __('Confirmation de donation', 'cmi-donation' );
					$post->post_content   = __( 'Merci beaucoup pour votre support et donation!', 'cmi-donation' );	
				} else {
					$post->post_content   = __( 'Votre don n\'a pas pu être effectué. Merci de réessayer', 'cmi-donation' );	
					$post->post_title     =  __('Echec d’opération', 'cmi-donation' );
				}
			}else {
				$post->post_content   = __( 'Alerte de sécurité. La signature numérique n\'est pas valide', 'cmi-donation' );
			}		
		}		
		$post->ID             = 9999999999999999;
		$post->post_type      = 'page';
		$post->post_status    = 'static';
		$post->comment_status = 'closed';
		$post->ping_status    = 'open';
		$post->comment_count  = 0;
		$post->post_date      = current_time( 'mysql' );
		$post->post_date_gmt  = current_time( 'mysql', 1 );
		$posts                = NULL;
		$posts[]              = $post;

		// make wpQuery believe this is a real page too
		$wp_query->is_page             = true;
		$wp_query->is_singular         = true;
		$wp_query->is_home             = false;
		$wp_query->is_archive          = false;
		$wp_query->is_category         = false;
		unset( $wp_query->query[ 'error' ] );
		$wp_query->query_vars[ 'error' ] = '';
		$wp_query->is_404 = false;
	}

	return $posts;
}
function str_without_accents($str, $charset='utf-8')
	{
		$str = htmlentities($str, ENT_NOQUOTES, $charset);
		$str = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
		$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
		$str = preg_replace('#&[^;]+;#', '', $str); 
		$str = preg_replace('/[^a-zA-Z0-9_ -]/s','',$str);
		return $str;   
	}