<section class="section big-catalog">
	<h2 class="section__title"><?php echo $this->lang->line('choose_category'); ?></h2>
	<div class="container">
		<div class="js-tab-container">
			<div class="js-tabs">
				<div class="js-tab active" id="js-tab-1">
					<?php foreach ($menu_list as $key => $value){ ?>
						<article class="catalog">
							<div class="shadow"></div>
							<img src="<?php echo $value['img_link'] ?>" alt="<?php echo $value['name'] ?>">
							<a query_string="<?php echo $value['target'] ?>" class="target_url" href="">
								<h2 class="catalog__title"><?php echo $value['name'] ?></h2>
								<div class="<?php echo $value['icon'] ?>"></div>
							</a>
						</article>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</section>