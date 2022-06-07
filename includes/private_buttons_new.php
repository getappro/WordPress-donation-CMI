<?php

global $current_user;
$currArr = getCurrencies();
	if (isset($_POST['update'])) {
		$my_post = array(
		  'post_title'    => sanitize_text_field($_POST['cmiedon_button_name']),
		  'post_status'   => 'publish',
		  'post_author'   => $current_user->ID,
		  'post_type'     => 'wpplugin_don_button'
		);
		// var_dump($my_post);
		if (!isset($error)) {
			
			// Insert the post and meta data into the database
			$post_id = wp_insert_post( $my_post );
			
			update_post_meta($post_id, 'cmiedon_button_anonymous', sanitize_text_field($_POST['cmiedon_button_anonymous']));
			update_post_meta($post_id, 'cmiedon_button_customPrice', sanitize_text_field($_POST['cmiedon_button_customPrice']));
			update_post_meta($post_id, 'cmiedon_button_LabelCustomPrice', sanitize_text_field($_POST['cmiedon_button_LabelCustomPrice']));
			for ($i = 1; $i <= 10; $i++) {
				foreach ($currArr as $key => $curr ) {
					if (isset($_POST['cmiedon_button_scprice'.$i.'_'.$curr['code']]) && $_POST['cmiedon_button_scprice'.$i.'_'.$curr['code']] != "") {
						update_post_meta($post_id, 'cmiedon_button_scprice'.$i.'_'.$curr['code'], sanitize_text_field($_POST['cmiedon_button_scprice'.$i.'_'.$curr['code']]));
					}
				}
				if (isset($_POST['cmiedon_button_scpricedesc'.$i]) && $_POST['cmiedon_button_scpricedesc'.$i] != "") {
					update_post_meta($post_id, 'cmiedon_button_scpricedesc'.$i, sanitize_text_field($_POST['cmiedon_button_scpricedesc'.$i]));
				}
			}
			
			echo'<script>window.location="?page=cmiedon_buttons&message=created";</script>';
			exit;
		
		}
	}
	
	$anonymous = array (
		'0' => 'Disabled',
		'1' => 'Enabled'
	);
	?>
	
	<div style="width:98%;">
	
		<form method='post' action='<?php $_SERVER["REQUEST_URI"]; ?>'>
			
				<table width="100%"><tr><td valign="bottom" width="85%">
				<br />
				<span style="font-size:20pt;">New CMI Donation Button</span>
				</td><td valign="bottom">
				<input type="submit" class="button-primary" style="font-size: 14px;height: 30px;float: right;" value="Save CMI Donation Button">
				</td><td valign="bottom">
				<a href="admin.php?page=cmiedon_buttons" class="button-secondary" style="font-size: 14px;height: 30px;float: right;">Cancel</a>
				</td></tr></table>
			
			
			<?php
			// error
			if (isset($error) && isset($error) && isset($message)) {
					echo "<div class='error'><p>"; echo $message; echo"</p></div>";
			}
			?>
			
				
			<br />

			<div style="background-color:#fff;padding:8px;border: 1px solid #CCCCCC;"><br />
				
					<table>
						<tr>
							<td>Button Name<span style="color:red;">*</span> : </td>
							<td>
								<input type="text" name="cmiedon_button_name" value="<?php if(isset($_POST['cmiedon_button_name'])) { echo esc_attr($_POST['cmiedon_button_name']); } ?>" required='true'>
							</td>
							<td></td>
						</tr>
						<tr>
							<td>Anonymous donor: </td>
							<td>
								<select name="cmiedon_button_anonymous">
									<?php foreach($anonymous as $key => $el ){  ?>
										<option <?php if (isset($_POST['cmiedon_button_anonymous']) && $_POST['cmiedon_button_anonymous'] == $key ) echo 'selected' ; ?> value="<?php echo $key; ?>" ><?php echo $el; ?></option>
									<?php }  ?>
								</select>
							</td>
							<td> Optional - If enabled, the donor can donate as anonymous.</td>
						</tr>
						<tr>
							<td></td>
							<td><br /></td>
							<td></td>
						</tr>
						<tr>
							<td>Your selected currencies</td>
							<td>
								<ul>
								<?php
									
									foreach ($currArr as $key => $curr ) {
										echo "<li><strong>- ".$curr['label']."(".$curr['symbol'].")</strong></li>";
									}
								?>
								</ul>
							</td>
							<td>Manage existing Currencies: <a target="_blank" href="admin.php?page=cmiedon_currencies">here</a></td>
						</tr>
						<tr>
							<td></td>
							<td><br /></td>
							<td></td>
						</tr>
						<tr>
							<td>Custom Price: </td>
							<td>
								<select name="cmiedon_button_customPrice">
									<?php foreach($anonymous as $key => $el ){  ?>
										<option <?php if (isset($_POST['cmiedon_button_customPrice']) && $_POST['cmiedon_button_customPrice'] == $key ) echo 'selected' ; ?> value="<?php echo $key; ?>" ><?php echo $el; ?></option>
									<?php }  ?>
								</select>
							</td>
							<td> Optional - If enabled, the donor can enter their own amount.</td>
						</tr>
						<tr>
							<td>Label Custom Price: </td>
							<td>
								<input type="text" name="cmiedon_button_LabelCustomPrice" value="<?php if(isset($_POST['cmiedon_button_LabelCustomPrice'])) { echo esc_attr($_POST['cmiedon_button_LabelCustomPrice']); } ?>" required='true'>
							</td>
							<td> Optional - If Custom Price option enabled, the donor can enter their own label.</td>
						</tr>
						<tr>
							<td></td>
							<td><br /></td>
							<td></td>
						</tr>
						
						<tr>
							<td>Amount Select Options: </td>
						</tr>
						<tr>
							<table>
								<thead>
									<tr>
										<td> </td>
										<?php								
											foreach ($currArr as $key => $curr ) {
												echo "<td align='center'><strong>".$curr['label']."(".$curr['symbol'].")</strong></td>";
											}
										?>
										<td align='center'><strong>Description</strong></td>
									</tr>
								</thead>
								<tbody>
									<?php for ($i = 1; $i <= 10; $i++) { ?>
										<tr>
											<td><strong>Option / Amount <?php echo $i;?>:</strong></td>
											<?php								
												foreach ($currArr as $key => $curr ) {
													echo "<td> ";
											?>
													<input  type='number' step='0.01' min='1'  style="width:100px;" name="cmiedon_button_scprice<?php echo $i.'_'.$curr['code'];?>" id="cmiedon_button_scprice<?php echo $i.'_'.$curr['code'];?>" value="<?php if(isset($_POST['cmiedon_button_scprice'.$i.'_'.$curr['code']])) { echo esc_attr($_POST['cmiedon_button_scprice'.$i.'_'.$curr['code']]); } ?>">
											<?php
													echo "</td> ";
												}
											?>
											<td><input style="width:250px;background: #f1f1f1;" type="text" name="cmiedon_button_scpricedesc<?php echo $i;?>" id="cmiedon_button_scpricedesc<?php echo $i;?>" value="<?php if(isset($_POST['cmiedon_button_scpricedesc'.$i])) { echo esc_attr($_POST['cmiedon_button_scpricedesc'.$i]); } ?>"></td>
										</tr>				
									<?php } ?> 
								</tbody>
							</table>
						</tr>
					</table>
					<input type="hidden" name="update">
				</div>
			
		</form>
	</div>