<?php echo $map['js']; ?>
<?php echo heading($p_title, 1); ?>
<p>
Sagittis hendrerit hac posuere massa mattis euismod cursus ullamcorper hendrerit phasellus est in, ut felis donec at erat at magna fermentum consequat ipsum quisque. 
odio aliquam habitant integer varius vulputate donec commodo pellentesque quisque, eleifend ante aliquam feugiat vehicula curabitur nec facilisis. 
</p>

<div class="home_recent_info">
	<div class="home_recent_rate">
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
	$date_added = date("F j, Y, g:i a", strtotime($date_addded)); 
	?>
	<div class="each_row">
		<div class="row_head"><?php echo anchor("dealership/show/$dealership_id ", $review_title); ?></div>
		<div class="row_info">
	<?Php
	echo $date_added." ".anchor("review/show/$rid ", $rname)." | rate ".$rate." out of 5";
	?>
		</div>
	</div>
<?php	
}

?>
	</div>
	<div class="home_recent_top_dealership">
<h3>List of top dealerships </h3>
<?php
foreach($dealership as $row){
	$id = $row->id;
	$dname = $row->name;
	$image_url = $row->image_url;
	$address = $row->address;
	$average_rate1 = $row->average_rate;
	$ave = (float) $average_rate1;
	$rate_percent = $ave * 20;
	?>
	<div class="each_row">
		<div class="row_head"><?php echo anchor("dealership/show/$id ", $dname); ?></div>
		<div style="margin-bottom:3px;"><div class="rate_bar"><div class="current_rate" <?php echo "style='width:$rate_percent%'"; ?> > </div></div></div>
		<div class="dealer_pic_small"><img src="<?php echo $image_url; ?>" width="60px"/></div>
		<div class="row_info"><?php echo " ".$address; ?></div>
		
	<?php
	//echo  anchor("dealership/show/$row->id", $row->name).$row->address."<br />";
	?>
	</div>

<?php 	
}
?>
	</div>
</div>
<div class="big_map">
<?php 

echo $map['html'];
?>
</div>



