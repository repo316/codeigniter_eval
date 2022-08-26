<?php

class User_model extends CI_Model{

	protected $table_name='users';

	public function user($email, $password){
		return $this->db->select('*')->from($this->table_name)->where('email', strtolower($email))->where('password', $password)->get()->row();
	}

	public function get($id){
		$this->db->select('*')->from($this->table_name)->where('id', $id);
		return $this->db->get()->row();
	}

	public function create($data=array()){
		if(is_array($data) && count($data)>0){
			if($this->db->insert($this->table_name, $data)){
				return $this->db->insert_id();
			}
		}
		return false;
	}
}
