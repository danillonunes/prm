(function($) {

$(function(){
	var $amount = $('.prm-amount');
	var $sandbox = $('#prm-sandbox-mode');
	var $sandboxPaypalEmail = $('#prm-paypal-sandbox-email');
	var $sandboxPagseguroEmail = $('#prm-pagseguro-sandbox-email');
	var $sandboxPagseguroToken = $('#prm-pagseguro-sandbox-token');

	$amount
		.mask('#.##0,00', {reverse: true});

	$sandbox
		.on('change init', function() {
			if ($sandbox.is(':checked')) {
				$sandboxPaypalEmail.parents('tr').show();
				$sandboxPagseguroEmail.parents('tr').show();
				$sandboxPagseguroToken.parents('tr').show();
			}
			else {
				$sandboxPaypalEmail.parents('tr').hide();
				$sandboxPagseguroEmail.parents('tr').hide();
				$sandboxPagseguroToken.parents('tr').hide();
			}
		})
		.trigger('init');
});

})(jQuery);