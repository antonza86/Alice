<?php 
	$checkbox_filter_list = get_checkbox_filter_list();
	$cuisine_list = get_cuisine_list();
	$cuisine_alt_list = get_cuisine_alt_list();
?>
<div class="col s-3 left_side_restaurant">
	<aside class="list-page_sidebar">
		<div class="sort-block">
			<div class="sort-block_header">Mostrar apenas Rest</div>
			<div class="sort-block_content">
				<?php foreach ($checkbox_filter_list as $key => $value){ ?>
					<input type="checkbox" class="checkbox_filter" name="<?php echo $value['value']; ?>" value="free" id="ch<?php echo $key; ?>">
					<label for="ch<?php echo $key; ?>"><?php echo $value['name']; ?></label>
				<?php } ?>
			</div>
		</div>
		<div class="sort-block">
			<div class="sort-block_header">Categorias</div>
			<div class="sort-block_content">
				<input type="checkbox" class="cuisines" value="all" id="standard_cat_0" checked>
				<label for="standard_cat_0">Todos os restaurantes</label>
				<?php foreach ($cuisine_list as $key => $value){ ?>
					<input type="checkbox" class="cuisine" value="<?php echo $value['value']; ?>" cuisine="<?php echo $key; ?>" id="standard_cat_<?php echo $key; ?>">
					<label for="standard_cat_<?php echo $key; ?>"><?php echo $value['name']; ?></label>
				<?php } ?> 
			</div>
		</div>
		<div class="sort-block sort-block--interactive">
			<div class="sort-block_header">Outras categorias</div>
			<div class="sort-block_content">
				<?php foreach ($cuisine_alt_list as $key => $value){ ?>
					<input type="checkbox" class="cuisine_alt" value="<?php echo $value['value']; ?>" cuisine="<?php echo $key; ?>" id="other_cat_<?php echo $key; ?>">
					<label for="other_cat_<?php echo $key; ?>"><?php echo $value['name']; ?></label>
				<?php } ?> 
			</div>
		</div>
	</aside>
</div>