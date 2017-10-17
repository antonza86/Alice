<div class="modal modal--enter opened">
	<div class="modal-close"></div>
	<form method="post" id="form_login" class="enter-form" onsubmit="return false;">
		<h2 class="enter-form__title"><?php echo $this->lang->line('btn_enter') ?></h2>
		<input type="email" name="email" placeholder="<?php echo $this->lang->line('placeholder_email') ?>">
		<input type="password" name="password" placeholder="<?php echo $this->lang->line('placeholder_password') ?>">
	
		<p class="modal-login_text text-center hide login_error_message error_alert" style="color: red;"><?php echo $this->lang->line('error_email_password') ?></p>
		<p class="modal-login_text text-center hide need_confirm_message error_alert" style="color: darkorange;"><?php echo $this->lang->line('error_need_confirm') ?></p>
		<p class="modal-login_text text-center hide no_exists_message error_alert" style="color: darkorange;"><?php echo $this->lang->line('error_email_dont_exist') ?></p>
		<button type="submit" id="login_user" class="btn btn--green"><?php echo $this->lang->line('btn_enter') ?></button>

	</form>
	<a href="#" onclick="return modal.load('forgot');" class="retreive-password"><?php echo $this->lang->line('btn_forget_password') ?></a>
	<div class="social-login">
		<div class="social-login__text"><?php echo $this->lang->line('autenticate_social') ?></div>
		<a href="fblogin?go_to=" class="login-btn login-btn--fb btn--social-fb">facebook</a>
		<div class="social-login__notice"><?php echo $this->lang->line('label_not_with_us') ?> <a href="#" onclick="return modal.load('registration');" class="social-login__register"><?php echo $this->lang->line('btn_registe_now') ?></a></div>
	</div>
</div>