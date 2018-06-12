<?php
class Vendor{
	private $_db;

	public function __construct(){
		$this->_db = Db::get_instance()->db;
	}

	public $cities = array('Delhi','Jaipur','Mumbai');
	private $_vendorName,
			$_vendorAddress,
			$_vendorCity,
			$_vendorInfo;
	/**
	 * @param  $vendor_name,$vendor_address,$vendor_info
	 * @return New Vendor
 	 */

	public function add_vendor($vendor_name,$vendor_address,$vendor_city,$vendor_info){
		$sql 	= "INSERT INTO vendors(vendor_name,vendor_address,vendor_city,vendor_info) VALUES(?,?,?,?)";
		$query 	= $this->_db->prepare($sql);
		$values = array($vendor_name,$vendor_address,$vendor_city,$vendor_info);
		$query->execute($values);
		if($query->rowCount()){
			return true;
		}
		else{
			return false;
		}
	}

	/**
	 * @param  id value
	 * @return single vendor
 	 */

	public function get_vendor($id_value){
		$sql 	= "SELECT * FROM vendors WHERE id = ? LIMIT 1";
		$query 	= $this->_db->prepare($sql);
		$values = array($id_value);
		$query->execute($values);
		if($query->rowCount()){
			$row = $query->fetchAll(PDO::FETCH_OBJ)[0];
			$this->_vendorName 		= $row->vendor_name;
			$this->_vendorAddress 	= $row->vendor_address; 
			$this->_vendorCity 		= $row->vendor_city; 
			$this->_vendorInfo 		= $row->vendor_info;  
		}
		else{
			return false;
		}
	}

	/**
	 * @return Vendor Name
 	 */

	public function get_name(){
		return $this->_vendorName;
	}

	/**
	 * @return Vendor address
 	 */

	public function get_address(){
		return $this->_vendorAddress;
	}

	/**
	 * @return Vendor city
 	 */

	public function get_city(){
		return $this->_vendorCity;
	}

	/**
	 * @return Vendor info
 	 */

	public function get_info(){
		return $this->_vendorInfo;
	}

	public function get_vendor_by($field,$field_value){
		$sql 	= "SELECT * FROM vendors WHERE $field = ?";
		$query 	= $this->_db->prepare($sql);
		$values = array($field_value);
		$query->execute($values);
		if($query->rowCount()){
			$results = $query->fetchAll(PDO::FETCH_OBJ);
			return $results;
		}
		else{
			return false;
		}
	}
}

?>