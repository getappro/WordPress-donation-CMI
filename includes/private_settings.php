<?php


function cmiedon_plugin_options() {
	if ( !current_user_can( "manage_options" ) )  {
		wp_die( __( "You do not have sufficient permissions to access this page." ) );
	}




// media uploader
function load_admin_things() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
}
load_admin_things();

?>

<script>
jQuery(document).ready(function() {
	var formfield;
	jQuery('.upload_image_button').click(function() {
		jQuery('html').addClass('Image');
		formfield = jQuery(this).prev().attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});
	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html){
	if (formfield) {
		fileurl = jQuery('img',html).attr('src');
		jQuery('#'+formfield).val(fileurl);
		tb_remove();
		jQuery('html').removeClass('Image');
	} else {
		window.original_send_to_editor(html);
	}
	};
});
</script>

<?php


// settings page
echo "<table width='100%'><tr><td width='70%'><br />";
echo "<label style='color: #000;font-size:18pt;'><center>CMI Donation Settings</center></label>";
echo "<form method='post' action='".$_SERVER["REQUEST_URI"]."'>";


// save and update options
if (isset($_POST['update'])) {

	if (!isset($_POST['action_save']) || ! wp_verify_nonce($_POST['action_save'],'nonce_save') ) {
	   print 'Sorry, your nonce did not verify.';
	   exit;
	}
	
	if($_POST['merchant_id']){
		$options['merchant_id'] = 		sanitize_text_field($_POST['merchant_id']);
	}	
	
	if($_POST['SLKSecretkey']){
		$options['SLKSecretkey'] = 		sanitize_text_field($_POST['SLKSecretkey']);
	}
	
	if($_POST['actionslk']){
		$options['actionslk'] = 		sanitize_text_field($_POST['actionslk']);
	}
	if($_POST['confirmation_mode']){
		$options['confirmation_mode'] = 		sanitize_text_field($_POST['confirmation_mode']);
	}
	if($_POST['return']){
		$options['return'] = 		sanitize_text_field($_POST['return']);
	}
	
	if($_POST['cancel']){
		$options['cancel'] = 		sanitize_text_field($_POST['cancel']);
	}
	if($_POST['term']){
		$options['term'] = 		sanitize_text_field($_POST['term']);
	}
	
	
	update_option("cmiedon_settingsoptions", $options);
	
	echo "<br /><div class='updated'><p><strong>"; _e("Settings Updated."); echo "</strong></p></div>";
}


// get options
$options = get_option('cmiedon_settingsoptions');
foreach ($options as $k => $v ) { $value[$k] = esc_attr($v); }

echo "</td><td></td></tr><tr><td>";

// form
echo "<br />";
$confirmMode = array (
            'a' => 'Automatic',
            'm' => 'Manual'
        );
		// var_dump($options);
?>
<div style="background-color:#333333;padding:8px;color:#eee;font-size:12pt;font-weight:bold;">
&nbsp; CMI Merchant Informations </div><div style="background-color:#fff;border: 1px solid #E5E5E5;padding:5px;"><br />
<table>
	<tr>
		<td><b>Merchant ID <span style="color:red;">*</span>:</b></td>
		<td><input type='text' name='merchant_id' value='<?php if(isset($value['merchant_id'])) { echo $value['merchant_id']; } ?>' required='true' ></td>
	</tr>
	<tr>
		<td></td>
		<td>Enter a valid CMI Merchant ID.<br /><br /></td>
	</tr>
	<tr>
		<td><b>Secret Key <span style="color:red;">*</span>:</b></td>
		<td><input type='text' name='SLKSecretkey' value='<?php if(isset($value['SLKSecretkey'])) { echo $value['SLKSecretkey']; } ?>' required='true' ></td>
	</tr>
	<tr>
		<td></td>
		<td>Enter a hash key generated from your CMI back office.<br /><br /></td>
	</tr>
	<tr>
		<td><b>Gateway URL <span style="color:red;">*</span>:</b></td>
		<td><input type='text' name='actionslk' value='<?php if(isset($value['actionslk'])) { echo $value['actionslk']; } ?>' required='true' ></td>
	</tr>
	<tr>
		<td></td>
		<td>Gateway URL provided by CMI.<br /><br /></td>
	</tr>
	<tr>
		<td><b>Confirmation mode:</b></td>
		<td>
		<select name='confirmation_mode' >
			<?php foreach($confirmMode as $key => $el ){  ?>
				<option <?php if (isset($value['confirmation_mode']) && $value['confirmation_mode'] == $key ) echo 'selected' ; ?> value="<?php echo $key; ?>" ><?php echo $el; ?></option>
			<?php }  ?>
		</select>
		</td>
	</tr>
	<tr>
		<td></td>
		<td>Automatic confirmation of CMI transactions.<br /><br /></td>
	</tr>
</table>

</div><br /><br />
<div style="background-color:#333333;padding:8px;color:#eee;font-size:12pt;font-weight:bold;">
&nbsp; Other Settings
</div><div style="background-color:#fff;border: 1px solid #E5E5E5;padding:5px;"><br />
<?php 
$siteurl = get_site_url();
?>
<table>
	<tr>
		<td><b>Terms & conditions URL <span style="color:red;">*</span> :</b></td>
		<td><input type='text' name='term' value='<?php if(isset($value['term'])) { echo $value['term']; } ?>' required='true' ></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo "URL of the terms and conditions page";?></td>
	</tr>
	<tr>
		<td><b>Cancel URL:</b></td>
		<td><input type='text' name='cancel' value='<?php if(isset($value['cancel'])) { echo $value['cancel']; } ?>'></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo "If the customer goes to CMI and clicks the cancel button, where does he go. <br />Example: $siteurl/cancel. Max length: 1,024 characters. <br /><br />";?></td>
	</tr>
	<tr>
		<td><b>Return URL :</b></td>
		<td><input type='text' name='return' value='<?php if(isset($value['return'])) { echo $value['return']; } ?>'></td>
	</tr>
	<tr>
		<td></td>
		<td><?php echo "If the customer goes to CMI and successfully pays, where is he redirected to after. <br />Example: $siteurl/thankyou. Max length: 1,024 characters. <br /><br />";?></td>
	</tr>
</table>
<br /><br /></div>

<input type='hidden' name='update'><br />
<?php echo wp_nonce_field('nonce_save','action_save'); ?>
<input type='submit' name='btn2' class='button-primary' style='font-size: 17px;line-height: 28px;height: 32px;' value='Save Settings'>





<br /><br /><br />


WPPlugin is an offical CMI Partner. Various trademarks held by their respective owners.


</form>




</td><td width='5%'>
</td><td width='24%' valign='top'>

<br />

<div style="background-color:#333333;padding:8px;color:#eee;font-size:12pt;font-weight:bold;">
&nbsp; Usage - How to use this plugin
</div>

<div style="background-color:#fff;border: 1px solid #E5E5E5;padding:5px;"><br />

<b>1. Enter CMI Merchant Informations</b><br />
Use the information that are sent to you by CMI in the integration kit. <br /><br />

<b>2. Manage currencies</b><br />
If you use Multi-currencies, On the <a href='admin.php?page=cmiedon_currencies' target='_blank'>currencies page</a>, add currencies. <br /><br />

<b>2. Make a button</b><br />
On the <a href='admin.php?page=cmiedon_buttons' target='_blank'>buttons page</a>, make a new button. <br /><br />

<b>3. Place button on page</b><br />
You can place the button on your site in 3 ways. In you Page / Post editor you can use the button titled "CMI Donation Button". You can use the "CMI Donation Button" Widget. Or you can manually place the shortcode on a Page / Post.<br /><br />

<b>4. View donations</b><br />
On the <a href='admin.php?page=cmiedon_menu' target='_blank'>donations page</a> you can view the donations that have been made on your site.<br /><br />

</td><td width='1%'>

</td></tr></table>


<?php
// end settings page and required permissions
}