<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index(){
		$this->home();
	}

	public function home(){
		$data = array("p_title"=>"Admin page");
		
		$this->load->view('template/head_site');
		$this->load->view('template/top_body');
		if($this->session->userdata('is_logedin')==1){
			$data["admin"]= $this -> admin_model-> get_data();
			$this->load->view('admin_view/home', $data);
		}else{
			$data["error_msg"] = "You shouldn't be here, do you know that? please leave now :)";
			$this->load->view('pages/error_page', $data);
		}
		
		
		$this->load->view('template/bottom_body');
	}
	
	public function login(){
		$data = array("p_title"=>"Login ");
		$this->load->view('template/head_site');
		$this->load->view('template/top_body');
		
		// if login ok, go admin homepage else stay in login page
		$this->load->library("form_validation");
		$this->form_validation->set_rules("email", "Email", "required|max_length[255]|trim|xss_clear|callback_check_pass");
		$this->form_validation->set_rules("password", "Password", "required|max_length[300]|trim|xss_clear");
		
		if($this->form_validation->run() == true){
			$data = array(
				'email' => $this->input->post('email'),
				'is_logedin' => 1
			);
			$this->session->set_userdata($data);
			redirect("dealership/index", "refresh");
		}else{
		
		}
		if($this->session->userdata('is_logedin')==1){
			redirect("admin/index", "refresh");
		}
		$this->load->view('admin_view/login', $data);
		
		$this->load->view('template/bottom_body');
	}
	
	public function check_pass(){
		if($this->admin_model->valid_user_pass()){
			return true;
		}else{
			$this->form_validation->set_message("check_pass", "Email or passowrd is not valid");
			return false;
		}
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect("admin/login", "refresh");
	}
	
	
	


}