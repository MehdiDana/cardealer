<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dealership_model extends CI_Model{
	private $id;
	private $name;
	private $address;
	private $post_code;
	private $opening_hours;
	private $number_of_car;
	private $image_url;
	private $approved;
	private $date_addded;
	private $average_rate;


	public function create_record($data){
		// if table does not exsit, create new table 
		$table_result = mysql_query("SHOW TABLES LIKE 'dealership'");
		$n_tables = mysql_num_rows($table_result);
		if($n_tables == 0){
			// create table
			$fields = array(
				'id' => array(
						 'type' => 'INT',
						 'constraint' => 5, 
						 'unsigned' => TRUE,
						 'auto_increment' => TRUE
				  ),
				'name' => array(
						 'type' =>'VARCHAR',
						 'constraint' => '255',
						 'default' => 'unknown'
				  ),
				'address' => array(
						 'type' => 'TEXT',
						 'null' => TRUE
				  ),
				 'post_code' => array(
						 'type' =>'VARCHAR',
						 'constraint' => '255',
						 'default' => 'unknown'
				  ),
				'opening_hours' => array(
						 'type' => 'TEXT',
						 'null' => TRUE
				  ),
				 'number_of_car' => array(
						 'type' => 'INT',
						 'constraint' => '10',
						 'default' => 0
				  ),
				'image_url' => array(
						 'type' =>'VARCHAR',
						 'constraint' => '1000',
						 'null' => TRUE
				  ),
				 'approved' => array(
						 'type' => 'INT',
						 'constraint' => '10',
						 'default' => 0
				  ),
				 'date_addded' => array(
						 'type' =>'VARCHAR',
						 'constraint' => '255',
						 'default'  => date("Y-m-d H:i:s")
				  ),
				'average_rate' => array(
						 'type' =>'VARCHAR',
						 'constraint' => '10',
						 'null' => TRUE
				  ),
                );
				
			$this->load->dbforge();
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field($fields);
			$this->dbforge->create_table('dealership');
		}
		$this->db->insert("dealership", $data);
	//	redirect('dealership/index', 'refresh');
		return true;
	}
	
	public function read_record($id){
		if($this->session->userdata('is_logedin')!=1){
				$this->db->where('approved', 1);
			}
		$query  = $this->db->get_where("dealership", array('id' => $id));
		return $query -> result();
	}
	
	public function update_record($id=0, $data){
		$this->db->where('id', $id);
		$this->db->update('dealership', $data); 
		return true;
	}
	
	public function delete_record($id){
		$this->db->delete('dealership', array('id' => $id));  
		return true;
	}
	
	public function get_data($limit=null, $start=null){
		$this->db->order_by("average_rate", "desc");
			if($this->session->userdata('is_logedin')!=1){
				$this->db->where('approved', 1);
			}
		$query = $this -> db -> get('dealership', $limit, $start);
		return $query -> result();
	}
	
}