<?php echo heading($p_title, 1);  ?>
<div id="contact_us">
<?php 
	$this->load->helper("form");
	echo "<span style='color:red;'>".validation_errors()."</span>";
	echo  "<span style='color:green;'>".$ok_message."</span>";
	
	echo form_open("p/contact_us");
	
	echo "<div class='inp_row'>";
	echo form_label("Name: ", "name");
	$data = array(
		"name" => "name",
		"id" => "name",
		"class" => "inp",
		"value"=> set_value("name")
	);
	echo form_input($data);
	echo "</div><div class='inp_row'>";
	
	echo form_label("Email: ", "email");
	$data = array(
		"name" => "email",
		"id" => "email",
		"class" => "inp",
		"value"=> set_value("email")
	);
	echo form_input($data);
	echo "</div><div class='inp_row'>";
	
	echo form_label("Message: ", "message");
	$data = array(
		"name" => "message",
		"id" => "message",
		"class" => "inp_ta",
		"value"=> set_value("message")
	);
	echo form_textarea($data);
	echo "</div><div class='inp_row'>";
	
	$submit = array("name" => "submit_contact", "value" => " Send ", "class" => "create_button");
	echo form_submit($submit);
	echo "</div>";
	
	
	echo form_close();
?>

</div>

