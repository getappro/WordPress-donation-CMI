<?php


// shortcode
add_shortcode('cmiedon', 'cmiedon_options');

function cmiedon_options($atts) {
	$countries = array
(
	'AF' => __( 'Afghanistan', 'CMI Pay' ),
	'AX' => 'Aland Islands',
	'AL' => 'Albania',
	'DZ' => 'Algeria',
	'AS' => 'American Samoa',
	'AD' => 'Andorra',
	'AO' => 'Angola',
	'AI' => 'Anguilla',
	'AQ' => 'Antarctica',
	'AG' => 'Antigua And Barbuda',
	'AR' => 'Argentina',
	'AM' => 'Armenia',
	'AW' => 'Aruba',
	'AU' => 'Australia',
	'AT' => 'Austria',
	'AZ' => 'Azerbaijan',
	'BS' => 'Bahamas',
	'BH' => 'Bahrain',
	'BD' => 'Bangladesh',
	'BB' => 'Barbados',
	'BY' => 'Belarus',
	'BE' => 'Belgium',
	'BZ' => 'Belize',
	'BJ' => 'Benin',
	'BM' => 'Bermuda',
	'BT' => 'Bhutan',
	'BO' => 'Bolivia',
	'BA' => 'Bosnia And Herzegovina',
	'BW' => 'Botswana',
	'BV' => 'Bouvet Island',
	'BR' => 'Brazil',
	'IO' => 'British Indian Ocean Territory',
	'BN' => 'Brunei Darussalam',
	'BG' => 'Bulgaria',
	'BF' => 'Burkina Faso',
	'BI' => 'Burundi',
	'KH' => 'Cambodia',
	'CM' => 'Cameroon',
	'CA' => 'Canada',
	'CV' => 'Cape Verde',
	'KY' => 'Cayman Islands',
	'CF' => 'Central African Republic',
	'TD' => 'Chad',
	'CL' => 'Chile',
	'CN' => 'China',
	'CX' => 'Christmas Island',
	'CC' => 'Cocos (Keeling) Islands',
	'CO' => 'Colombia',
	'KM' => 'Comoros',
	'CG' => 'Congo',
	'CD' => 'Congo, Democratic Republic',
	'CK' => 'Cook Islands',
	'CR' => 'Costa Rica',
	'CI' => 'Cote D\'Ivoire',
	'HR' => 'Croatia',
	'CU' => 'Cuba',
	'CY' => 'Cyprus',
	'CZ' => 'Czech Republic',
	'DK' => 'Denmark',
	'DJ' => 'Djibouti',
	'DM' => 'Dominica',
	'DO' => 'Dominican Republic',
	'EC' => 'Ecuador',
	'EG' => 'Egypt',
	'SV' => 'El Salvador',
	'GQ' => 'Equatorial Guinea',
	'ER' => 'Eritrea',
	'EE' => 'Estonia',
	'ET' => 'Ethiopia',
	'FK' => 'Falkland Islands (Malvinas)',
	'FO' => 'Faroe Islands',
	'FJ' => 'Fiji',
	'FI' => 'Finland',
	'FR' => 'France',
	'GF' => 'French Guiana',
	'PF' => 'French Polynesia',
	'TF' => 'French Southern Territories',
	'GA' => 'Gabon',
	'GM' => 'Gambia',
	'GE' => 'Georgia',
	'DE' => 'Germany',
	'GH' => 'Ghana',
	'GI' => 'Gibraltar',
	'GR' => 'Greece',
	'GL' => 'Greenland',
	'GD' => 'Grenada',
	'GP' => 'Guadeloupe',
	'GU' => 'Guam',
	'GT' => 'Guatemala',
	'GG' => 'Guernsey',
	'GN' => 'Guinea',
	'GW' => 'Guinea-Bissau',
	'GY' => 'Guyana',
	'HT' => 'Haiti',
	'HM' => 'Heard Island & Mcdonald Islands',
	'VA' => 'Holy See (Vatican City State)',
	'HN' => 'Honduras',
	'HK' => 'Hong Kong',
	'HU' => 'Hungary',
	'IS' => 'Iceland',
	'IN' => 'India',
	'ID' => 'Indonesia',
	'IR' => 'Iran, Islamic Republic Of',
	'IQ' => 'Iraq',
	'IE' => 'Ireland',
	'IM' => 'Isle Of Man',
	'IL' => 'Israel',
	'IT' => 'Italy',
	'JM' => 'Jamaica',
	'JP' => 'Japan',
	'JE' => 'Jersey',
	'JO' => 'Jordan',
	'KZ' => 'Kazakhstan',
	'KE' => 'Kenya',
	'KI' => 'Kiribati',
	'KR' => 'Korea',
	'KW' => 'Kuwait',
	'KG' => 'Kyrgyzstan',
	'LA' => 'Lao People\'s Democratic Republic',
	'LV' => 'Latvia',
	'LB' => 'Lebanon',
	'LS' => 'Lesotho',
	'LR' => 'Liberia',
	'LY' => 'Libyan Arab Jamahiriya',
	'LI' => 'Liechtenstein',
	'LT' => 'Lithuania',
	'LU' => 'Luxembourg',
	'MO' => 'Macao',
	'MK' => 'Macedonia',
	'MG' => 'Madagascar',
	'MW' => 'Malawi',
	'MY' => 'Malaysia',
	'MV' => 'Maldives',
	'ML' => 'Mali',
	'MT' => 'Malta',
	'MH' => 'Marshall Islands',
	'MQ' => 'Martinique',
	'MR' => 'Mauritania',
	'MU' => 'Mauritius',
	'YT' => 'Mayotte',
	'MX' => 'Mexico',
	'FM' => 'Micronesia, Federated States Of',
	'MD' => 'Moldova',
	'MC' => 'Monaco',
	'MN' => 'Mongolia',
	'ME' => 'Montenegro',
	'MS' => 'Montserrat',
	'MA' => 'Maroc',
	'MZ' => 'Mozambique',
	'MM' => 'Myanmar',
	'NA' => 'Namibia',
	'NR' => 'Nauru',
	'NP' => 'Nepal',
	'NL' => 'Netherlands',
	'AN' => 'Netherlands Antilles',
	'NC' => 'New Caledonia',
	'NZ' => 'New Zealand',
	'NI' => 'Nicaragua',
	'NE' => 'Niger',
	'NG' => 'Nigeria',
	'NU' => 'Niue',
	'NF' => 'Norfolk Island',
	'MP' => 'Northern Mariana Islands',
	'NO' => 'Norway',
	'OM' => 'Oman',
	'PK' => 'Pakistan',
	'PW' => 'Palau',
	'PS' => 'Palestinian Territory, Occupied',
	'PA' => 'Panama',
	'PG' => 'Papua New Guinea',
	'PY' => 'Paraguay',
	'PE' => 'Peru',
	'PH' => 'Philippines',
	'PN' => 'Pitcairn',
	'PL' => 'Poland',
	'PT' => 'Portugal',
	'PR' => 'Puerto Rico',
	'QA' => 'Qatar',
	'RE' => 'Reunion',
	'RO' => 'Romania',
	'RU' => 'Russian Federation',
	'RW' => 'Rwanda',
	'BL' => 'Saint Barthelemy',
	'SH' => 'Saint Helena',
	'KN' => 'Saint Kitts And Nevis',
	'LC' => 'Saint Lucia',
	'MF' => 'Saint Martin',
	'PM' => 'Saint Pierre And Miquelon',
	'VC' => 'Saint Vincent And Grenadines',
	'WS' => 'Samoa',
	'SM' => 'San Marino',
	'ST' => 'Sao Tome And Principe',
	'SA' => 'Saudi Arabia',
	'SN' => 'Senegal',
	'RS' => 'Serbia',
	'SC' => 'Seychelles',
	'SL' => 'Sierra Leone',
	'SG' => 'Singapore',
	'SK' => 'Slovakia',
	'SI' => 'Slovenia',
	'SB' => 'Solomon Islands',
	'SO' => 'Somalia',
	'ZA' => 'South Africa',
	'GS' => 'South Georgia And Sandwich Isl.',
	'ES' => 'Spain',
	'LK' => 'Sri Lanka',
	'SD' => 'Sudan',
	'SR' => 'Suriname',
	'SJ' => 'Svalbard And Jan Mayen',
	'SZ' => 'Swaziland',
	'SE' => 'Sweden',
	'CH' => 'Switzerland',
	'SY' => 'Syrian Arab Republic',
	'TW' => 'Taiwan',
	'TJ' => 'Tajikistan',
	'TZ' => 'Tanzania',
	'TH' => 'Thailand',
	'TL' => 'Timor-Leste',
	'TG' => 'Togo',
	'TK' => 'Tokelau',
	'TO' => 'Tonga',
	'TT' => 'Trinidad And Tobago',
	'TN' => 'Tunisia',
	'TR' => 'Turkey',
	'TM' => 'Turkmenistan',
	'TC' => 'Turks And Caicos Islands',
	'TV' => 'Tuvalu',
	'UG' => 'Uganda',
	'UA' => 'Ukraine',
	'AE' => 'United Arab Emirates',
	'GB' => 'United Kingdom',
	'US' => 'United States',
	'UM' => 'United States Outlying Islands',
	'UY' => 'Uruguay',
	'UZ' => 'Uzbekistan',
	'VU' => 'Vanuatu',
	'VE' => 'Venezuela',
	'VN' => 'Viet Nam',
	'VG' => 'Virgin Islands, British',
	'VI' => 'Virgin Islands, U.S.',
	'WF' => 'Wallis And Futuna',
	'YE' => 'Yemen',
	'ZM' => 'Zambia',
	'ZW' => 'Zimbabwe',
);
	global $wp_query;
	$currArr = getCurrencies();
	// get shortcode id
		$atts = shortcode_atts(array(
			'id'		=> '',
			'align' 	=> '',
			'widget' 	=> '',
			'name' 		=> ''
		), $atts);
			
		$post_id = $atts['id'];

	// get settings page values
	$options = get_option('cmiedon_settingsoptions');
	 
	// get values for button
	$sku = 		esc_attr(get_post_meta($post_id,'cmiedon_button_id',true));
	

	$post_data = 	get_post($post_id);
	$name = 		$post_data->post_title;

	// CMI INFOS
	if (isset($options)  && $options) {
		$merchant_id = $options['merchant_id'];
		$SLKSecretkey = $options['SLKSecretkey'];
		$actionslk = $options['actionslk'];
		$confirmation_mode = $options['confirmation_mode'];
		$term = $options['term'];
		if(isset($options['return']) && $options['return']){
			$return = $options['return'];
		}		
		if(isset($options['cancel']) && $options['cancel']){
			$cancel = $options['cancel'];
		}
		
		
	}
	
	// widget
	if ($atts['widget'] == "true") {
		$width = "180px";
	} else {
		$width = "220px";
	}
	
	$siteurl = get_site_url();
	$anonymousMode = esc_attr(get_post_meta($post_id,'cmiedon_button_anonymous',true));
	$customPrice = esc_attr(get_post_meta($post_id,'cmiedon_button_customPrice',true));
	$labelCustomPrice = esc_attr(get_post_meta($post_id,'cmiedon_button_LabelCustomPrice',true));
	$orgClientId  =   $merchant_id;
	// $orgAmount = "50";
	if(isset($options['return']) && $options['return']){
		$orgOkUrl =  $return;
	} else {
		$orgOkUrl =  $siteurl.'/confirmcmidon';
	}	
	if(isset($options['cancel']) && $options['cancel']){
		$orgFailUrl =  $cancel;
	} else {
		$orgFailUrl = $siteurl.'/confirmcmidon';
	}
	$shopurl = $siteurl;
	$orgTransactionType = "PreAuth";
	$orgRnd =  microtime();
	$orgCallbackUrl = get_admin_url() . "admin-post.php?action=add_cmiedon_button_ipn";
	$orgCurrency = "504";
	$lang = get_locale();
	if(substr( $lang, 0, 2 ) === 'en'){
		$lang = "en";
	} else if(substr( $lang, 0, 2 ) === 'fr'){
		$lang = "fr";
	} else if(substr( $lang, 0, 2 ) === 'ar'){
		$lang = "ar";
	}else{
		$lang = "en";
	}

	$output = "";
	
	// override name field if passed as shortcode attribute
	if (!empty($atts['name'])) {
		$name = $atts['name'];
	}
	$actionForm = $siteurl.'/confirmationdon';
	$output .= "<div class='cmiDonForm'>";
	$output .= "<form action='$actionForm' method='post' name='don_form' id='myForm'>";
	$output .= "<div class='box_paiment'>";
	$output .= "<strong>".__( 'Choisissez votre devise', 'cmi-donation' )." :</strong><br>";
	$currCodes = array();
	$i = 1;
	foreach ($currArr as $key => $curr ) {
		if($i == 1){$check = "checked='checked'";}
		$currCodes[] = $curr['code'];
		$currCode = $curr['code'];
		$currLabel = $curr['label'];
		$currSymbol = $curr['symbol'];
		$output .= "<p><input name='symbolCur' class='devise' type='radio' value='$currCode' id='devise_$currCode' $check><label for='devise_$currCode' > ".__( $currLabel, 'cmi-donation' )." ($currSymbol)</label></p>";
		$check="";
		$i++;
	}
		$output .= "<strong>".__( 'Choisissez le montant que vous souhaitez donner', 'cmi-donation' )." :</strong>";
	foreach ($currArr as $key => $curr ) {
		$currCodes[] = $curr['code'];
		$currCode = $curr['code'];
		$currLabel = $curr['label'];
		$currSymbol = $curr['symbol'];
		$output .= "<div id='div_$currCode' class='currency'>";
		for ($i = 1; $i <= 10; $i++) {
			if($i == 1){$check = "checked='checked'";}
			$price = esc_attr(get_post_meta($post_id,'cmiedon_button_scprice'.$i.'_'.$curr['code'],true));
			$description = esc_attr(get_post_meta($post_id,'cmiedon_button_scpricedesc'.$i,true));
			if (!empty($price) || !empty($description)) { $output .= "<label><input type='radio' name='montant_$currCode' value='$price' class='montant'>&nbsp;&nbsp; <strong>$price $currSymbol</strong> - ".__( $description, 'cmi-donation' )."</label> <br>"; }
			$output .= "";
			$check="";
		}
		if (!empty($customPrice) && $customPrice == "1") {
			if (!empty($labelCustomPrice) && isset($labelCustomPrice)) {
				$output .= "<label><input type='radio' name='montant_$currCode' value='autres' class='montant'>&nbsp;&nbsp; <strong>".__( $labelCustomPrice, 'cmi-donation' )."</strong></label>";
			} else {
				$output .= "<label><input type='radio' name='montant_$currCode' value='autres' class='montant'>&nbsp;&nbsp; <strong>".__( 'Autre montant', 'cmi-donation' )."</strong></label>";
			}
		$output .= "<input type='number' step='0.01' min='1' name='autres_montant_$currCode' class='autres_montant' id='autres_montant_$currCode' placeholder='".__( 'Saisir votre montant', 'cmi-donation' )." ($currSymbol)' style='display:none' >";
		}
		$output .= "</div>";
	}
	$output .= "</div>";
	$output .= "<div class='box_paiment'>";
	$output .= "<strong>".__( 'Saisissez vos coordonnées', 'cmi-donation' )." :</strong> :<br>";
	if (!empty($anonymousMode) && $anonymousMode == "1") { 
		$output .= "<label><input type='radio' name='type_don' value='nominatif' class='nominatif' checked='checked'>&nbsp;&nbsp; ".__( 'Faire un don nominatif', 'cmi-donation' )."</label> <br>"; 
		$output .= "<label><input type='radio' name='type_don' value='anonyme' class='anonyme'>&nbsp;&nbsp; ".__( 'Faire un don anonyme', 'cmi-donation' )."</label> <br>"; 
	}
	$output .= "<div class='infoDonor'>";
	$output .= __( 'Nom', 'cmi-donation' )." :<input type='text' name='lastName' value='' class='classicInput' required='true' ><span class='spacer_input' ></span>";
	$output .= __( 'Prénom', 'cmi-donation' )." :<input type='text' name='firstName' value='' class='classicInput' required='true' ><span class='spacer_input' ></span>";
	$output .= __( 'Téléphone', 'cmi-donation' )." :<input type='tel'  pattern='^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$' name='tel' value='' class='classicInput' required='true' ><span class='spacer_input' ></span>";
	$output .= __( 'E-mail', 'cmi-donation' )." :<input type='email' name='email' id='email' value='' class='classicInput' required='true' ><span class='spacer_input' ></span>";
	$output .= __( 'Adresse', 'cmi-donation' )." :<input type='text' name='BillToStreet1' value='' class='classicInput' required='true' ><span class='spacer_input' ></span>";
	$output .= __( 'Ville', 'cmi-donation' )." :<input type='text' name='BillToCity' value='' class='classicInput' required='true' ><span class='spacer_input' ></span>";
	$output .= __( 'Pays', 'cmi-donation' )." :<select name='BillToCountry' required='true' class='classicInput_list'>";
	$output .= "<option value=''>".__( 'Choisir', 'cmi-donation' )." ...</option>";
	// foreach($countries as $countryCode => $countryName ){
		// if($countryCode == "MA"){$selected = "selected='selected'";}else{$selected = "";}
		// $output .= "<option value='$countryCode' $selected >".$countryName."</option>";
	// }
	$output .= "<option value='AF'>".__( 'Afghanistan', 'cmi-donation' )."</option>";
	$output .= "<option value='AX'>".__( 'Aland Islands', 'cmi-donation' )."</option>";
	$output .= "<option value='AL'>".__( 'Albania', 'cmi-donation' )."</option>";
	$output .= "<option value='DZ'>".__( 'Algeria', 'cmi-donation' )."</option>";
	$output .= "<option value='AS'>".__( 'American Samoa', 'cmi-donation' )."</option>";
	$output .= "<option value='AD'>".__( 'Andorra', 'cmi-donation' )."</option>";
	$output .= "<option value='AO'>".__( 'Angola', 'cmi-donation' )."</option>";
	$output .= "<option value='AI'>".__( 'Anguilla', 'cmi-donation' )."</option>";
	$output .= "<option value='AQ'>".__( 'Antarctica', 'cmi-donation' )."</option>";
	$output .= "<option value='AG'>".__( 'Antigua And Barbuda', 'cmi-donation' )."</option>";
	$output .= "<option value='AR'>".__( 'Argentina', 'cmi-donation' )."</option>";
	$output .= "<option value='AM'>".__( 'Armenia', 'cmi-donation' )."</option>";
	$output .= "<option value='AW'>".__( 'Aruba', 'cmi-donation' )."</option>";
	$output .= "<option value='AU'>".__( 'Australia', 'cmi-donation' )."</option>";
	$output .= "<option value='AT'>".__( 'Austria', 'cmi-donation' )."</option>";
	$output .= "<option value='AZ'>".__( 'Azerbaijan', 'cmi-donation' )."</option>";
	$output .= "<option value='BS'>".__( 'Bahamas', 'cmi-donation' )."</option>";
	$output .= "<option value='BH'>".__( 'Bahrain', 'cmi-donation' )."</option>";
	$output .= "<option value='BD'>".__( 'Bangladesh', 'cmi-donation' )."</option>";
	$output .= "<option value='BB'>".__( 'Barbados', 'cmi-donation' )."</option>";
	$output .= "<option value='BY'>".__( 'Belarus', 'cmi-donation' )."</option>";
	$output .= "<option value='BE'>".__( 'Belgium', 'cmi-donation' )."</option>";
	$output .= "<option value='BZ'>".__( 'Belize', 'cmi-donation' )."</option>";
	$output .= "<option value='BJ'>".__( 'Benin', 'cmi-donation' )."</option>";
	$output .= "<option value='BM'>".__( 'Bermuda', 'cmi-donation' )."</option>";
	$output .= "<option value='BT'>".__( 'Bhutan', 'cmi-donation' )."</option>";
	$output .= "<option value='BO'>".__( 'Bolivia', 'cmi-donation' )."</option>";
	$output .= "<option value='BA'>".__( 'Bosnia And Herzegovina', 'cmi-donation' )."</option>";
	$output .= "<option value='BW'>".__( 'Botswana', 'cmi-donation' )."</option>";
	$output .= "<option value='BV'>".__( 'Bouvet Island', 'cmi-donation' )."</option>";
	$output .= "<option value='BR'>".__( 'Brazil', 'cmi-donation' )."</option>";
	$output .= "<option value='IO'>".__( 'British Indian Ocean Territory', 'cmi-donation' )."</option>";
	$output .= "<option value='BN'>".__( 'Brunei Darussalam', 'cmi-donation' )."</option>";
	$output .= "<option value='BG'>".__( 'Bulgaria', 'cmi-donation' )."</option>";
	$output .= "<option value='BF'>".__( 'Burkina Faso', 'cmi-donation' )."</option>";
	$output .= "<option value='BI'>".__( 'Burundi', 'cmi-donation' )."</option>";
	$output .= "<option value='KH'>".__( 'Cambodia', 'cmi-donation' )."</option>";
	$output .= "<option value='CM'>".__( 'Cameroon', 'cmi-donation' )."</option>";
	$output .= "<option value='CA'>".__( 'Canada', 'cmi-donation' )."</option>";
	$output .= "<option value='CV'>".__( 'Cape Verde', 'cmi-donation' )."</option>";
	$output .= "<option value='KY'>".__( 'Cayman Islands', 'cmi-donation' )."</option>";
	$output .= "<option value='CF'>".__( 'Central African Republic', 'cmi-donation' )."</option>";
	$output .= "<option value='TD'>".__( 'Chad', 'cmi-donation' )."</option>";
	$output .= "<option value='CL'>".__( 'Chile', 'cmi-donation' )."</option>";
	$output .= "<option value='CN'>".__( 'China', 'cmi-donation' )."</option>";
	$output .= "<option value='CX'>".__( 'Christmas Island', 'cmi-donation' )."</option>";
	$output .= "<option value='CC'>".__( 'Cocos (Keeling) Islands', 'cmi-donation' )."</option>";
	$output .= "<option value='CO'>".__( 'Colombia', 'cmi-donation' )."</option>";
	$output .= "<option value='KM'>".__( 'Comoros', 'cmi-donation' )."</option>";
	$output .= "<option value='CG'>".__( 'Congo', 'cmi-donation' )."</option>";
	$output .= "<option value='CD'>".__( 'Congo, Democratic Republic', 'cmi-donation' )."</option>";
	$output .= "<option value='CK'>".__( 'Cook Islands', 'cmi-donation' )."</option>";
	$output .= "<option value='CR'>".__( 'Costa Rica', 'cmi-donation' )."</option>";
	$output .= "<option value='CI'>".__( 'Cote D\'Ivoire', 'cmi-donation' )."</option>";
	$output .= "<option value='HR'>".__( 'Croatia', 'cmi-donation' )."</option>";
	$output .= "<option value='CU'>".__( 'Cuba', 'cmi-donation' )."</option>";
	$output .= "<option value='CY'>".__( 'Cyprus', 'cmi-donation' )."</option>";
	$output .= "<option value='CZ'>".__( 'Czech Republic', 'cmi-donation' )."</option>";
	$output .= "<option value='DK'>".__( 'Denmark', 'cmi-donation' )."</option>";
	$output .= "<option value='DJ'>".__( 'Djibouti', 'cmi-donation' )."</option>";
	$output .= "<option value='DM'>".__( 'Dominica', 'cmi-donation' )."</option>";
	$output .= "<option value='DO'>".__( 'Dominican Republic', 'cmi-donation' )."</option>";
	$output .= "<option value='EC'>".__( 'Ecuador', 'cmi-donation' )."</option>";
	$output .= "<option value='EG'>".__( 'Egypt', 'cmi-donation' )."</option>";
	$output .= "<option value='SV'>".__( 'El Salvador', 'cmi-donation' )."</option>";
	$output .= "<option value='GQ'>".__( 'Equatorial Guinea', 'cmi-donation' )."</option>";
	$output .= "<option value='ER'>".__( 'Eritrea', 'cmi-donation' )."</option>";
	$output .= "<option value='EE'>".__( 'Estonia', 'cmi-donation' )."</option>";
	$output .= "<option value='ET'>".__( 'Ethiopia', 'cmi-donation' )."</option>";
	$output .= "<option value='FK'>".__( 'Falkland Islands (Malvinas)', 'cmi-donation' )."</option>";
	$output .= "<option value='FO'>".__( 'Faroe Islands', 'cmi-donation' )."</option>";
	$output .= "<option value='FJ'>".__( 'Fiji', 'cmi-donation' )."</option>";
	$output .= "<option value='FI'>".__( 'Finland', 'cmi-donation' )."</option>";
	$output .= "<option value='FR'>".__( 'France', 'cmi-donation' )."</option>";
	$output .= "<option value='GF'>".__( 'French Guiana', 'cmi-donation' )."</option>";
	$output .= "<option value='PF'>".__( 'French Polynesia', 'cmi-donation' )."</option>";
	$output .= "<option value='TF'>".__( 'French Southern Territories', 'cmi-donation' )."</option>";
	$output .= "<option value='GA'>".__( 'Gabon', 'cmi-donation' )."</option>";
	$output .= "<option value='GM'>".__( 'Gambia', 'cmi-donation' )."</option>";
	$output .= "<option value='GE'>".__( 'Georgia', 'cmi-donation' )."</option>";
	$output .= "<option value='DE'>".__( 'Germany', 'cmi-donation' )."</option>";
	$output .= "<option value='GH'>".__( 'Ghana', 'cmi-donation' )."</option>";
	$output .= "<option value='GI'>".__( 'Gibraltar', 'cmi-donation' )."</option>";
	$output .= "<option value='GR'>".__( 'Greece', 'cmi-donation' )."</option>";
	$output .= "<option value='GL'>".__( 'Greenland', 'cmi-donation' )."</option>";
	$output .= "<option value='GD'>".__( 'Grenada', 'cmi-donation' )."</option>";
	$output .= "<option value='GP'>".__( 'Guadeloupe', 'cmi-donation' )."</option>";
	$output .= "<option value='GU'>".__( 'Guam', 'cmi-donation' )."</option>";
	$output .= "<option value='GT'>".__( 'Guatemala', 'cmi-donation' )."</option>";
	$output .= "<option value='GG'>".__( 'Guernsey', 'cmi-donation' )."</option>";
	$output .= "<option value='GN'>".__( 'Guinea', 'cmi-donation' )."</option>";
	$output .= "<option value='GW'>".__( 'Guinea-Bissau', 'cmi-donation' )."</option>";
	$output .= "<option value='GY'>".__( 'Guyana', 'cmi-donation' )."</option>";
	$output .= "<option value='HT'>".__( 'Haiti', 'cmi-donation' )."</option>";
	$output .= "<option value='HM'>".__( 'Heard Island &amp; Mcdonald Islands', 'cmi-donation' )."</option>";
	$output .= "<option value='VA'>".__( 'Holy See (Vatican City State)', 'cmi-donation' )."</option>";
	$output .= "<option value='HN'>".__( 'Honduras', 'cmi-donation' )."</option>";
	$output .= "<option value='HK'>".__( 'Hong Kong', 'cmi-donation' )."</option>";
	$output .= "<option value='HU'>".__( 'Hungary', 'cmi-donation' )."</option>";
	$output .= "<option value='IS'>".__( 'Iceland', 'cmi-donation' )."</option>";
	$output .= "<option value='IN'>".__( 'India', 'cmi-donation' )."</option>";
	$output .= "<option value='ID'>".__( 'Indonesia', 'cmi-donation' )."</option>";
	$output .= "<option value='IR'>".__( 'Iran, Islamic Republic Of', 'cmi-donation' )."</option>";
	$output .= "<option value='IQ'>".__( 'Iraq', 'cmi-donation' )."</option>";
	$output .= "<option value='IE'>".__( 'Ireland', 'cmi-donation' )."</option>";
	$output .= "<option value='IM'>".__( 'Isle Of Man', 'cmi-donation' )."</option>";
	$output .= "<option value='IL'>".__( 'Israel', 'cmi-donation' )."</option>";
	$output .= "<option value='IT'>".__( 'Italy', 'cmi-donation' )."</option>";
	$output .= "<option value='JM'>".__( 'Jamaica', 'cmi-donation' )."</option>";
	$output .= "<option value='JP'>".__( 'Japan', 'cmi-donation' )."</option>";
	$output .= "<option value='JE'>".__( 'Jersey', 'cmi-donation' )."</option>";
	$output .= "<option value='JO'>".__( 'Jordan', 'cmi-donation' )."</option>";
	$output .= "<option value='KZ'>".__( 'Kazakhstan', 'cmi-donation' )."</option>";
	$output .= "<option value='KE'>".__( 'Kenya', 'cmi-donation' )."</option>";
	$output .= "<option value='KI'>".__( 'Kiribati', 'cmi-donation' )."</option>";
	$output .= "<option value='KR'>".__( 'Korea', 'cmi-donation' )."</option>";
	$output .= "<option value='KW'>".__( 'Kuwait', 'cmi-donation' )."</option>";
	$output .= "<option value='KG'>".__( 'Kyrgyzstan', 'cmi-donation' )."</option>";
	$output .= "<option value='LA'>".__( 'Lao People\'s Democratic Republic', 'cmi-donation' )."</option>";
	$output .= "<option value='LV'>".__( 'Latvia', 'cmi-donation' )."</option>";
	$output .= "<option value='LB'>".__( 'Lebanon', 'cmi-donation' )."</option>";
	$output .= "<option value='LS'>".__( 'Lesotho', 'cmi-donation' )."</option>";
	$output .= "<option value='LR'>".__( 'Liberia', 'cmi-donation' )."</option>";
	$output .= "<option value='LY'>".__( 'Libyan Arab Jamahiriya', 'cmi-donation' )."</option>";
	$output .= "<option value='LI'>".__( 'Liechtenstein', 'cmi-donation' )."</option>";
	$output .= "<option value='LT'>".__( 'Lithuania', 'cmi-donation' )."</option>";
	$output .= "<option value='LU'>".__( 'Luxembourg', 'cmi-donation' )."</option>";
	$output .= "<option value='MO'>".__( 'Macao', 'cmi-donation' )."</option>";
	$output .= "<option value='MK'>".__( 'Macedonia', 'cmi-donation' )."</option>";
	$output .= "<option value='MG'>".__( 'Madagascar', 'cmi-donation' )."</option>";
	$output .= "<option value='MW'>".__( 'Malawi', 'cmi-donation' )."</option>";
	$output .= "<option value='MY'>".__( 'Malaysia', 'cmi-donation' )."</option>";
	$output .= "<option value='MV'>".__( 'Maldives', 'cmi-donation' )."</option>";
	$output .= "<option value='ML'>".__( 'Mali', 'cmi-donation' )."</option>";
	$output .= "<option value='MT'>".__( 'Malta', 'cmi-donation' )."</option>";
	$output .= "<option value='MH'>".__( 'Marshall Islands', 'cmi-donation' )."</option>";
	$output .= "<option value='MQ'>".__( 'Martinique', 'cmi-donation' )."</option>";
	$output .= "<option value='MR'>".__( 'Mauritania', 'cmi-donation' )."</option>";
	$output .= "<option value='MU'>".__( 'Mauritius', 'cmi-donation' )."</option>";
	$output .= "<option value='YT'>".__( 'Mayotte', 'cmi-donation' )."</option>";
	$output .= "<option value='MX'>".__( 'Mexico', 'cmi-donation' )."</option>";
	$output .= "<option value='FM'>".__( 'Micronesia, Federated States Of', 'cmi-donation' )."</option>";
	$output .= "<option value='MD'>".__( 'Moldova', 'cmi-donation' )."</option>";
	$output .= "<option value='MC'>".__( 'Monaco', 'cmi-donation' )."</option>";
	$output .= "<option value='MN'>".__( 'Mongolia', 'cmi-donation' )."</option>";
	$output .= "<option value='ME'>".__( 'Montenegro', 'cmi-donation' )."</option>";
	$output .= "<option value='MS'>".__( 'Montserrat', 'cmi-donation' )."</option>";
	$output .= "<option value='MA' selected='selected'>".__( 'Morocco', 'cmi-donation' )."</option>";
	$output .= "<option value='MZ'>".__( 'Mozambique', 'cmi-donation' )."</option>";
	$output .= "<option value='MM'>".__( 'Myanmar', 'cmi-donation' )."</option>";
	$output .= "<option value='NA'>".__( 'Namibia', 'cmi-donation' )."</option>";
	$output .= "<option value='NR'>".__( 'Nauru', 'cmi-donation' )."</option>";
	$output .= "<option value='NP'>".__( 'Nepal', 'cmi-donation' )."</option>";
	$output .= "<option value='NL'>".__( 'Netherlands', 'cmi-donation' )."</option>";
	$output .= "<option value='AN'>".__( 'Netherlands Antilles', 'cmi-donation' )."</option>";
	$output .= "<option value='NC'>".__( 'New Caledonia', 'cmi-donation' )."</option>";
	$output .= "<option value='NZ'>".__( 'New Zealand', 'cmi-donation' )."</option>";
	$output .= "<option value='NI'>".__( 'Nicaragua', 'cmi-donation' )."</option>";
	$output .= "<option value='NE'>".__( 'Niger', 'cmi-donation' )."</option>";
	$output .= "<option value='NG'>".__( 'Nigeria', 'cmi-donation' )."</option>";
	$output .= "<option value='NU'>".__( 'Niue', 'cmi-donation' )."</option>";
	$output .= "<option value='NF'>".__( 'Norfolk Island', 'cmi-donation' )."</option>";
	$output .= "<option value='MP'>".__( 'Northern Mariana Islands', 'cmi-donation' )."</option>";
	$output .= "<option value='NO'>".__( 'Norway', 'cmi-donation' )."</option>";
	$output .= "<option value='OM'>".__( 'Oman', 'cmi-donation' )."</option>";
	$output .= "<option value='PK'>".__( 'Pakistan', 'cmi-donation' )."</option>";
	$output .= "<option value='PW'>".__( 'Palau', 'cmi-donation' )."</option>";
	$output .= "<option value='PS'>".__( 'Palestinian Territory, Occupied', 'cmi-donation' )."</option>";
	$output .= "<option value='PA'>".__( 'Panama', 'cmi-donation' )."</option>";
	$output .= "<option value='PG'>".__( 'Papua New Guinea', 'cmi-donation' )."</option>";
	$output .= "<option value='PY'>".__( 'Paraguay', 'cmi-donation' )."</option>";
	$output .= "<option value='PE'>".__( 'Peru', 'cmi-donation' )."</option>";
	$output .= "<option value='PH'>".__( 'Philippines', 'cmi-donation' )."</option>";
	$output .= "<option value='PN'>".__( 'Pitcairn', 'cmi-donation' )."</option>";
	$output .= "<option value='PL'>".__( 'Poland', 'cmi-donation' )."</option>";
	$output .= "<option value='PT'>".__( 'Portugal', 'cmi-donation' )."</option>";
	$output .= "<option value='PR'>".__( 'Puerto Rico', 'cmi-donation' )."</option>";
	$output .= "<option value='QA'>".__( 'Qatar', 'cmi-donation' )."</option>";
	$output .= "<option value='RE'>".__( 'Reunion', 'cmi-donation' )."</option>";
	$output .= "<option value='RO'>".__( 'Romania', 'cmi-donation' )."</option>";
	$output .= "<option value='RU'>".__( 'Russian Federation', 'cmi-donation' )."</option>";
	$output .= "<option value='RW'>".__( 'Rwanda', 'cmi-donation' )."</option>";
	$output .= "<option value='BL'>".__( 'Saint Barthelemy', 'cmi-donation' )."</option>";
	$output .= "<option value='SH'>".__( 'Saint Helena', 'cmi-donation' )."</option>";
	$output .= "<option value='KN'>".__( 'Saint Kitts And Nevis', 'cmi-donation' )."</option>";
	$output .= "<option value='LC'>".__( 'Saint Lucia', 'cmi-donation' )."</option>";
	$output .= "<option value='MF'>".__( 'Saint Martin', 'cmi-donation' )."</option>";
	$output .= "<option value='PM'>".__( 'Saint Pierre And Miquelon', 'cmi-donation' )."</option>";
	$output .= "<option value='VC'>".__( 'Saint Vincent And Grenadines', 'cmi-donation' )."</option>";
	$output .= "<option value='WS'>".__( 'Samoa', 'cmi-donation' )."</option>";
	$output .= "<option value='SM'>".__( 'San Marino', 'cmi-donation' )."</option>";
	$output .= "<option value='ST'>".__( 'Sao Tome And Principe', 'cmi-donation' )."</option>";
	$output .= "<option value='SA'>".__( 'Saudi Arabia', 'cmi-donation' )."</option>";
	$output .= "<option value='SN'>".__( 'Senegal', 'cmi-donation' )."</option>";
	$output .= "<option value='RS'>".__( 'Serbia', 'cmi-donation' )."</option>";
	$output .= "<option value='SC'>".__( 'Seychelles', 'cmi-donation' )."</option>";
	$output .= "<option value='SL'>".__( 'Sierra Leone', 'cmi-donation' )."</option>";
	$output .= "<option value='SG'>".__( 'Singapore', 'cmi-donation' )."</option>";
	$output .= "<option value='SK'>".__( 'Slovakia', 'cmi-donation' )."</option>";
	$output .= "<option value='SI'>".__( 'Slovenia', 'cmi-donation' )."</option>";
	$output .= "<option value='SB'>".__( 'Solomon Islands', 'cmi-donation' )."</option>";
	$output .= "<option value='SO'>".__( 'Somalia', 'cmi-donation' )."</option>";
	$output .= "<option value='ZA'>".__( 'South Africa', 'cmi-donation' )."</option>";
	$output .= "<option value='GS'>".__( 'South Georgia And Sandwich Isl.', 'cmi-donation' )."</option>";
	$output .= "<option value='ES'>".__( 'Spain', 'cmi-donation' )."</option>";
	$output .= "<option value='LK'>".__( 'Sri Lanka', 'cmi-donation' )."</option>";
	$output .= "<option value='SD'>".__( 'Sudan', 'cmi-donation' )."</option>";
	$output .= "<option value='SR'>".__( 'Suriname', 'cmi-donation' )."</option>";
	$output .= "<option value='SJ'>".__( 'Svalbard And Jan Mayen', 'cmi-donation' )."</option>";
	$output .= "<option value='SZ'>".__( 'Swaziland', 'cmi-donation' )."</option>";
	$output .= "<option value='SE'>".__( 'Sweden', 'cmi-donation' )."</option>";
	$output .= "<option value='CH'>".__( 'Switzerland', 'cmi-donation' )."</option>";
	$output .= "<option value='SY'>".__( 'Syrian Arab Republic', 'cmi-donation' )."</option>";
	$output .= "<option value='TW'>".__( 'Taiwan', 'cmi-donation' )."</option>";
	$output .= "<option value='TJ'>".__( 'Tajikistan', 'cmi-donation' )."</option>";
	$output .= "<option value='TZ'>".__( 'Tanzania', 'cmi-donation' )."</option>";
	$output .= "<option value='TH'>".__( 'Thailand', 'cmi-donation' )."</option>";
	$output .= "<option value='TL'>".__( 'Timor-Leste', 'cmi-donation' )."</option>";
	$output .= "<option value='TG'>".__( 'Togo', 'cmi-donation' )."</option>";
	$output .= "<option value='TK'>".__( 'Tokelau', 'cmi-donation' )."</option>";
	$output .= "<option value='TO'>".__( 'Tonga', 'cmi-donation' )."</option>";
	$output .= "<option value='TT'>".__( 'Trinidad And Tobago', 'cmi-donation' )."</option>";
	$output .= "<option value='TN'>".__( 'Tunisia', 'cmi-donation' )."</option>";
	$output .= "<option value='TR'>".__( 'Turkey', 'cmi-donation' )."</option>";
	$output .= "<option value='TM'>".__( 'Turkmenistan', 'cmi-donation' )."</option>";
	$output .= "<option value='TC'>".__( 'Turks And Caicos Islands', 'cmi-donation' )."</option>";
	$output .= "<option value='TV'>".__( 'Tuvalu', 'cmi-donation' )."</option>";
	$output .= "<option value='UG'>".__( 'Uganda', 'cmi-donation' )."</option>";
	$output .= "<option value='UA'>".__( 'Ukraine', 'cmi-donation' )."</option>";
	$output .= "<option value='AE'>".__( 'United Arab Emirates', 'cmi-donation' )."</option>";
	$output .= "<option value='GB'>".__( 'United Kingdom', 'cmi-donation' )."</option>";
	$output .= "<option value='US'>".__( 'United States', 'cmi-donation' )."</option>";
	$output .= "<option value='UM'>".__( 'United States Outlying Islands', 'cmi-donation' )."</option>";
	$output .= "<option value='UY'>".__( 'Uruguay', 'cmi-donation' )."</option>";
	$output .= "<option value='UZ'>".__( 'Uzbekistan', 'cmi-donation' )."</option>";
	$output .= "<option value='VU'>".__( 'Vanuatu', 'cmi-donation' )."</option>";
	$output .= "<option value='VE'>".__( 'Venezuela', 'cmi-donation' )."</option>";
	$output .= "<option value='VN'>".__( 'Viet Nam', 'cmi-donation' )."</option>";
	$output .= "<option value='VG'>".__( 'Virgin Islands, British', 'cmi-donation' )."</option>";
	$output .= "<option value='VI'>".__( 'Virgin Islands, U.S.', 'cmi-donation' )."</option>";
	$output .= "<option value='WF'>".__( 'Wallis And Futuna', 'cmi-donation' )."</option>";
	$output .= "<option value='YE'>".__( 'Yemen', 'cmi-donation' )."</option>";
	$output .= "<option value='ZM'>".__( 'Zambia', 'cmi-donation' )."</option>";
	$output .= "<option value='ZW'>".__( 'Zimbabwe', 'cmi-donation' )."</option>";
	$output .= "</select><span class='spacer_input' ></span>";
	$output .= "</div>";
	if (!empty($term) && $term == "1") { 
		$termUrl = $term;
	} else {
		$termUrl = "#";
	}
	$output .= "<p><br><label><input type='checkbox' required='true'> ".__( 'J\'accepte', 'cmi-donation' )." </label><a href='$term' target='_blank'>".__( 'les conditions générales de donations', 'cmi-donation' )."</a></p>";
	$output .= "</div>";
	$output .= "<input type='hidden' name='pid' value='$post_id'>";
	$output .= "<input type='hidden' name='clientid' value='$orgClientId'>";
	$output .= "<input type='hidden' name='okUrl' value='$orgOkUrl'>";
	$output .= "<input type='hidden' name='failUrl' value='$orgFailUrl'>";
	$output .= "<input type='hidden' name='TranType' value='$orgTransactionType'>";
	$output .= "<input type='hidden' name='callbackUrl' value='$orgCallbackUrl'>";
	$output .= "<input type='hidden' name='currency' value='$orgCurrency'>";
	$output .= "<input type='hidden' name='rnd' value='$orgRnd'>";
	$output .= "<input type='hidden' name='storetype' value='3D_PAY_HOSTING'>";
	$output .= "<input type='hidden' name='hashAlgorithm' value='ver3'>";
	$output .= "<input type='hidden' name='refreshtime' value='5'>";
	$output .= "<input type='hidden' name='shopurl' value='$shopurl'>";
	$output .= "<input type='hidden' name='encoding' value='UTF-8'>";
	$output .= "<center><input class='cmiedon_cmibuttonimage' type='submit' name='submit' value=".__( 'Submit', 'cmi-donation' )."></center>";
	$output .= "</form></div>";

	return $output;
	
}