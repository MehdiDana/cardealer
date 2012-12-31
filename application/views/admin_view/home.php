<?php
if(isset($admin)){
	foreach($admin as $row){
		echo $row->id." ".$row->full_name."<br />";
	}
}
