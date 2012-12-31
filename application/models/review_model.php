<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review_model extends CI_Model{

    private $id;
    private $dealership_id;
    private $rate;
    private $name;
    private $email;
    private $review_title;
    private $review_description;
    private $approved;
	private $date_added;
	private $ip_address;

	public function create_record($data){
		// if table does not exsit, create new table 
		$table_result = mysql_query("SHOW TABLES LIKE 'review'");
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
				'dealership_id' => array(
						 'type' => 'INT',
						 'constraint' => '10',
						 'default' => 0
				  ),
				 'rate' => array(
						 'type' => 'INT',
						 'constraint' => '10',
						 'default' => 0
				  ),
				'name' => array(
						 'type' =>'VARCHAR',
						 'constraint' => '255',
						 'default' => 'unknown'
				  ),
				'email' => array(
						 'type' =>'VARCHAR',
						 'constraint' => '255',
						 'default' => 'unknown'
				  ),		  
				 'review_title' => array(
						 'type' =>'VARCHAR',
						 'constraint' => '255',
						 'default' => ''
				  ),
				'review_description' => array(
						 'type' => 'TEXT',
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
				  'ip_address' => array(
						 'type' =>'VARCHAR',
						 'constraint' => '255',
						 'null' => TRUE
				  )
                );
				
			$this->load->dbforge();
			$this->dbforge->add_key('id', TRUE);
			
			$this->dbforge->add_field($fields);
			$this->dbforge->create_table('review');
		}
		$this->db->insert("review", $data);
		return true;
	}
	
	
	
	public function read_record($id){
			if($this->session->userdata('is_logedin')!=1){
				$this->db->where('approved', 1);
			}
		$query  = $this->db->get_where("review", array('id' => $id));
		return $query -> result();
	}
	
    /**
     * Get all review belong to a dealership
     *
     * @return array reviews
     */
	public function read_records($dealership_id){		
			if($this->session->userdata('is_logedin')!=1){
				$this->db->where('approved', 1);
			}
		$this->db->order_by("id", "desc");
		$query  = $this->db->get_where("review", array('dealership_id' => $dealership_id));
		return $query -> result();
	}
	
	public function update_record($id=0, $data){
		$this->db->where('id', $id);
		$this->db->update('review', $data); 
		return true;
	}
	
	public function delete_record($id){
		$this->db->delete('review', array('id' => $id));  
		return true;
	}
	
	public function delete_records($dealership_id){
		$this->db->delete('review', array('dealership_id' => $dealership_id));  
		return true;
	}
	
	public function get_data($limit=null, $start=null){
		if($this->session->userdata('is_logedin')!=1){
				$this->db->where('approved', 1);
		}
		$this->db->order_by("id", "desc");
		$query = $this -> db -> get('review', $limit, $start);
		return $query -> result();
	}


}