
<div class="form_review">
<b>Write a review </b>

<?php
foreach($dealer as $row){
$dlr = $row->id;
}
// write a review
$this->load->helper("form");
echo "<span style='color:red;'>".validation_errors()."</span>";
echo form_open("dealership/show/$dlr");

	echo "<div class='inp_row'>";
	echo form_label("Rate: ", "rate");
	$data = array(
		"name" => "rate",
		"id" => "rate",
		"class" => "inp",
		"value"=> set_value("name")
	);
	$options = array(
		  1  => "1 * ",
		  2  => "2 * * ",
		  3  => "3 * * * ",
		  4  => "4 * * * * ",
		  5  => "5 * * * * * "
		);
	echo form_dropdown('rate', $options, set_value("rate"));
	echo "</div><div class='inp_row'>";
	
	
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
	
	echo form_label("Review_title: ", "review_title");
	$data = array(
		"name" => "review_title",
		"id" => "review_title",
		"class" => "inp",
		"placeholder" => "Review title",
		"value"=> set_value("review_title")
	);
	echo form_input($data);
	echo "</div><div class='inp_row'>";
	
	echo form_label("Review description: ", "review_description");
	$data = array(
		"name" => "review_description",
		"id" => "review_description",
		"class" => "inp_ta",
		"placeholder" => "Review description",
		"value"=> set_value("review_description")
	);
	echo form_textarea($data);
	echo "</div><div class='inp_row'>";
	
	$submit = array ("name" => "create_review", "value" => " Create ", "class" => "create_button");
	echo form_submit($submit);
	echo "</div>";

echo form_close();
?>
</div>