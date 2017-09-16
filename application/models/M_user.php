<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model
{
	
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
	
	function getUser(){
		$query = $this->db->query("SELECT * FROM user");
		$result = $query->result();
		return $result;
	}
	

	function getUserDetail($id){
		$query = $this->db->query("SELECT * FROM user WHERE id = $id");
		$result = $query->row();
		return $result;
	}
	
	public function insert($data){	
		$execute = $this->db->insert('user', $data);
		return $execute;
	}
	
	public function update($id, $data){
		$exec = $this->db->where('id', $id);
		$exec = $this->db->update('user', $data);
		return $exec;
	}
	
	
	public function remove($id){
		$execute = $this->db->delete('user', array('id' => $id));
		return $execute;
	}
	
}