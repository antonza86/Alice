<div class="modal modal--enter opened">
	<div class="modal-close"></div>
	<form method="post" class="enter-form" onsubmit="return userLogin();">
		<h2 class="enter-form__title"><?php echo $this->lang->line('btn_enter') ?></h2>
		<input type="email" name="email" placeholder="<?php echo $this->lang->line('placeholder_email') ?>">
		<input type="password" name="password" placeholder="<?php echo $this->lang->line('placeholder_password') ?>">
		<label for="phone" class="enter-form__label" style="display: none;">Или используя мобильный телефон:</label>
		<input type="tel" name="phone" class="hide" placeholder="Телефон">
		<div class="modal-error"></div>
		<button type="submit" class="btn btn--green"><?php echo $this->lang->line('btn_enter') ?></button>
	</form>
	<a href="#" onclick="return modal.load('forgot');" class="retreive-password"><?php echo $this->lang->line('btn_forget_password') ?></a>
	<div class="social-login">
		<div class="social-login__text"><?php echo $this->lang->line('autenticate_social') ?></div>
		<a href="/oauth/facebook" class="login-btn login-btn--fb">facebook</a>
		<div class="social-login__notice"><?php echo $this->lang->line('label_not_with_us') ?> <a href="#" onclick="return modal.load('registration');" class="social-login__register"><?php echo $this->lang->line('btn_registe_now') ?></a></div>
	</div>
</div>