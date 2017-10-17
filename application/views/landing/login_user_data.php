<div class="col s-8 text-right">
	<div class="main-header_user to-right">
		<div class="tooltip user-info">
			<a href="#" class="tooltip_title js-toggle-tooltip">
				<img src="<?php echo base_url(); ?>assets/images/avatar.png" class="user-info_image" alt="Avatar">
				<p class="user-info_name"><?php print_r($this->session->userdata('logged_in')['name']); ?></p>
				<p class="user-info_ball hide" data-score="1400">1400 баллов</p>
			</a>
			<div class="tooltip_content tooltip_content--small user-nav text-left">
				<a href="profile">Perfil</a>
				<a href="profile?target=history">Historico de pedidos</a>
				<a href="<?php echo base_url(); ?>usercontroller/logout" class="logout_user">Sair</a>
			</div>
		</div>

		<?php $this->load->view('landing/favorite'); ?>

		<div class="tooltip" style="display: none;">
			<a href="#" class="tooltip_title tooltip_title--message js-toggle-tooltip">Mensagens<span class="notice">3</span></a>
			<div class="tooltip_content tooltip_content--medium list">
				<div class="scroll">
					<div class="notice-item notice-item--gift clearfix">
						<div class="notice-item_image"></div>
						<a href="#" class="notice-item_title">200 баллов</a>
						<div class="notice-item_text">Вы получили 200 баллов за подтверждение e-mail, удачных заказов!</div>
						<button class="notice-item_delete js-delete-notice" data-type="msg" data-id="23524741">удалить</button>
					</div>
					<div class="notice-item notice-item--gift clearfix">
						<div class="notice-item_image"></div>
						<a href="#" class="notice-item_title">100 баллов</a>
						<div class="notice-item_text">Вы получили 100 баллов на ваш счет, удачных заказов!</div>
						<button class="notice-item_delete js-delete-notice" data-type="msg" data-id="20175437">удалить</button>
					</div>
					<div class="notice-item notice-item--message clearfix">
						<div class="notice-item_image"></div>
						<a href="#" class="notice-item_title">Новый бейдж</a>
						<div class="notice-item_text"><a href="/user/profile">Вы получили бейдж "Друг Заки", удачных заказов!</a></div>
						<button class="notice-item_delete js-delete-notice" data-type="msg" data-id="20175436">удалить</button>
					</div>
					<div class="notice-item--empty">У вас нет ни одного уведомления</div>
					<a href="#" class="btn btn--notice">показать больше уведомлений</a>
				</div>
			</div>
		</div>
	</div>
</div>