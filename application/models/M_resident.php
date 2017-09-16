<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_resident extends CI_Model
{
	
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        // $this->load->library('session');
    }
	
	function get(){
		$query = $this->db->query("SELECT * FROM resident");
		$result = $query->result();
		return $result;
	}
	

	function getDetail($id){
		$query = $this->db->query("SELECT * FROM resident WHERE resident_id = $id");
		$result = $query->row();
		return $result;
	}
	
	public function insert($data){	
		$execute = $this->db->insert('resident', $data);
		return $execute;
	}
	
	public function update($id, $data){
		$exec = $this->db->where('resident_id', $id);
		$exec = $this->db->update('resident', $data);
		return $exec;
	}
	
	
	public function remove($id){
		$execute = $this->db->delete('resident', array('resident_id' => $id));
		return $execute;
	}
	
}