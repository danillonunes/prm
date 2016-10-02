(function($) {

var phoneMaskCallback = function(val) {
	return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
};
var phoneMaskOptions = {
	onKeyPress: function(val, e, field, options) {
		field.mask(phoneMaskCallback.apply({}, arguments), options);
	}
};

$(function(){
	var $form = $('#prm-donation-form');
	var $required = $form.find('[required]');
	var $paymentMethods = $form.find('.prm-donation-form-payment-method input');
	var $phone = $('#prm-donation-form-phone');
	var $postal = $('#prm-donation-form-address-postal-code');
	var $postalEl = $postal.parents('.prm-donation-form-element');
	var $postalMsg = $postal.after('<span class="msg"></span>').next('.msg');
	var $administrativeArea = $('#prm-donation-form-address-administrative-area');
	var $locality = $('#prm-donation-form-address-locality');
	var $dependentLocality = $('#prm-donation-form-address-dependent-locality');
	var $thoroughfare = $('#prm-donation-form-address-thoroughfare');
	var $premise = $('#prm-donation-form-address-premise');
	var $amount = $('#prm-donation-form-subscription-amount');

	$form
		.on('submit', function(e) {
			var error = false;
			$required.each(function() {
				$input = $(this);
				if ($input.val() == '') {
					error = true;
					$input.parents('.prm-donation-form-element').addClass('prm-donation-form-element-error');
				}
			});

			if (!$paymentMethods.filter(':checked').length) {
				error = true;
				$paymentMethods.parents('.prm-donation-form-element').addClass('prm-donation-form-element-error');
			}

			if (error) {
				$('html, body').scrollTop($form.offset().top);
				return false;
			}
		});

	$required.add($paymentMethods)
		.on('change', function() {
			$(this).parents('.prm-donation-form-element').removeClass('prm-donation-form-element-error');
		});

	$amount.mask('#.##0,00', {reverse: true});

	$paymentMethods
		.on('change', function() {
			$paymentMethods
				.parents('div').removeClass('prm-donation-form-element-checked');
			$paymentMethods.filter(':checked')
				.parents('div').addClass('prm-donation-form-element-checked');

			if ($paymentMethods.filter('#prm-donation-form-payment-method-paypal:checked,#prm-donation-form-payment-method-pagseguro:checked').length) {
				$amount.parents('.prm-donation-form-element').show();
			}
			else {
				$amount.parents('.prm-donation-form-element').hide();
			}
		})
		.trigger('change');

	$phone.mask(phoneMaskCallback, phoneMaskOptions);

	$postal
		.mask('00000-000')
		.on('loading-start', function() {
			$postalEl.addClass('loading');
			$postalMsg.text('Carregando endereço...');
		})
		.on('loading-error', function() {
			$postal.trigger('loading-clean');
			$postalEl.addClass('prm-donation-form-element-error');
			$postalMsg.text('CEP não encontrado.');
		})
		.on('loading-clean', function() {
			$postalEl
				.removeClass('prm-donation-form-element-error')
				.removeClass('loading');
			$postalMsg.text('');
		})
		.on('change', function() {
			$postal
				.trigger('loading-clean')
				.trigger('loading-start');
			$.ajax({
				'dataType': 'json',
				'url': 'http://viacep.com.br/ws/' + $postal.val().replace(/-/, '') + '/json/',
				'success': function(data) {
					if (data.erro) {
						$postal.trigger('loading-error');
					}
					else {
						$administrativeArea.val(data.uf).trigger('change');
						$locality.val(data.localidade).trigger('change');
						$dependentLocality.val(data.bairro).trigger('change');
						$thoroughfare.val(data.logradouro).trigger('change');
						$premise.trigger('focus');
						$postal.trigger('loading-clean');
					}
				},
				'error': function() {
					$postal.trigger('loading-error');
				},
			});
		});
});

})(jQuery);