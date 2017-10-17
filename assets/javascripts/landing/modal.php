<div class="modal-overlay"></div>

<!-- Modal Login -->
<div class="modal modal-login">
	<div class="modal_wrapper">
		<div class="modal_container modal_container--no-padding">
			<a href="#" class="modal_close js-close-modal">Fechar a janela</a>
			<form id="form_login" accept-charset="utf-8" onSubmit="return false;">
				<div class="row">
					<div class="col s-6 modal_column">
						<p class="modal-login_title">Entrar</p>
						<input type="text" class="custom-field" name="email" id="email" placeholder="Email...">
						<input type="password" class="custom-field" name="password" id="password" placeholder="Palavra-passe...">
						<p class="modal-login_text text-center hide login_error_message error_alert" style="color: red;">Email/password errados.</p>
						<p class="modal-login_text text-center hide need_confirm_message error_alert" style="color: darkorange;">Neccesita de confirmar no email a sua identificação.</p>
						<p class="modal-login_text text-center hide no_exists_message error_alert" style="color: darkorange;">Email indicado não existe no sistema, registe-se.</p>
						<fieldset class="row modal-login_fieldset">
							<div class="col s-6">
								<a href="#" data-modal="modal-recovery" class="modal-login_link js-get-modal">Esqueceu-se da password?</a>
							</div>
							<div class="col s-6 text-right">
								<button type="submit" id="login_user" class="btn btn--green">Entrar</button>
							</div>
						</fieldset>
						<p class="modal-login_text text-center">Ainda não esta connosco? <a href="#" data-modal="modal-registration" class="modal-login_link js-get-modal">Registe-se!</a></p>
					</div>
					<div class="col s-6 modal_column modal_column--grey">
						<div class="social-login">
							<p class="modal-login_text">Use a conta<br/> das redes sociais</p>
							<a href="fblogin?go_to=" class="btn btn--social btn--social-fb">Facebook</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<a href="#" data-modal="modal-login" class="js-get-modal"></a>
</div>

<!-- Modal Register -->
<div class="modal modal-registration">
	<div class="modal_wrapper">
		<div class="modal_container modal_container--no-padding">
			<a href="#" class="modal_close js-close-modal">Fechar a janela</a>
			<form id="form_new_account" onSubmit="return false;">
				<div class="row">
					<div class="col s-6 modal_column">
						<p class="modal-registration_title">Registar-se</p>
						<input name="name" type="text" class="custom-field" placeholder="Nome" required>
						<input name="email" type="email" class="custom-field" placeholder="Email" required>
						<input name="password" type="password" class="custom-field" placeholder="Palavra-passe" required>
						<input name="tel" type="tel" class="custom-field" placeholder="Telemovel">
						<input type="checkbox" checked id="condition">
						<p class="modal-login_text text-center hide error_message error_alert" style="color: darkorange;">Preencha todos os campos e tente de novo.</p>
						<p class="modal-login_text text-center hide exists_error_message error_alert" style="color: red;">Este email já existe no sistema.</p>
						<label for="condition" class="label--grey modal-registration_text">Aceito as condições</label>
						<a href="/agreement" target="_blank" class="modal-registration_link">Termo de condições do utilizador</a>
						<p class="modal-login_text text-center"></p>
						<div class="modal-registration_btn">
							<button type="submit" class="btn btn--green" id="new_account">Registar-se</button>
						</div>
					</div>
					<div class="col s-6 modal_column modal_column--grey">
						<div class="social-login">
							<p class="modal-registration_text">Utilizar uma conta<br/> das redes sociais</p>
							<a href="fblogin?go_to=" class="btn btn--social btn--social-fb">Facebook</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<a href="#" data-modal="modal-registration" class="js-get-modal"></a>
</div>

<!-- Pedido de uma nova password -->
<div class="modal modal-recovery">
	<div class="modal_wrapper">
		<div class="modal_container">
			<a href="#" class="modal_close js-close-modal">Fechar a janela</a>
			<form id="form_forgot" onSubmit="return false;">
				<p class="modal_title">Recuperar a palavra-passe</p>
				<input type="email" name="email" class="custom-field" placeholder="Email" required>
				<p class="info">Nos enviamos lhe um email com a descrição dos passos para a recuperação da password</p>
				<button type="submit" id="forgot_btn" class="btn btn--green custom-button">Enviar</button>
			</form>
		</div>
	</div>
	<a href="#" data-modal="modal-recovery" class="js-get-modal"></a>
</div>

<!-- Introdução de uma nova password -->
<div class="modal modal-forgot">
	<div class="modal_wrapper">
		<div class="modal_container">
			<a href="#" class="modal_close js-close-modal">Fechar a janela</a>
			<form id="form_reset_password" onSubmit="return false;">
				<p class="modal_title">Recuperar a palavra-passe</p>
				<input type="password" name="password" class="custom-field" placeholder="Nova palavra-passe" required>
				<input type="password" name="passconf" class="custom-field" placeholder="Repita a nova palavra-passe" required>
				<p class="modal-login_text text-center hide some_password_error_message error_alert" style="color: red;">As palavra-passe não são iguais.</p>
				<p class="info">Introduza nova palavra-passe</p>
				<button type="submit" id="reset_password" class="btn btn--green custom-button">Enviar</button>
			</form>
		</div>
	</div>
	<a href="#" data-modal="modal-forgot" class="js-get-modal"></a>
</div>

<!-- Mensagem enviada com sucesso -->
<div class="modal modal-confirm-email">
	<div class="modal_wrapper">
		<div class="modal_container">
			<a href="#" class="modal_close js-close-modal">Fechar a janela</a>
			<form id="sendFeedback" onSubmit="return false;">
				<p class="modal_title">Obrigado pelo registo.</p>
				<p class="info">Mensagem de confirmação enviada para o email!<br><br><br></p>
				<button type="submit" class="btn btn--green custom-button js-close-modal">Ok!</button>
			</form>
		</div>
	</div>
	<a href="#" data-modal="modal-confirm-email" class="js-get-modal"></a>
</div>

<!-- Mensagem de confirmação enviada com sucesso -->
<div class="modal modal-confirm">
	<div class="modal_wrapper">
		<div class="modal_container">
			<a href="#" class="modal_close js-close-modal">Fechar a janela</a>
			<form id="sendFeedback" onSubmit="return false;">
				<p class="modal_title">Obrigado</p>
				<p class="info">Mensagem enviada com sucesso!<br><br><br></p>
				<button type="submit" class="btn btn--green custom-button js-close-modal">Ok!</button>
			</form>
		</div>
	</div>
	<a href="#" data-modal="modal-confirm" class="js-get-modal"></a>
</div>

<!-- Mensagem de confirmação enviada com sucesso -->
<div class="modal modal-confirm-email-response">
	<div class="modal_wrapper">
		<div class="modal_container">
			<a href="#" class="modal_close js-close-modal">Fechar a janela</a>
			<form id="sendFeedback" onSubmit="return false;">
				<p class="modal_title">Obrigado</p>
				<p class="info">Email confirmado com sucesso!<br><br><br></p>
				<button type="submit" class="btn btn--green custom-button js-close-modal">Ok!</button>
			</form>
		</div>
	</div>
	<a href="#" data-modal="modal-confirm-email-response" class="js-get-modal"></a>
</div>

<!-- Mensagem de password recuperada com sucesso -->
<div class="modal modal-password-recuperada">
	<div class="modal_wrapper">
		<div class="modal_container">
			<a href="#" class="modal_close js-close-modal">Fechar a janela</a>
			<form id="sendFeedback" onSubmit="return false;">
				<p class="modal_title">Obrigado</p>
				<p class="info">Palavra passe alterada com sucesso!<br><br><br></p>
				<button type="submit" id="recuperada-success" class="btn btn--green custom-button js-close-modal">Ok!</button>
			</form>
		</div>
	</div>
	<a href="#" data-modal="modal-password-recuperada" class="js-get-modal"></a>
</div>

<!-- Escreva nos -->
<div class="modal modal-support">
	<div class="modal_wrapper">
		<div class="modal_container">
			<a href="#" class="modal_close js-close-modal">Fechar a janela</a>
			<form id="form_write_feedback" onSubmit="return false;">
				<p class="modal_title">Escrever para administração</p>
				<input type="email" name="email" class="custom-field" placeholder="Email" required>
				<input type="text" name="name" class="custom-field" placeholder="Nome" required>
				<textarea name="text" class="custom-field custom-field--textarea" placeholder="Mensagem" required></textarea>
				<button type="submit" class="btn btn--green custom-button">Enviar</button>
			</form>
		</div>
	</div>
</div>