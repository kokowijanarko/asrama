<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->library('message');
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
	public function index()
	{
		$this->load->view('admin/index');
	}
}
