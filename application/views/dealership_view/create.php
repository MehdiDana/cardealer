<div class="form_review">
<h3>Create a new dealership </h3>
<?php 

echo "<span style='color:red;'>".validation_errors()."</span>";

echo form_open("dealership/create");

	echo "<div class='inp_row'>";
	echo form_label("Name: ", "name");
	$data = array(
		"name" => "name",
		"id" => "name",
		"class" => "inp",
		"placeholder" => "Name",
		"value"=> set_value("name")
	);
	echo form_input($data);
	echo "</div><div class='inp_row'>";

	echo form_label("Address: ", "address");
	$data = array(
		"name" => "address",
		"id" => "address",
		"class" => "inp_ta",
		"placeholder" => "Address",
		"value"=> set_value("address")
	);
	echo form_textarea($data);
	echo "</div><div class='inp_row'>";
	
	echo "<span style='font-size:10px;'>Please enter postcode again</span><br />";
	echo form_label("Post code: ", "post_code");
	$data = array(
		"name" => "post_code",
		"id" => "post_code",
		"class" => "inp",
		"placeholder" => "Post code",
		"value"=> set_value("post_code")
	);
	echo form_input($data);
	echo "</div><div class='inp_row'>";
	
	echo form_label("Opening hours: ", "opening_hours");
	$data = array(
		"name" => "opening_hours",
		"id" => "opening_hours",
		"class" => "inp_ta",
		"placeholder" => "Opening hours",
		"value"=> set_value("opening_hours")
	);
	echo form_textarea($data);
	echo "</div><div class='inp_row'>";
	
	echo form_label("Number of car: ", "number_of_car");
	$data = array(
		"name" => "number_of_car",
		"id" => "number_of_car",
		"class" => "inp",
		"placeholder" => "Number os car",
		"value"=> set_value("number_of_car")
	);
	echo form_input($data);
	echo "</div><div class='inp_row'>";
	
	echo form_label("Image url: ", "image_url");
	$data = array(
		"name" => "image_url",
		"id" => "image_url",
		"class" => "inp",
		"placeholder" => "Image url",
		"value"=> set_value("image_url")
	);
	echo form_input($data);
	echo "</div><div class='inp_row'>";

	$submit = array ("name" => "create_dealership", "value" => " Create ", "class" => "create_button");
	echo form_submit($submit);
	echo "</div>";
	
echo form_close();
?>
</div>