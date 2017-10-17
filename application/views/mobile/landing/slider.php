<section class="banner" xmlns="http://www.w3.org/1999/html">
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php foreach ($slider as $value){ ?>
				<div class="swiper-slide mobile_slide">
					<h1 class="page-title title"><?php echo $this->lang->line('slider_title') ?></h1>
					<div class="note"><?php echo $this->lang->line('slider_description') ?></div>
					<img src="<?php echo $value['img_link'] ?>" alt="<?php echo $this->lang->line('slogan_v2') ?>">
				</div>
      <?php } ?>
		</div>
		<div class="swiper-pagination"></div>
	</div>
	<div class="mobile_sliders">
		<div class="mobile_rest">
			<a href="" class="btn btn--round target_url" query_string=""><?php echo $this->lang->line('all_restaurants') ?></a>
		</div>
		<div class="mobile_buttons">
			<a rel="nofollow" href="https://app.appsflyer.com/id824133875?pid=index_applink&c=mob_bann" target="_blank">
				<img src="<?php echo base_url(); ?>assets/images/btn-ios-small.png" alt="Загрузить в AppStore">
			</a>
			<a rel="nofollow" href="https://app.appsflyer.com/ru.handh.android.zakazaka?pid=index_applink&c=mob_bann" target="_blank">
				<img src="<?php echo base_url(); ?>assets/images/btn-android-small.png" alt="Загрузить в Google Play">
			</a>
		</div>
	</div>
</section>