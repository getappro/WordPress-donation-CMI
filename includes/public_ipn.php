<?php

// cmi post
add_action('admin_post_add_cmiedon_button_ipn', 'wpplugin_cmiedon_button_ipn');
add_action('admin_post_nopriv_add_cmiedon_button_ipn', 'wpplugin_cmiedon_button_ipn');

function wpplugin_cmiedon_button_ipn() {
	$options = get_option('cmiedon_settingsoptions');
	foreach ($options as $k => $v ) { $value[$k] = esc_attr($v); }
	if (isset($value)  && $value) {
		$SLKSecretkey = $value['SLKSecretkey'];
		$confirmation_mode = $value['confirmation_mode'];		
	}
	$storeKey = $SLKSecretkey;
	
	
	$postParams = array();
	if(isset($_POST) && !empty($_POST)){
	foreach ($_POST as $key => $value){
		array_push($postParams, $key);				
	}
	
	natcasesort($postParams);		
	$hach = "";
	$hashval = "";					
	foreach ($postParams as $param){				
	    $paramValue = html_entity_decode(preg_replace("/\n$/","",$_POST[$param]), ENT_QUOTES, 'UTF-8'); 

		$hach = $hach . "(!".$param."!:!".$_POST[$param]."!)";
		$escapedParamValue = str_replace("|", "\\|", str_replace("\\", "\\\\", $paramValue));	
			
		$lowerParam = strtolower($param);
		if($lowerParam != "hash" && $lowerParam != "encoding" )	{
			$hashval = $hashval . $escapedParamValue . "|";
		}
	}
	
	
	$escapedStoreKey = str_replace("|", "\\|", str_replace("\\", "\\\\", $storeKey));	
	$hashval = $hashval . $escapedStoreKey;
	
	$calculatedHashValue = hash('sha512', $hashval);  
	$actualHash = base64_encode (pack('H*',$calculatedHashValue));
	
	$retrievedHash = $_POST["HASH"];
	if($retrievedHash == $actualHash && $_POST["ProcReturnCode"] == "00" )	{
		// assign posted variables to local variables
		$txn_id = 					sanitize_text_field($_POST['TransId']);
		$custom = 					sanitize_text_field($_POST['pid']);
		
		// lookup post author to save ipn as based on author of button
		$post_id_data = 		get_post($custom); 
		$post_id_author = 		$post_id_data->post_author;
		
		
		if (!empty($txn_id)) {
			$item_number = 			$_POST['ReturnOid'];
			$payment_status = 		sanitize_text_field(__( 'Paiement accepté par le CMI', 'cmi-donation' ));
			if (isset($_POST['symbolCur']) && !empty($_POST['symbolCur']) ) {
				$symbolCur = $_POST['symbolCur']; 
				$amountCur = $_POST['amountCur']; 
				$currency = $symbolCur;	
				$amount = $amountCur;	
			} else { 
				$currency = "MAD";
				$amount = $_POST['amount'];	
			}
			$payment_amount = 		sanitize_text_field($amount);
			$payment_currency = 	sanitize_text_field($currency);
			if($_POST["type_don"] != "anonyme"){
				$payer_name = sanitize_text_field($_POST['BillToName']);
			} else {
				$payer_name = __( 'Anonyme', 'cmi-donation' );
			}
				$ipn_post = array(
				'post_title'    => $payer_name,
				'post_status'   => 'publish',
				'post_author'   => $post_id_author,
				'post_type'     => 'wpplugin_don_order'
			);
			
			$post_id = wp_insert_post($ipn_post);
			update_post_meta($post_id, 'cmiedon_button_item_type_don', $_POST["type_don"]);
			update_post_meta($post_id, 'cmiedon_button_item_number', $item_number);
			update_post_meta($post_id, 'cmiedon_button_payment_status', $payment_status);
			update_post_meta($post_id, 'cmiedon_button_payment_amount', $payment_amount);
			update_post_meta($post_id, 'cmiedon_button_payment_currency', $payment_currency);
			update_post_meta($post_id, 'cmiedon_button_txn_id', $txn_id);
			if($_POST["type_don"] != "anonyme"){
				$payer_email = sanitize_email($_POST['email']);
				$payer_phone= sanitize_text_field($_POST['tel']);
				$payer_addr= sanitize_text_field($_POST['BillToStreet1']);
				$payer_city= sanitize_text_field($_POST['BillToCity']);
				$payer_country= sanitize_text_field($_POST['BillToCountry']);
				update_post_meta($post_id, 'cmiedon_button_payer_email', $payer_email);
				update_post_meta($post_id, 'cmiedon_button_payment_phone', $payer_phone);
				update_post_meta($post_id, 'cmiedon_button_payment_addr', $payer_addr);
				update_post_meta($post_id, 'cmiedon_button_payment_city', $payer_city);
				update_post_meta($post_id, 'cmiedon_button_payment_country', $payer_country);
			}
		}
		if($confirmation_mode == "a" ){
			echo "ACTION=POSTAUTH";	
		} else if($confirmation_mode == "m" ){
			echo "APPROVED";
		}
		   
	}else {
		   echo "FAILURE";
	}		
	}

}