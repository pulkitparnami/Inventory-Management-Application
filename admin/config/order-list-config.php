<?php
include('../../core/init.php'); 
if(isset($_POST['dp_submit'])){
	$dp_start  = escape($_POST['dp_start']);
	$dp_end    = escape($_POST['dp_end']);
	$order_cl  = new Order();
	$orders    = $order_cl->get_order_by_date($dp_start,$dp_end);
	if($orders){
		?>
		<div class="table-responsive changelog-table">
			<table class="table table-striped">
				<tr>
					<th>ID</th>
					<th>Image</th>
					<th>Order Date</th>
					<th>Product Code</th>
					<th>Quantity</th>
					<th>Order Taken</th>
				</tr>
				<tbody>
				<?php
					foreach ($orders as $order) {

						$order_id   = escape($order['order_id']);
						$order_date = escape($order['order_date']);
						$prod_img   = escape($order['image']);
						$prod_code  = escape($order['pc_code']);
						$order_qty  = (int) $order['order_qty'];
						$order_tk   = $_SESSION['user_name'];


						$td  = '<tr>';
						$td .= '<td><a href="'.REL.'/admin/edit-order.php?od='.$order_id.'">'.$order_id.'</a></td>';
						$td .= '<td class="ti-img"><img src="'.REL.'/uploads/80X80/'.$prod_img.'"/></td>';
						$td .= '<td>'.$order_date.'</td>';
						$td .= '<td><a href="'.REL.'/admin/edit-product.php?p='.$prod_code.'">'.$prod_code.'</td>';
						$td .= '<td>'.$order_qty.'</td>';
						$td .= '<td>'.$order_tk.'</td>';
						$td .= '</tr>';
						echo $td;
					}
				?>
				</tbody>
			</table>
		</div>
	<?php 
		}
	}
?>