<?php $this->load->view('landing/header'); ?>
<div class="container profile-page">
	<div id="contentBox">
		<div class="cart-layout row">
			<?php $this->load->view('cart/left_side'); ?>
			<?php $this->load->view('cart/right_side'); ?>
		</div>
	</div>
</div>

<?php $this->load->view('landing/footer'); ?>