<?php

global $current_user;

	if (isset($_POST['update'])) {

		$my_post = array(
		  'post_title'    => sanitize_text_field($_POST['cmiedon_currency_name']),
		  'post_status'   => 'publish',
		  'post_author'   => $current_user->ID,
		  'post_type'     => 'wpplugin_don_curr'
		);
		
		if (!isset($error)) {
			
			// Insert the post and meta data into the database
			// $post_id = wp_insert_post( $my_post );
			 $post_id = wp_insert_post( $my_post);
			update_post_meta($post_id, 'cmiedon_currency_rate', sanitize_text_field($_POST['cmiedon_currency_rate']));
			update_post_meta($post_id, 'cmiedon_currency_label', sanitize_text_field($_POST['cmiedon_currency_label']));
			
			update_post_meta($post_id, 'cmiedon_currency_status', sanitize_text_field($_POST['cmiedon_currency_status']));
			
			echo'<script>window.location="?page=cmiedon_currencies&message=created";</script>';
			exit;
		
		}
	}
	
	?>
	
	<div style="width:98%;">
	
		<form method='post' action='<?php $_SERVER["REQUEST_URI"]; ?>'>
			
				<table width="100%"><tr><td valign="bottom" width="85%">
				<br />
				<span style="font-size:20pt;">New Donation Currency</span>
				</td><td valign="bottom">
				<input type="submit" class="button-primary" style="font-size: 14px;height: 30px;float: right;" value="Save CMI Donation Currency">
				</td><td valign="bottom">
				<a href="admin.php?page=cmiedon_currencies" class="button-secondary" style="font-size: 14px;height: 30px;float: right;">Cancel</a>
				</td></tr></table>
			
			
			<?php
			// error
			if (isset($error) && isset($error) && isset($message)) {
					echo "<div class='error'><p>"; echo $message; echo"</p></div>";
			}
			$currList = array (
				'AFN' => 'Afghan afghani',
				'ALL' => 'Albanian lek',
				'DZD' => 'Algerian dinar',
				'AOA' => 'Angolan kwanza',
				'XCD' => 'East Caribbean dollar',
				'ARS' => 'Argentine peso',
				'AMD' => 'Armenian dram',
				'AUD' => 'Australian dollar',
				'AZN' => 'Azerbaijani manat',
				'BSD' => 'Bahamian dollar',
				'BHD' => 'Bahraini dinar',
				'BDT' => 'Bangladeshi taka',
				'BBD' => 'Barbadian dollar',
				'BYN' => 'Belarusian ruble',
				'BZD' => 'Belize dollar',
				'BTN' => 'Bhutanese ngultrum',
				'BOB' => 'Bolivian boliviano',
				'BAM' => 'Bosnia and Herzegovina convertible mark',
				'BWP' => 'Botswana pula',
				'BRL' => 'Brazilian real',
				'GBP' => 'British pound',
				'BND' => 'Brunei dollar',
				'BGN' => 'Bulgarian lev',
				'BIF' => 'Burundian franc',
				'MMK' => 'Burmese kyat',
				'KHR' => 'Cambodian riel',
				'CAD' => 'Canadian dollar',
				'CVE' => 'Cape Verdean escudo',
				'XAF' => 'Central African CFA franc',
				'CLP' => 'Chilean peso',
				'CNY' => 'Chinese yuan',
				'COP' => 'Colombian peso',
				'KMF' => 'Comorian franc',
				'CRC' => 'Costa Rican colón',
				'HRK' => 'Croatian kuna',
				'CUP' => 'Cuban peso',
				'CZK' => 'Czech koruna',
				'CDF' => 'Congolese franc',
				'DKK' => 'Danish krone',
				'DJF' => 'Djiboutian franc',
				'DOP' => 'Dominican peso',
				'XCD' => 'East Caribbean dollar',
				'EGP' => 'Egyptian pound',
				'ERN' => 'Eritrean nakfa',
				'ETB' => 'Ethiopian birr',
				'EUR' => 'Euro',
				'FJD' => 'Fijian dollar',
				'GMD' => 'Gambian dalasi',
				'GEL' => 'Georgian lari',
				'GHS' => 'Ghanaian cedi',
				'GTQ' => 'Guatemalan quetzal',
				'GNF' => 'Guinean franc',
				'GYD' => 'Guyanese dollar',
				'HTG' => 'Haitian gourde',
				'HNL' => 'Honduran lempira',
				'HUF' => 'Hungarian forint',
				'ISK' => 'Icelandic króna',
				'INR' => 'Indian rupee',
				'IDR' => 'Indonesian rupiah',
				'IRR' => 'Iranian rial',
				'IQD' => 'Iraqi dinar',
				'ILS' => 'Israeli new shekel',
				'JMD' => 'Jamaican dollar',
				'JPY' => 'Japanese yen',
				'JOD' => 'Jordanian dinar',
				'KZT' => 'Kazakhstani tenge',
				'KES' => 'Kenyan shilling',
				'KWD' => 'Kuwaiti dinar',
				'KGS' => 'Kyrgyzstani som',
				'LAK' => 'Lao kip',
				'LBP' => 'Lebanese pound',
				'LSL' => 'Lesotho loti',
				'LRD' => 'Liberian dollar',
				'LYD' => 'Libyan dinar',
				'MKD' => 'Macedonian denar',
				'MGA' => 'Malagasy ariary',
				'MWK' => 'Malawian kwacha',
				'MYR' => 'Malaysian ringgit',
				'MVR' => 'Maldivian rufiyaa',
				'KPW' => 'North Korean won',
				'MRO' => 'Mauritanian ouguiya',
				'MUR' => 'Mauritian rupee',
				'MXN' => 'Mexican peso',
				'MDL' => 'Moldovan leu',
				'MNT' => 'Mongolian tögrög',
				'MAD' => 'Moroccan dirham',
				'MZN' => 'Mozambican metical',
				'NAD' => 'Namibian dollar',
				'NPR' => 'Nepalese rupee',
				'NZD' => 'New Zealand dollar',
				'NIO' => 'Nicaraguan córdoba',
				'NGN' => 'Nigerian naira',
				'NOK' => 'Norwegian krone',
				'OMR' => 'Omani rial',
				'PKR' => 'Pakistani rupee',
				'PAB' => 'Panamanian balboa',
				'PGK' => 'Papua New Guinean kina',
				'PYG' => 'Paraguayan guaraní',
				'PEN' => 'Peruvian sol',
				'PHP' => 'Philippine peso',
				'PLN' => 'Polish zloty',
				'QAR' => 'Qatari riyal',
				'RON' => 'Romanian leu',
				'RUB' => 'Russian ruble',
				'RWF' => 'Rwandan franc',
				'WST' => 'Samoan tala',
				'STD' => 'São Tomé and Príncipe dobra',
				'SAR' => 'Saudi riyal',
				'RSD' => 'Serbian dinar',
				'SCR' => 'Seychellois rupee',
				'SLL' => 'Sierra Leonean leone',
				'SGD' => 'Singapore dollar',
				'SBD' => 'Solomon Islands dollar',
				'SOS' => 'Somali shilling',
				'ZAR' => 'South African rand',
				'KRW' => 'South Korean won',
				'SSP' => 'South Sudanese pound',
				'LKR' => 'Sri Lankan rupee',
				'SDG' => 'Sudanese pound',
				'SRD' => 'Surinamese dollar',
				'SZL' => 'Swazi lilangeni',
				'SEK' => 'Swedish krona',
				'CHF' => 'Swiss franc',
				'SYP' => 'Syrian pound',
				'TWD' => 'New Taiwan dollar',
				'TJS' => 'Tajikistani somoni',
				'TZS' => 'Tanzanian shilling',
				'THB' => 'Thai baht',
				'TOP' => 'Tongan paanga',
				'TTD' => 'Trinidad and Tobago dollar',
				'TND' => 'Tunisian dinar',
				'TRY' => 'Turkish lira',
				'TMT' => 'Turkmenistan manat',
				'UGX' => 'Ugandan shilling',
				'UAH' => 'Ukrainian hryvnia',
				'AED' => 'United Arab Emirates dirham',
				'USD' => 'United States dollar',
				'UYU' => 'Uruguayan peso',
				'UZS' => 'Uzbekistani som',
				'VUV' => 'Vanuatu vatu',
				'VEF' => 'Venezuelan bolívar',
				'VND' => 'Vietnamese dong',
				'XOF' => 'West African CFA franc',
				'YER' => 'Yemeni rial',
				'ZMW' => 'Zambian kwacha',
			);
			$status = array (
            '1' => 'Enabled',
            '0' => 'Disabled'
        );

			(isset($_POST["company"])) ? $company = $_POST["company"] : $company=1;
			?>
			
				
			<br />

			<div style="background-color:#fff;padding:8px;border: 1px solid #CCCCCC;"><br />
				
					<table>
						<tr>
							<td>Code<span style="color:red;">*</span>  :</td>
							<td>
								<select name="cmiedon_currency_name" required='true' >
									<option value="">Choose...</option>
									<?php foreach($currList as $currCode => $currName ){  ?>
										<option <?php if (isset($_POST['cmiedon_currency_name']) && $_POST['cmiedon_currency_name'] == $currCode ) echo 'selected' ; ?> value="<?php echo $currCode; ?>" ><?php echo $currName; ?></option>
									<?php }  ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Label<span style="color:red;">*</span>  :</td>
							<td>
								<input type="text" name="cmiedon_currency_label" value="<?php if(isset($_POST['cmiedon_currency_label'])) { echo esc_attr($_POST['cmiedon_currency_label']); } ?>" required='true'/>
							</td>
						</tr>
						<tr>
							<td>Conversion rate<span style="color:red;">*</span> :</td>
							<td>
								<input class='allownumericwithdecimal' type="text" name="cmiedon_currency_rate" value="<?php if(isset($_POST['cmiedon_currency_rate'])) { echo esc_attr($_POST['cmiedon_currency_rate']); } ?>" required='true' /><br/>
								<small>Numeric values only allowed With Decimal Point - If default currency(MAD) enter the value "1".</small>
							</td>
						</tr>
						<tr>
							<td>Status :</td>
							<td>
								<select name="cmiedon_currency_status">
									<?php foreach($status as $key => $el ){  ?>
										<option <?php if (isset($_POST['cmiedon_currency_status']) && $_POST['cmiedon_currency_status'] == $key ) echo 'selected' ; ?> value="<?php echo $key; ?>" ><?php echo $el; ?></option>
									<?php }  ?>
								</select>
							</td>
						</tr>
					</table>
						<input type="hidden" name="update">
							
				</div>
			
		</form>
<script type="text/javascript">
jQuery( document ).ready(function() {
	jQuery(".allownumericwithdecimal").on("keypress keyup blur",function (event) {
		jQuery(this).val(jQuery(this).val().replace(/[^0-9\.]/g,''));
		if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});
	jQuery(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
           jQuery(this).val(jQuery(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
});
</script>