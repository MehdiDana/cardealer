<h3><?Php echo anchor("dealership/index", "Dealership list");?> </h3>
<div class="form_review">
<h3>Update this dealership </h3>
<?php 
$this->load->helper("form");
echo "<span style='color:red;'>".validation_errors()."</span>";
echo form_open("dealership/update/$id");

foreach($dealer as $row){

	echo "<div class='inp_row'>";
	echo form_label("Name: ", "name");
	$data = array(
		"name" => "name",
		"id" => "name",
		"class" => "inp",
		"value"=> $row->name
	);
	echo form_input($data);
	echo "</div><div class='inp_row'>";

	echo form_label("Address: ", "address");
	$data = array(
		"name" => "address",
		"id" => "address",
		"class" => "inp_ta",
		"value"=> $row->address
	);
	echo form_textarea($data);
	echo "</div><div class='inp_row'>";
	
	echo "<span style='font-size:10px;'>Please enter postcode again</span><br />";
	echo form_label("Post code: ", "post_code");
	$data = array(
		"name" => "post_code",
		"id" => "post_code",
		"class" => "inp",
		"value"=> $row->post_code
	);
	echo form_input($data);
	echo "</div><div class='inp_row'>";
	
	echo form_label("Opening_hours: ", "opening_hours");
	$data = array(
		"name" => "opening_hours",
		"id" => "opening_hours",
		"class" => "inp_ta",
		"value"=> $row->opening_hours
	);
	echo form_textarea($data);
	echo "</div><div class='inp_row'>";
	
	echo form_label("Number_of_car: ", "number_of_car");
	$data = array(
		"name" => "number_of_car",
		"id" => "number_of_car",
		"class" => "inp",
		"value"=> $row->number_of_car
	);
	echo form_input($data);
	echo "</div><div class='inp_row'>";
	
	echo form_label("image_url: ", "image_url");
	$data = array(
		"name" => "image_url",
		"id" => "image_url",
		"class" => "inp",
		"value"=> $row->image_url
	);
	echo form_input($data);
	echo "</div><div class='inp_row'>";

	echo form_label("Approved: ", "approved");
	$data = array(
		"name" => "approved",
		"id" => "approved",
		"class" => "inp",
		"value"=> set_value("approved")
	);
	$options = array(
		  1  => "Approved ",
		  0  => "Not Approved",
		);
	echo form_dropdown('approved', $options, $row->approved);
	echo "</div><div class='inp_row'>";	
}
	echo "<br />";

	$submit = array ("name" => "update_dealership", "value" => " Update ", "class" => "create_button");
	echo form_submit($submit);
	echo "</div>";
	
echo form_close();
?>
</div>
