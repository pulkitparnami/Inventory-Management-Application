<?php

class Db{
	private static $_instance = null;
	public $db;

	private function __construct(){
		try{
			$this->db = new PDO('mysql:host = localhost;dbname=db_xoo', 'root', '');
		}
		catch(PDOException $e){
			die($e->getMessage());
		}
	}

	public static function get_instance(){
		if(!isset(self::$_instance)){
			 return self::$_instance = new Db();		
		}
		else{
			return self::$_instance;
		}
	}

	public static function update($table_name,$set_args,$where_args){
		$set = $values = $where = array();
		foreach ($set_args as $field => $field_value) {
			$set[] = $field;
			$values[] = $field_value;
		}

		$set = implode('=?,', $set).'=?';
		$where = $where_args['key'].'=?';
		$values[] = $where_args['value'];

		$sql = "UPDATE {$table_name} SET {$set} WHERE {$where}";
		$query = Db::get_instance()->db->prepare($sql);
		$query->execute($values);
		if($query->rowCount()){
			return true;
		}
		else{
			return false;
		}
	}
}




?>
<?php
/* 
public static function update($table_name,$set_args,$where_args){
		$set = $values = $where = array();
		foreach ($set_args as $field => $field_value) {
			$set[] = $field;
			$values[] = $field_value;
		}

		$set = implode('=?,', $set).'=?';

		foreach ($where_args as $single) {
				if(is_array($single)){
					$where[]  = $single['key'].$single['compare'].'?';
					$values[] = $single['value'];
				}
		}
		if(array_key_exists('relation', $where_args)){
			$where = implode(' '.$where_args['relation'].' ', $where);
		}
		else{
			$where = $where[0];
		}


		$sql = "UPDATE {$table_name} SET {$set} WHERE {$where}";
		$query = Db::get_instance()->db->prepare($sql);
		$query->execute($values);
		if($query->rowCount()){
			return true;
		}
		else{
			return false;
		}
	}

*/
?>