<?php

add_action('plugins_loaded', 'prm_subscription_submit');

function prm_subscription_submit() {
	if (isset($_POST['prm-donation-form-submit'])) {
		include_once(PRM_PLUGIN_DIR . '/includes/prm.donation-form.submit.php');
		$values = prm_donation_form_values($_POST);
		$payment = prm_donation_form_submit_payment($values);

		if ($payment['status'] == 'completed') {
			prm_donation_form_submit_email($values);
		}
		if (isset($payment['redirect'])) {
			wp_redirect($payment['redirect']);
			exit;
		}
	}
}

function prm_donation_form() {
	$html = '';

	if (!isset($_POST['prm-donation-form-submit'])) {
		ob_start();
		include(PRM_PLUGIN_DIR . '/includes/prm.donation-form.html.php');
		$html = ob_get_clean();
	}

	return $html;
}

function prm_subscription_message() {
	$html = '';

	if (isset($_REQUEST['prm-donation-payment-method'])) {
		switch ($_REQUEST['prm-donation-payment-method']) {
			case 'paypal':
			case 'pagseguro':
			case 'deposito':
			case 'boleto':
				$html = get_option('prm_subscription_' . $_REQUEST['prm-donation-payment-method'] . '_message');
				break;
		}
	}

	return $html;
}
