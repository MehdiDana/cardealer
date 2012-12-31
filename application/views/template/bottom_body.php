</div>
	<div class="footer">
	Copyright Mehdi Dana [m3dana at gmail dot com] 
		<div class="inout_section">
			<?php if($this->session->userdata('is_logedin')==1){ ?>
				<a href="<?php echo base_url(); ?>admin/logout">Logout</a>
			<?php }else {?>
				<a href="<?php echo base_url(); ?>admin/login">Login</a>
			<?php }?>
		</div>
		<p class="footer_right">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
	</div>
</div>

</body>
</html>