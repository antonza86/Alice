<?php 
//if(count($restaurant_list) == 0){
//	$this->load->view('restaurants/no_results');
//}
?>
<?php foreach ($restaurant_list as $key => $value){ ?>
	<a href="<?php echo $value['url_name'] ?>" class="restoran-item row <?php if($value['special'] == "true") echo 'restoran-item--food-bal' ?> h-tooltip">
		<div class="col s-3">
			<figure class="restoran-item_image">
				<img src="assets/images/restaurant/<?php echo $value['url_name'] ?>/<?php echo $value['logo'] ?>" height="160" width="160" alt="<?php echo $value['name'] ?>">
			</figure>
		</div>
		<div class="col s-9">
			<div class="restoran-item_top row">
				<div class="col s-8">
					<h4 class="restoran-item_title"><?php echo $value['name'] ?></h4>
					<p class="restoran-item_description">
            <span>Cozinha:</span> <?php echo $value['cuisine'] ?>
            <span class="distance hide">5 Km</span>
          </p>
				</div>
				<div class="col s-4 text-right hide">
					<div class="rate rate--5">
						<?php for ($i = 0; $i < $value['rate']; $i++) { ?>
							<i></i>
						<?php } ?>
					</div>
					<p class="restoran-item_star-col"><?php echo $value['num_rate'] ?> classificações</p>
				</div>
			</div>
			<div class="restoran-item_bottom row">
				<div class="col s-3">
					<p class="restoran-item_sub-titile">Valor min.:</p>
					<p class="restoran-item_big"><i class="sprite sprite-ico-stack "></i>
						<?php echo $value['min_price'] ?> €
					</p>
				</div>
				<div class="col s-3">
					<p class="restoran-item_sub-titile">Valor entrega:</p>
					<p class="restoran-item_big"><i class="sprite sprite-ico-rocket-w"></i>
						<?php if($value['delivery_price'] == '0')
								echo "Grátis";
							else
						  	echo $value['delivery_price']." €";	
						 ?>
					</p>
				</div>
				<div class="col s-3">
					<p class="restoran-item_sub-titile">Tempo entrega:</p>
					<p class="restoran-item_big"><i class="sprite sprite-ico-timer-2"></i> <?php echo $value['delivery_time'] ?> min.</p>
				</div>
				<div class="col s-3">
					<p class="restoran-item_sub-titile">Pagamento c/cartão:</p>
						<p class="restoran-item_big"><i class="sprite sprite-ico-viza"></i> 
							<?php if($value['card_payment'] == 1)
								echo "Sim";
							  else
							  	echo "Não";	
							?>
						</p>
				</div>
			</div>
		</div>
		<?php if($value['extra_info'] != ''){ ?>
			<div class="b-tooltip to"> <?php echo $value['extra_info'] ?></div>
		<?php } ?>
	</a>
<?php } ?>