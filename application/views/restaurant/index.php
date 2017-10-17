<?php if(!$mobile){ ?>
	<?php $this->load->view('landing/header'); ?>
<?php }else{ ?>
	<?php $this->load->view('landing/header_mobile'); ?>
<?php } ?>
<?php $this->load->view('restaurant/header'); ?>
<div class="container cafe-item">
	<div class="list-page_top row">
		<?php $this->load->view('restaurant/left_side'); ?>
		<?php $this->load->view('restaurant/right_side'); ?>
		<?php $this->load->view('restaurant/more_info'); ?>
   </div>
</div>
<?php $this->load->view('restaurant/cart'); ?>
<?php $this->load->view('landing/footer'); ?>