<?php

function cmiedon_plugin_currencies() {

	if (!isset($_GET['action']) || $_GET['action'] == "delete" || !empty($_GET['action2']) == "delete") {
		
		// create a table
		
		if(!class_exists('WP_List_Table')) {
			require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
		}
		
		class cmiedon_currencies_table extends WP_List_Table {
			
			
			function get_data() {
				global $wp_query;
				
				$args = array('post_type' => 'wpplugin_don_curr','posts_per_page' => -1);
				
				$posts = get_posts($args);
				$count = "0";
				foreach ($posts as $post) {
					
					$id = $posts[$count]->ID;
					$post_title = $posts[$count]->post_title;
					
					if ($post_title == "" || $post_title == " " || empty($post_title)) {
						$post_title = "(No Item Name)";
					}
					
					$rate = 	esc_attr(get_post_meta($id,'cmiedon_currency_rate',true));
					$label = 		esc_attr(get_post_meta($id,'cmiedon_currency_label',true));
					$status = 			esc_attr(get_post_meta($id,'cmiedon_currency_status',true));
					if($status == "0"){
						$status = "Disabled";
					}else{
						$status = "Enabled";
					}
					
					if (empty($price)) {
						$price = "Customer enters amount";
					}
					
					
					$product = $post_title;
					
					$data[] = array(
						'ID' 		=> $id,
						'product' 	=> $product,
						'shortcode' => $rate,
						'price' 	=> $label,
						'sku'		=> $status
					);
					
					$count++;
				}
				
				if (empty($data)) {
					$data = array();
				}
				
				return $data;
			}
				
				
				
			function __construct() {
				global $status, $page;
				
				parent::__construct( array(
					'singular'  => 'product',
					'plural'    => 'products',
					'ajax'      => false
				) );
			}
				
				
			 function column_default($item, $column_name){
					switch($column_name){
						case 'product':
						case 'shortcode':
						case 'price':
						case 'sku':
							return $item[$column_name];
						default:
							return print_r($item,true);
					}
			}

			function column_product($item){
			
				// edit
				$edit_bare = '?page=cmiedon_currencies&action=edit&product='.$item['ID'];
				$edit_url = wp_nonce_url($edit_bare, 'edit_'.$item['ID']);
				
				// delete
				$delete_bare = '?page=cmiedon_currencies&action=delete&inline=true&product='.$item['ID'];
				$delete_url = wp_nonce_url($delete_bare, 'bulk-'.$this->_args['plural']);
				
				$actions = array(
					'edit'      => "<a href=$edit_url>Edit</a>",
					'delete'      => "<a href=$delete_url>Delete</a>"
				);
				
				return sprintf('%1$s %2$s',
					$item['product'],
					$this->row_actions($actions)
				);
			}
			
			
			
			function column_cb($item) {
				return sprintf(
					'<input type="checkbox" name="%1$s[]" value="%2$s" />',
					$this->_args['singular'],
					$item['ID']
				);
			}
			
			
			function get_columns() {
				$columns = array(
					'cb'			=> '<input type="checkbox" />',
					'product'     	=> 'Code',
					'shortcode'     => 'Rate',
					'price'    		=> 'Label',
					'sku'			=> 'Status'
				);
				return $columns;
			}
			
			
			function no_items() {
				_e( 'No currencies found.' );
			}
			
			
			function get_bulk_actions() {
					$actions = array(
						'delete'    => 'Delete'
					);
					return $actions;
			}
			
			public function process_bulk_action() {
				if ( isset( $_GET['_wpnonce'] ) && ! empty( $_GET['_wpnonce'] ) ) {
					$nonce  = $_GET['_wpnonce'];
					$action = 'bulk-' . $this->_args['plural'];
					
					if ( ! wp_verify_nonce( $nonce, $action ) ) {
						wp_die('Security check fail'); 
					}
				}
			}
			
			
			function prepare_items() {
				global $wpdb;
				
				$per_page = 5;
				
				$columns = $this->get_columns();
				$hidden = array();
				$sortable = $this->get_sortable_columns();
				
				$this->_column_headers = array($columns, $hidden, $sortable);
				
				$this->process_bulk_action();
				
				$data = $this->get_data();

				function usort_reorder($a,$b) {
					$orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'product';
					$order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc';
					$result = strcmp($a[$orderby], $b[$orderby]);
					return ($order==='asc') ? $result : -$result;
				}
				usort($data, 'usort_reorder');
				

				$current_page = $this->get_pagenum();
				
				

				$total_items = count($data);

				$data = array_slice($data,(($current_page-1)*$per_page),$per_page);

				$this->items = $data;

				$this->set_pagination_args( array(
					'total_items' => $total_items,
					'per_page'    => $per_page,
					'total_pages' => ceil($total_items/$per_page)
				) );
				
			}
		}
	

		function cmiedon_tt_render_list_page() {

			$testListTable = new cmiedon_currencies_table();
			$testListTable->prepare_items();

			?>
			
			<style>
			.check-column {
				width: 2% !important;
			}
			.column-product {
				width: 25%;
			}
			.column-shortcode {
				width: 35%;
			}
			.column-price {
				width: 25%;
			}
			.column-sku {
				width: 13%;
			}
			</style>
			
			<div style="width:98%">
			
				<table width="100%"><tr><td>
				<br />
				<span style="font-size:20pt;">CMI Donation currencies</span>
				</td><td valign="bottom">
				<a href="?page=cmiedon_currencies&action=new" name='btn2' class='button-primary' style='font-size: 14px;height: 30px;float: right;'>New currency</a>
				</td></tr></table>
				
				<?php
				if (isset($_GET['message']) && $_GET['message'] == "created") {
					echo "<div class='updated'><p>currency created.</p></div>";
				}
				if (isset($_GET['message']) && $_GET['message'] == "deleted") {
					echo "<div class='updated'><p>currency(s) deleted.</p></div>";
				}
				if (isset($_GET['message']) && $_GET['message'] == "nothing") {
					echo "<div class='updated'><p>No action selected.</p></div>";
				}
				if (isset($_GET['message']) && $_GET['message'] == "nothing_deleted") {
					echo "<div class='updated'><p>Nothing selected to delete.</p></div>";
				}
				if (isset($_GET['message']) && $_GET['message'] == "error") {
					echo "<div class='updated'><p>An error occured while processing the query. Please try again.</p></div>";
				}
				?>
				
				<form id="products-filter" method="get">
					<input type="hidden" name="page" value="<?php echo $_REQUEST['page'] ?>" />
					<?php $testListTable->display() ?>
				</form>
			
			</div>

			<?php
		}
		
		cmiedon_tt_render_list_page();
		
		
	}
	
	
	// admin products page new product
	if (isset($_GET['action']) && $_GET['action'] == "new") {
		include_once ('private_currencies_new.php');
	}
	// end admin products page new product
	
	// admin products page edit product
	if (isset($_GET['action']) && $_GET['action'] == "edit") {
		$post_id = $_GET['product'];
		check_admin_referer('edit_'.$post_id);
		include_once ('private_currencies_edit.php');
	}
	// end admin products page edit product
	
	// admin products page delete product
	if (isset($_GET['action']) && $_GET['action'] == "delete" || isset($_GET['action2']) && $_GET['action2'] == "delete") {		
		
		if (!empty($_GET['inline']) == "true") {
			$post_id = array($_GET['product']);
		} else {
			$post_id = $_GET['product'];
		}
		
		if (empty($post_id)) {
			echo'<script>window.location="?page=cmiedon_currencies&message=nothing_deleted"; </script>';
			exit;
		}
		
		foreach ($post_id as $to_delete) {
			
			$to_delete = intval($to_delete);
			
			if (!$to_delete) {
				echo'<script>window.location="?page=cmiedon_currencies&message=error"; </script>';
				exit;
			}
			
			wp_delete_post($to_delete,1);
			delete_post_meta($to_delete,'cmiedon_currency_name');
			delete_post_meta($to_delete,'cmiedon_currency_rate');
			delete_post_meta($to_delete,'cmiedon_currency_label');
			// delete_post_meta($to_delete,'cmiedon_currency_position');
			delete_post_meta($to_delete,'cmiedon_currency_status');
			
		}
		
		echo'<script>window.location="?page=cmiedon_currencies&message=deleted"; </script>';
		exit;
		
	}
	// end admin products page delete product
	
	// admin orders page no action taken
	if (isset($_GET['action']) && $_GET['action'] == "-1") {
		echo'<script>window.location="?page=cmiedon_currencies&message=nothing"; </script>';
	}
	// end admin orders page no action taken

}