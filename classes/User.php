<?php
class User{
	private $_userPassword,
			$_userId,
			$_firstName,
			$_lastName,
			$_emailId,
			$_mobileNo,
			$_insertedId;

	private $_db;

	public function __construct(){
		$this->_db = Db::get_instance()->db;
	}

	/**
	 * @param   None
	 * @return  Number of Customers
 	 */

	public function count_users(){
		$sql   = "SELECT COUNT(*) FROM users98_xoo WHERE permission = 3";
		$query = $this->_db->prepare($sql);
		$query->execute();
		$rows_count = $query->fetchColumn();
		return $rows_count;
	}


	/**
	 * @param   Email id , Mobile number , Name
	 * @return  Item from inventory
 	 */

	public function get_user_like($user_data){
		$sql = "SELECT * FROM users98_xoo WHERE first_name LIKE ? OR last_name LIKE ? OR mobile_no LIKE ? OR email_id LIKE ? ";
		$query = $this->_db->prepare($sql);
		$values = array("%$user_data%","%$user_data%","%$user_data%","%$user_data%");
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
	 * @param ID , Mobile number , Email Id
	 * @return User info
 	 */

	public function get_user_by($field,$field_value){
		$sql 	= "SELECT * FROM users98_xoo WHERE $field = ? LIMIT 1";
		$query 	= $this->_db->prepare($sql);
		$values = array($field_value);
		$query->execute($values);
		if($query->rowCount() == 1){
			$query_results = $query->fetchAll(PDO::FETCH_OBJ);
			foreach ($query_results as $obj) {
				$this->_userId 		 = $obj->id;	
				$this->_permission	 = $obj->permission;
				$this->_firstName	 = $obj->first_name;
				$this->_lastName	 = $obj->last_name;
				$this->_emailId	 	 = $obj->email_id;
				$this->_mobileNo	 = $obj->mobile_no;
			}
			return $this;	
		}
		return false;
	}



	/**
	 * @param $first_name,$last_name,$email_id,$password,$mobile_no
	 * @return register user
 	 */

	public function register_user($first_name,$last_name,$email_id,$password,$mobile_no){
		$now = date("d-m-Y h:i:a");
		$sql   = 'INSERT INTO users98_xoo(first_name,last_name,email_id,password,permission,date_added,mobile_no) VALUES(?,?,?,?,?,?,?)';
		$query = $this->_db->prepare($sql);
		$values = array($first_name,$last_name,$email_id,$password,3,$now,$mobile_no); 
		$query->execute($values);
		if($query->rowCount()){
			$this->_insertedId = $this->_db->lastInsertId();
			return $this;
		}
		else{
			return false;
		}
	}

	/**
	 * @param Mobile Number/Email
	 * @return Mobile number/Email exists or  not
 	 */

	public function check_user($mobile_email){
		$sql = 'SELECT NULL FROM users98_xoo WHERE mobile_email = ? LIMIT 1';
		$query = $this->_db->prepare($sql);
		$values = array($mobile_no);
		$query->execute($values);
		if($query->rowCount()){
			return true;
		}
		return false;
	}


	/**
	 * @param $mobile_email - Mobile number , Email Id
	 * @return login user
 	 */
	public function login_user($mobile_email){
		$sql 	= 'SELECT * FROM users98_xoo WHERE mobile_no = ? OR email_id = ? LIMIT 1';
		$query 	= $this->_db->prepare($sql);
		$values = array($mobile_email,$mobile_email);
		$query->execute($values);
		if($query->rowCount() == 1){
			$query_results = $query->fetchAll(PDO::FETCH_OBJ);
			foreach ($query_results as $obj) {
				$this->_userPassword = $obj->password;	
				$this->_userId 		 = $obj->id;	
				$this->_permission	 = $obj->permission;
				$this->_firstName	 = $obj->first_name;
				$this->_emailId	 	 = $obj->email_id;
			}
			return $this;	
		}
		return false;
	}


	/**
	 * @param None
	 * @return Users list
 	 */

	public function user_list(){
		$page_no  = isset($_GET['page'])? $_GET['page'] : 1;
		$offset = ($page_no-1)*10;
		$sql = "SELECT * FROM users98_xoo WHERE permission = ? LIMIT $offset,10";
		$query = $this->_db->prepare($sql);
		$values = array(3);
		$query->execute($values);
		if($query->rowCount()){
			$query_results = $query->fetchAll(PDO::FETCH_OBJ);
			return $query_results;
		}
		else{
			return false;
		}
	}

	public function get_user_password(){
		return escape($this->_userPassword);
	}

	public function get_user_id(){
		return escape($this->_userId);
	}

	public function get_user_first_name(){
		return escape($this->_firstName);
	}

	public function get_user_last_name(){
		return escape($this->_lastName);
	}

	public function get_user_permission(){
		return  escape($this->_permission);
	}

	public function get_user_email(){
		return escape($this->_emailId);
	}

	public function get_user_mobile(){
		return escape($this->_mobileNo);
	}

	public function get_inserted_id(){
		return $this->_insertedId;
	}
}


?>