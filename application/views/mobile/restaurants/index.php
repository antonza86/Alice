<div class="global">
		<!-- Side menu -->
	<?php $this->load->view('mobile/landing/side_menu'); ?>
	<div class="wrapper">
		<!-- HEADER -->
		<?php $this->load->view('mobile/landing/header'); ?>
		<!-- RESTO -->
		<?php //$this->load->view('mobile/restaurants/search'); ?>
		<?php $this->load->view('mobile/restaurants/sort'); ?>
		<?php $this->load->view('mobile/restaurants/list'); ?>
		<?php $this->load->view('mobile/restaurants/modal'); ?>
		<!-- FOOTER -->
		<?php $this->load->view('mobile/landing/footer'); ?>
	</div>
</div>
<div id="overlay">
	<img src="<?php echo base_url(); ?>assets/images/loader.gif" alt="Loading...">
</div>