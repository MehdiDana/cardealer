<h3><?Php echo anchor("review/index", "Review list");?> </h3>
<div class="form_review">
<h3>Update this review </h3>

<?php 
$this->load->helper("form");
echo "<span style='color:red;'>".validation_errors()."</span>";
echo form_open("review/update/$id");

	foreach($review as $row){
		echo form_label("Approved: ", "approved");
		$data = array(
			"name" => "approved",
			"id" => "approved",
			"value"=> $row->approved
		);
			$options = array(
				  0  => " NO ",
				  1  => " YES "
				);
			echo form_dropdown('approved', $options, $row->approved);
			echo "<br />";
		}

	echo "<br />";

	$submit = array ("name" => "update_review", "value" => " Update ", "class" => "create_button");
	echo form_submit($submit);
	
echo form_close();
?>
</div>