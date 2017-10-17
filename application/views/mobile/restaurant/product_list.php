<?php if(count($products) != 0){ ?>
	<div class="category-items-wrapper">
		<?php foreach ($products as $key => $value){ ?>
			<div class="category-item container">
				<img src="<?php echo base_url().'assets/images/restaurant/'.$restaurant_name.'/'.$value['url']; ?>" alt="<?php echo $value['name']; ?>" class="category-item__image">
				<div class="category-item__info">
					<h3 class="category-item__title"><?php echo $value['name']; ?></h3>
					<p class="category-item__ingredients"><?php echo $value['description']; ?></p>
					<div class="category-item__price-row product-item" data-id="<?php echo $value['prod_id']; ?>" data-type="item" data-constructor="0" data-price="<?php echo $value['prod_price']; ?>">
						<div class="category-item__price"><span><?php echo $value['prod_price']; ?></span> €</div>
						<button class="btn btn--green btn--order" data-extras="<?php echo $value['extra']; ?>"><?php echo $this->lang->line("restaurant_add_product"); ?></button>
						<div class="basket-item__qnty  hidden ">
							<button onclick="cartIncrementItem(2935809, this, 625, -1);" type="button" class="btn btn--green btn--decrease">-</button>
							<input type="text" disabled="" value="0">
							<button onclick="cartIncrementItem(2935809, this, 625, 1);" type="button" class="btn btn--green btn--increase">+</button>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
<?php } ?>