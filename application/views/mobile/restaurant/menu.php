<div class="restaurant-menu" id="menu_box">
	<ul class="restaurant-menu__list">
		<?php for($i = 0; $i < count($categories); $i++){ ?>
		  <?php if($categories[$i]["sub_cat"] == -1){?>
		  	<li class="restaurant-menu__list-item">
					<a href="<?php echo $restaurant_name."/category_mobile/".$categories[$i]['cat']."/".$categories[$i]['sub_cat'] ?>" class="restaurant-menu__link parent" cat_id="<?php echo $categories[$i]['cat']; ?>" sub_cat_id="<?php echo $categories[$i]['sub_cat']; ?>">
						<span class="flag-orange" style="display: none;"><?php echo $categories[$i]['name']; ?></span>
						<?php echo $categories[$i]['name']; ?>
					</a>
				</li>
			<?php }else{ ?>
				<li class="restaurant-menu__list-item"> <!-- active -->
					<a href="" class="restaurant-menu__link parent" cat_id="<?php echo $categories[$i]['cat']; ?>" sub_cat_id="<?php echo $categories[$i]['sub_cat']; ?>"><?php echo $categories[$i]['name']; ?></a>
						<ul class="restaurant-menu__list">
			    	<?php if($categories[$i]["sub_cat"] == 0){ ?>
			    		<?php $i++; ?>
			    		<?php while(array_key_exists($i, $categories) && $categories[$i]["sub_cat"] > 0){ ?>
					      <li class="restaurant-menu__list-item parent">
									<a href="<?php echo $restaurant_name."/category_mobile/".$categories[$i]['cat']."/".$categories[$i]['sub_cat'] ?>" class="restaurant-menu__link" cat_id="<?php echo $categories[$i]['cat']; ?>" sub_cat_id="<?php echo $categories[$i]['sub_cat']; ?>"><?php echo $categories[$i]['name']; ?></a>
								</li>
			    			<?php $i++; ?>
			    		<?php } ?>
			    		<?php $i--; ?>
						<?php } ?>
			    </ul>
				</li>
			<?php } ?>
		<?php } ?>
	</ul>
</div>