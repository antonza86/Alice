<header class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-3">
				<?php if($restaurant) { ?>
					<a href="<?php echo base_url().$city_name; ?>" class="btn btn-back"></a>
				<?php }else{ ?>
					<a href="<?php echo base_url().$restaurant_name; ?>" class="btn btn-back"></a>
				<?php } ?>
			</div>
			<div class="col-6 text-center">
				<a href="<?php echo base_url(); ?>?city_name=<?php echo $city_name; ?>" class="city_info" id="<?php echo $city_id; ?>" value="<?php echo $city_name; ?>">
					<figure class="logo">
						<img src="<?php echo base_url(); ?>assets/images/logo.png" width="210" height="46" alt="<?php echo $this->lang->line('slogan') ?>">
					</figure>
				</a>
			</div>
			<div class="col-3 text-right">
				<a href="<?php echo base_url()."cart"; ?>" class="ico cart">
				</a>
			</div>
		</div>
	</div>
</header>