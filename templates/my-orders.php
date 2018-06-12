
<?php
$order_class = new Order();
$orders = $order_class->get_order_by('user_id',$user_id);

?>
<div class="orders-list">
	<?php
	if(empty($orders)){
		echo 'Your order list is empty.';
	}
	else{
		foreach($orders as $order){
			$order_id 	  = intval($order->order_id);
			$order_date	  = escape($order->order_date);
			$order_qty	  = intval($order->order_qty);
			$order_status = intval($order->order_status);
			$tracking	  = json_decode($order->tracking_details,true);
			$product_code =	escape($order->pc_code);
			$product_img  = escape($order->image);
			?>
			<div class="order-details-container">
				<div class="od-top clearfix">
					<span class="od-id">Order ID: <?php echo $order_id; ?></span>
					<span class="od-date">Placed On: <?php echo $order_date; ?></span>
				</div>

				<div class="od-main">
					<img src="<?php echo REL.'/uploads/110X110/'.$product_img ?>"/>
					<?php 
						if(is_admin()){
							echo '<a href="'.REL.'/admin/edit-order.php?od='.$order_id.'" class="btn btn-info edit-order-btn">Edit Order</a>';
						}
					?>
					<ul class="od-track">
					<?php foreach ($tracking as $step => $date) {
						switch ($step) {
							case '1':
								$step_title = 'Order Placed';
								break;

							case '3':
								$step_title = 'Ready to print';
								break;

							case '5':
								$step_title = 'Printed';
								break;

							case '7':
								$step_title = 'Assembled';
								break;

							case '9':
								$step_title = 'Ready to dispatch';
								break;
							
							default:
								$step_title = 'Order Placed';
								break;
						}
						$step_done = !empty($date) ? 'od-step-done' : null;
						$html  = '<li class="od-step '.$step_done.'">';
						$html .= '<span class="od-tr-txt">'.$step_title.'</span>';
						$html .= '<span class="od-tr-date">'.$date.'</span>';
						$html .= '</li>';
						echo $html;
					}
					?>
					</ul>
				</div>
			</div>


	<?php		
		}
	}
	?>
</div>