<?php
foreach($dealer as $row){
	$id = $row->id;
	$dname = $row->name;
	$image_url = $row->image_url;
	$address = $row->address;
	$opening_hours = $row->opening_hours;
	$number_of_car = $row->number_of_car;
	$average_rate1 = $row->average_rate;
	$ave = (float) $average_rate1;
	$rate_percent = $ave * 20;
	
	?>
	<div class="each_row">
		<div class="edit_update"><?php 
		if($this->session->userdata('is_logedin')==1){
			echo anchor("dealership/update/$id", " Upadate ")." | ".anchor("dealership/delete/$id", " Delete "); 
		} ?>
		</div>
		<div style="font-size:20px; padding:7px;"><?php echo $dname; ?></div>
		<div class="rate_all_bar" style="width:100%;"><div class="rate_bar"><div class="current_rate" <?php echo "style='width:$rate_percent%'"; ?> > </div></div></div>
		<div class="dealer_pic_large"><img src="<?php echo $image_url; ?>" width="200px"/></div>
		<div class="rows"><b>Address: </b><?php echo " ".$address; ?></div>
		<div class="rows"><b>Opening hours: </b><?php echo " ".$opening_hours; ?></div>
		
		<div class="short_info">Recent reviews:
	<?php
		foreach($review as $row2){
			if($row->id == $row2->dealership_id){
				// first get data then print
				$dealership_id = $row2->dealership_id;
				$rname = $row2->name;
				$review_title = $row2->review_title;
				$review_description = $row2->review_description;
				$date_addded = $row2->date_addded;
				$date_added = date("F j, Y, g:i a", strtotime($date_addded)); 
			}
		}
		echo "<div class='row_info'>Number of cars: <b>".$number_of_car."</b></div>";
		echo "<div class='row_info'>Average review: <b>".$average_rate1."</b></div>";
		
	?>
		</div>
	</div>
<h3>List of recent reviews </h3>
<?php
foreach($review as $row2){
	// first get data then print
	$rid = $row2->id;
	$dealership_id = $row2->dealership_id;
	$rname = $row2->name;
	$rate = $row2->rate;
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
					echo $ap ;
					echo anchor("review/update/$rid", " Upadate ")." | ".anchor("review/delete/$rid", " Delete "); 
				} ?>
		</div>
		<div class="row_head"><?php echo anchor("review/show/$rid", $review_title); ?></div>
		<div class="row_info"><?Php echo $date_added." ".anchor("review/show/$rid", $rname)." | rate ".$rate." out of 5";;?> </div>
		<div class="rows"><?php echo $review_description; ?></div>
	</div>
<?php	
}

?>

<?php 	
}




