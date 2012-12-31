<div class="form_review">
<?php

echo "<span style='color:red;'>".validation_errors()."</span>";
echo form_open();
	echo "<div class='inp_row'>";
	echo form_label("Email: ", "email");
	$data = array(
		"name" => "email",
		"id" => "email",
		"class" => "inp",
		"placeholder" => "Email",
		"value"=> set_value("email")
	);
	echo form_input($data);
	echo "</div><div class='inp_row'>";
	
	echo form_label("Password: ", "password");
	$data = array(
		"name" => "password",
		"id" => "password",
		"class" => "inp",
		"placeholder" => "Password",
		"value"=> set_value("password")
	);
	echo form_password($data);
	echo "</div><div class='inp_row'>";
	
	$submit = array("name" => "login", "value" => " Login ", "class" => "create_button");
	echo form_submit($submit);
	echo "</div>";

echo form_close();
?>
</div>