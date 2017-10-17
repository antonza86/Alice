<div class="ingredients-box" data-id="<?php echo $prod_id; ?>">
	<div class="box">
			<div class="title">
				Extras
					<a href="#" onclick="return extras.close();" class="close"></a>
			</div>
			<div class="catalog">
				<div class="row">
					<?php foreach ($extras as $key => $value){ ?>
						<div class="col s-6">
						<input type="checkbox" name="promo" value="<?php echo $value['extra_id']; ?>" data-price="<?php echo $value['extra_price']; ?>" id="ing<?php echo $value['extra_id']; ?>">
							<label for="ing<?php echo $value['extra_id']; ?>">
								<span class="price">+<?php echo $value['extra_price']; ?> €</span>
								<span class="name"><?php echo $value['name']; ?></span>
							</label>
						</div>
					<?php } ?>
				</div>
			</div>
		<div class="row footer">
			<div class="col s-6 cost">
				<span class="text">Preço com extras:</span> <span class="price price_total"><?php echo $value['prod_price']; ?></span> €
			</div>
			<div class="col s-6 text-right">
				<button onclick="extras.inc(-1)" class="btn--minus">-</button>
				<input class="item-count" type="text" disabled value="1">
				<button onclick="extras.inc(1)" class="btn--plus">+</button>
				<button onclick="extras.order();" class="btn btn--green">Adicionar ao pedido</button>
			</div>
		</div>
	</div>
</div>