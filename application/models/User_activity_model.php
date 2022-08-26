<?php

class user_activity_model extends CI_Model {

	protected $table_name = 'user_activities';

	public function get($id){
		$this->db->select('*')->from($this->table_name)->where('id', $id);
		return $this->db->get()->result();
	}

	public function get_by($column,$id){
		$this->db->select('*')->from($this->table_name)->where($column, $id);
		return $this->db->get()->result();
	}
}
