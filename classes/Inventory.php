<?php
class Inventory{

	public $_db,
		   $all_locations = array('shop','basement','first floor','second floor','third floor','home');

	public function __construct(){
		$this->_db = Db::get_instance()->db;
	}


	/**
	 * @return  Full Inventory 
 	 */
	public function get_inventory($prod_code = null){
		$sql = "SELECT * , DATE_FORMAT(edited_time,'%d %b %Y %h:%i %p') as edited_time FROM inventory98_xoo WHERE 1=1";

		if($prod_code){
			$sql .= 'AND pc_code = ?';
		}

		$query = $this->_db->prepare($sql);
		$values = array($prod_code);
		$query->execute($values);
		if($query->rowcount()){
			$query_results = $query->fetchAll(PDO::FETCH_ASSOC);
			return $query_results;
		}
		else{
			return false;
		}
	}

	/**
	 * @var Return value for Getters function (Single product)
	 */
	private $id,
			$_prodCode,
			$_dealerCode,
			$_quantity,
			$_image,
			$_category,
			$_location;


	/**
	 * @param   Product code(dealer_code)
	 * @return  Single Product 
 	 */

	public function get_product($prod_code){
		$sql = "SELECT * FROM inventory98_xoo WHERE pc_code = ? LIMIT 1";
		$query = $this->_db->prepare($sql);
		$values = array($prod_code);
		$query->execute($values);
		if($query->rowCount() == 1){
			$query_results = $query->fetchAll(PDO::FETCH_OBJ);
			$item = $query_results[0];
			$this->_id 			 = $item->id;
			$this->_prodCode 	 = $item->pc_code;
			$this->_dealerCode 	 = $item->dealer_code;
			$this->_quantity 	 = $item->quantity;
			$this->_image 	 	 = $item->image;
			$this->_category 	 = $item->category;
			$this->_location	 = $item->location;
			return $this; 
		}
		else{
			return false;
		}
	}

	/**
	 * @return Product ID
 	 */

	public function get_id(){
		return intval($this->_id);
	}

	/**
	 * @return Product code
 	 */

	public function get_prod_code(){
		return escape($this->_prodCode);
	}


	/**
	 * @return Dealer code
 	 */

	public function get_dealer_code(){
		return escape($this->_dealerCode);
	}

	/**
	 * @return Product Quantity
 	 */

	public function get_quantity(){
		return intval($this->_quantity);
	}

	/**
	 * @return Product Category
 	 */

	public function get_category(){
		return escape($this->_category);
	}

	/**
	 * @return Product Image
 	 */

	public function get_image(){
		return escape($this->_image);
	}

	/**
	 * @return Product Location
 	 */

	public function get_location(){
		return $this->_location;
	}


	/**
	 * @return  add product in inventory
 	 */

	public function add_product($category,$quantity,$image,$dealer_code,$location,$prod_code){
		//$now = date("d-m-Y h:i:a");
		$sql = "INSERT INTO inventory98_xoo (category,quantity,image,dealer_code,location,pc_code,edited_time) VALUES(?,?,?,?,?,?,NOW())";
		$query = $this->_db->prepare($sql);
		$values = array($category,$quantity,$image,$dealer_code,$location,$prod_code);
		$query->execute($values);

		if($query->rowCount()){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * @return  Update product in inventory.
 	 */

	public function update_product($category,$quantity,$image,$location,$new_dealer_code,$new_prod_code,$old_prod_code){
		//$now = date("d-m-Y h:i:a");
		$sql = 'UPDATE inventory98_xoo SET category = ? , quantity = ? , image = ?, dealer_code = ? , pc_code = ? , edited_time = NOW(), location = ? WHERE pc_code = ?';
		$query = $this->_db->prepare($sql);
		$values = array($category,$quantity,$image,$new_dealer_code,$new_prod_code,$location,$old_prod_code);
		$query->execute($values);
		if($query->rowCount()){
			return true;
		}
		else{
			return false;
		}
	}

	public function update_product_fields($set_args,$where_args){
		$table_name = 'inventory98_xoo';
		Db::update($table_name,$set_args,$where_args);
	}


	/**
	 * @return Insert entries in changelog.
 	 */

	public function update_changelog($image,$prod_code,$qty_edited,$old_qty,$new_qty,$edited_by,$edit_notes){
		$sql = "INSERT INTO inventory_changelog (image,pc_code,qty_edited,old_qty,new_qty,edited_by,edit_notes,edited_on) VALUES (?,?,?,?,?,?,?,NOW())";
		$query  = $this->_db->prepare($sql);
		$values = array($image,$prod_code,$qty_edited,$old_qty,$new_qty,$edited_by,$edit_notes);
        $query->execute($values);
        if($query->rowCount()){
        	return true;
        }
        else{
        	return false;
        }
	}

	public function update_changelog_fields($args = array()){

		if(!isset($args['pc_code']) || !isset($args['edit_notes'])){
			die('Pass parameters.');
		}

		$this->get_product_by('pc_code',$args['pc_code']);
		$db_dealer_code = $this->get_dealer_code();
		$db_quantity 	= $this->get_quantity();
		$db_image 		= $this->get_image();
		$db_location 	= $this->get_location();

		if(!isset($args['image'])){
			$args['image'] = $db_image;
		}

		if(!isset($args['old_qty'])){
			$args['old_qty'] = $db_quantity;
		}

		if(!isset($args['new_qty'])){
			$args['new_qty'] = $db_quantity;
		}

		if(!isset($args['qty_edited'])){
			$args['qty_edited'] = $args['new_qty']-$args['old_qty'];
		}

		if(!isset($args['edited_by'])){
			$args['edited_by'] = $_SESSION['user_name'];
		}


		foreach ($args as $field => $field_value) {
			$fields[] = $field;
			$values[] = $field_value;
		}
		$count_fields = count($fields);
		for ($i=0; $i < $count_fields; $i++) { 
			$placeholders[] = '?';
		}

		$fields[] 		= 'edited_on';
		$placeholders[] = 'NOW()';
		$fields 		= implode(',', $fields);
		$placeholders 	= implode(',',$placeholders);

		$sql = "INSERT INTO inventory_changelog ({$fields}) VALUES ({$placeholders})";

		$query  = $this->_db->prepare($sql);
        $query->execute($values);
        if($query->rowCount()){
        	return true;
        }
        else{
        	return false;
        }
	}

	/**
	 * @param   Product code(dealer_code)
	 * @return  Get Changelog by product.
 	 */

	public function get_changelog($prod_code){
		$sql = "SELECT *, DATE_FORMAT(edited_on,'%d %b %Y %h:%i %p') as edited_on FROM inventory_changelog WHERE pc_code = ? ORDER BY edited_on DESC";
		$query = $this->_db->prepare($sql);
		$values = array($prod_code);
		$query->execute($values);
		if($query->rowCount()){
			$query_results = $query->fetchAll(PDO::FETCH_ASSOC);
			//$this->_dealerCode = $dealer_code;
			return $query_results;
		}
		else{
			return false;
		}
	}

	/**
	 * @param   Date
	 * @return  Get Changelog by date.
 	 */

	public function get_changelog_by_date($date_start,$date_end){
		$sql = "SELECT *, DATE_FORMAT(edited_on,'%d %b %Y %h:%i %p') as edited_on FROM inventory_changelog WHERE edited_on BETWEEN ? AND ? ORDER BY edited_on DESC";
		$query = $this->_db->prepare($sql);
		$values = array($date_start.' 00:00:00',$date_end.' 23:59:59');
		$query->execute($values);
		if($query->rowCount()){
			$query_results = $query->fetchAll(PDO::FETCH_ASSOC);
			return $query_results;
		}
		else{
			return false;
		}
	}



	/**
	 * @param   pc code OR dealer_code
	 * @return  Item from inventory
 	 */

	public function get_product_like($code){
		$sql = "SELECT * FROM inventory98_xoo WHERE pc_code LIKE ? OR dealer_code LIKE ?";
		$query = $this->_db->prepare($sql);
		$values = array("%$code%","%$code%");
		$query->execute($values);
		if($query->rowCount()){
			$query_results = $query->fetchAll(PDO::FETCH_OBJ);
			return $query_results;
		}
		else{
			return false;
		}		
	}

	/**
	 * @param   PC code || Dealer Code || Location || ID
	 * @return  Item from inventory
 	*/

	public function get_product_by($field,$field_value){
		$sql    = "SELECT * FROM inventory98_xoo WHERE $field = ? LIMIT 1";
		$query  = $this->_db->prepare($sql);
		$values = array($field_value);
		$query->execute($values);
		if($query->rowCount() == 1){
			$query_results = $query->fetchAll(PDO::FETCH_OBJ);
			$item = $query_results[0];
			$this->_id 			 = $item->id;
			$this->_prodCode 	 = $item->pc_code;
			$this->_dealerCode 	 = $item->dealer_code;
			$this->_quantity 	 = $item->quantity;
			$this->_image 	 	 = $item->image;
			$this->_category 	 = $item->category;
			$this->_location 	 = $item->location;
			return $this; 
		}
		else{
			return false;
		}
	}
}
?>