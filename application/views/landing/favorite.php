<div class="tooltip">
	<a href="#" class="tooltip_title tooltip_title--star js-toggle-tooltip">Favoritos<span class="notice"><?php echo count($favorite); ?></span></a>
	<div class="tooltip_content tooltip_content--medium list">
		<div class="scroll">
			<?php foreach ($favorite as $key => $value){ ?>
				<?php if($key < 3){ ?>
					<div class="notice-item clearfix">
				<?php }else{ ?>
					<div class="notice-item clearfix" style="display: none;">
				<?php } ?>
					<div class="notice-item_image">
						<a href="<?php echo $value['url_name'] ?>"><img src="assets/images/restaurant/<?php echo $value['url_name'] ?>/<?php echo $value['logo'] ?>" height="43" width="43" alt="<?php echo $value['name'] ?>"></a>
					</div>
					<a href="<?php echo $value['url_name'] ?>" class="notice-item_title"><?php echo $value['name'] ?></a>
					<div class="notice-item_text"><?php echo $value['cuisine'] ?></div>
					<button class="notice-item_delete js-delete-notice" data-type="org" data-id="<?php echo $value['id'] ?>">Remover</button>
				</div>
			<?php } ?>
			<div class="notice-item--empty">Não tem favoritos</div>
			<a href="#" class="btn btn--notice" style="display: none;">mostrar mais</a>
		</div>
	</div>
</div>