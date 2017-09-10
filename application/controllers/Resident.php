<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resident extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
        $this->load->library('message');
		$this->load->model('M_resident');
		// var_dump($this->session);die;
		if(empty($this->session->userdata('user_id'))){
			$msg = '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Anda Harus Login Dulu!</h4>
				</div>			
			';
			$this->session->set_flashdata(array('msg'=>$msg));
			// var_dump($msg, $this->session);die;
			redirect(site_url('home/login'));
		}
		
    }
	
	public function show()
	{
		$data['list'] = $this->M_resident->get();
		// var_dump($data);die;
		if(isset($this->session->userdata['msg'])){
			$data['message'] = $this->session->userdata['msg'];
		}
		// var_dump($data);
		// die();
		$this->load->view('admin/pages/resident/list', $data);
	}
	
	public function form($id=null)
	{
		if(empty($id)){
			$detail = new StdClass;
			$detail->resident_id = null;
			$detail->resident_name = null;
			$detail->resident_identity_type = null;
			$detail->resident_identity_number = null;
			$detail->resident_origin_address = null;
			$detail->resident_email = null;
			$detail->resident_contact = null;
			$detail->resident_type = null;
			$detail->resident_status = null;
			
			$data['detail'] = $detail;
			$data['identity_type'] = array('ktp', 'sim', 'pasport');
			$data['type'] = array(
				array(
					'id'=>0,
					'name'=> 'Mahasiswa S1'
				),
				array(
					'id'=>1,
					'name'=> 'Mahasiswa Pasca Sarjana'
				),
				array(
					'id'=>2,
					'name'=> 'Kerabat Mahasiswa'
				),
				array(
					'id'=>3,
					'name'=> 'Tamu'
				),
			
			);
			// var_dump($data);die();
			
		}else{
			$data['identity_type'] = array('ktp', 'sim', 'pasport');
			$data['type'] = array(
				array(
					'id'=>0,
					'name'=> 'Mahasiswa S1'
				),
				array(
					'id'=>1,
					'name'=> 'Mahasiswa Pasca Sarjana'
				),
				array(
					'id'=>2,
					'name'=> 'Kerabat Mahasiswa'
				),
				array(
					'id'=>3,
					'name'=> 'Tamu'
				),
			
			);
			$data['detail'] = $this->M_resident->getDetail($id);
			// var_dump($data);die();
		}
		$this->load->view('admin/pages/resident/form', $data);
	}
	
	public function input(){
		if($_POST['id'] == ''){
			
			$params = $_POST;
			
			$this->db->trans_start();
			$result = $this->M_resident->insert($params);
			
			// var_dump($upload, $params);die;
			$this->db->trans_complete($result);
			
			if($result){
				$msg = '
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Tambah Penghuni Berhasil</h4>
					</div>			
				';
				$this->session->set_flashdata(array('msg'=>$msg));
				redirect(site_url('resident/show'));
			}else{
				$msg = '
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Tambah Penghuni Gagal</h4>
					</div>
				';
				$this->session->set_flashdata(array('msg'=>$msg));
				redirect(site_url('resident/show'));
			}
			
			
			
		}else{
			
			// var_dump($_POST, $_FILES);
			
			$params = $_POST;	
			
			$this->db->trans_start();
			$result = $this->M_resident->update($params['id'], $params);
			
			
			// var_dump($upload, $params, $result);die;
			$this->db->trans_complete($result);
			
			if($result){
				$msg = '
					<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Edit Penghuni Berhasil</h4>
					</div>			
				';
				$this->session->set_flashdata(array('msg'=>$msg));
				redirect(site_url('resident/show'));
			}else{
				$msg = '
					<div class="alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<h4>Edit Penghuni Gagal</h4>
					</div>
				';
				$this->session->set_flashdata(array('msg'=>$msg));
				redirect(site_url('resident/show'));
			}
		}
	}
	
	public function remove($id){
		$result = $this->M_resident->remove($id);	
		if($result){
			$msg = '
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Hapus Penghuni Berhasil</h4>
				</div>			
			';
			$this->session->set_flashdata(array('msg'=>$msg));
			redirect(site_url('resident/show'));
		}else{
			$msg = '
				<div class="alert alert-danger alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<h4>Hapus Penghuni Gagal</h4>
				</div>
			';
			$this->session->set_flashdata(array('msg'=>$msg));
			redirect(site_url('resident/show'));
		}
	}
	
}
