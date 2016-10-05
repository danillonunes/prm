<?php defined('ABSPATH') or exit; ?>
<div class="wrap">
<h2><?php _e('PRM: The Patrão Relationship Management!', 'prm'); ?></h2>

<form method="post" action="options.php">
	<?php settings_fields('prm'); ?>
	<?php do_settings_sections('prm'); ?>
<table class="form-table">

<tr>
<th scope="row" colspan="2">
	<h3><?php _e('Configurações de inscrição', 'prm'); ?></h3>
</th>
</tr>

<tr>
<th scope="row"><label for="prm-email"><?php _e('Email administrativo', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text" name="prm_email" id="prm-email" value="<?php echo get_option('prm_email'); ?>" placeholder="<?php echo bloginfo('admin_email'); ?>" />
	<p class="description">
		<?php _e('Endereço de email para onde as inscrições serão enviadas. Múltiplos emails podem ser separados por vírgula.', 'prm'); ?>
		<br>
		<?php _e('Deixe em branco para usar o email administrativo padrão do WordPress.', 'prm'); ?>
	</p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-amount"><?php _e('Valor', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text prm-amount" name="prm_subscription_amount" id="prm-subscription-amount" value="<?php echo get_option('prm_subscription_amount'); ?>" />
  <p class="description"><?php _e('O valor mensal da inscrição, em reais.', 'prm'); ?></p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-item-name"><?php _e('Nome do item de assinatura', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text" name="prm_subscription_item_name" id="prm-subscription-item-name" value="<?php echo get_option('prm_subscription_item_name'); ?>" placeholder="<?php echo bloginfo('name'); ?>" />
	<p class="description">
		<?php _e('Nome que será exibido na página de checkout da assinatura.', 'prm'); ?>
		<br>
		<?php _e('Deixe em branco para usar o nome do site.', 'prm'); ?>
	</p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-address-description"><?php _e('Descrição do endereço', 'prm'); ?></label></th>
<td>
	<textarea class="large-text code" rows="5" cols="50" name="prm_subscription_address_description" id="prm-subscription-address-description"><?php echo get_option('prm_subscription_address_description'); ?></textarea>
	<p class="description">
		<?php _e('Mensagem de ajuda que será exibida na seção <b>endereço</b> na página de inscrição.', 'prm'); ?>
		<br>
		<?php _e('Você pode usar código HTML.', 'prm'); ?>
	</p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-payment-amount-description"><?php _e('Descrição do valor de pagamento', 'prm'); ?></label></th>
<td>
	<textarea class="large-text code" rows="5" cols="50" name="prm_subscription_payment_amount_description" id="prm-subscription-payment-amount-description"><?php echo get_option('prm_subscription_payment_amount_description'); ?></textarea>
	<p class="description">
		<?php _e('Mensagem de ajuda que será exibida no campo <b>valor</b> na página de inscrição.', 'prm'); ?>
		<br>
		<?php _e('Você pode usar código HTML.', 'prm'); ?>
	</p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-sandbox-mode"><?php _e('Modo de teste', 'prm'); ?></label></th>
<td>
	<label>
		<input type="checkbox"  name="prm_sandbox_mode" id="prm-sandbox-mode" value="1" <?php if (get_option('prm_sandbox_mode')) { echo 'checked="checked"'; } ?> />
		<?php _e('Ativar o modo de teste', 'prm'); ?>
	</label>
	<p class="description">
		<?php _e('Ative para usar os sistemas de teste para os meios de pagamento suportados.', 'prm'); ?>
	</p>
</td>
</tr>

<tr>
<th scope="row" colspan="2">
	<h3><?php _e('Configurações do PayPal', 'prm'); ?></h3>
</th>
</tr>

<tr>
<th scope="row"><label for="prm-paypal-email"><?php _e('Email do PayPal', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text" name="prm_paypal_email" id="prm-paypal-email" value="<?php echo get_option('prm_paypal_email'); ?>" />
	<p class="description">
		<?php _e('Endereço de email da sua conta PayPal.', 'prm'); ?>
	</p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-paypal-sandbox-email"><?php _e('Email do PayPal Sandbox', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text" name="prm_paypal_sandbox_email" id="prm-paypal-sandbox-email" value="<?php echo get_option('prm_paypal_sandbox_email'); ?>" />
	<p class="description">
		<?php _e('Endereço de email da sua conta Sandbox do PayPal.', 'prm'); ?>
	</p>
</td>
</tr>

<tr>
<th scope="row" colspan="2">
	<h3><?php _e('Configurações do PagSeguro', 'prm'); ?></h3>
</th>
</tr>

<tr>
<th scope="row"><label for="prm-pagseguro-email"><?php _e('Email do PagSeguro', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text" name="prm_pagseguro_email" id="prm-pagseguro-email" value="<?php echo get_option('prm_pagseguro_email'); ?>" />
  <p class="description"><?php _e('Endereço de email da sua conta PagSeguro.', 'prm'); ?></p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-pagseguro-token"><?php _e('Token do PagSeguro', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text" name="prm_pagseguro_token" id="prm-pagseguro-token" value="<?php echo get_option('prm_pagseguro_token'); ?>" />
  <p class="description">
		<?php _e('Token da sua conta PagSeguro.', 'prm'); ?>
		<br>
		<?php echo sprintf(__('<a href="%s" target="_blank">Acesse essa página para obter o token</a>.', 'prm'), 'https://pagseguro.uol.com.br/integracao/token-de-seguranca.jhtml'); ?>
	</p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-pagseguro-sandbox-email"><?php _e('Email do PagSeguro Sandbox', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text" name="prm_pagseguro_sandbox_email" id="prm-pagseguro-sandbox-email" value="<?php echo get_option('prm_pagseguro_sandbox_email'); ?>" />
  <p class="description"><?php _e('Endereço de email da sua conta Sandbox do PagSeguro.', 'prm'); ?></p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-pagseguro-sandbox-token"><?php _e('Token do PagSeguro Sandbox', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text" name="prm_pagseguro_sandbox_token" id="prm-pagseguro-sandbox-token" value="<?php echo get_option('prm_pagseguro_sandbox_token'); ?>" />
  <p class="description">
		<?php _e('Token da sua conta Sandbox do PagSeguro.', 'prm'); ?>
		<br>
		<?php echo sprintf(__('<a href="%s" target="_blank">Acesse essa página para obter o token de teste</a>.', 'prm'), 'https://sandbox.pagseguro.uol.com.br/vendedor/configuracoes.html'); ?>
	</p>
</td>
</tr>

<tr>
<th scope="row" colspan="2">
	<h3><?php _e('Configurações do Boleto', 'prm'); ?></h3>
</th>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-boleto-month-3-amount"><?php _e('Valor trimestral', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text prm-amount" name="prm_subscription_boleto_month_3_amount" id="prm-subscription-boleto-month-3-amount" value="<?php echo get_option('prm_subscription_boleto_month_3_amount'); ?>" />
  <p class="description"><?php _e('O valor da inscrição via boleto trimestral, em reais.', 'prm'); ?></p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-boleto-month-6-amount"><?php _e('Valor semestral', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text prm-amount" name="prm_subscription_boleto_month_6_amount" id="prm-subscription-boleto-month-6-amount" value="<?php echo get_option('prm_subscription_boleto_month_6_amount'); ?>" />
  <p class="description"><?php _e('O valor da inscrição via boleto semestral, em reais.', 'prm'); ?></p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-boleto-month-12-amount"><?php _e('Valor anual', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text prm-amount" name="prm_subscription_boleto_month_12_amount" id="prm-subscription-boleto-month-12-amount" value="<?php echo get_option('prm_subscription_boleto_month_12_amount'); ?>" />
  <p class="description"><?php _e('O valor da inscrição via boleto anual, em reais.', 'prm'); ?></p>
</td>
</tr>

<tr>
<th scope="row" colspan="2">
	<h3><?php _e('Configurações do Depósito', 'prm'); ?></h3>
</th>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-deposito-month-3-amount"><?php _e('Valor trimestral', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text prm-amount" name="prm_subscription_deposito_month_3_amount" id="prm-subscription-deposito-month-3-amount" value="<?php echo get_option('prm_subscription_deposito_month_3_amount'); ?>" />
  <p class="description"><?php _e('O valor da inscrição via depósito trimestral, em reais.', 'prm'); ?></p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-deposito-month-6-amount"><?php _e('Valor semestral', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text prm-amount" name="prm_subscription_deposito_month_6_amount" id="prm-subscription-deposito-month-6-amount" value="<?php echo get_option('prm_subscription_deposito_month_6_amount'); ?>" />
  <p class="description"><?php _e('O valor da inscrição via depósito semestral, em reais.', 'prm'); ?></p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-deposito-month-12-amount"><?php _e('Valor anual', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text prm-amount" name="prm_subscription_deposito_month_12_amount" id="prm-subscription-deposito-month-12-amount" value="<?php echo get_option('prm_subscription_deposito_month_12_amount'); ?>" />
  <p class="description"><?php _e('O valor da inscrição via depósito anual, em reais.', 'prm'); ?></p>
</td>
</tr>

<tr>
<th scope="row" colspan="2">
	<h3><?php _e('Configurações da página de resposta', 'prm'); ?></h3>
</th>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-return-url"><?php _e('Página de sucesso', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text" name="prm_subscription_return_url" id="prm-subscription-return-url" value="<?php echo get_option('prm_subscription_return_url'); ?>" />
	<p class="description">
		<?php _e('URL da página para onde o usuário será redirecionado após efetuar a inscrição.', 'prm'); ?>
	</p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-paypal-message"><?php _e('Mensagem de inscrição via PayPal', 'prm'); ?></label></th>
<td>
	<textarea class="large-text code" rows="5" cols="50" name="prm_subscription_paypal_message" id="prm-subscription-paypal-message"><?php echo get_option('prm_subscription_paypal_message'); ?></textarea>
	<p class="description">
		<?php _e('Mensagem que será exibida ao usuário após inscrever-se usando <b>PayPal</b> como forma de pagamento.', 'prm'); ?>
		<br>
		<?php _e('Você pode usar código HTML.', 'prm'); ?>
	</p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-pagseguro-message"><?php _e('Mensagem de inscrição via PagSeguro', 'prm'); ?></label></th>
<td>
	<textarea class="large-text code" rows="5" cols="50" name="prm_subscription_pagseguro_message" id="prm-subscription-pagseguro-message"><?php echo get_option('prm_subscription_pagseguro_message'); ?></textarea>
	<p class="description">
		<?php _e('Mensagem que será exibida ao usuário após inscrever-se usando <b>PagSeguro</b> como forma de pagamento.', 'prm'); ?>
		<br>
		<?php _e('Você pode usar código HTML.', 'prm'); ?>
	</p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-boleto-message"><?php _e('Mensagem de inscrição via boleto', 'prm'); ?></label></th>
<td>
	<textarea class="large-text code" rows="5" cols="50" name="prm_subscription_boleto_message" id="prm-subscription-boleto-message"><?php echo get_option('prm_subscription_boleto_message'); ?></textarea>
	<p class="description">
		<?php _e('Mensagem que será exibida ao usuário após inscrever-se usando <b>boleto</b> como forma de pagamento.', 'prm'); ?>
		<br>
		<?php _e('Você pode usar código HTML.', 'prm'); ?>
	</p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-deposito-message"><?php _e('Mensagem de inscrição via depósito', 'prm'); ?></label></th>
<td>
	<textarea class="large-text code" rows="5" cols="50" name="prm_subscription_deposito_message" id="prm-subscription-deposito-message"><?php echo get_option('prm_subscription_deposito_message'); ?></textarea>
	<p class="description">
		<?php _e('Mensagem que será exibida ao usuário após inscrever-se usando <b>depósito</b> como forma de pagamento.', 'prm'); ?>
		<br>
		<?php _e('Você pode usar código HTML.', 'prm'); ?>
	</p>
</td>
</tr>

</table>
<?php submit_button(); ?>
</form>
</div>