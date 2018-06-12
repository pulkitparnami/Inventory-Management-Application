<?php
include('../../core/init.php'); 
if(isset($_POST['dp_submit'])){
	$dp_start  = escape($_POST['dp_start']);
	$dp_end    = escape($_POST['dp_end']);
	$inventory = new Inventory();
	$changelog = $inventory->get_changelog_by_date($dp_start,$dp_end);
	if($changelog){
		?>
		<div class="table-responsive changelog-table">
			<table class="table">
				<tr class="chng-th">
					<th>Image</th>
					<th>Code</th>
					<th>Last Edit</th>
					<th><span class="chng-pur">Pr.</span><span class="chng-sale">Sale</span></th>
					<th>Qty before</th>
					<th>New Qty</th>
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
						$td .= '<td class="ti-img"><img src="'.REL.'/uploads/80X80/'.escape($item['image']).'"/></td>';
						$td .= '<td>'.escape($item['pc_code']).'</td>';
						$td .= '<td>'.escape($item['edited_on']).'</td>';
						$td .= '<td><span class="'.$qty_class.'">'.intval($quantity).'</span></td>';
						$td .= '<td>'.intval($item['old_qty']).'</td>';
						$td .= '<td>'.intval($item['new_qty']).'</td>';
						$td .= '<td>'.$item['edit_notes'].'</td>';
						$td .= '<td>'.escape($item['edited_by']).'</td>';
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