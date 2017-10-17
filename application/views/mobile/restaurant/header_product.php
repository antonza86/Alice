<div class="hide restoran-item_title" url_name="<?php echo $restaurant_info['url_name'] ?>" rest_id="<?php echo $restaurant_info['id'] ?>"></div>
<div class="category-title container">
	<a href="<?php echo base_url().$restaurant_name."/category_mobile/".$prev['cat']."/".$prev['sub_cat']; ?>" class="category-title__prev"></a>
	<a href="<?php echo base_url().$restaurant_name."/category_mobile/".$next['cat']."/".$next['sub_cat']; ?>" class="category-title__next"></a>
	<?php if(count($category) != 1){ ?>
		<h2 class="category-title__title"><?php echo $category[1]['name']; ?></h2>
		<div class="category-title__description"><?php echo $category[0]['name']; ?></div>
	<?php }else{ ?>
		<h2 class="category-title__title"><?php echo $category[0]['name']; ?></h2>
	<?php } ?>
</div>