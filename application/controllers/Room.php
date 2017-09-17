<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
        $this->load->library('message');
		$this->load->model('M_room');
		//var_dump($this->session->userdata('user_id'));die;
		if(empty($this->session->userdata('user_id'))){
			$msg = '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Anda Harus Login Dulu!</h4>
				</div>			
			';
			$this->session->set_flashdata(array('msg'=>$msg));
			// var_dump($msg, $this->session);die;
			redirect(site_url('login/auth'));
		}
		
    }
	
	public function show()
	{
		if(isset($this->session->userdata['msg'])){
			$data['message'] = $this->session->userdata['msg'];
		}
		
		$data['list'] = $this->M_room->get();
		
		foreach($data['list'] as $key=>$val){
				$data['list'][$key]->photo = $this->M_room->getPhoto($val->room_id);
		}

		$this->load->view('admin/pages/room/list', $data);
	}
	
	public function form($id=null)
	{
		if(empty($id)){
			$detail = new StdClass;
			$detail->room_id = null;
			$detail->room_code = null;
			$detail->room_type_id = null;
			$detail->room_floor_id = null;
			$detail->room_availibility = null;
			$detail->room_desc = null;
			$detail->room_photo = null;
			
			$building = array(
                array(
                    'id'=>1,
                    'name'=>'TB Satu'
                ),
                array(
                    'id'=>2,
                    'name'=>'TB Dua'
                )
                
            );
			$data['building'] = $building;
			$data['type'] = $this->M_room->getType();
			$data['floor'] = $this->M_room->getFloor();
			$data['detail'] = $detail;
			// var_dump($data);die();
			
		}else{
			
			$data['detail'] = $this->M_room->getDetail($id);
			$data['detail']->photo = $this->M_room->getPhoto($id);

			/*echo '<pre>';
			var_dump($data);
			die();*/
			
			$building = array(
                array(
                    'id'=>1,
                    'name'=>'TB Satu'
                ),
                array(
                    'id'=>2,
                    'name'=>'TB Dua'
                )
                
            );
			$data['building'] = $building;
			$data['type'] = $this->M_room->getType();
			$data['floor'] = $this->M_room->getFloor();
			// var_dump($data);die();
		}
		$this->load->view('admin/pages/room/form', $data);
	}
	
	public function input(){
		$path = 'assets/admin/images/room/';			
		$params = $_POST;
		
		if(!isset($params["room_availibility"])){
			$params["room_availibility"] = '0';
		}else{
			$params["room_availibility"] = '1';
		}
		// var_dump($params);die;
		if($_POST['room_id'] == ''){			
			$this->db->trans_start();
			$result = $this->M_room->insert($params);
			
			
			if($result){
				$id = $this->db->insert_id();
				echo '<pre>';
				$number_of_files_uploaded = count($_FILES['photo']['name']);
    			
    			for ($i = 0; $i < $number_of_files_uploaded; $i++){
					$_FILES['userfile']['name']     = $_FILES['photo']['name'][$i];
      				$_FILES['userfile']['type']     = $_FILES['photo']['type'][$i];
      				$_FILES['userfile']['tmp_name'] = $_FILES['photo']['tmp_name'][$i];
      				$_FILES['userfile']['error']    = $_FILES['photo']['error'][$i];
      				$_FILES['userfile']['size']     = $_FILES['photo']['size'][$i];
					
					$photo_name = $params['room_code'] . '_' . $_FILES['photo']['name'][$i];
					$upload = $this->do_upload($path, $photo_name, 'userfile');
					
					/*echo '<pre>';
					var_dump($upload);
					*/
					
					if(!empty($upload['data'])){
						$photo_params = array(
							'photo_room_id' => $id,
							'photo_name' => $path . $upload['data']['file_name']
						);
						$result = $result && $this->M_room->insertPhoto($photo_params);
					}	
					
					/*var_dump($result, $photo_params);
					
					die();	*/		
				}
				
			}
			
			$this->db->trans_complete($result);
			if($result){
				$msg = '
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Tambah Kamar Berhasil</h4>
					</div>			
				';
				$this->session->set_flashdata(array('msg'=>$msg));
				redirect(site_url('room/show'));
			}else{
				$msg = '
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Tambah User kamar</h4>
					</div>
				';
				$this->session->set_flashdata(array('msg'=>$msg));
				redirect(site_url('room/show'));
			}
			
			
			
		}else{
			
			$this->db->trans_start();		
			$result = $this->M_room->update($params['room_id'], $params);
			
			// var_dump($result, $params, $_FILES);die;
					
			if($result && $_FILES['photo']['error'][0] == 0){				
				$result = $result && $this->M_room->removePhoto($params['room_id']);								
				$number_of_files_uploaded = count($_FILES['photo']['name']);
    			for ($i = 0; $i < $number_of_files_uploaded; $i++){
					$_FILES['userfile']['name']     = $_FILES['photo']['name'][$i];
      				$_FILES['userfile']['type']     = $_FILES['photo']['type'][$i];
      				$_FILES['userfile']['tmp_name'] = $_FILES['photo']['tmp_name'][$i];
      				$_FILES['userfile']['error']    = $_FILES['photo']['error'][$i];
      				$_FILES['userfile']['size']     = $_FILES['photo']['size'][$i];
					
					$photo_name = $params['room_code'] . '_' . $_FILES['photo']['name'][$i];
					$upload = $this->do_upload($path, $photo_name, 'userfile');
					
					/*echo '<pre>';
					var_dump($upload);
					*/
					
					if(!empty($upload['data'])){
						$photo_params = array(
							'photo_room_id' => $params['room_id'],
							'photo_name' => $path . $upload['data']['file_name']
						);
						$result = $result && $this->M_room->insertPhoto($photo_params);
					}	
					
					/*var_dump($result, $photo_params);
					
					die();	*/		
				}
				
			}
			
			$this->db->trans_complete($result);
			if($result){
				$msg = '
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Edit Kamar Berhasil</h4>
					</div>			
				';
				$this->session->set_flashdata(array('msg'=>$msg));
				redirect(site_url('room/show'));
			}else{
				$msg = '
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Edit Kamar kamar</h4>
					</div>
				';
				$this->session->set_flashdata(array('msg'=>$msg));
				redirect(site_url('room/show'));
			}
		}
	}
	
	public function remove($id){
		$detail = $this->M_user->getUserDetail($id);		
		if(file_exists(FCPATH . $detail->photo)){
			unlink(FCPATH . $detail->photo);	
		}		
		$result = $this->M_user->remove($id);	
		if($result){
			$msg = '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Hapus User Berhasil</h4>
				</div>			
			';
			$this->session->set_flashdata(array('msg'=>$msg));
			redirect(site_url('user/show'));
		}else{
			$msg = '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Hapus User Gagal</h4>
				</div>
			';
			$this->session->set_flashdata(array('msg'=>$msg));
			redirect(site_url('user/show'));
		}
	}
	
	public function do_upload($path, $name, $var){
		$config = array(
			'file_name'     => $name,
			'allowed_types' => 'jpg|jpeg|png|gif',
			'max_size'      => 3000,
			'overwrite'     => TRUE,
			'upload_path'	=> FCPATH . $path
		  );
		  $this->upload->initialize($config);
		  if ( ! $this->upload->do_upload($var)){
			$error = array('error' => $this->upload->display_errors());
			return array('msg'=>$error, 'data'=>'');
		  }else{
			$final_files_data = $this->upload->data();
			return array('msg'=>'', 'data'=>$final_files_data);
		  }
	}
	
	/*public function codeGenerator($floor,$building){
		$last_code = $this->M_room->getLastCode($floor, $building);	
		
		$code = explode('', $last_code->room_code);
		
		
		var_dump($code);die;
		echo json_encode ($last_code);
		exit;
	}*/
	
}
