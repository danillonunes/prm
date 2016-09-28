<?php

function prm_donation_form_submit($values) {
	$html = '';

	switch ($values['prm-donation-form-payment-method']) {
		case 'paypal':
			$html = __('PayPal selected.', 'prm');
			break;
		case 'pagseguro':
			$html = __('PagSeguro selected.', 'prm');
			break;
		case 'deposito':
			$html = __('Depósito selected.', 'prm');
			break;
		case 'boleto':
			$html = __('Boleto selected.', 'prm');
			break;
	}

	return $html;
}
