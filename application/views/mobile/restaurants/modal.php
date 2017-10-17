<?php 
	$checkbox_filter_list = get_checkbox_filter_list();
	$cuisine_list = get_cuisine_list();
	$cuisine_alt_list = get_cuisine_alt_list();
?>
<span class="modal modal--sort popup container">
	<span class="modal-close" onclick="closeFilters();"></span>
	<div class="modal__filters-block">
		<input type="hidden" name="sort" value="1">
		<div class="modal__block-title"><?php echo $this->lang->line("restaurants_order_by"); ?></div>
		<div class="tab-controls tab-controls--narrow tab-controls--blue">
			<button type="button" onclick="setSort(2, this);" class="tab-control-2 tab-control--narrow tab-control--blue sort_restaurant_mobile" data-order="abc"><?php echo $this->lang->line("restaurants_order_by_abc"); ?></button>
			<button type="button" onclick="setSort(3, this);" class="tab-control-2 tab-control--narrow tab-control--blue sort_restaurant_mobile" data-order="min_price"><?php echo $this->lang->line("restaurants_order_by_price"); ?></button>
			<button type="button" onclick="setSort(4, this);" class="tab-control-2 tab-control--narrow tab-control--blue sort_restaurant_mobile" data-order="min_time"><?php echo $this->lang->line("restaurants_order_by_time"); ?></button>
		</div>
	</div>
	<br><br>
	<div class="modal__filters-block">
		<h4 class="modal__block-title"><?php echo $this->lang->line("restaurants_show_just"); ?></h4>
		<?php foreach ($checkbox_filter_list as $key => $value){ ?>
			<input type="checkbox" class="checkbox_filter" name="<?php echo $value['value']; ?>" value="free" id="ch<?php echo $key; ?>">
			<label for="ch<?php echo $key; ?>" class="modal__checkbox-label"><?php echo $value['name']; ?></label>
		<?php } ?>
	</div>
	<br><br>
	<div class="modal__filters-block">
		<h4 class="modal__block-title"><?php echo $this->lang->line("restaurants_show_categories"); ?></h4>
		<input type="checkbox" class="cuisines" name="cuisines" value="all" id="standard_cat_0" checked="">
		<label for="standard_cat_0" class="modal__checkbox-label"><?php echo $this->lang->line("all_restaurants"); ?></label>
		<?php foreach ($cuisine_list as $key => $value){ ?>
			<input type="checkbox" class="cuisine" name="cuisine" value="<?php echo $value['value']; ?>" cuisine="<?php echo $key; ?>" id="standard_cat_<?php echo $key; ?>">
			<label for="standard_cat_<?php echo $key; ?>" class="modal__checkbox-label"><?php echo $value['name']; ?></label>
		<?php } ?> 
	</div>
	<br><br>
	<div class="modal__filters-block">
		<h4 class="modal__block-title"><?php echo $this->lang->line("restaurants_show_other_categories"); ?></h4>
			<?php foreach ($cuisine_alt_list as $key => $value){ ?>
				<input type="checkbox" class="cuisine_alt" value="<?php echo $value['value']; ?>" cuisine="<?php echo $key; ?>" id="other_cat_<?php echo $key; ?>">
				<label for="other_cat_<?php echo $key; ?>" class="modal__checkbox-label"><?php echo $value['name']; ?></label>
			<?php } ?>
	</div>
	<br>
</span>
<span class="modal-footer modal--sort">
	<button type="button" onclick="closeFilters();" class="btn btn--orange btn--fluid"><?php echo $this->lang->line("restaurants_sort_apply"); ?></button>
</span>