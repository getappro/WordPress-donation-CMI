<?php

add_action('init', 'cmiedon_button_media_buttons_init');

function cmiedon_button_media_buttons_init() {
	global $pagenow, $typenow;

	// add media button for editor page
	if ( in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) && $typenow != 'download' ) {
		
		add_action('admin_footer', 'cmiedon_button_add_inline_popup_content');
		add_action('media_buttons', 'cmiedon_button_add_my_media_button', 20);
		
		// button
		function cmiedon_button_add_my_media_button() {
			echo '<a href="#TB_inline?width=600&height=500&inlineId=cmiedon_popup_container" title="Insert a CMI Donation Button" id="insert-my-media" class="button thickbox">CMI Donation Button</a>';
		}
		
		// popup
		function cmiedon_button_add_inline_popup_content() {
		?>
		
			
		<script type="text/javascript">
			function cmiedon_button_InsertShortcode() {
			
				var id = document.getElementById("cmiedon_button_id").value;
				// var cmiedon_alignmentc = document.getElementById("cmiedon_align");
				// var cmiedon_alignmentb = cmiedon_alignmentc.options[cmiedon_alignmentc.selectedIndex].value;
				
				if(id == "No buttons found.") { alert("Error: Please select an existing button from the dropdown or make a new one."); return false; }
				if(id == "") { alert("Error: Please select an existing button from the dropdown or make a new one."); return false; }
				
				// if(cmiedon_alignmentb == "none") { var cmiedon_alignment = ""; } else { var cmiedon_alignment = ' align="' + cmiedon_alignmentb + '"'; };
				
				window.send_to_editor('[cmiedon id="' + id + '"]');
				
				document.getElementById("cmiedon_button_id").value = "";
				// cmiedon_alignmentc.selectedIndex = null;
			}
		</script>

		
		<div id="cmiedon_popup_container" style="display:none;">
		
		
			<h2>Insert a CMI Donation Button</h2>

			<table><tr><td>
			
			Choose an existing button: </td></tr><tr><td>
			<select id="cmiedon_button_id" name="cmiedon_button_id">
				<?php
				$args = array('post_type' => 'wpplugin_don_button','posts_per_page' => -1);

				$posts = get_posts($args);

				$count = "0";
				
				if (isset($posts)) {
					
					foreach ($posts as $post) {

						$id = $posts[$count]->ID;
						$post_title = $posts[$count]->post_title;
						$price = get_post_meta($id,'cmiedon_button_price',true);
						$sku = get_post_meta($id,'cmiedon_button_id',true);

						echo "<option value='$id'>";
						echo "Name: ";
						echo $post_title;
						// echo " - Amount: ";
						// echo $price;
						// echo " - ID: ";
						// echo $sku;
						echo "</option>";

						$count++;
					}
				}
				else {
					echo "<option>No buttons found.</option>";
				}
				
				?>
			</select>
			</td></tr><tr><td>
			Make a new button: <a target="_blank" href="admin.php?page=cmiedon_buttons&action=new">here</a><br />
			Manage existing buttons: <a target="_blank" href="admin.php?page=cmiedon_buttons">here</a>
			
			</td></tr><tr><td>
			<br />
			</td></tr><tr><td>
			
			<input type="button" id="cmiedon-cmi-insert" class="button-primary" onclick="cmiedon_button_InsertShortcode();" value="Insert Button">		
			
			</td></tr></table>
		</div>
		<?php
		}
	}
}