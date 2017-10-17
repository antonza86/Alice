<div class="global">
		<!-- Side menu -->
	<?php $this->load->view('mobile/landing/side_menu'); ?>
	<div class="wrapper">
		<!-- HEADER -->
		<?php $this->load->view('mobile/restaurant/header'); ?>
		<!-- RESTO -->
		<div id="content-box">
			<div class="basket-unit">
				<?php $this->load->view('mobile/cart/header'); ?>
				<?php $this->load->view('mobile/cart/product_list'); ?>
			</div>
			<?php $this->load->view('mobile/cart/footer'); ?>
		</div>
		<!-- FOOTER -->
		<?php $this->load->view('mobile/landing/footer'); ?>
	</div>
</div>
<div id="overlay">
	<img src="<?php echo base_url(); ?>assets/images/loader.gif" alt="Loading...">
</div>