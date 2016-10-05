<?php defined( 'ABSPATH' ) or die( 'No direct access allowed.' ); ?>
<div class="prm-donation-form">
	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="prm-donation-form">

		<?php if ($prm_donation_form_error = prm_donation_form_error()): ?>
			<div class="prm-donation-form-error"><?php _e('Verifique os valores preenchidos e tente novamente.', 'prm'); ?></div>
		<?php endif; ?>

		<div class="prm-donation-form-section prm-donation-form-personal">
			<h4><?php _e('Dados pessoais', 'prm'); ?></h4>
			<div class="prm-donation-form-element prm-donation-form-name">
				<label for="prm-donation-form-name"><?php _e('Nome', 'prm'); ?> <span class="required" title="<?php _e('Obrigatório', 'prm'); ?>">*</span></label>
				<input type="text" name="prm-donation-form-name" id="prm-donation-form-name" value="<?php echo $_POST['prm-donation-form-name']; ?>" required="required">
			</div>

			<div class="prm-donation-form-element prm-donation-form-email">
				<label for="prm-donation-form-email"><?php _e('Email', 'prm'); ?> <span class="required" title="<?php _e('Obrigatório', 'prm'); ?>">*</span></label>
				<input type="email" name="prm-donation-form-email" id="prm-donation-form-email" value="<?php echo $_POST['prm-donation-form-email']; ?>" required="required">
			</div>

			<div class="prm-donation-form-element prm-donation-form-phone">
				<label for="prm-donation-form-phone"><?php _e('Telefone', 'prm'); ?></label>
				<input type="text" name="prm-donation-form-phone" id="prm-donation-form-phone" value="<?php echo $_POST['prm-donation-form-phone']; ?>">
			</div>
		</div>

		<div class="prm-donation-form-section prm-donation-form-address">
			<h4><?php _e('Endereço', 'prm'); ?></h4>
			<?php if ($address_description = prm_get_option('prm_subscription_address_description')): ?>
				<div class="description"><?php echo $address_description; ?></div>
			<?php endif; ?>
			<div class="prm-donation-form-element prm-donation-form-address-postal-code">
				<label for="prm-donation-form-address-postal-code">
					<?php _e('CEP', 'prm'); ?>
				</label>
				<input type="text" name="prm-donation-form-address-postal-code" id="prm-donation-form-address-postal-code" value="<?php echo $_POST['prm-donation-form-address-postal-code']; ?>">
			</div>

			<div class="prm-donation-form-element prm-donation-form-address-thoroughfare">
				<label>
					<?php _e('Logradouro', 'prm'); ?>
					<input type="text" name="prm-donation-form-address-thoroughfare" id="prm-donation-form-address-thoroughfare" value="<?php echo $_POST['prm-donation-form-address-thoroughfare']; ?>">
				</label>
			</div>

			<div class="prm-donation-form-element prm-donation-form-address-premise">
				<label>
					<?php _e('Número', 'prm'); ?>
					<input type="text" name="prm-donation-form-address-premise" id="prm-donation-form-address-premise" value="<?php echo $_POST['prm-donation-form-address-premise']; ?>">
				</label>
			</div>

			<div class="prm-donation-form-element prm-donation-form-address-sub-premise">
				<label>
					<?php _e('Complemento', 'prm'); ?>
					<input type="text" name="prm-donation-form-address-sub-premise" id="prm-donation-form-address-sub-premise" value="<?php echo $_POST['prm-donation-form-address-sub-premise']; ?>">
				</label>
			</div>

			<div class="prm-donation-form-element prm-donation-form-address-dependent-locality">
				<label>
					<?php _e('Bairro', 'prm'); ?>
					<input type="text" name="prm-donation-form-address-dependent-locality" id="prm-donation-form-address-dependent-locality" value="<?php echo $_POST['prm-donation-form-address-dependent-locality']; ?>">
				</label>
			</div>

			<div class="prm-donation-form-element prm-donation-form-address-locality">
				<label>
					<?php _e('Cidade', 'prm'); ?>
					<input type="text" name="prm-donation-form-address-locality" id="prm-donation-form-address-locality" value="<?php echo $_POST['prm-donation-form-address-locality']; ?>">
				</label>
			</div>

			<div class="prm-donation-form-element prm-donation-form-address-administrative-area">
				<label>
					<?php _e('Estado', 'prm'); ?>
					<select name="prm-donation-form-address-administrative-area" id="prm-donation-form-address-administrative-area">
						<option value=""><?php _e('--', 'prm'); ?></option>
						<option value="AC" <?php if ('AC' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Acre', 'prm'); ?></option>
						<option value="AL" <?php if ('AL' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Alagoas', 'prm'); ?></option>
						<option value="AP" <?php if ('AP' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Amapá', 'prm'); ?></option>
						<option value="AM" <?php if ('AM' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Amazonas', 'prm'); ?></option>
						<option value="BA" <?php if ('BA' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Bahia', 'prm'); ?></option>
						<option value="CE" <?php if ('CE' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Ceará', 'prm'); ?></option>
						<option value="DF" <?php if ('DF' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Distrito Federal', 'prm'); ?></option>
						<option value="ES" <?php if ('ES' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Espírito Santo', 'prm'); ?></option>
						<option value="GO" <?php if ('GO' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Goiás', 'prm'); ?></option>
						<option value="MA" <?php if ('MA' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Maranhão', 'prm'); ?></option>
						<option value="MT" <?php if ('MT' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Mato Grosso', 'prm'); ?></option>
						<option value="MS" <?php if ('MS' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Mato Grosso do Sul', 'prm'); ?></option>
						<option value="MG" <?php if ('MG' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Minas Gerais', 'prm'); ?></option>
						<option value="PA" <?php if ('PA' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Pará', 'prm'); ?></option>
						<option value="PB" <?php if ('PB' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Paraíba', 'prm'); ?></option>
						<option value="PR" <?php if ('PR' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Paraná', 'prm'); ?></option>
						<option value="PE" <?php if ('PE' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Pernambuco', 'prm'); ?></option>
						<option value="PI" <?php if ('PI' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Piauí', 'prm'); ?></option>
						<option value="RJ" <?php if ('RJ' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Rio de Janeiro', 'prm'); ?></option>
						<option value="RN" <?php if ('RN' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Rio Grande do Norte', 'prm'); ?></option>
						<option value="RS" <?php if ('RS' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Rio Grande do Sul', 'prm'); ?></option>
						<option value="RO" <?php if ('RO' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Rondônia', 'prm'); ?></option>
						<option value="RR" <?php if ('RR' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Roraima', 'prm'); ?></option>
						<option value="SC" <?php if ('SC' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Santa Catarina', 'prm'); ?></option>
						<option value="SP" <?php if ('SP' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('São Paulo', 'prm'); ?></option>
						<option value="SE" <?php if ('SE' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Sergipe', 'prm'); ?></option>
						<option value="TO" <?php if ('TO' == $_POST['prm-donation-form-address-administrative-area']) { echo 'selected="selected"'; } ?>><?php _e('Tocantins', 'prm'); ?></option>
					</select>
				</label>
			</div>
		</div>

		<div class="prm-donation-form-section prm-donation-form-payment">
			<h4><?php _e('Pagamento', 'prm'); ?></h4>
			<?php if ($payment_description = prm_get_option('prm_subscription_payment_description')): ?>
				<div class="description"><?php echo $payment_description; ?></div>
			<?php endif; ?>
			<div class="prm-donation-form-element prm-donation-form-payment-method">
				<?php _e('Forma de pagamento', 'prm'); ?> <span class="required" title="<?php _e('Obrigatório', 'prm'); ?>">*</span>
				<div class="prm-donation-form-payment-method-paypal">
					<label>
						<input type="radio" name="prm-donation-form-payment-method" value="paypal" id="prm-donation-form-payment-method-paypal" <?php if ('paypal' == $_POST['prm-donation-form-payment-method']) { echo 'checked="checked"'; } ?>>
						<?php _e('PayPal', 'prm'); ?>
					</label>
				</div>

				<div class="prm-donation-form-payment-method-pagseguro">
					<label>
						<input type="radio" name="prm-donation-form-payment-method" value="pagseguro" id="prm-donation-form-payment-method-pagseguro" <?php if ('pagseguro' == $_POST['prm-donation-form-payment-method']) { echo 'checked="checked"'; } ?>>
						<?php _e('PagSeguro', 'prm'); ?>
					</label>
				</div>

				<div class="prm-donation-form-payment-method-boleto">
					<label>
						<input type="radio" name="prm-donation-form-payment-method" value="boleto" id="prm-donation-form-payment-method-boleto" <?php if ('boleto' == $_POST['prm-donation-form-payment-method']) { echo 'checked="checked"'; } ?>>
						<?php _e('Boleto', 'prm'); ?>
					</label>
				</div>

				<div class="prm-donation-form-payment-method-deposito">
					<label>
						<input type="radio" name="prm-donation-form-payment-method" value="deposito" id="prm-donation-form-payment-method-deposito" <?php if ('deposito' == $_POST['prm-donation-form-payment-method']) { echo 'checked="checked"'; } ?>>
						<?php _e('Depósito', 'prm'); ?>
					</label>
				</div>
			</div>

			<div class="prm-donation-form-element prm-donation-form-subscription-amount">
				<label for="prm-donation-form-subscription-amount"><?php _e('Valor (mensal)', 'prm'); ?></label>
				<span><?php _e('R$', 'prm'); ?></span> <input type="text" name="prm-donation-form-subscription-amount" id="prm-donation-form-subscription-amount" value="<?php echo $_POST['prm-donation-form-subscription-amount']; ?>" placeholder="<?php echo get_option('prm_subscription_amount'); ?>">
			</div>

			<div class="prm-donation-form-element prm-donation-form-subscription-boleto-frequency">
				<?php _e('Valor para Boleto', 'prm'); ?> <span class="required" title="<?php _e('Obrigatório', 'prm'); ?>">*</span>
				<div class="prm-donation-form-subscription-boleto-frequency-month-3">
					<label>
						<input type="radio" name="prm-donation-form-subscription-boleto-frequency" value="month-3" id="prm-donation-form-subscription-boleto-frequency-month-3" <?php if ('month-3' == $_POST['prm-donation-form-subscription-boleto-frequency-month-3']) { echo 'checked="checked"'; } ?>>
						<?php echo sprintf(__('R$ %s (Trimestral)', 'prm'), prm_get_option('prm_subscription_boleto_month_3_amount')); ?>
					</label>
				</div>

				<div class="prm-donation-form-subscription-boleto-frequency-month-6">
					<label>
						<input type="radio" name="prm-donation-form-subscription-boleto-frequency" value="month-6" id="prm-donation-form-subscription-boleto-frequency-month-6" <?php if ('month-6' == $_POST['prm-donation-form-subscription-boleto-frequency-month-6']) { echo 'checked="checked"'; } ?>>
						<?php echo sprintf(__('R$ %s (Semestral)', 'prm'), prm_get_option('prm_subscription_boleto_month_6_amount')); ?>
					</label>
				</div>

				<div class="prm-donation-form-subscription-boleto-frequency-month-12">
					<label>
						<input type="radio" name="prm-donation-form-subscription-boleto-frequency" value="month-12" id="prm-donation-form-subscription-boleto-frequency-month-12" <?php if ('month-12' == $_POST['prm-donation-form-subscription-boleto-frequency-month-12']) { echo 'checked="checked"'; } ?>>
						<?php echo sprintf(__('R$ %s (Anual)', 'prm'), prm_get_option('prm_subscription_boleto_month_12_amount')); ?>
					</label>
				</div>
			</div>

			<div class="prm-donation-form-element prm-donation-form-subscription-deposito-frequency">
				<?php _e('Valor para Depósito', 'prm'); ?> <span class="required" title="<?php _e('Obrigatório', 'prm'); ?>">*</span>
				<div class="prm-donation-form-subscription-deposito-frequency-month-3">
					<label>
						<input type="radio" name="prm-donation-form-subscription-deposito-frequency" value="month-3" id="prm-donation-form-subscription-deposito-frequency-month-3" <?php if ('month-3' == $_POST['prm-donation-form-subscription-deposito-frequency-month-3']) { echo 'checked="checked"'; } ?>>
						<?php echo sprintf(__('R$ %s (Trimestral)', 'prm'), prm_get_option('prm_subscription_deposito_month_3_amount')); ?>
					</label>
				</div>

				<div class="prm-donation-form-subscription-deposito-frequency-month-6">
					<label>
						<input type="radio" name="prm-donation-form-subscription-deposito-frequency" value="month-6" id="prm-donation-form-subscription-deposito-frequency-month-6" <?php if ('month-6' == $_POST['prm-donation-form-subscription-deposito-frequency-month-6']) { echo 'checked="checked"'; } ?>>
						<?php echo sprintf(__('R$ %s (Semestral)', 'prm'), prm_get_option('prm_subscription_deposito_month_6_amount')); ?>
					</label>
				</div>

				<div class="prm-donation-form-subscription-deposito-frequency-month-12">
					<label>
						<input type="radio" name="prm-donation-form-subscription-deposito-frequency" value="month-12" id="prm-donation-form-subscription-deposito-frequency-month-12" <?php if ('month-12' == $_POST['prm-donation-form-subscription-deposito-frequency-month-12']) { echo 'checked="checked"'; } ?>>
						<?php echo sprintf(__('R$ %s (Anual)', 'prm'), prm_get_option('prm_subscription_deposito_month_12_amount')); ?>
					</label>
				</div>
			</div>
		</div>

		<div class="prm-donation-form-element prm-donation-form-buttons">
			<input type="submit" class="prm-donation-form-submit" name="prm-donation-form-submit" id="prm-donation-form-submit" value="<?php _e('Enviar'); ?>">
		</div>
	</form>
</div>
