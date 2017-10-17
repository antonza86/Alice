<div class="col s-9 history_data hide">
	<h1 class="page-title">Histórico</h1>
	<?php if(count($order_list) != 0){ ?>
		<?php foreach ($order_list as $key){ ?>
			<section class="order-item">
				<h3 class="order-item_title"><a href="<?php echo base_url().$key['rest_url'] ;?>"><?php echo $key['rest_name']; ?></a> — <?php echo $key['order_date']; ?></h3>
				<div class="row">
					<div class="col s-8">
						<?php foreach ($key["product_list"] as $product){ ?>
							<div class="order-line row">
								<div class="col s-7 order-line_name">
									<img src="<?php echo base_url().'assets/images/restaurant/'.$key['rest_url'].'/'.$product['url']; ?>" height="50" width="50" alt="<?php echo $product["name"]; ?>">
									<p><?php echo $product["name"]; ?></p>
									<?php $extra_price = 0; ?>
									<?php if(count($product['extras']) != 0){ ?>
										<div class="ingredients-history">
											<div class="title">Extras:</div>
											<?php foreach ($product['extras'] as $extra){ ?>
												<?php $extra_price += $extra['price']; ?>
												<div class="item">
													<span><?php echo $extra['price']; ?> €</span>
													<?php echo $extra['name']; ?>
												</div>
											<?php } ?>
										</div>
									<?php } ?>
								</div>
								<div class="col s-2 order-line_count text-center">
									<?php echo $product["qnt"]; ?>
								</div>
								<div class="col s-3 order-line_price text-right">
									<?php echo $product["single_price"] + $extra_price; ?> €
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="col s-4">
						<div class="order-item_info">
							<p>Valor do pedido:</p>
							<p><span><?php echo $key['price']; ?> €</span></p>
							<p>Valor da entrega:</p>
							<p><span><?php echo $key['delivery_price']; ?> €</span></p>
							<p class="order-item_price">Total: <?php echo $key['total_price']; ?> €</p>
							<div class="h-tooltip">
								<!--<button class="btn btn--green disabled repeat_order" disabled>Pedir novamente</button>-->
								<button class="btn btn--green repeat_order" order_id="<?php echo $key['order_id']; ?>">Pedir novamente</button>
								<div class="b-tooltip tc" style="display: none;">De momento não é possivel fazer o pedido neste restaurante</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php } ?>
	<?php } ?>
</div>