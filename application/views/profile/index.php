<?php $data['city_name'] = (count($address_info) != 0 ? $address_info[0]['city'] : "" );?>
<?php $data['city_id'] = "1";?>

<?php if(!$mobile){ ?>
	<?php $this->load->view('landing/header', $data); ?>
<?php }else{ ?>
	<?php $this->load->view('landing/header_mobile'); ?>
<?php } ?>

<div class="container profile-page">
	<?php $this->load->view('profile/header'); ?>
	<div class="list-page_top row">
		<?php $this->load->view('profile/left_side'); ?>
		<?php $this->load->view('profile/right_side_profile'); ?>
		<?php $this->load->view('profile/right_side_history'); ?>
	</div>
</div>

<?php $this->load->view('landing/footer'); ?>