<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review extends CI_Controller {

	public function index(){
		$this->home();
	}

	public function home(){
		$data = array("p_title"=>"Review page");
		
		$this->load->view('template/head_site');
		$this->load->view('template/top_body');
		
		$this->load->library("pagination");
		$config = array();
        $config["base_url"] = base_url() . "review/home";
        $config["total_rows"] = count($this->review_model->get_data());
        $config["per_page"] = 7;
        $config["uri_segment"] = 3;
		
		 $this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["review"] = $this->review_model->
            get_data($config["per_page"], $page);
        $data["links"] = $this->pagination->create_links();
		
		$this->load->view('review_view/home', $data);
		$this->load->view('template/bottom_body');
	}
	
	public function update($id){
		if($this->session->userdata('is_logedin')!=1) redirect("admin/login", "refresh");
		$this->load->view('template/head_site');
		$this->load->view('template/top_body');
		
		$this->load->library("form_validation");
		$this->form_validation->set_rules("approved", "Approved", "max_length[255]|required|xss_clear");
		
		$data = array(
			"approved" => $this->input->post("approved")
			);
		if($this->form_validation->run() == true){
			$this->review_model->update_record($id, $data);
			// 
			$data['ok_msg'] = "Thanks, review successfully has been updated";
			$this->load->view('pages/ok_page', $data);
			
				// update the rate ave
				$data["review_em"] = $this->review_model->read_record($id);
				foreach($data["review_em"] as $rev){
						$dealership_id = $rev->dealership_id;
					}
				$data["review_tem"] = $this->review_model->read_records($dealership_id);
					$i = 0;
					$count = 0;
					foreach($data["review_tem"] as $rev){
						if($rev-> approved == 1){
							$j = $rev->rate;
							$i = $i+$j;
							$count++;
						}
					}
					if(count($data["review_tem"])>0){
						$i = $i / $count;
					}
					$i = number_format($i,2);
						$data_dealership = array(
								"average_rate" => ''.$i
							);
							$this->dealership_model->update_record($dealership_id, $data_dealership);
				// end update
			
			
			header("Refresh:2;url=../");
		}else{
		}
		
		$data = array("p_title"=>"Update information", "id"=>$id);
		
		$data["review"] = $this->review_model->read_record($id);
		
		$this->load->view('review_view/update', $data);
		$this->load->view('template/bottom_body');
	}
	
	public function show($id){
		$data = array("p_title"=>"Full information");
		$data = array("ok_message"=>"");
		$this->load->view('template/head_site');
		$this->load->view('template/top_body');
		
		$data["review"] = $this->review_model->read_record($id);
		foreach($data["review"] as $rev){
			$data["dealer"] = $this->dealership_model->read_record($rev->dealership_id);
		}
		if($data["review"]==0){
			$data["error_msg"] = "Whats a pitty, no data found :)";
			$this->load->view('pages/error_page', $data);
		}else{
			$this->load->view('review_view/show', $data);
		}
				
		$this->load->view('template/bottom_body');
	}
	
	public function delete($id, $code=null){
	if($this->session->userdata('is_logedin')!=1 && $code==null) redirect("admin/login", "refresh");
		$data = array("p_title"=>"Delete review");
		$this->load->view('template/head_site');
		$this->load->view('template/top_body');
			$data["review"] = $this->review_model->read_record($id);
			if($data["review"]==null){
				redirect('review/index', 'refresh');
				die("Error");
			}
			foreach($data["review"] as $rev){
				$dlr = $rev->dealership_id;
				$ip_address = $rev->ip_address;
			}
			
		if($code!=null && $code!=md5($ip_address)){
			redirect('review/index', 'refresh');
			die("Error");
		}	
		if($this->review_model->delete_record($id) == true){
		
			// change averagerating in dealership	
				$dealership_id =$dlr; 
				$data["review_tem"] = $this->review_model->read_records($dealership_id);
					$i = 0;
					$count = 0;
					foreach($data["review_tem"] as $rev){
						if($rev-> approved == 1){
							$j = $rev->rate;
							$i = $i+$j;
							$count++;
						}
					}
					if(count($data["review_tem"])>0){
						$i = $i / $count;
					}
					$i = number_format($i,2);
						$data_dealership = array(
								"average_rate" => ''.$i
							);
							$this->dealership_model->update_record($dealership_id, $data_dealership);
				// end update
			
			 redirect('review/index', 'refresh');
		}else{
			//$this->load->view('dealership_view/show/', $data);
			redirect('review/index', 'refresh');
		}
		$this->load->view('template/bottom_body');
	}
	
}