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
	var $administrativeArea = $('#prm-donation-form-address-administrative-area');
	var $locality = $('#prm-donation-form-address-locality');
	var $dependentLocality = $('#prm-donation-form-address-dependent-locality');
	var $thoroughfare = $('#prm-donation-form-address-thoroughfare');
	var $premise = $('#prm-donation-form-address-premise');

	$phone.mask(phoneMaskCallback, phoneMaskOptions);

	$postal
		.mask('00000-000')
		.on('change', function() {
			$.getJSON('http://viacep.com.br/ws/' + $postal.val().replace(/-/, '') + '/json/', function(data) {
				$administrativeArea.val(data.uf);
				$locality.val(data.localidade);
				$dependentLocality.val(data.bairro);
				$thoroughfare.val(data.logradouro);
				$premise.trigger('focus');
			});
		});
});

})(jQuery);