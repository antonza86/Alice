<?php $holiday = explode(",",$restaurant_info['holiday']) ?>
<div id="more_info_box" class="restaurant-info hide">
	<h2 class="restaurant-info__block-title"><?php echo $this->lang->line('restaurant_more_info_important'); ?></h2>
	<div class="restaurant-info__text">Info Bla Bla Bla, More info etc
	</div>
	<h2 class="restaurant-info__block-title"><?php echo $this->lang->line('restaurant_more_info_schedules'); ?></h2>
	<table class="opening-hours-table">
		<?php $week = ["ext", $this->lang->line("restaurant_more_info_day_2"), $this->lang->line("restaurant_more_info_day_3"), $this->lang->line("restaurant_more_info_day_4"), $this->lang->line("restaurant_more_info_day_5"), $this->lang->line("restaurant_more_info_day_6"), $this->lang->line("restaurant_more_info_day_7"), $this->lang->line("restaurant_more_info_day_1")] ?>
		<?php for($i = 1; $i < 8; $i ++){ ?>
			<tr>
				<td>
					<?php if(in_array($i, $holiday)){ ?>
						<?php echo $week[$i]; ?>:</td><td><?php echo $this->lang->line("restaurant_more_info_holiday"); ?>
					<?php }else{ ?>
						<?php echo $week[$i]; ?>:</td><td><?php echo $restaurant_info['schedule']; ?>
					<?php } ?>
				</td>
			</tr>
			<?php } ?>
	</table>
	<?php if($restaurant_info['card_payment'] == 1){ ?> 
		<h2 class="restaurant-info__block-title"><?php echo $this->lang->line("restaurant_more_info_accept_mb"); ?></h2>
		<div class="payment-options">
			<img src="<?php echo base_url(); ?>assets/images/visa-big.png" alt="" class="payment-option">
			<img src="<?php echo base_url(); ?>assets/images/mastercard-big.png" alt="" class="payment-option">
		</div>  
	<?php } ?>
	<h2 class="restaurant-info__block-title"><?php echo $this->lang->line("restaurant_more_info_kitchen"); ?></h2>
	<div class="restaurant-info__kitchen"><?php echo $restaurant_info['cuisine'] ?></div>
</div>