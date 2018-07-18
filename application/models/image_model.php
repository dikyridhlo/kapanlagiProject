<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	public function GetData($tbname){
		$result = $this->db->get($tbname);
		return $result->result_array();
	}
	public function InsertData($tbname,$obj){
		$insert = $this->db->insert($tbname, $obj);
		return $insert;
	}
	public function UpdateData($tbname, $obj, $where){
		$update = $this->db->update($tbname, $obj, $where);
		return $update;
	}
	public function DeleteData($tbname, $where){
		$delete = $this->db->delete($tbname, $where);
		return $delete;
	}
	public function searchimage($tbname, $where){
		// $search = $this->db->get_where($tbname, $where);
		$this->db->select('foto');
		$this->db->where($where);
		$search = $this->db->get($tbname);
		return $search;
	}
	

}

/* End of file image_model.php */
/* Location: ./application/models/image_model.php */