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
	var $phone = $('#prm-donation-form-phone');
	var $postal = $('#prm-donation-form-address-postal-code');
	var $postalEl = $postal.parents('.prm-donation-form-element');
	var $postalMsg = $postal.after('<span class="msg"></span>').next('.msg');
	var $administrativeArea = $('#prm-donation-form-address-administrative-area');
	var $locality = $('#prm-donation-form-address-locality');
	var $dependentLocality = $('#prm-donation-form-address-dependent-locality');
	var $thoroughfare = $('#prm-donation-form-address-thoroughfare');
	var $premise = $('#prm-donation-form-address-premise');

	$phone.mask(phoneMaskCallback, phoneMaskOptions);

	$postal
		.mask('00000-000')
		.on('loading-start', function() {
			$postalEl.addClass('loading');
			$postalMsg.text('Carregando endereço...');
		})
		.on('loading-error', function() {
			$postal.trigger('loading-clean');
			$postalEl.addClass('error');
			$postalMsg.text('Não foi encontrado um endereço para o CEP informado.');
		})
		.on('loading-clean', function() {
			$postalEl
				.removeClass('error')
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
						$administrativeArea.val(data.uf);
						$locality.val(data.localidade);
						$dependentLocality.val(data.bairro);
						$thoroughfare.val(data.logradouro);
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