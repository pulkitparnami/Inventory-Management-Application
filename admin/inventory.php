<?php
include('../core/init.php'); 
require_once('../templates/header.php'); 
$inventory = new Inventory();
$get_inventory = $inventory->get_inventory();
if($get_inventory){	
?>
<div class="container">
	<div class="row">
		<div class="col-md-10 inventory-modal">
			<div class="cust-btn add-product-btn"><a href="<?php echo REL.'/admin/add-product.php'; ?>">ADD PRODUCT</a></div>
			<div class="cust-btn view-cl-btn"><a href="<?php echo REL.'/admin/changelog.php'; ?>">VIEW CHANGELOG</a></div>
			<div class="table-responsive inventory-table">
				<table class="table">
					<tr class="inv-th">
						<th>Product Image</th>
						<th>Product Code</th>
						<th>Product Quantity</th>
						<th>Last Edited</th>
						<th>Edit Product</th>
						<th>Changelog</th>
					</tr>
					<tbody>
					<?php
						foreach ($get_inventory as $item) {
							$td  = '<tr>';
							$td .= '<td class="ti-img"><img src="'.REL.'/uploads/80X80/'.escape($item['image']).'"/></td>';
							$td .= '<td>'.escape($item['pc_code']).'<br>'.escape($item['dealer_code']).'</td>';
							$td .= '<td>'.intval($item['quantity']).'</td>';
							$td .= '<td>'.escape($item['edited_time']).'</td>';
							$td .= '<td><a href="'.REL.'/admin/edit-product.php?p='.escape($item['pc_code']).'">Edit</a></td>';
							$td .= '<td><a href="'.REL.'/admin/changelog-product.php?p='.escape($item['pc_code']).'">View</a></td>';
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
else{
	echo 'Opss !! You have no products.';
	echo '<div class="cust-btn"><a href="'.REL.'/admin/add-product.php">ADD PRODUCT</a></div>';
}
?>
