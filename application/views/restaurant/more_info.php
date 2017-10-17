<?php $holiday = explode(",",$restaurant_info['holiday']) ?>
<div class="col s-9 hide" id="more_info_box">
	<div id="org-info">
		<section class="cafe-item_item cafe-item_form">
			<h2 class="page-title"><?php echo $restaurant_info['title']; ?></h2>
			<div class="notification notification--blue notification--about">
				<div class="row">
					<div class="col s-4 tooltip">
						<a href="#" class="js-toggle-tooltip">
							<i class="sprite sprite-ico-timer--blue"></i>
							<p class="small-title">Horario de atendimento</p>
							<?php if(in_array(date("N"), $holiday)){ ?>
								<p class="big-time">Hoje fechado</p>
							<?php }else{ ?>
								<p class="big-time">Hoje <?php echo $restaurant_info['schedule']; ?></p>
							<?php } ?>
						</a>
						<div class="tooltip_content">
							<?php $week = ["ext", "2ª", "3ª", "4ª", "5ª", "6ª", "Sab", "Dom"] ?>
							<?php for($i = 1; $i < 8; $i ++){ ?>
								<?php if(in_array($i, $holiday)){ ?>
									<?php echo $week[$i]; ?>: <span>Feriado</span> <br>		
								<?php }else{ ?>
									<?php echo $week[$i]; ?>: <span><?php echo $restaurant_info['schedule']; ?></span> <br>		
								<?php } ?>
							<?php } ?>
						</div>
					</div>
					<div class="col s-8 text-right">
						<a class="btn btn--orange see_menu_box">Voltar ao menu</a>
					</div>
				</div>
			</div>
		</section>
		<article class="org-description">
			<p>Description</p>
		</article>
		<section class="cafe-item_item cafe-item_form">
			<h3 class="page-title"><?php echo $restaurant_info['name']; ?> no mapa</h3>
			<label class="hide" id="map_location"><?php echo $restaurant_info['gps']; ?></label>
			<div class="cafe-item_map" id="map"></div>
		</section>
		<section class="cafe-item_item cafe-item_form hide">
			<h3 class="page-title">Gostaram do <?php echo $restaurant_info['name']; ?>? Então recomenda aos amigos</h3>
			<div class="cafe-item_share hide">
				<div class="yashare-auto-init" data-yashareType="link" data-yashareQuickServices="yaru,vkontakte,facebook,twitter,odnoklassniki,moimir,gplus" data-yashareTheme="counter"></div>
			</div>
		</section>
	</div>
</div>