<?php
class UserModel extends MainModel
{
	
	 public function select($cols,$where){
		return $this->db->select("user", $cols, $where);
	 }

}