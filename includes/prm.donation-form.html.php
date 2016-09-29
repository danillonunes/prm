<?php defined( 'ABSPATH' ) or die( 'No direct access allowed.' ); ?>
<div class="prm-donation-form">
	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
		<div class="prm-donation-form-element prm-donation-form-name">
			<label for="prm-donation-form-name"><?php _e('Nome', 'prm'); ?> <span class="required" title="<?php _e('Obrigatório', 'prm'); ?>">*</span></label>
			<input type="text" name="prm-donation-form-name" id="prm-donation-form-name" required>
		</div>

		<div class="prm-donation-form-element prm-donation-form-email">
			<label for="prm-donation-form-email"><?php _e('Email', 'prm'); ?> <span class="required" title="<?php _e('Obrigatório', 'prm'); ?>">*</span></label>
			<input type="email" name="prm-donation-form-email" id="prm-donation-form-email" required>
		</div>

		<div class="prm-donation-form-element prm-donation-form-phone">
			<label for="prm-donation-form-phone"><?php _e('Telefone', 'prm'); ?> <span class="required" title="<?php _e('Obrigatório', 'prm'); ?>">*</span></label>
			<input type="text" name="prm-donation-form-phone" id="prm-donation-form-phone" required>
		</div>

		<div class="prm-donation-form-address">
			<div class="prm-donation-form-element prm-donation-form-address-postal-code">
				<label for="prm-donation-form-address-postal-code">
					<?php _e('CEP', 'prm'); ?> <span class="required" title="<?php _e('Obrigatório', 'prm'); ?>">*</span>
				</label>
				<input type="text" name="prm-donation-form-address-postal-code" id="prm-donation-form-address-postal-code" required>
			</div>

			<div class="prm-donation-form-element prm-donation-form-address-thoroughfare">
				<label>
					<?php _e('Logradouro', 'prm'); ?> <span class="required" title="<?php _e('Obrigatório', 'prm'); ?>">*</span>
					<input type="text" name="prm-donation-form-address-thoroughfare" id="prm-donation-form-address-thoroughfare" required>
				</label>
			</div>

			<div class="prm-donation-form-element prm-donation-form-address-premise">
				<label>
					<?php _e('Número', 'prm'); ?>
					<input type="text" name="prm-donation-form-address-premise" id="prm-donation-form-address-premise">
				</label>
			</div>

			<div class="prm-donation-form-element prm-donation-form-address-sub-premise">
				<label>
					<?php _e('Complemento', 'prm'); ?>
					<input type="text" name="prm-donation-form-address-sub-premise" id="prm-donation-form-address-sub-premise">
				</label>
			</div>

			<div class="prm-donation-form-element prm-donation-form-address-dependent-locality">
				<label>
					<?php _e('Bairro', 'prm'); ?> <span class="required" title="<?php _e('Obrigatório', 'prm'); ?>">*</span>
					<input type="text" name="prm-donation-form-address-dependent-locality" id="prm-donation-form-address-dependent-locality" required>
				</label>
			</div>

			<div class="prm-donation-form-element prm-donation-form-address-locality">
				<label>
					<?php _e('Cidade', 'prm'); ?> <span class="required" title="<?php _e('Obrigatório', 'prm'); ?>">*</span>
					<input type="text" name="prm-donation-form-address-locality" id="prm-donation-form-address-locality" required>
				</label>
			</div>

			<div class="prm-donation-form-element prm-donation-form-address-administrative-area">
				<label>
					<?php _e('Estado', 'prm'); ?> <span class="required" title="<?php _e('Obrigatório', 'prm'); ?>">*</span>
					<select name="prm-donation-form-address-administrative-area" id="prm-donation-form-address-administrative-area" required>
						<option value=""><?php _e('--', 'prm'); ?></option>
						<option value="AC"><?php _e('Acre', 'prm'); ?></option>
						<option value="AL"><?php _e('Alagoas', 'prm'); ?></option>
						<option value="AP"><?php _e('Amapá', 'prm'); ?></option>
						<option value="AM"><?php _e('Amazonas', 'prm'); ?></option>
						<option value="BA"><?php _e('Bahia', 'prm'); ?></option>
						<option value="CE"><?php _e('Ceará', 'prm'); ?></option>
						<option value="DF"><?php _e('Distrito Federal', 'prm'); ?></option>
						<option value="ES"><?php _e('Espírito Santo', 'prm'); ?></option>
						<option value="GO"><?php _e('Goiás', 'prm'); ?></option>
						<option value="MA"><?php _e('Maranhão', 'prm'); ?></option>
						<option value="MT"><?php _e('Mato Grosso', 'prm'); ?></option>
						<option value="MS"><?php _e('Mato Grosso do Sul', 'prm'); ?></option>
						<option value="MG"><?php _e('Minas Gerais', 'prm'); ?></option>
						<option value="PA"><?php _e('Pará', 'prm'); ?></option>
						<option value="PB"><?php _e('Paraíba', 'prm'); ?></option>
						<option value="PR"><?php _e('Paraná', 'prm'); ?></option>
						<option value="PE"><?php _e('Pernambuco', 'prm'); ?></option>
						<option value="PI"><?php _e('Piauí', 'prm'); ?></option>
						<option value="RJ"><?php _e('Rio de Janeiro', 'prm'); ?></option>
						<option value="RN"><?php _e('Rio Grande do Norte', 'prm'); ?></option>
						<option value="RS"><?php _e('Rio Grande do Sul', 'prm'); ?></option>
						<option value="RO"><?php _e('Rondônia', 'prm'); ?></option>
						<option value="RR"><?php _e('Roraima', 'prm'); ?></option>
						<option value="SC"><?php _e('Santa Catarina', 'prm'); ?></option>
						<option value="SP"><?php _e('São Paulo', 'prm'); ?></option>
						<option value="SE"><?php _e('Sergipe', 'prm'); ?></option>
						<option value="TO"><?php _e('Tocantins', 'prm'); ?></option>
					</select>
				</label>
			</div>
		</div>

		<div class="prm-donation-form-element prm-donation-form-payment-method">
			<?php _e('Forma de pagamento', 'prm'); ?> <span class="required" title="<?php _e('Obrigatório', 'prm'); ?>">*</span>
			<div class="prm-donation-form-payment-method-paypal">
				<label>
					<input type="radio" name="prm-donation-form-payment-method" value="paypal" id="prm-donation-form-payment-method-paypal">
					<?php _e('PayPal', 'prm'); ?>
				</label>
			</div>

			<div class="prm-donation-form-payment-method-pagseguro">
				<label>
					<input type="radio" name="prm-donation-form-payment-method" value="pagseguro" id="prm-donation-form-payment-method-pagseguro">
					<?php _e('PagSeguro', 'prm'); ?>
				</label>
			</div>

			<div class="prm-donation-form-payment-method-boleto">
				<label>
					<input type="radio" name="prm-donation-form-payment-method" value="boleto" id="prm-donation-form-payment-method-boleto">
					<?php _e('Boleto', 'prm'); ?>
				</label>
			</div>

			<div class="prm-donation-form-payment-method-deposito">
				<label>
					<input type="radio" name="prm-donation-form-payment-method" value="deposito" id="prm-donation-form-payment-method-deposito">
					<?php _e('Depósito', 'prm'); ?>
				</label>
			</div>
		</div>

		<div class="prm-donation-form-element prm-donation-form-buttons">
			<input type="submit" class="prm-donation-form-submit" name="prm-donation-form-submit" id="prm-donation-form-submit" value="<?php _e('Enviar'); ?>">
		</div>
	</form>
</div>
