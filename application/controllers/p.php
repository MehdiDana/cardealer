<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class P extends CI_Controller {

	public function index()
	{
		$this->home();
	}
	
	public function home(){
		$data = array("p_title"=>"Home page");
		$table_result = mysql_query("SHOW TABLES LIKE 'dealership'");
		$n_tables = mysql_num_rows($table_result);
		if($n_tables == 0){
			redirect("admin/login", "refresh");
		}
		
		$data["dealership"] = $this->dealership_model->get_data(5);
		$data["review"] = $this->review_model->get_data(7);
		
		// get google map
		$this->load->library('googlemaps');
		$config = array();
		$config['zoom'] = 'auto';
		//$config['center'] = 'auto';
		$config['onboundschanged'] = 'if (!centreGot) {
			var mapCentre = map.getCenter();
			marker_0.setOptions({
				position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
			});
		}
		centreGot = true;';
		
		$this->googlemaps->initialize($config);
		
			$marker = array();
			$marker['position']= 'HD1 3DH'; 
			$marker['infowindow_content']= "This could be you <br /><img src='http://www.lemonlawtips.com/photos/image/middle_funny-car-yWtJ9.jpg' width='100px'>";
			$this->googlemaps->add_marker($marker);
		$data["dealership_map"] = $this->dealership_model->get_data();	
		for($j=0; $j< count($data["dealership_map"]); $j++){	
			$img = $data["dealership_map"][$j]->image_url;
			$marker = array();
				$ave = (float) $data["dealership_map"][$j]->average_rate;
				$rate_percent = $ave * 20; 
			$rate_b = "<div class='rate_bar'><div class='current_rate' style='width:$rate_percent%' > </div></div>";
			$marker['position']= $data["dealership_map"][$j]->post_code; 
			$marker['infowindow_content']= anchor("dealership/show/".$data['dealership_map'][$j]->id, $data["dealership_map"][$j]->name).$rate_b."# cars ".$data["dealership_map"][$j]->number_of_car."<br /><img src='$img' width='100px'>";
			$this->googlemaps->add_marker($marker);	
		}		
		
		$data['map'] = $this->googlemaps->create_map(); 
		
		$this->load->view('template/head_site', $data);
		$this->load->view('template/top_body');
		
		$this->load->view('pages/home_page', $data);
		
		$this->load->view('template/bottom_body');
	}
	
	public function contact()
	{
		$data = array("p_title"=>"Contact us");
		$data["ok_message"] = "";
		
		$this->load->view('template/head_site');
		$this->load->view('template/top_body');
		$this->load->view('pages/contact_page', $data);
		$this->load->view('template/bottom_body');
	}

	public function contact_us(){
		$this->load->library("form_validation");
		
		$this->form_validation->set_rules("name", "Name", "required|max_length[50]|alpha|xss_clear");
		$this->form_validation->set_rules("email", "Email address", "required|valid_email|xss_clear");
		$this->form_validation->set_rules("message", "Message", "required|max_length[500]|xss_clear");
		
		if($this->form_validation->run() == false){
			$data = array("p_title"=>"Contact us");
			$data["ok_message"] = "";
		
			$this->load->view('template/head_site');
			$this->load->view('template/top_body');
			$this->load->view('pages/contact_page', $data);
			$this->load->view('template/bottom_body');
		}else{
			$data = array("p_title"=>"Contact us");
			$data["ok_message"] = "";
		

			$this->load->model('mail');
			if($this->mail->send_email("m3dana@gmail.com", "A message from a form ".set_value("email"), set_value("message"))){
				$data["ok_message"] = "Message sent";
			}else {
				$data["ok_message"] = "Message NOT send however everything is OK";
				//show_error($this->email->print_debugger());
			}
		
		
			$this->load->view('template/head_site');
			$this->load->view('template/top_body');
			$this->load->view('pages/contact_page', $data);
			//redirect("p/home", "refresh");
			$this->load->view('template/bottom_body');
			
		}
	}

}
