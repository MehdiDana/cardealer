<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model{
	private $id;
	private $full_name;
	private $email;
	private $password;
	
	
	public function get_data(){
		//$query = $this -> db -> query("SELECT * FROM admin");
		$query = $this -> db -> get('admin');
		return $query -> result();
	}
	
	public function valid_user_pass(){
		$this->db->where('email', $this->input->post('email') );
		$this->db->where('password', MD5($this->input->post('password')) );
		$query = $this->db->get('admin');
		if($query->num_rows() == 1){
			return true;
		}else {
			return false;
		}
	}


}