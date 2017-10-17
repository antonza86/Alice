<?php 
	$checkbox_filter_list = array(
			array(
				"name" => "Entrega gratuita",
				"value" => "delivery"
			),array(
				"name" => "Pagamento online",
				"value" => "online"
			),array(
				"name" => "Pagamento multibanco",
				"value" => "card"
			),array(
				"name" => "Aberto agora",
				"value" => "work"
			)
		);

	$cuisine_list = array(
			1 => array(
				"name" => "Sushi",
				"value" => "sushi"
			),
			2 => array(
				"name" => "Pizza",
				"value" => "pizza"
			),
			3 => array(
				"name" => "Espetadas",
				"value" => "shashlik"
			),
			4 => array(
				"name" => "Bolos",
				"value" => "desert"
			),
			5 => array(
				"name" => "Hamburgeres",
				"value" => "burger"
			)
		);

	$cuisine_alt_list = array(
			6 => array(
				"name" => "Americana",
				"value" => "usa"
			),
			7 => array(
				"name" => "Europea",
				"value" => "cuisine-europe"
			),
			8 => array(
				"name" => "Italiana",
				"value" => "italy"
			),
			9 => array(
				"name" => "Chinesa",
				"value" => "cuisine-chinese"
			),
			10 => array(
				"name" => "Mexicana",
				"value" => "mexico"
			),
			11 => array(
				"name" => "Exotica",
				"value" => "ecsotic"
			),
			12 => array(
				"name" => "Japonesa",
				"value" => "cuisine-japan"
			)
		);
?>
<div class="col s-3 left_side_product hide">
	<aside class="list-page_sidebar">
		<div class="sort-block">
			<div class="sort-block_header">Mostrar apenas Prod</div>
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
				<input type="checkbox" class="cuisines" value="all" id="0" checked>
				<label for="0">Todos os restaurantes</label>
				<?php foreach ($cuisine_list as $key => $value){ ?>
					<input type="checkbox" class="cuisine" value="<?php echo $value['value']; ?>" id="<?php echo $key; ?>">
					<label for="<?php echo $key; ?>"><?php echo $value['name']; ?></label>
				<?php } ?> 
			</div>
		</div>
		<div class="sort-block sort-block--interactive">
			<div class="sort-block_header">Outras categorias</div>
			<div class="sort-block_content">
				<?php foreach ($cuisine_alt_list as $key => $value){ ?>
					<input type="checkbox" class="cuisine_alt" value="<?php echo $value['value']; ?>" id="<?php echo $key; ?>">
					<label for="<?php echo $key; ?>"><?php echo $value['name']; ?></label>
				<?php } ?> 
			</div>
		</div>
	</aside>
</div>