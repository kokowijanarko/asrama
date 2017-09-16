<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->library('authex');
    }
	
	public function index()
	{
		$this->load->view('admin/login');
	}
	
	public function auth(){
		
		$auth = $this->authex->login($_POST['username'], $_POST['password']);
		//var_dump($_POST, $auth);die;
		if($auth){
			redirect('home');			
		}else{
			redirect(site_url('login'));
		}
	}
	
	public function logout(){
		session_destroy();
		redirect(site_url('login'));
	}
}
