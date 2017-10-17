<script>
	$('.modal--constructor .basket-item__extra input').change(extras.select);
	extras.select();
</script>
<div class="modal modal--constructor popup opened" data-id="<?php echo $prod_id; ?>">
	<div class="modal-close"></div>
	<div class="enter-form">
		<h2 class="enter-form__title"><?php echo $this->lang->line("product_extras_ingredient"); ?></h2>
		<?php foreach ($extras as $key => $value){ ?>
			<div class="basket-item__extra">
				<input type="checkbox" value="<?php echo $value['extra_id']; ?>" data-price="<?php echo $value['extra_price']; ?>" id="ing<?php echo $value['extra_id']; ?>">
				<label class="modal__checkbox-label" for="ing<?php echo $value['extra_id']; ?>"><?php echo $value['name']; ?></label>
				<span class="price">+<?php echo $value['extra_price']; ?> €</span>
			</div>
		<?php } ?>
		<br><br>
	</div>
	<br><br><br><br>
</div>
<div class="modal-footer opened modal--constructor">
	<div class="container">
		<span class="total-price price price_total" data-price="<?php echo $value['prod_price']; ?>"><?php echo $value['prod_price']; ?></span> €
		<div class="basket-item__qnty">
			<button onclick="extras.inc(-1)" type="button" class="btn btn--green btn--decrease">-</button>
			<input type="text" class="item-count" disabled value="1">
			<button onclick="extras.inc(1)" type="button" class="btn btn--green btn--increase">+</button>
		</div>
	</div>
	<button type="button" onclick="extras.order();" class="btn btn--green btn--fluid"><?php echo $this->lang->line("cart_add_to_list"); ?></button>
</div>