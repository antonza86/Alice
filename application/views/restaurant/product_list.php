<?php if(count($products) != 0){ ?>
	<div class="row items">
		<?php foreach ($products as $key => $value){ ?>
				<div class="col s-4" id="<?php echo $value['id']; ?>">
				   <div class="itool2 product-item product-item--button" data-id="<?php echo $value['prod_id']; ?>" data-type="item" data-constructor="0" data-price="<?php echo $value['prod_price']; ?>">
				      <div class="product-item_image">
				         <div class="product-item_image_wrapper">
				            <img src="<?php echo base_url().'assets/images/restaurant/'.$restaurant_name.'/'.$value['url']; ?>" alt="<?php echo $value['name']; ?>">
				         </div>
				      </div>
				      <div class="product-item_title">
				         <div class="product-item_title_wrapper ingredients">
				            <p><?php echo $value['name']; ?></p>
				            <?php if($value['extra'] == "1"){ ?>
					            <span class="link">
									<a href="#" onclick="return extras.load(this);">extras</a>
								</span>
							<?php } ?>
				         </div>
				      </div>
				      <div class="product-item_row clearfix">
				         <p class="product-item_bonus">
				            <i class="sprite sprite-ico-stack"></i>
				            <span><?php echo $value['prod_price']; ?></span> €
				         </p>
				         <button class="btn btn--green">Adicionar</button>
				      </div>
				      <div class="itool2-box">
				         <div class="product-item_image">
				            <img src="<?php echo base_url().'assets/images/restaurant/'.$restaurant_name.'/'.$value['url']; ?>" alt="<?php echo $value['name']; ?>">
				         </div>
				         <div class="product-item_title">
				            <div class="product-item_title_wrapper ingredients">
				               <div><?php echo $value['name']; ?></div>
				               <p><?php echo $value['description']; ?></p>
				            	<?php if($value['extra'] == "1"){ ?>
					               <span class="link">
										<a href="#" onclick="return extras.load(this);">extras</a>
									</span>
								<?php } ?>
				            </div>
				         </div>
				         <div class="product-item_row clearfix">
				            <p class="product-item_bonus">
				               <i class="sprite sprite-ico-stack"></i>
				               <span><?php echo $value['prod_price']; ?></span> €
				            </p>
				            <button class="btn btn--green">Adicionar</button>
				         </div>
				      </div>
				   </div>
				</div>
			<?php if($key != 0 && ($key+1)%3 == 0){ ?>
				</div>
				<div class="row items">		
			<?php } ?>
		<?php } ?>
	</div>
<?php } ?>