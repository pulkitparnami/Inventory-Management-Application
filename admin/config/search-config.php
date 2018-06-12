<?php
include('../../core/init.php');

//Search product
if(isset($_POST['product_kw'])){
	$input_code = escape($_POST['product_kw']);
	$inventory = new Inventory();
	$products = $inventory->get_product_like($input_code);
	
	if(empty($products)){
		echo 'No product found.';
	}
	else{
		$total_products = count($products);
		$html = '<ul class="src-plist striped src-ul">';
		$i = 0;
		foreach($products as $product){
			$i++;
			if($i >5){
				echo $html;
				echo '<a class="src-count" href="'.REL.'/admin/inventory.php">See all : '.$total_products.' results.</a></ul>';
				die();
			}
			$prod_code   = escape($product->pc_code);
			$dealer_code = escape($product->dealer_code);
			$image  	 = escape($product->image);
			$quantity 	 = intval($product->quantity);
			$locations	 = $product->location;
			$permalink 	 = REL.'/admin/edit-product.php?p='.$prod_code;

			$html .= '<li>';
			$html .= '<div class="src-pimg"><img src="'.REL.'/uploads/80X80/'.$image.'"/></div>';
			$html .= '<div class="src-pdetails">';
			$html .= '<span class="src-ppc_code src-this">'.$prod_code.'</span>';
			$html .= '<span class="src-pdeal_code src-this">'.$dealer_code.'</span>';
			$html .= '<span class="src-quantity">Qty: '.$quantity.'</span>';
			$html .= '</div>';
			$html .= '<a href="'.$permalink.'" class="src-link"></a>';
			$html .= '<div class="src-pinfo" data-spi=\'{"prod_code": "'.$prod_code.'","quantity":"'.$quantity.'","locations": '.$locations.'}\'></div>';
			$html .= '</li>';
		}
		$html .= '</ul>';
		$html .= '<div class="src-count">Results found: '.$total_products.'</div>';
		echo $html;
	}
}

//Search Customer
if(isset($_POST['user_kw'])){
	$user_data = escape($_POST['user_kw']);
	$user_class = new User();
	$users = $user_class->get_user_like($user_data);
	
	if(empty($users)){
		echo 'No Customer found.';
	}
	else{
		$total_users = count($users);
		$html = '<ul class="src-clist striped src-ul">';
		$i = 0;
		foreach($users as $user){
			$i++;
			if($i >5){
				echo $html;
				echo '<a class="src-count" href="'.REL.'/admin/users-list.php">See all : '.$total_users.' results.</a></ul>';
				die();
			}
			$user_id 	 = intval($user->id);
			$first_name  = escape($user->first_name);
			$last_name   = escape($user->last_name);
			$email_id	 = escape($user->email_id);
			$mobile	 	 = intval($user->mobile_no);
			$permalink 	 = REL.'/admin/single-user.php?u='.$user_id;

			if(strlen($email_id) > 24){
				$email_id = str_replace(substr($email_id, 24),'..', $email_id); 
			}

			$html .= '<li>';
			$html .= '<div class="src-cdetails">';
			$html .= '<span class="src-cname src-this">'.$first_name.' '.$last_name.'</span>';
			$html .= '<span class="src-cemail src-this">'.$email_id.'</span>';
			$html .= '<span class="icon icon-phone"></span><span class="src-cmobile src-this">'.$mobile.'</span>';
			$html .= '</div>';
			$html .= '<a href="'.$permalink.'" class="src-link"></a>';
			$html .= '</li>';
		}
		$html .= '</ul>';
		$html .= '<div class="src-count">Results found: '.$total_users.'</div>';
		echo $html;
	}
}


?>