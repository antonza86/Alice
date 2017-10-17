<div class="modal modal--enter modal--forgot opened">
	<div class="modal-close"></div>
	<form method="post" id="form_forgot" class="enter-form" onsubmit="return false;">
		<h2 class="enter-form__title"><?php echo $this->lang->line('forgot_password') ?></h2>
		<br>
		<input type="text" name="email" placeholder="E-mail">
		<label class="enter-form__label"><?php echo $this->lang->line('forgot_password_description') ?></label>
		<br>
		<div class="modal-error"></div>
		<button type="submit" id="forgot_btn" class="btn btn--green"><?php echo $this->lang->line('send') ?></button>
	</form>
</div>