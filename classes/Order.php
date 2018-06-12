<?php

class Order{

	private $_db;

	public function __construct(){
		$this->_db = Db::get_instance()->db;
	}


	/**
	 * @param Order Id , Product ID , User ID 
	 * @return Orders list
 	 */

	public function get_order_by($field,$field_value){
		$sql 	= "SELECT * FROM orders98_xoo 
		JOIN inventory98_xoo 
		ON orders98_xoo.pc_code = inventory98_xoo.pc_code 
		WHERE orders98_xoo.$field = ? 
		ORDER BY order_id DESC";

		$query 	= $this->_db->prepare($sql);
		$values = array($field_value);
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
	 * @param  userid,productid,quantity,print,assemble,status,tracking details
	 * @return New Order
 	 */

	public function new_order($user_id,$prod_code,$quantity,$to_print,$to_assemble,$status,$tracking,$location){
		$sql = "INSERT INTO orders98_xoo(user_id,pc_code,order_date,order_qty,to_print,to_assemble,order_status,tracking_details,retr_location)
		VALUES(?,?,NOW(),?,?,?,?,?,?)";

		$query 	= $this->_db->prepare($sql);
		$values = array($user_id,$prod_code,$quantity,$to_print,$to_assemble,$status,$tracking,$location);
		$query->execute($values);
		if($query->rowCount()){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * @param  Order id ,productid,quantity,print,assemble,status,tracking details
	 * @return Update Order
 	 */

	public function update_order($prod_code,$quantity,$to_print,$to_assemble,$status,$tracking,$location,$od_id){
		$sql = "UPDATE orders98_xoo SET pc_code = ? , order_qty = ? , to_print = ? , to_assemble = ? , order_status = ? , tracking_details = ? , retr_location = ? WHERE order_id = ?";
		$query = $this->_db->prepare($sql);
		$values = array($prod_code,$quantity,$to_print,$to_assemble,$status,$tracking,$location,$od_id);
		$query->execute($values);
		if($query->rowCount()){
			return true;
		}
		else{
			return false;
		}
	}


	/**
	 * @param  Order id ,productid,quantity,print,assemble,status,tracking details
	 * @return Update Order
 	 */

	public function update_order_fields($set_args,$where_args){
		$table_name = 'orders98_xoo';
		Db::update($table_name,$set_args,$where_args);
	}

	public function get_order_by_date($date_start,$date_end){
		$sql = "SELECT * , DATE_FORMAT(order_date,'%d %b %Y %h:%i %p') as order_date 
		FROM orders98_xoo JOIN inventory98_xoo 
		ON orders98_xoo.pc_code = inventory98_xoo.pc_code 
		WHERE order_date BETWEEN ? AND ? ORDER BY order_date DESC";
		
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


}
?>