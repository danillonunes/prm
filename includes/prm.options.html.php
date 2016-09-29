<?php defined( 'ABSPATH' ) or die( 'No direct access allowed.' ); ?>
<div class="wrap">
<h2><?php _e( 'PRM: The Patrão Relationship Management!', 'prm' ); ?></h2>

<form method="post" action="options.php">
	<?php settings_fields('prm'); ?>
	<?php do_settings_sections('prm'); ?>
<table class="form-table">

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
<th scope="row"><label for="prm-paypal-email"><?php _e('Email do PayPal', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text" name="prm_paypal_email" id="prm-paypal-email" value="<?php echo get_option('prm_paypal_email'); ?>" />
	<p class="description">
		<?php _e('Endereço de email da sua conta PayPal.', 'prm'); ?>
	</p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-paypal-item-name"><?php _e('Descrição do item do PayPal', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text" name="prm_subscription_paypal_item_name" id="prm-subscription-paypal-item-name" value="<?php echo get_option('prm_subscription_paypal_item_name'); ?>" />
	<p class="description">
		<?php _e('Descrição do item do PayPal. Será exibida na página de checkout.', 'prm'); ?>
	</p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-paypal-item-number"><?php _e('ID de inscrição do PayPal', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text" name="prm_subscription_paypal_item_number" id="prm-subscription-paypal-item-number" value="<?php echo get_option('prm_subscription_paypal_item_number'); ?>" />
	<p class="description">
		<?php _e('Apenas para uso interno. Você pode utilizar este campo para identificar as inscrições feitas pelo site.', 'prm'); ?>
	</p>
</td>
</tr>

<tr>
<th scope="row"><label for="prm-subscription-paypal-amount"><?php _e('Valor', 'prm'); ?></label></th>
<td>
	<input type="text" class="regular-text" name="prm_subscription_paypal_amount" id="prm-subscription-paypal-amount" value="<?php echo get_option('prm_subscription_paypal_amount'); ?>" />
  <?php $prm_subscription_paypal_currency = get_option('prm_subscription_paypal_currency'); ?>
  <select id="prm-subscription-paypal-currency" name="prm_subscription_paypal_currency">
    <option value="USD" <?php if ('USD' == $prm_subscription_paypal_currency) { echo 'selected="selected"'; } ?>><?php _e('USD', 'mmdimo'); ?></option>
    <option value="BRL" <?php if ('BRL' == $prm_subscription_paypal_currency) { echo 'selected="selected"'; } ?>><?php _e('BRL', 'mmdimo'); ?></option>
  </select>
  <p class="description"><?php _e('O valor da inscrição.', 'prm'); ?></p>
</td>
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
		<?php _e('Mensagem que será exibida ao usuário após inscrever-se usando <strong>PayPal</strong> como forma de pagamento.', 'prm'); ?>
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
		<?php _e('Mensagem que será exibida ao usuário após inscrever-se usando <strong>PagSeguro</strong> como forma de pagamento.', 'prm'); ?>
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
		<?php _e('Mensagem que será exibida ao usuário após inscrever-se usando <strong>boleto</strong> como forma de pagamento.', 'prm'); ?>
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
		<?php _e('Mensagem que será exibida ao usuário após inscrever-se usando <strong>depósito</strong> como forma de pagamento.', 'prm'); ?>
		<br>
		<?php _e('Você pode usar código HTML.', 'prm'); ?>
	</p>
</td>
</tr>

</table>
<?php submit_button(); ?>
</form>
</div>