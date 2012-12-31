<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dealership extends CI_Controller {

	public function index(){
		$this->home();
	}

	public function home(){
		$data = array("p_title"=>"Dearships page");
		
		$this->load->view('template/head_site');
		$this->load->view('template/top_body');
		$table_result = mysql_query("SHOW TABLES LIKE 'dealership'");
		$n_tables = mysql_num_rows($table_result);
		if($n_tables == 0){
			redirect("dealership/create", "refresh");
		}
		
		$data["review"] = $this->review_model->get_data();

	//	$data["dealership"] = $this->dealership_model->get_data(5);
		
		$this->load->library("pagination");
		$config = array();
        $config["base_url"] = base_url() . "dealership/home";
        $config["total_rows"] = count($this->dealership_model->get_data());
        $config["per_page"] = 7;
        $config["uri_segment"] = 3;
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["dealership"] = $this->dealership_model->
        get_data($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		
		
		$this->load->view('dealership_view/home', $data);
		$this->load->view('template/bottom_body');
	}

	
	public function create(){
	if($this->session->userdata('is_logedin')!=1) redirect("dealership/index", "refresh");
		$data = array("p_title"=>"Dearships page");
		$this->load->view('template/head_site');
		$this->load->view('template/top_body');
		
		$this->load->library("form_validation");
		$this->form_validation->set_rules("name", "Name", "required|max_length[255]|xss_clear");
		$this->form_validation->set_rules("address", "Address", "required|max_length[300]|xss_clear");
		$this->form_validation->set_rules("post_code", "Post code", "required|max_length[20]|xss_clear");
		$this->form_validation->set_rules("opening_hours", "Opening hours", "required|max_length[300]|xss_clear");
		$this->form_validation->set_rules("number_of_car", "Number of car", "required|max_length[255]|xss_clear");
		$this->form_validation->set_rules("image_url", "Image url", "max_length[255]|xss_clear");
		
		$data = array(
			"name" => $this->input->post("name"), 
			"address" => $this->input->post("address"), 
			"post_code" => $this->input->post("post_code"), 
			"opening_hours" => $this->input->post("opening_hours"),
			"number_of_car" => $this->input->post("number_of_car"),
			"image_url" => $this->input->post("image_url"),
			"approved" => 0,
			"date_addded" => date("Y-m-d H:i:s"),
			"average_rate" => 0
			);
		if($this->form_validation->run() == true){
		header("Refresh:3;url=$id");
			$this->dealership_model->create_record($data);
				$last_row = $this->db->insert_id();;
				$data = array("ok_message"=>"Your dealership details has been successfully submitted, it will appear later");
				$this->load->view('review_view/message', $data);
				// send email to reviewer
				$this->load->model('mail');
				$email_subject = "A notification needs your review";
				$email_body = "A dealership has been created and need to be approved, click here to approve 
				".anchor("dealership/update/$last_row", "Update this dealership");
				
				// $email_to = $this->input->post("email");
				$data["admin"]= $this -> admin_model-> get_data();
				foreach($data["admin"] as $ad){
					$email_to = $ad->email;
					$this->mail->send_email($email_to ,$email_subject , $email_body);
				}				
				
				//redirect('dealership/index', 'refresh');		
			
		}else{
		}
		
		if($this->session->userdata('is_logedin')==1){
			$this->load->view('dealership_view/create', $data);
		}else{
			$data["error_msg"] = "You shouldn't be here, do you know that? please leave now :)";
			$this->load->view('pages/error_page', $data);
		}
		$this->load->view('template/bottom_body');
	}
	
	public function show($id){
		$data = array("p_title"=>"Full information");
		$data = array("ok_message"=>"");
		$this->load->view('template/head_site');
		$this->load->view('template/top_body');
		
		$data["dealer"] = $this->dealership_model->read_record($id);
		if(count($data["dealer"])==null){
			redirect("dealership/index", "refresh");
		}

		$data["review"] = $this->review_model->read_records($id);
	
		$this->load->view('dealership_view/show', $data);
		
		$this->load->library("form_validation");
		$this->form_validation->set_rules("rate", "Rate", "required|xss_clear");
		$this->form_validation->set_rules("name", "Name", "required|max_length[250]|xss_clear");
		$this->form_validation->set_rules("email", "Email", "required|max_length[300]|valid_email|xss_clear");
		$this->form_validation->set_rules("review_title", "Review title", "required|max_length[255]|xss_clear");
		$this->form_validation->set_rules("review_description", "Review description", "max_length[1000]|xss_clear");
		
		$ip = $_SERVER['REMOTE_ADDR'];
		$data_review = array(
			"dealership_id" => $id,
			"rate" => $this->input->post("rate"),
			"name" => $this->input->post("name"), 
			"email" => $this->input->post("email"), 
			"review_title" => $this->input->post("review_title"),
			"review_description" => $this->input->post("review_description"),
			"approved" => 0,
			"date_addded" => date("Y-m-d H:i:s"),
			"ip_address" => $ip 
			);
	
			if($this->form_validation->run() == true && count($_POST) > 0 ){
				$this->review_model->create_record($data_review);	
				
				//$last_row =$this->db->affected_rows();
				$last_row = $this->db->insert_id();
				
				$code = md5($ip);
				$data = array("ok_message"=>"Your review has been successfully submitted, it will appear later");
				$this->load->view('review_view/message', $data);
				// send email to reviewer
				$this->load->model('mail');
				$email_to = $this->input->post("email");
				$email_subject = "Confirmation of your review ";
				$email_body = $this->input->post("review_title")."<br />".$this->input->post("review_description")."<br /><br />".
				"Click here to delete your review: ".anchor("review/delete/$last_row/$code", "Delete this review");;
				$this->mail->send_email($email_to ,$email_subject , $email_body);
				
				
				header("Refresh:5;url=$id");
			}else{
				$this->load->view('review_view/create', $data);
			}		
		$this->load->view('template/bottom_body');
	}
	
	public function update($id){
	if($this->session->userdata('is_logedin')!=1) redirect("dealership/index", "refresh");
		$this->load->view('template/head_site');
		$this->load->view('template/top_body');
		
		$this->load->library("form_validation");
		$this->form_validation->set_rules("name", "Name", "required|max_length[255]|xss_clear");
		$this->form_validation->set_rules("address", "Address", "required|max_length[300]|xss_clear");
		$this->form_validation->set_rules("post_code", "Post code", "required|max_length[20]|xss_clear");		
		$this->form_validation->set_rules("opening_hours", "Opening_hours", "required|max_length[300]|xss_clear");
		$this->form_validation->set_rules("number_of_car", "Number_of_car", "required|max_length[255]|xss_clear");
		$this->form_validation->set_rules("image_url", "Image_url", "max_length[255]|xss_clear");
		$this->form_validation->set_rules("approved", "Approved", "max_length[255]|xss_clear");
		
		$data = array(
			"name" => $this->input->post("name"), 
			"address" => $this->input->post("address"), 
			"post_code" => $this->input->post("post_code"), 
			"opening_hours" => $this->input->post("opening_hours"),
			"number_of_car" => $this->input->post("number_of_car"),
			"image_url" => $this->input->post("image_url"),
			"approved" => $this->input->post("approved")
			);
		if($this->form_validation->run() == true){
			$this->dealership_model->update_record($id, $data);
			$data['ok_msg'] = "Thanks, dealership successfully has been updated";
			$this->load->view('pages/ok_page', $data);
		}else{
		}
	
		$data = array("p_title"=>"Update information", "id"=>$id);

		$data["dealer"] = $this->dealership_model->read_record($id);
		if(count($data["dealer"])==null){
			redirect("dealership/index", "refresh");
		}
		if($this->session->userdata('is_logedin')==1){
			$this->load->view('dealership_view/update', $data);
		}else{
			$data["error_msg"] = "You shouldn't be here, do you know that? please leave now :)";
			$this->load->view('pages/error_page', $data);
		}		
		$this->load->view('template/bottom_body');
	}
	
	public function delete($id){
	if($this->session->userdata('is_logedin')!=1) redirect("dealership/index", "refresh");
		$data = array("p_title"=>"Delete dealership");
		$this->load->view('template/head_site');
		$this->load->view('template/top_body');
		
		if($this->dealership_model->delete_record($id) == true){
			// delete all revies belong to this id
			$this->review_model->delete_records($id);
			
			$data["dealership"] = $this->dealership_model->get_data();
			  redirect('dealership/home', 'refresh');
		}else{
			$this->load->view('dealership_view/home', $data);
		}
		$this->load->view('template/bottom_body');
	}
	

}