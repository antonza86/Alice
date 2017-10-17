<div class="global">
		<!-- Side menu -->
	<?php $this->load->view('mobile/landing/side_menu'); ?>
	<div class="wrapper">
		<!-- HEADER -->
		<?php $this->load->view('mobile/restaurant/header'); ?>
		<!-- RESTO -->
		<?php if($restaurant) { ?>
			<?php $this->load->view('mobile/restaurant/header_restaurant'); ?>
			<?php $this->load->view('mobile/restaurant/header_menu'); ?>
			<?php $this->load->view('mobile/restaurant/menu'); ?>
			<?php $this->load->view('mobile/restaurant/more_info'); ?>
		<?php }else{ ?>
			<?php $this->load->view('mobile/restaurant/header_product'); ?>
			<?php $this->load->view('mobile/restaurant/product_list'); ?>
		<?php } ?>
		<!-- FOOTER -->
		<?php $this->load->view('mobile/landing/footer'); ?>
	</div>
</div>
<div id="overlay">
	<img src="<?php echo base_url(); ?>assets/images/loader.gif" alt="Loading...">
</div>