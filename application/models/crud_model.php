<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model {
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
	public function joinData($tbname, $jointb,$column1, $column2){
		$this->db->join($jointb, $tbname.'.'.$column1.'='.$jointb.'.'.$column2);
		$query =$this->db->get($tbname);
		// $this->db->join('Table', 'table.column = table.column', 'left');
		return $query->result_array();
	}
	


}

/* End of file crud_model.php */
/* Location: ./application/models/crud_model.php */