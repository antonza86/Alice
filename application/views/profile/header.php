<div class="restoran-item restoran-item--user row">
	<div class="col s-3">
		<figure class="restoran-item_image">
			<img src="<?php echo base_url(); ?>assets/images/no-image.png" height="200" width="200" alt="Anton Zverev">
		</figure>
	</div>
	<div class="col s-9">
		<div class="restoran-item_top row">
			<div class="col s-9">
				<h3 class="restoran-item_title"><?php echo $user_info['name'] ?></h3>
			</div>
		</div>
		<div class="restoran-item_bottom row">
			<div class="col s-3">
				<p class="restoran-item_sub-titile">Data de registo</p>
				<p class="restoran-item_big"><?php echo $user_info['creation_date'] ?></p>
			</div>
			<div class="col s-3">
				<p class="restoran-item_sub-titile">Última visita</p>
				<p class="restoran-item_big"><?php echo $user_info['last_login'] ?></p>
			</div>
			<div class="col s-3 hide">
				<p class="restoran-item_sub-titile">Feedback</p>
				<p class="restoran-item_big">0</p>
			</div>
			<div class="col s-3 hide">
				<p class="restoran-item_sub-titile">Pontos</p>
				<p class="restoran-item_big"><?php echo $user_info['points'] ?></p>
			</div>
		</div>
	</div>
</div>
