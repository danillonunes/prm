<?php

function prm_donation_form_submit($values) {
	$html = '';

	$message_sent = prm_donation_form_submit_email($values);

	return $html;
}

function prm_donation_form_submit_email($values) {
	$to = get_bloginfo('admin_email');
	$subject = sprintf(__('Nova inscrição em %s'), get_bloginfo('name'));
	$message = prm_donation_form_submit_email_message($values);

	$headers[] = 'Content-Type: text/html; charset=UTF-8';
	$headers[] = 'Reply-To: ' . $values['prm-donation-form-name'] . ' <' . $values['prm-donation-form-email'] . '>';

	return wp_mail($to, $subject, $message, $headers);
}

function prm_donation_form_submit_email_message($values) {
	$name = $values['prm-donation-form-name'];
	$email = $values['prm-donation-form-email'];
	$phone = $values['prm-donation-form-phone'];

	$thoroughfare = $values['prm-donation-form-address-thoroughfare'];
	$premise = $values['prm-donation-form-address-premise'];
	$sub_premise = $values['prm-donation-form-address-sub-premise'];

	$dependent_locality = $values['prm-donation-form-address-dependent-locality'];
	$locality = $values['prm-donation-form-address-locality'];
	$administrative_area = $values['prm-donation-form-address-administrative-area'];
	$postal_code = $values['prm-donation-form-address-postal-code'];

	$payment_methods = array(
		'paypal' => __('PayPal', 'prm'),
		'pagseguro' => __('PagSeguro', 'prm'),
		'deposito' => __('Depósito', 'prm'),
		'boleto' => __('Boleto', 'prm'),
	);

	$payment_method = isset($payment_methods[$values['prm-donation-form-payment-method']]) ? $payment_methods[$values['prm-donation-form-payment-method']] : '';

	ob_start();
	include(PRM_PLUGIN_DIR . '/includes/prm.donation-form.message.html.php');
	return ob_get_clean();
}
