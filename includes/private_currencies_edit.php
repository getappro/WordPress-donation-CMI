<?php
		if (isset($_POST['update'])) {
			
			$post_id = intval($_GET['product']);
			
			if (!$post_id) {
				echo'<script>window.location="admin.php?page=cmiedon_currencies"; </script>';
				exit;
			}
			
			// Update data
			
			if (!isset($error)) {
			
				$my_post = array(
				'ID'           => $post_id,
				'post_title'   => sanitize_text_field($_POST['cmiedon_currency_name'])
				);
				wp_update_post($my_post);
				
				update_post_meta($post_id, 'cmiedon_currency_rate', sanitize_text_field($_POST['cmiedon_currency_rate']));
				update_post_meta($post_id, 'cmiedon_currency_label', sanitize_text_field($_POST['cmiedon_currency_label']));
				update_post_meta($post_id, 'cmiedon_currency_status', sanitize_text_field($_POST['cmiedon_currency_status']));
								
				$message = "Saved";
				
			}
		}
		
		?>
		
		<div style="width:98%;">
		
			<form method='post' action='<?php $_SERVER["REQUEST_URI"]; ?>'>
			
				<?php
				$post_id = sanitize_text_field($_GET['product']);
				
				$post_data = get_post($post_id);
				$title = $post_data->post_title;
				
				$siteurl = get_site_url();
				?>

				<table width="100%"><tr><td valign="bottom" width="85%">
					<br />
					<span style="font-size:20pt;">Edit CMI Donation Currency</span>
					</td><td valign="bottom">
					<input type="submit" class="button-primary" style="font-size: 14px;height: 30px;float: right;" value="Save CMI Donation Currency">
					</td><td valign="bottom">
					<a href="admin.php?page=cmiedon_currencies" class="button-secondary" style="font-size: 14px;height: 30px;float: right;">View All Donation Currencies</a>
				</td></tr></table>

				<?php
				// error
				if (isset($error) && isset($error) && isset($message)) {
					echo "<div class='error'><p>"; echo $message; echo"</p></div>";
				}
				// saved
				if (!isset($error)&& !isset($error) && isset($message)) {
					echo "<div class='updated'><p>"; echo $message; echo"</p></div>";
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
				'CRC' => 'Costa Rican col??n',
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
				'ISK' => 'Icelandic kr??na',
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
				'MNT' => 'Mongolian t??gr??g',
				'MAD' => 'Moroccan dirham',
				'MZN' => 'Mozambican metical',
				'NAD' => 'Namibian dollar',
				'NPR' => 'Nepalese rupee',
				'NZD' => 'New Zealand dollar',
				'NIO' => 'Nicaraguan c??rdoba',
				'NGN' => 'Nigerian naira',
				'NOK' => 'Norwegian krone',
				'OMR' => 'Omani rial',
				'PKR' => 'Pakistani rupee',
				'PAB' => 'Panamanian balboa',
				'PGK' => 'Papua New Guinean kina',
				'PYG' => 'Paraguayan guaran??',
				'PEN' => 'Peruvian sol',
				'PHP' => 'Philippine peso',
				'PLN' => 'Polish zloty',
				'QAR' => 'Qatari riyal',
				'RON' => 'Romanian leu',
				'RUB' => 'Russian ruble',
				'RWF' => 'Rwandan franc',
				'WST' => 'Samoan tala',
				'STD' => 'S??o Tom?? and Pr??ncipe dobra',
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
				'VEF' => 'Venezuelan bol??var',
				'VND' => 'Vietnamese dong',
				'XOF' => 'West African CFA franc',
				'YER' => 'Yemeni rial',
				'ZMW' => 'Zambian kwacha',
			);
				$status = array (
				'1' => 'Enabled',
				'0' => 'Disabled'
			);
			$statusVal = get_post_meta($post_id,'cmiedon_currency_status',true);
				?>
				
				<br />
				
				<div style="background-color:#fff;padding:8px;border: 1px solid #CCCCCC;"><br />
				
					<table>
						<tr>
							<td>Code<span style="color:red;">*</span>  :</td>
							<td>
								<select name="cmiedon_currency_name">
									<?php foreach($currList as $currCode => $currName ){  ?>
										<option <?php if (isset($title) && $title == $currCode ) echo 'selected' ; ?> value="<?php echo $currCode; ?>" ><?php echo $currName; ?></option>
									<?php }  ?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Label<span style="color:red;">*</span>  :</td>
							<td>
								<input class='allownumericwithoutdecimal' type="text" name="cmiedon_currency_label" value="<?php echo esc_attr(get_post_meta($post_id,'cmiedon_currency_label',true)); ?>" />
							</td>
						</tr>
						<tr>
							<td>Conversion rate<span style="color:red;">*</span> :</td>
							<td>
								<input class='allownumericwithdecimal' type="text" name="cmiedon_currency_rate" value="<?php echo esc_attr(get_post_meta($post_id,'cmiedon_currency_rate',true)); ?>" required='true' /><br/>
								<small>Numeric values only allowed With Decimal Point - If default currency(MAD) enter the value "1".</small>
							</td>
						</tr>
						<tr>
							<td>Status :</td>
							<td>
								<select name="cmiedon_currency_status">
									<?php foreach($status as $key => $el ){  ?>
										<option <?php if (isset($statusVal) && $statusVal == $key ) echo 'selected' ; ?> value="<?php echo esc_attr($key); ?>" ><?php echo $el; ?></option>
									<?php }  ?>
								</select>
							</td>
						</tr>
					</table>
					<input type="hidden" name="update">					
				</div>
				
			</form>