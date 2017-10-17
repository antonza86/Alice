<div class="restaurant-overview" style="background-image: url(assets/images/bg-org-pizza_mobile.jpg); background-repeat: no-repeat; background-size: cover;">
	<div class="restaurant-overview__image-block">
		<div class="restaurant-overview__logo-wrapper">
			<img src="<?php echo base_url().'assets/images/restaurant/'.$restaurant_info['url_name'].'/'.$restaurant_info['logo'] ?>" alt="<?php echo $restaurant_info['name'] ?>" class="restaurant-overview__logo">
		</div>
		<div class="restaurant-overview__rating-row hide">
			<div class="restaurant-overview__star-rating">
				<svg xmlns="http://www.w3.org/2000/svg" width="119.219" height="19" viewBox="0 0 119.219 19">
					<defs>
						<linearGradient id="Gradient625">
							<stop offset="0%" stop-color="#ffa115" />
							<stop offset="92.8466%" stop-color="#ffa115" />
							<stop offset="92.8466%" stop-color="#dadada" />
							<stop offset="100%" stop-color="#dadada" />
						</linearGradient>
						<style>
							.cls-11 {
								fill-rule: evenodd;
							}
						</style>
					</defs>
					<path id="star_copy_4" data-name="star copy 4" class="cls-11" fill="url(#Gradient625)" d="M142.941,366.682a1.055,1.055,0,0,0-.856-0.717l-5.631-.812-2.518-5.063a1.063,1.063,0,0,0-1.9,0l-2.52,5.065-5.631.812a1.055,1.055,0,0,0-.855.717,1.04,1.04,0,0,0,.268,1.079l4.075,3.942-0.962,5.567a1.054,1.054,0,0,0,.421,1.028,1.082,1.082,0,0,0,1.118.081l5.036-2.629,5.037,2.629a1.065,1.065,0,0,0,.492.121h0a1.067,1.067,0,0,0,.624-0.2,1.055,1.055,0,0,0,.422-1.029L138.6,371.7l4.075-3.942A1.042,1.042,0,0,0,142.941,366.682Zm-24.568,0a1.055,1.055,0,0,0-.856-0.717l-5.631-.812-2.519-5.063a1.063,1.063,0,0,0-1.9,0l-2.519,5.065-5.631.812a1.055,1.055,0,0,0-.856.717,1.042,1.042,0,0,0,.269,1.079L102.8,371.7l-0.962,5.567a1.054,1.054,0,0,0,.421,1.028,1.08,1.08,0,0,0,1.117.081l5.037-2.629,5.036,2.629a1.072,1.072,0,0,0,.493.121h0a1.056,1.056,0,0,0,1.045-1.23l-0.962-5.567,4.075-3.942A1.043,1.043,0,0,0,118.373,366.682Zm-24.569,0a1.055,1.055,0,0,0-.856-0.717l-5.631-.812L84.8,360.09a1.063,1.063,0,0,0-1.9,0l-2.519,5.065-5.631.812a1.055,1.055,0,0,0-.856.717,1.042,1.042,0,0,0,.268,1.079l4.075,3.942-0.962,5.567a1.053,1.053,0,0,0,.421,1.028,1.081,1.081,0,0,0,1.117.081l5.037-2.629,5.037,2.629a1.069,1.069,0,0,0,.493.121h0a1.056,1.056,0,0,0,1.045-1.23L89.461,371.7l4.075-3.942A1.042,1.042,0,0,0,93.8,366.682Zm-24.568,0a1.055,1.055,0,0,0-.856-0.717l-5.631-.812L60.23,360.09a1.063,1.063,0,0,0-1.9,0l-2.519,5.065-5.631.812a1.055,1.055,0,0,0-.856.717,1.042,1.042,0,0,0,.268,1.079l4.075,3.942L52.7,377.27a1.053,1.053,0,0,0,.421,1.028,1.081,1.081,0,0,0,1.117.081l5.037-2.629,5.036,2.629a1.069,1.069,0,0,0,.493.121h0a1.056,1.056,0,0,0,1.045-1.23L64.892,371.7l4.075-3.942A1.042,1.042,0,0,0,69.236,366.682Zm-25.478,0a1.055,1.055,0,0,0-.856-0.717l-5.631-.812-2.519-5.063a1.063,1.063,0,0,0-1.9,0l-2.519,5.065-5.631.812a1.055,1.055,0,0,0-.856.717,1.042,1.042,0,0,0,.268,1.079l4.075,3.942-0.962,5.567a1.053,1.053,0,0,0,.421,1.028,1.081,1.081,0,0,0,1.117.081L33.8,375.75l5.037,2.629a1.069,1.069,0,0,0,.492.121h0a1.056,1.056,0,0,0,1.045-1.23L39.414,371.7l4.075-3.942A1.042,1.042,0,0,0,43.758,366.682Z" transform="translate(-23.781 -359.5)"/>
				</svg>
			</div>
			<div class="restaurant-overview__reviews"><?php echo $restaurant_info['num_rate'] ?></div>
		</div>
	</div>
	<div class="restaurant-overview__info-block">
		<div class="restaurant-overview__title restoran-item_title" url_name="<?php echo $restaurant_info['url_name'] ?>" rest_id="<?php echo $restaurant_info['id'] ?>"><?php echo $restaurant_info['name'] ?></div>
		<div class="restaurant-overview__type"><?php echo $restaurant_info['cuisine'] ?></div>
		<div class="restaurant-overview__row">
				<div class="restaurant-overview__distance" style="display: none;">9.41 км</div>
				<?php if($restaurant_info['card_payment'] == 1){ ?> 
					<div class="restaurant-overview__visa">
						<img src="<?php echo base_url(); ?>assets/images/visa.png" alt="Visa">
					</div>
					<div class="restaurant-overview__mastercard">
						<img src="<?php echo base_url(); ?>assets/images/mastercard.png" alt="Mastercard">
					</div>
				<?php } ?>

		</div>
		<table class="restaurant-overview__info-table">
			<tr>
				<th><?php echo $this->lang->line('restaurant_header_min_value'); ?></th>
				<th><?php echo $this->lang->line('restaurant_header_delivery_value'); ?></th>
				<th><?php echo $this->lang->line('restaurant_header_delivery_time'); ?></th>
			</tr>
			<tr>
				<td><span class="price need_minimum_summa"><?php echo $restaurant_info['min_price'] ?></span></td>
				<td>
					<?php if($restaurant_info['delivery_price'] == '0'){ ?>
						<?php echo $this->lang->line('restaurant_header_free'); ?>
					<?php }else{ ?>
						<span class="delivery-price"><?php echo $restaurant_info['delivery_price']; ?></span> €
					<?php } ?>
				</td>
				<td><span class="time"><?php echo $restaurant_info['delivery_time'] ?> </span>min</td>
			</tr>
		</table>
	</div>
</div>