<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

class M_room extends CI_Model
{
	
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }
	
	function get(){
		$query = $this->db->query("
			SELECT
				a.`room_id`,
			    a.`room_code`,
    			a.`room_availibility`,
    			a.`room_desc`,
    			b.type_id,
    			b.type_name,
    			c.floor_id,
    			c.floor_name,
    			c.floor_price,
    			c.floor_price_int

			FROM room a 
			LEFT JOIN room_type b ON b.type_id = a.`room_type_id`
			LEFT JOIN room_floor c ON c.floor_id = a.`room_floor_id`
			ORDER BY a.`room_code`
		");
		$result = $query->result();
		return $result;
	}

	function getDetail($id){
		$query = $this->db->query("
			SELECT
				a.`room_id`,
			    a.`room_code`,
    			a.`room_availibility`,
    			a.`room_desc`,
    			b.type_id,
    			b.type_name,
    			c.floor_id,
    			c.floor_name,
    			c.floor_price,
    			c.floor_price_int

			FROM room a 
			LEFT JOIN room_type b ON b.type_id = a.`room_type`
			LEFT JOIN room_floor c ON c.floor_id = a.`room_floor_id` 
			WHERE 
				a.`room_id` = $id
		");
		
		$result = $query->row();
		return $result;
	}
	
	public function insert($data){	
		$execute = $this->db->insert('room', $data);
		return $execute;
	}
	
	public function insertPhoto($data){	
		$execute = $this->db->insert('room_photo', $data);
		return $execute;
	}
	
	public function update($id, $data){
		$exec = $this->db->where('id', $id);
		$exec = $this->db->update('room', $data);
		return $exec;
	}
	
	
	public function remove($id){
		$execute = $this->db->delete('room', array('id' => $id));
		return $execute;
	}
	
	#############################################################
	
	function getType(){
		$query = $this->db->query("SELECT * FROM room_type");
		$result = $query->result();
		return $result;
	}
	
	function getFloor(){
		$query = $this->db->query("SELECT * FROM room_floor");
		$result = $query->result();
		return $result;
	}
	
	function getLastCode($floor, $building){
		$query = $this->db->query("
			SELECT
			    a.`room_code`	

			FROM room a 
			LEFT JOIN room_type b ON b.type_id = a.`room_type` 
			LEFT JOIN room_floor c ON c.floor_id = a.`room_floor_id`
			
			WHERE
				a.`room_building` = $building
				AND c.`floor_id` = $floor
			ORDER BY a.`room_building` DESC
			LIMIT 0,1

		");
		$result = $query->row();
		return $result;
	}
	
	function getPhoto($id){
		$query = $this->db->query("SELECT * FROM room_photo WHERE photo_room_id = $id");
		$result = $query->result();
		return $result;
	
	}
	
	
	
}