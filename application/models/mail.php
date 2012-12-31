<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_Model{

	public function send_email($email_to, $email_subj, $email_body){
			$config = Array(
		    'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'xxx@gmail.com',
			'smtp_pass' => 'xxxx',
			'mailtype'  => 'html',
			'charset'   => 'iso-8859-1'
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		$this->email->from("xxx@gmail.com", "Webmaster");
		$this->email->to($email_to);
		$this->email->subject($email_subj);
		$this->email->message($email_body);
		if($this->email->send()){
			return true;
		}else {
			return false;
		}
	}


}
