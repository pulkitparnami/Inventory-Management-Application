<?php
include('../core/init.php'); 
if(!isset($_GET['p'])){
	redirect(REL.'/404.php');
}
else{
	$prod_code 		= escape($_GET['p']);
	$inventory	  	= new Inventory();
	$changelog  	= $inventory->get_changelog($prod_code);
	include_once(ROOT.'/templates/header.php');
	if(!$changelog){
		echo 'No edit has been made yet.';
	}
	else{
?>
<div class="container">
	<div class="row">
		<div class="col-md-10 changelog-modal">
			<div class="cust-btn"><a href="<?php echo REL.'/admin/inventory.php'; ?>">BACK</a></div>
			<div class="table-responsive changelog-table">
				<table class="table">
					<tr class="chng-th">
						<th>Last Edit</th>
						<th><span class="chng-pur">Purchase</span><span class="chng-sale">Sale</span></th>
						<th>Quantity before</th>
						<th>New Quantity</th>
						<th>Edit Notes</th>
						<th>Edited by</th>
					</tr>
					<tbody>
					<?php
						foreach ($changelog as $item) {

							$quantity = (int) $item['qty_edited'];
							if($quantity < 0){
								$qty_class = 'qty-sale';
							}
							elseif($quantity == 0){
								$qty_class = '';
							}
							else{
								$qty_class = 'qty-pur';
							}

							$td  = '<tr>';
							$td .= '<td>'.escape($item['edited_on']).'</td>';
							$td .= '<td><span class="'.$qty_class.'">'.escape($quantity).'</span></td>';
							$td .= '<td>'.escape($item['old_qty']).'</td>';
							$td .= '<td>'.escape($item['new_qty']).'</td>';
							$td .= '<td>'.strip_tags($item['edit_notes'],'<br>').'</td>';
							$td .= '<td>'.escape($item['edited_by']).'</td>';
							$td .= '</tr>';
							echo $td;
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php
	}
}
?>