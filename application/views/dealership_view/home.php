
<?php
if($this->session->userdata('is_logedin')==1){
	echo anchor("dealership/create", "Create new ");
}

echo "<div class='page_num'>".$links."</div>"; 

foreach($dealership as $row){
	$id = $row->id;
	$dname = $row->name;
	$image_url = $row->image_url;
	$address = $row->address;
	$average_rate1 = $row->average_rate;
	$ave = (float) $average_rate1;
	$rate_percent = $ave * 20;
	
	$dapproved = $row->approved;
	if($dapproved==1){
		$ap = "";
		echo "<div class='each_row'>";
	}else {
		$ap = "NOT approved";
		echo "<div class='each_row' style='background-color:#FEF5CA;'>";
	}
	?>
	
		<div class="edit_update"><?php 
			if($this->session->userdata('is_logedin')==1){
				echo $ap;
				echo anchor("dealership/update/$id", " Upadate ")." | ".anchor("dealership/delete/$id", " Delete "); 
			} ?>
		</div>
		<div class="row_head"><?php echo anchor("dealership/show/$id ", $dname); ?></div>
		<div class="rate_all_bar"><div class="rate_bar"><div class="current_rate" <?php echo "style='width:$rate_percent%'"; ?> > </div></div></div>
		<div class="dealer_pic_large"><img src="<?php echo $image_url; ?>" width="200px"/></div>
		<div class="rows"><b>Address: </b><?php echo " ".$address; ?></div>
		
		<div class="short_info">Recent reviews:
	<?php

	$number_od_reviews = 0;
		foreach($review as $row2){
			if($row->id == $row2->dealership_id){
				// first get data then print
				$rid = $row2->id;
				$dealership_id = $row2->dealership_id;
				$rname = $row2->name;
				$review_title = $row2->review_title;
				$review_description = $row2->review_description;
				$date_addded = $row2->date_addded;
				$date_added = date("F j, Y, g:i a", strtotime($date_addded)); 
				$rapproved = $row2->approved;
				if($number_od_reviews < 3){
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
						echo $ap;
						echo anchor("review/update/$rid", " Upadate ")." | ".anchor("review/delete/$rid", " Delete "); 
					} ?>
				</div>
					<div class="row_head"><?php echo anchor("review/show/$dealership_id ", $review_title); ?></div></div>
			<?php }
				$number_od_reviews 	++;	
			}
		}
		echo "<div class='row_info'># of reviews: <b>".$number_od_reviews."</b> || avegare review: <b>".$average_rate1."</b></div>";
		
	?>
		</div>
	</div>

<?php 	
}

echo "<div class='page_num'>".$links."</div>"; 
?>


<?php
if($this->session->userdata('is_logedin')==1){
	echo anchor("dealership/create", "Create new");
}
?>
