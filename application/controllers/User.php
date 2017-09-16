<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
        $this->load->library('message');
		$this->load->model('M_user');
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
		$data['list'] = $this->M_user->getUser();
		if(isset($this->session->userdata['msg'])){
			$data['message'] = $this->session->userdata['msg'];
		}
		foreach($data['list'] as $idx=>$list){
			if(empty($list->photo)){
				$data['list'][$idx]->photo = 'assets/admin/images/user/default.jpg';
			}
		}
		// var_dump($data);
		// die();
		$this->load->view('admin/pages/user/list', $data);
	}
	
	public function form($id=null)
	{
		if(empty($id)){
			$detail = new StdClass;
			$detail->id = null;
			$detail->name = null;
			$detail->username = null;
			$detail->photo = null;
			$detail->desc = null;
			
			$data['detail'] = $detail;
			// var_dump($data);die();
			
		}else{
			$data['detail'] = $this->M_user->getUserDetail($id);
			// var_dump($data);die();
		}
		$this->load->view('admin/pages/user/form', $data);
	}
	
	public function input(){
		if($_POST['id'] == ''){
			$path = 'assets/admin/images/user/';			
			// var_dump($_POST, $_FILES, FCPATH.$path);
			
			$photo = $path . $_POST['username'] . '.jpg';
			$photo_name = $_POST['username'] . '.jpg';
			$params = $_POST;			
			$params['password'] = md5($params['username']);
			$params['photo'] = $photo;
			
			$this->db->trans_start();
			$result = $this->M_user->insert($params);
			
			if($result){
				$upload = $this->do_upload($path, $photo_name, 'photo');
			}
			// var_dump($upload, $params);die;
			$this->db->trans_complete($result);
			
			if($result){
				$msg = '
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Tambah User Berhasil</h4>
					</div>			
				';
				$this->session->set_flashdata(array('msg'=>$msg));
				redirect(site_url('user/show'));
			}else{
				$msg = '
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Tambah User Gagal</h4>
					</div>
				';
				$this->session->set_flashdata(array('msg'=>$msg));
				redirect(site_url('user/show'));
			}
			
			
			
		}else{
			
			var_dump($_POST, $_FILES);
			
			$path = 'assets/admin/images/user/';
			
			$photo = $path . $_POST['username'] . '.jpg';
			$photo_name = $_POST['username'] . '.jpg';
			
			$params = $_POST;	
			
			$this->db->trans_start();
			$result = $this->M_user->update($params['id'], $params);
			
			if($result && $_FILES['photo']['error'] !== 4){
				$result = $this->M_user->update($params['id'], array('photo'=>$photo));
				$upload = $this->do_upload($path, $photo_name, 'photo');
			}
			// var_dump($upload, $params, $result);die;
			$this->db->trans_complete($result);
			
			if($result){
				$msg = '
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Edit User Berhasil</h4>
					</div>			
				';
				$this->session->set_flashdata(array('msg'=>$msg));
				redirect(site_url('user/show'));
			}else{
				$msg = '
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Edit User Gagal</h4>
					</div>
				';
				$this->session->set_flashdata(array('msg'=>$msg));
				redirect(site_url('user/show'));
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
	
}
