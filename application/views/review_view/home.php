
<h3>List of recent reviews </h3>
<?php
echo "<div class='page_num'>".$links."</div>"; 
foreach($review as $row2){
	// first get data then print
	$rid = $row2->id;
	$dealership_id = $row2->dealership_id;
	$rname = $row2->name;
	$review_title = $row2->review_title;
	$review_description = $row2->review_description;
	$date_addded = $row2->date_addded;
	$rapproved = $row2->approved;
	$date_added = date("F j, Y, g:i a", strtotime($date_addded)); 
	if($rapproved==1){
		$ap = "";
		echo "<div class='each_row'>";
	}else {
		$ap = "NOT approved";
		echo "<div class='each_row' style='background-color:#FEF5CA;'>";
	}
	?>
			<div class="edit_update"><?php 
				if($this->session->userdata('is_logedin')==1){
					echo $ap. " | ";
					echo anchor("review/update/$rid", " Upadate ")." | ".anchor("review/delete/$rid", " Delete "); 
				} ?>
		</div>
		<div class="row_head"><?php echo anchor("dealership/show/$dealership_id ", $review_title); ?></div>
		<div class="row_info"><?Php echo $date_added." ".anchor("review/show/$rid ", $rname);?> </div>
		<div class="rows"><?php echo $review_description; ?></div>
	</div>
<?php	
}
echo "<div class='page_num'>".$links."</div>"; 
?>

